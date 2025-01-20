<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Odcuser;
use App\Models\Activite;
use App\Models\Candidat;
use App\Models\CandidatAttribute;
use App\Models\Presence;
use App\Models\Userlocal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PresenceController extends Controller
{
    public function updatePresences(Request $request)
    {
        $presences = $request->input('presences');

        foreach ($presences as $candidateId => $dates) {
            $existingPresences = Presence::where('candidat_id', $candidateId)->pluck('date')->toArray();

            $datesToRemove = array_diff($existingPresences, $dates);
            if (!empty($datesToRemove)) {
                Presence::where('candidat_id', $candidateId)
                    ->whereIn('date', $datesToRemove)
                    ->delete();
            }

            foreach ($dates as $date) {
                $presence = Presence::where('candidat_id', $candidateId)
                    ->where('date', $date)
                    ->first();

                if (!$presence) {
                    // Si la présence n'existe pas, on la crée
                    Presence::create([
                        'candidat_id' => $candidateId,
                        'date' => $date
                    ]);
                }
            }
        }

        return redirect()->back()->with('success', 'Presences updated successfully.');
    }

    public function index()
    {
        $presences = Presence::orderBy('id')->get();

        return view('presences.presence', compact('presences'));
    }

    public function create($id, Request $request)
    {
        $selected = $request->query('selected');
        $selectedids = explode(',', $id);
        $events = [];
        foreach ($selectedids as $key => $value) {
            $events[] = Activite::find($value);
        }
        $activite = Activite::find($id);
        return view('presences.selection', compact('id', 'activite', 'events'));
    }

    public function filtrer(Request $request, $id)
    {
        $coordonnee = $request->input('coordonnee');

        $re = '/(^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$)|([0-9]{9})$/m';

        preg_match($re, $coordonnee, $value);

        $activity = Activite::find($id);

        if (isset($value[1]) && $value[1] !== "") {
            $email = $value[1];
            $odcuser = Odcuser::where('email', $email)->first();

            // Vérifier si l'utilisateur existe
            if (!$odcuser) {
                return [
                    'error' => 'Désolé, vous n\'avez pas de compte. Contactez un agent de la sécurité pour vous créer un compte. Merci !',
                    'title' => $activity->title,
                ];
            }

            // Vérifier si le candidat est inscrit à l'activité
            $candidat = DB::table('candidat_attributes')
                ->select(
                    'candidat_attributes.candidat_id',
                    'candidats.odcuser_id',
                    'candidats.id',
                    'odcusers.first_name',
                    'odcusers.last_name',
                    'odcusers.email',
                    'activites.title'
                )
                ->join('candidats', 'candidats.id', '=', 'candidat_attributes.candidat_id')
                ->join('activites', 'activites.id', '=', 'candidats.activite_id')
                ->join('odcusers', 'odcusers.id', '=', 'candidats.odcuser_id')
                ->where('candidat_attributes.value', 'like', "%$email%")
                ->where('candidats.activite_id', $id)
                ->where('candidats.status', 'accept')
                ->first();

            if (!$candidat) {
                return [
                    'error' => 'Désolé, vous n\'êtes pas enregistré sur cette activité. Merci !',
                    'title' => $activity->title,
                ];
            }

            // Retourner les informations du candidat
            return [
                'prenom' => $odcuser->first_name,
                'nom' => $odcuser->last_name,
                'email' => $odcuser->email,
                'id' => $id,
                'activite' => $activity->title,
            ];
        } elseif (isset($value[2]) || is_int($value[2])) {
            $numero = $value[2];
            $candidat = DB::table('candidat_attributes')
                ->select('candidat_attributes.candidat_id', 'candidats.odcuser_id', 'candidats.id', 'odcusers.first_name', 'odcusers.last_name', 'odcusers.email', 'activites.title')
                ->join('candidats', 'candidats.id', '=', 'candidat_attributes.candidat_id')
                ->join('activites', 'activites.id', '=', 'candidats.activite_id')
                ->join('odcusers', 'odcusers.id', '=', 'candidats.odcuser_id')
                ->where('candidat_attributes.value', 'like', "%$numero%")
                ->where('candidats.activite_id', $id)
                ->where('candidats.status', 'accept')
                ->first();


            if (!isset($candidat)) {
                return [
                    'error' => 'Désolé, vous n\'êtes pas enregistré sur cette activité. Merci !',
                    'title' => $activity->title
                ];
            }

            return [
                'prenom' => $candidat->first_name,
                'nom' => $candidat->last_name,
                'email' => $candidat->email,
                'id' => $id,
                'activite' => $activity->title
            ];
        }
    }

    public function store(Request $request)
    {
        $prenom = $request->input('firstname');
        $nom = $request->input('lastname');
        $email = $request->input('email');
        $idactivite = $request->input('id');

        $odcuser = DB::table('odcusers')
            ->where('first_name', $prenom)
            ->where('last_name', $nom)
            ->where('email', $email)
            ->select('id')
            ->first();

        if ($odcuser) {
            $candidat = DB::table('candidats')
                ->where('candidats.activite_id', $idactivite)
                ->where('candidats.odcuser_id', $odcuser->id)
                ->select('candidats.id', 'candidats.activite_id')
                ->first();

            $date = now()->format('Y-m-d');

            if (!$candidat) {
                $createdCandidat = Candidat::firstOrCreate([
                    'odcuser_id' => $odcuser->id,
                    'activite_id' => $idactivite,
                    'status' => 'accept'
                ]);

                $presenceExists = Presence::where('candidat_id', $createdCandidat->id)
                    ->whereDate('date', $date)
                    ->exists();

                if (!$presenceExists) {
                    Presence::create([
                        'candidat_id' => $createdCandidat->id,
                        'date' => $date
                    ]);
                    session(['confirmation_access' => true]);
                    return view('presences.confirmation');
                } else {
                    return redirect('activitencours')->with('error', 'Votre presence pour cette journée existe déjà');
                }
            }

            $presenceExists = Presence::where('candidat_id', $candidat->id)
                ->whereDate('date', $date)
                ->exists();

            if (!$presenceExists) {
                Presence::create([
                    'candidat_id' => $candidat->id,
                    'date' => $date
                ]);
                session(['confirmation_access' => true]);
                return view('presences.confirmation');
            } else {
                return redirect('activitencours')->with('error', 'Votre presence pour cette journée existe déjà');
            }
        } else {
            return back()->with('error', 'Désole, vous n\'avez pas de compte. Contactez un agent de la sécurité pour vous créer un compte. Merci !');
        }
    }


    public function encours()
    {
        $today = Carbon::today();
        $activites = Activite::where('start_date', '<=', $today)->where('end_date', '>=', $today)->get();

        return view('presences.activiteEncours', compact('activites'));
    }


    public function userlocal(Request $request)
    {
        $odcuser = Odcuser::where('email', $request->input('email'))->first();

        if ($odcuser) {
            // Create candidat
            $candidat = Candidat::firstOrCreate([
                'odcuser_id' => $odcuser->id,
                'activite_id' => $request->input('activite'),
                'status' => 'accept',
            ]);

            $candidatAttributes = CandidatAttribute::firstOrCreate([
                'candidat_id' => $candidat->id,
                'label' => 'Téléphone',
                'value' => $request->input('phone')
            ]);
        } else {
            // Validate incoming data
            $validated = $request->validate([
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'gender' => 'required',
                'phone' => 'required|string|max:15',
                'email' => 'nullable|string|email|unique:odcusers,email',
                'activite' => 'required|exists:activites,id'
            ], [
                'first_name.required' => 'Le prénom est obligatoire.',
                'last_name.required' => 'Veuillez renseigner le nom.',
                'gender.required' => 'Veuillez spécifier le genre.',
                'phone.required' => 'Le numéro de téléphone est obligatoire.',
                'email.unique' => 'Cette adresse est déjà prise !',
            ]);

            // Create or update ODC user
            $userlocal = Odcuser::firstOrCreate([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'gender' => $validated['gender'],
            ]);

            // Create candidat
            $candidat = Candidat::firstOrCreate([
                'odcuser_id' => $userlocal->id,
                'activite_id' => $validated['activite'],
                'status' => 'accept',
            ]);

            $candidatAttributes = CandidatAttribute::firstOrCreate([
                'candidat_id' => $candidat->id,
                'label' => 'Téléphone',
                'value' => $validated['phone'],
            ]);
        }

        // Check if presence already exists
        $date = now()->format('Y-m-d');
        $presenceExists = Presence::where('candidat_id', $candidat->id)
            ->whereDate('date', $date)
            ->exists();

        if ($request->input('createdByAdmin')) {
            return redirect()->back()->with('success', 'Le participant a été ajouté à l\'activité avec succès !.');
        }

        if (!$presenceExists) {
            // Create new presence
            Presence::create([
                'candidat_id' => $candidat->id,
                'date' => $date
            ]);
        } else {
            return redirect()->route('activitencours')->with('error', 'La présence de ce candidat pour ce jour existe déjà');
        }

        return view('presences.confirmation')->with('success', 'Utilisateur créé avec succès.');
    }

    public function security()
    {
        $today = Carbon::today();
        $activites = Activite::where('start_date', '<=', $today)->where('end_date', '>=', $today)->get();

        return view('presences.securite', compact('activites'));
    }

    public function confirmation()
    {
        if (!session('enregistrement_complet')) {
            return redirect()->route('activitencours');
        }
        session()->forget('confirmation_access');

        return view('presences.confirmation');
    }
}
