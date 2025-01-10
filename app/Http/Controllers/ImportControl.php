<?php

namespace App\Http\Controllers;

use ZipArchive;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use DateTimeImmutable;
use App\Models\Odcuser;
use App\Models\Activite;
use App\Models\Candidat;
use App\Models\Presence;
use App\Models\Certificat;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\CandidatAttribute;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use App\Http\Controllers\CertificatController;

class ImportControl extends Controller
{
    public function index()
    {
        $activites = Activite::all();
        return view('components.activite-import'/*'import.import'*/, ['activites' => $activites]);
    }

    public function import(Request $request)
    {
        // Valider le fichier uploadé
        $request->validate([
            'file' => 'required',
            'activite' => 'required|exists:activites,id', // Valide que l'activité sélectionnée existe dans la table des activités
        ]);

        // Récupérer l'ID de l'activité à partir du formulaire
        //$activiteId = $request->activite;
        $activiteId = $request->activite;


        // Lire le fichier
        $file = $request->file('file');
        $fileContents = file($file->getPathname());
        // Supposons que le fichier CSV contient des en-têtes
        $header = str_getcsv(array_shift($fileContents));
        //dd($this->activiteId);
        // Parcourir les lignes du fichier CSV
        foreach ($fileContents as $line) {
            $data = str_getcsv($line);
            $rowData = array_combine($header, $data);
            // Valider les données de chaque ligne
            //dump($rowData);
            //dd($rowData['status']);
            try {
                $validatedData = $this->validateRowData($rowData);
                //dump($validatedData);
                // Chercher l'utilisateur par email ou par post-nom
                //$cond = [$validatedData['email']];
                /*if(empty($cond)){
                    $cond = [$validatedData['last_name']];
                } */
                $odcuser = Odcuser::where('email', $validatedData['email'])->first();
                //dd($odcuser);


                $validatedData['birth_date'] = '1970-02-05';
                $validatedData['password'] = 'kdjksjfkndjskjd5555';
                $validatedData['profession'] = "{'profession':'etudiant'}";
                //$validatedData['odc_country'] = "{'country':'congo'}";
                $validatedData['role'] = 'user';
                $validatedData['is_active'] = '1';
                $validatedData['_id'] = 'test';
                $validatedData['createdAt'] = date("Y-m-d h:i:s ");
                $validatedData['updatedAt'] = date("Y-m-d h:i:s ");
                //$validatedData['status']= 0;

                //$odcuser = Odcuser::firstOrCreate($cond, $validatedData);
                if ($odcuser) {
                    // Si l'utilisateur existe déjà, on recupere simplement son id.
                    $odcuser->update($validatedData);
                } else {
                    // Sinon, créez un nouvel utilisateur
                    $odcuser = Odcuser::create($validatedData);
                }

                //dd($odcuser);
                // Ajouter l'utilisateur à la table 'candidat'
                $candidat = Candidat::firstOrCreate(
                    [
                        'odcuser_id' => $odcuser->id,
                        'activite_id' => $activiteId
                    ],
                    [
                        'status' => $rowData['status']
                    ]
                );
                //sauvegarde numero
                if (empty($rowData['numero'])) {
                    $rowData['numero'] = 'non defini';
                }
                $setNumber = CandidatAttribute::firstOrCreate(
                    [
                        'candidat_id' => $candidat->id,
                        '_id' => $odcuser->_id,
                        'label' => 'numero',
                        'value' => $rowData['numero']
                    ]
                );
                //dd($setNumber);
                //sauvegarde université
                if (empty($rowData['etablissement/université'])) {
                    $rowData['etablissement/université'] = 'non defini';
                }
                $setEtablissement = CandidatAttribute::firstOrCreate(
                    [
                        'candidat_id' => $candidat->id,
                        '_id' => $odcuser->_id,
                        'label' => 'Etablissement/Université',
                        'value' => $rowData['etablissement/université']
                    ]
                );
                //dd($setEtablissement);

                //dd($candidat);

                $keyAsValue = $header;
                $position = $keyAsValue[6];
                //dd($position);
                $dateSave = explode('_', $position);
                //dd($dateSave[1]);
                //dd($position);
                //dd($rowData($keyAsValue[6]));
                $valueOfKey = $rowData[$position];
                if ($valueOfKey == 1) {

                    $presence = Presence::firstOrCreate(
                        [
                            'candidat_id' => $candidat->id,
                        ],
                        [
                            'date' => $dateSave[1],
                            'candidat_id' => $candidat->id,
                        ]
                    );
                } else {
                    continue;
                }
                //dd($rowData[$position]);
                //dd(array_keys($rowData));
                //array_keys
                /*
                $date = $rowData['Date_1977-01-01'];
                //dd($date);
                //on remplie la table presence
                $datemodif = explode('_', $date);
                */
                /*
                if (empty($date)){
                    continue; // Skip rows with empty date
                }else{
                    /*Presence::create([
                        'date' => $datemodif[1],
                        'candidat_id' => $candidat->id,
                    ]);*/
                /*
                    Presence::firstOrCreate(
                        [
                            'candidat_id' => $candidat->id,
                        ],
                        [
                            'date' => $datemodif[1],
                            'candidat_id' => $candidat->id,
                        ]
                    );
                } */
                //dd($date);

                //dump($validatedData['statut']);
            } catch (\Illuminate\Validation\ValidationException $e) {
                Log::error('Validation failed for row: ', ['row' => $rowData, 'errors' => $e->errors()]);
                // Add error message to the session
                session()->flash('error', 'Validation failed for one or more rows. Please check the logs for details.');
                continue; // Skip invalid rows
            } catch (\Exception $e) {
                Log::error('An error occurred while processing row: ', ['row' => $rowData, 'error' => $e->getMessage()]);
                // Add error message to the session
                session()->flash('error', 'An error occurred while processing the import. Please check the logs for details.');
                continue; // Skip rows with errors
            }
        }


        return redirect()->back()->with('success', 'Importation exécutée avec succès');
    }

    private function validateRowData($rowData)
    {
        // Définir les règles de validation spécifiques
        $validator = Validator::make($rowData, [
            'first_name' => '',
            'last_name' => '',
            'email' => '',
            'password' => '',
            'gender' => '',
            'birth_date' => '',
            'linkedin' => '',
            'profession' => '',
            'odc_country' => '',
            'role' => '',
            'is_active' => '',
            'hashtags' => '',
            'coding_school' => '',
            'fablab_solidaire' => '',
            'training' => '',
            'internship' => '',
            'event' => '',
            'subscribe' => '',
            'newsletters' => '',
            'topics' => '',
            'last_connection' => '',
            '_id' => '',
            'detail_profession' => '',
            'createdAt' => '',
            'updatedAt' => '',
            '__v' => '',
            'picture' => '',
            'user_cv' => '',
            /*'status' => ''*/
        ]);

        // Si la validation échoue, lever une exception
        if ($validator->fails()) {
            throw new \Illuminate\Validation\ValidationException($validator);
        }

        return $validator->validated();
    }

    public function store(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'activite' => 'required',
        ]);

        // Faire quelque chose avec les données (par exemple, les stocker dans une base de données)

        return redirect()->back()->with('success', 'Importation exécutée avec succès');
    }



    //function pour import hors activite

    public function indexacti()
    {
        $activites = Activite::all();
        return view(/*'components.activite-import'*/'import.import', ['activites' => $activites]);
    }

    public function exportModel(Request $request)
    {
        // Récupérer l'ID de l'activité à partir du formulaire
        $activiteId = $request->activite;
        //header of our spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Model 1'); // This is where I set the title of my sheet
        /*here is the header of my sheet*/
        $sheet->setCellValue('A1', 'first_name');
        $sheet->setCellValue('B1', 'last_name');
        $sheet->setCellValue('C1', 'email');
        $sheet->setCellValue('D1', 'gender');
        $sheet->setCellValue('E1', 'numero');
        $sheet->setCellValue('F1', 'Etablissement/univerisité');
        $sheet->setCellValue('G1', 'Date_1977-01-01');
        $sheet->setCellValue('H1', 'status'); //
        $row = 2; // Initialize row counter

        //dd($activiteId);
        $participants = Candidat::where('activite_id', $activiteId)->where('status', 'accept')->get();
        //dd($participants);
        //handle sheet



        foreach ($participants as $participant) {
            //recuperation et filtrage des numeros de telephone
            $phoneNumberResult = DB::table('candidat_attributes')
                ->whereRaw('LENGTH(CAST(RIGHT(value, 9) AS SIGNED)) = 9')
                ->select(DB::raw('CAST(RIGHT(value, 9) AS SIGNED) AS phone_number'))
                ->where('candidat_id', $participant->id)
                ->first();
            //dd($phoneNumberResult);

            if ($phoneNumberResult) {
                $phoneNumber = $phoneNumberResult->phone_number;
            } else {
                $phoneNumber = '';
            }

            // Récupération de l'université du candidat dans la table candidat_attributes et odcusers
            $variables = ['Université', 'Etablissement'];

            $universiteLabelAttribute = DB::table('candidat_attributes')
                ->where(function ($query) use ($variables) {
                    foreach ($variables as $value) {
                        $query->orWhere('label', 'LIKE', "%{$value}%");
                    }
                })
                ->where('candidat_id', $participant->id)
                ->first();
            if ($universiteLabelAttribute) {
                $universiteValue = $universiteLabelAttribute->value;
            } else {
                $odcusers = Odcuser::where('id', $participant->id)
                    ->get();
                if (request()->expectsJson()) {
                    return response()->json($odcusers);
                }
                foreach ($odcusers as $key => $odcuser) {
                    $detail_profession = json_decode($odcuser->detail_profession, true);
                    $universiteValue = $detail_profession['university'] ?? '';
                }
            }

            $sheet->setCellValue('A' . $row, $participant->odcuser->first_name);
            $sheet->setCellValue('B' . $row, $participant->odcuser->last_name);
            $sheet->setCellValue('C' . $row, $participant->odcuser->email);
            $sheet->setCellValue('D' . $row, $participant->odcuser->gender);
            $sheet->setCellValue('E' . $row, $phoneNumber);
            $sheet->setCellValue('F' . $row, $participant->Etablissement);
            $sheet->setCellValue('G' . $row, $participant->date);
            $sheet->setCellValue('H' . $row, $participant->status);
            //dd($sheet->setCellValue('H' . $row, $participant->status));
            $row++;
        }

        // Save the spreadsheet to a temporary file
        $writer = new Xlsx($spreadsheet);
        $fileName = "Model du fichier d'importation.xlsx";
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Content-Disposition: attachment;filename=\"$fileName\"");
        $writer->save("php://output");
        exit();
    }

    public function exportParticipant(Request $request)
    {
        $Id = $request->certif;
        $nameId = $request->certifTitle;
        //dd($Id);
        // Get all candidats for the given event
        $Participants = Candidat::where('activite_id', $Id)
            ->where('status', 'accept')
            ->with(['odcuser', 'candidat_attribute',])
            ->get();
        //dd($Participants);
        //generation du xlsx

        //header of our spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Participant'); // This is where I set the title of my sheet
        /*here is the header of my sheet*/
        $sheet->setCellValue('A1', 'first_name')->getStyle('A1')->getFont()->setBold(true);
        $sheet->setCellValue('B1', 'last_name')->getStyle('B1')->getFont()->setBold(true);
        $sheet->setCellValue('C1', 'email')->getStyle('C1')->getFont()->setBold(true);
        $sheet->setCellValue('D1', 'gender')->getStyle('D1')->getFont()->setBold(true);
        $sheet->setCellValue('E1', 'Evaluation')->getStyle('E1')->getFont()->setBold(true);
        $row = 2; // Initialize row counter

        foreach ($Participants as $participant) {
            $sheet->setCellValue('A' . $row, $participant->odcuser->first_name);
            $sheet->setCellValue('B' . $row, $participant->odcuser->last_name);
            $sheet->setCellValue('C' . $row, $participant->odcuser->email);
            $sheet->setCellValue('D' . $row, $participant->odcuser->gender);
            //dd($sheet->setCellValue('H' . $row, $participant->status));
            $row++;
        }



        // Save the spreadsheet to a temporary file
        $writer = new Xlsx($spreadsheet);
        $fileName = "Participants {$nameId}.xlsx";
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Content-Disposition: attachment;filename=\"$fileName\"");
        $writer->save("php://output");
        exit();
    }
    public function importAndgenerate(Request $request)
    {
        $file = $request->file;
        $Id = $request->activite;
        $spreadsheet = IOFactory::load($file);
        $sheets = $spreadsheet->getActiveSheet();
        //dump($sheets);
        //$rows = $sheets->toArray();
        //dd($rows);

        for ($lineexcel = 2; $lineexcel <= $sheets->getHighestRow(); $lineexcel++) {
            $prenom = $sheets->getcell("A{$lineexcel}")->getvalue();
            $nom = $sheets->getcell("B{$lineexcel}")->getvalue();
            $email = $sheets->getcell("C{$lineexcel}")->getvalue();
            $genre = $sheets->getcell("D{$lineexcel}")->getvalue();
            $Evaluation = $sheets->getcell("E{$lineexcel}")->getvalue();
            //dd($nom);
            //dd($Evaluation);
            if ($Evaluation >= 60) {
                $this->generateAllCertificats($request, $Id);
            } else {
                continue;
            }
            //$gestion = $this->handlecertification($Evaluation, $Id);
        }

        //dd($gestion);
    }

    public  function generateAllCertificats(Request $request, $Id)
    {
        $id = Activite::find($Id);
        //dd($Id);
        $idactivite = $id->id;
        //dd( $idactivite);
        set_time_limit(100000);
        $selectcerificat = $request->input('certificat');

        $candidats = Candidat::where('activite_id', $idactivite)
            ->where('status', 'accept')
            ->select('id', 'odcuser_id', 'activite_id', 'status')
            ->with(['odcuser', 'candidat_attribute'])
            ->get();

        //extension de la classe ZipArchive pour stocké tous les certificats
        $zip = new ZipArchive();
        $zipFilename = "certificats_" . preg_replace('/[^a-zA-Z0-9_\-]/', '_', $id->title) . ".zip";
        $zip->open($zipFilename, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        // Boucler sur chaque candidat et générer le certificat
        foreach ($candidats as $candidat) {
            // Récupération de l'université du candidat dans la table candidat_attributes et odcusers
            $variables = ['Université', 'Etablissement', 'Structure', 'Entreprise', 'Si autre université'];

            $universiteLabelAttribute = DB::table('candidat_attributes')
                ->where(function ($query) use ($variables) {
                    foreach ($variables as $value) {
                        $query->orWhere('label', 'LIKE', "%{$value}%");
                    }
                })
                ->where('candidat_id', $candidat->id)
                ->first();

            $universiteValue = '';
            if ($universiteLabelAttribute) {
                $universiteValue = $universiteLabelAttribute->value;
            } elseif ($universiteValue === null) {
                $odcusers = Odcuser::where('id', $candidat->id)
                    ->get();
                if (request()->expectsJson()) {
                    return response()->json($odcusers);
                }
                foreach ($odcusers as $key => $odcuser) {
                    $detail_profession = json_decode($odcuser->detail_profession, true);
                    $universiteValue = $detail_profession['university'] ?? '';
                }
            } else {
                $universiteValue = '';
            }
            // Définir la locale en français
            Carbon::setLocale('fr');

            $debut = new Carbon($candidat->activite->start_date);
            $start_date = $debut->isoFormat('D MMMM'); // Formatage en français

            $fin = new Carbon($candidat->activite->end_date);
            $end_date = $fin->isoFormat('D MMMM YYYY'); // Formatage en français

            $dateActuelle = Carbon::now();

            // Formater la date
            $dateFormatee = $dateActuelle->isoFormat('D MMMM YYYY');
            /*if($selectcerificat=='3'){
                $pdf = view('Templete_certificat.certificat_standars', compact('candidat', 'universiteValue', 'start_date', 'end_date', 'dateFormatee'));
            }elseif($selectcerificat == '4') {
                $pdf = view('Templete_certificat.cerificat_supeur_codeur_stand', compact('candidat', 'universiteValue', 'start_date', 'end_date', 'dateFormatee'));
            }elseif ($selectcerificat == '5') {
                $pdf = view('Templete_certificat.certificat_maker_junior_stand', compact('candidat', 'universiteValue', 'start_date', 'end_date', 'dateFormatee'));
            }*/


            $pdf = view('Templete_certificat.cerificat_supeur_codeur_stand', compact('candidat', 'universiteValue', 'start_date', 'end_date', 'dateFormatee'));

            $options = new Options();
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isRemoteEnabled', true);
            $dompdf = new Dompdf($options);
            $dompdf->loadHtml($pdf);
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();

            $pdfContent = $dompdf->output();
            $filename = "Certificat_" . $candidat->odcuser->first_name . "_" . $candidat->odcuser->last_name . ".pdf";
            $zip->addFromString($filename, $pdfContent);
        }

        $zip->close();
        return response()->download($zipFilename)->deleteFileAfterSend(true);
    }

    public function importParticipantsFromExcel(Request $request)
    {
        // Valider le fichier uploadé
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
            'activite' => 'required|exists:activites,id',
        ]);

        // Lire le fichier Excel
        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file);
        $sheets = $spreadsheet->getActiveSheet();

        // Parcourir les lignes du fichier Excel
        for ($row = 2; $row <= $sheets->getHighestRow(); $row++) {
            $firstName = $sheets->getCell("A{$row}")->getValue();
            $lastName = $sheets->getCell("B{$row}")->getValue();
            $email = $sheets->getCell("C{$row}")->getValue();
            $gender = $sheets->getCell("D{$row}")->getValue();

            // Ignorer les lignes avec des emails invalides ou des champs obligatoires vides
            if (!filter_var($email, FILTER_VALIDATE_EMAIL) || empty($firstName) || empty($lastName) || empty($gender)) {
                continue;
            }

            // Vérifier si l'utilisateur existe déjà
            $odcuser = Odcuser::where('email', $email)->first();

            try {
                if ($odcuser) {
                    // Vérifier si le candidat existe déjà
                    $candidat = Candidat::where('odcuser_id', $odcuser->id)
                        ->where('activite_id', $request->activite)
                        ->first();

                    if (!$candidat) {
                        // Créer un nouveau candidat avec le statut "accepté"
                        $candidat = Candidat::create([
                            'odcuser_id' => $odcuser->id,
                            'activite_id' => $request->activite,
                            'status' => 'accept', // Marquer le candidat comme accepté
                        ]);
                    } else {
                        // Mettre à jour le statut si nécessaire
                        $candidat->update(['status' => 'accept']);
                    }
                } else {
                    // Créer un nouvel utilisateur si l'utilisateur n'existe pas
                    $odcuser = Odcuser::create([
                        'first_name' => $firstName,
                        'last_name' => $lastName,
                        'email' => $email,
                        'gender' => $gender,
                    ]);

                    // Créer le candidat avec le statut "accepté"
                    Candidat::create([
                        'odcuser_id' => $odcuser->id,
                        'activite_id' => $request->activite,
                        'status' => 'accept', // Marquer le candidat comme accepté
                    ]);
                }
            } catch (\Exception $e) {
                // Gérer l'exception (vous pouvez logger l'erreur ou afficher un message)
                Log::error('Erreur lors de l\'importation des participants : ' . $e->getMessage());
                continue; // Passer à la ligne suivante en cas d'erreur
            }
        }

        return redirect()->back()->with('success', 'Importation des participants exécutée avec succès');
    }
}
