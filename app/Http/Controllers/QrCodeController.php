<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Activite;
use App\Models\Candidat;
use App\Models\Presence;
use Choowx\RasterizeSvg\Svg;

use Illuminate\Http\Request;
use function Laravel\Prompts\error;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class QrCodeController extends Controller
{
    public function index(Request $request)
    {
        $ipaddress = env('IP_ADDRESS');
        $code = QrCode::size(300)->generate($ipaddress);
        return view('presences.index', ['code' => $code]);
    }
    public function generercodeqr($id)
    {
        $candidatsAccept = Candidat::leftJoin('activites', 'candidats.activite_id', '=', 'activites.id')
            ->where('candidats.status', 'accept')
            ->where('activites.id', $id)
            ->select('candidats.*')
            ->get();

        if (!$candidatsAccept->isEmpty()) {
            foreach ($candidatsAccept as $candidat) {
                $candidatId = $candidat->id;
                $activiteId = $id;

                // Générer l'URL vers la route activite.show avec les paramètres activiteId et candidatId
                $url = route('scaner.qrcode', ['activiteId' => $activiteId, 'candidatId' => $candidatId]);

                // Générer le QR Code en format PNG
                $qrCode = QrCode::format('png')->size(300)->generate($url);

                // Chemin de stockage des fichiers dans 'storage/app/public/qrcodes'
                $directory = storage_path('app/public/qrcodes');
                if (!is_dir($directory)) {
                    mkdir($directory, 0755, true);
                }

                // Chemin complet de l'image QR Code
                $imagePath = "$directory/qrcode_$candidatId.png";

                file_put_contents($imagePath, $qrCode);
                $candidat->codeqr = 'qrcodes/qrcode_' . $candidatId . '.png';
                $candidat->save();
            }
            return redirect()->back()->with('success', 'QR Codes générés avec succès.');
        } else {
            return redirect()->back()->with('success', 'Pas de participant pour cette activité, donc pas moyen de générer le QR Code!');
        }
    }

    public function ScanerQrcode($activiteId, $candidatId)
    {
        try {
            Log::info('Début du processus de scan de QR code', ['activityId' => $activiteId, 'candidateId' => $candidatId]);

            // Récupérer l'activité
            $activite = Activite::findOrFail($activiteId);
            Log::info('Activité trouvée', ['activityName' => $activite->title]);

            // Vérification de l'existence du candidat et de l'association à l'activité
            $candidat = Candidat::where('id', $candidatId)
                ->where('activite_id', $activiteId)
                ->where('status', 'accept') // Vérifiez si le statut est accepté
                ->with('odcuser') // Charge l'utilisateur associé
                ->firstOrFail();



            $fullname = $candidat->odcuser->first_name . ' ' . $candidat->odcuser->last_name;
            $mail = $candidat->odcuser->email;
            $profileImage = $candidat->odcuser->picture ?: 'https://img.freepik.com/free-vector/teen-boy-with-smile-face_1308-130771.jpg';

            Log::info('Candidat accepté trouvé', [
                'candidateName' => $fullname,
                'activityName' => $activite->title,
                'email' => $mail,
                'profile' =>  $profileImage
            ]);

            return response()->json([
                'candidateName' => $fullname,
                'candidateEmail' => $candidat->odcuser->email,
                'activityName' => $activite->title,
                'candidatId' => $candidatId,
                'email' => $mail,
                'profile' =>  $profileImage
            ]);
        } catch (ModelNotFoundException $e) {
            Log::error('Activité ou candidat non trouvé', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Activité ou candidat non trouvé ou non accepté'], 404);
        } catch (Exception $e) {
            Log::error('Erreur inattendue lors du scan de QR code', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Une erreur inattendue s\'est produite'], 500);
        }
    }




    public function participant($id)
    {
        $candidat = Candidat::find($id);
        if ($candidat && $candidat->codeqr) {
            $qrCodeUrl = Storage::url($candidat->codeqr);
            return view('presences.enregistrement', compact('candidat', 'qrCodeUrl', 'id'));
        }
    }

    public function store($id, Request $request)
    {
        $date = $request->input('date', now()->format('Y-m-d'));
        $candidat = Candidat::find($id);

        if (!$candidat) {
            return response()->json([
                'success' => false,
                'message' => 'Candidat non trouvé.'
            ], 404);
        }

        $presenceExists = Presence::where('candidat_id', $id)
            ->whereDate('date', $date)
            ->exists();

        if (!$presenceExists) {
            Presence::create([
                'candidat_id' => $id,
                'date' => $date
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Votre présence a été enregistrée avec succès.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Votre présence pour cette journée est déjà enregistrée.'
            ]);
        }
    }
}
