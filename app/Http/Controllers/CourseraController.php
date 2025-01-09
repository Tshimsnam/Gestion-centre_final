<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\CourseraUsage;
use App\Models\CourseraMember;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\CourseraSpecialisation;
use App\Models\Odcuser;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class CourseraController extends Controller
{
    public function rapport_invitation()
    {
        $membersMonths = CourseraMember::selectRaw('MONTH(join_date) as month, COUNT(*) as count')
            ->whereYear('join_date', date('Y'))
            ->groupBy('month')->orderBy('month')->get();

        $labels = [];
        $mydata = [];
        $colors = [
            '#FF6384',
            '#36A2EB',
            '#c9625b',
            '#cf72fa',
            '#f83d3d',
            '#fa43cc',
            '#ADD478',
            '#fcc737',
            '#ADD813',
            '#36d4fc',
            '#c92daf',
            '#FF7890'
        ];

        for ($i = 1; $i <= 12; $i++) {
            $month = date('F', mktime(0, 0, 0, $i, 1));
            $count = 0;
            foreach ($membersMonths as $member) {
                if ($member->month == $i) {
                    $count = $member->count;
                    break;
                }
            }

            array_push($labels, $month);
            array_push($mydata, $count);
        }

        $datasets = [
            [
                'label' => "member join by month",
                'data' => $mydata,
                'backgroundColor' => $colors
            ]
        ];


        $acceptInvitation = CourseraMember::where('member_state', 'MEMBER')->get();
        $noAcceptInvitation = CourseraMember::where('member_state', 'INVITED')->get();
        $noAcceptInvitation_cout = $noAcceptInvitation->count();
        $acceptInvitation_count = $acceptInvitation->count();

        $allMembers = CourseraMember::all();

        //$membersKinshasa = $allMembers->where('external_id', 'REGEXP', '^1\d*');

        $coursera_members = $allMembers->count();

        //USAGES__________________________________________________
        $coursera_usages = DB::table('coursera_usages')
            ->selectRaw('count(*) as total')
            ->selectRaw("count(case when completed = 'Yes' then 1 end) as completed")
            ->selectRaw("count(case when completed = 'No' then 1 end) as noCompleted")
            ->first();

        $nombre_cours = CourseraUsage::distinct('course')->count();

        $total_cours =  CourseraUsage::select('course')->distinct()->get();

        $getCompletedUsages = CourseraUsage::join('coursera_members as cmem', 'cmem.id', '=', 'coursera_usages.coursera_member_id')->select([
            'cmem.name',
            'cmem.email',
            'coursera_usages.university',
            'coursera_usages.course_slug',
        ])->where('completed', 'Yes')->get();


        $getAllParticipants = CourseraUsage::leftjoin('coursera_members as cmem', 'cmem.id', '=', 'coursera_usages.coursera_member_id')
            ->leftJoin('odcusers as us', 'us.email', '=', 'cmem.email')
            ->select([
                'cmem.name',
                'cmem.email',
                'coursera_usages.class_start_time',
                'coursera_usages.class_end_time',
                'coursera_usages.course',
                'coursera_usages.completed',
                'cmem.external_id',
                'us.gender',
                'us.first_name',
                'us.last_name'
            ])->get();


        $getAllParticipants_count = $getAllParticipants->count();

        //obtenue certificats à kinshasa
        $getAllParticipants_kin = $getAllParticipants->filter(function ($member) {
            return preg_match('/^[10]\d*/', $member->external_id);
        });
        $getAllParticipants_kin_count = $getAllParticipants_kin->count();

        //obtenue certificat à lubumbashi
        $getAllParticipants_lub = $getAllParticipants->filter(function ($member) {
            return preg_match('/^[2]\d*/', $member->external_id);
        });
        $getAllParticipants_lub_count = $getAllParticipants_lub->count();
        //obtenue certificat à matadi
        $getAllParticipants_mat = $getAllParticipants->filter(function ($member) {
            return preg_match('/^[3]\d*/', $member->external_id);
        });
        $getAllParticipants_mat_count = $getAllParticipants_mat->count();
        //obtenue certificat à kananga
        $getAllParticipants_kan = $getAllParticipants->filter(function ($member) {
            return preg_match('/^[4]\d*/', $member->external_id);
        });

        $getAllParticipants_kan_count = $getAllParticipants_kan->count();




        $uncompletedUsages = CourseraUsage::where('completed', 'NO')->get();

        $allUsages = CourseraUsage::all();



        //Specialisation__________________________________________
        $allSpecialisations = CourseraSpecialisation::select('specialisaton', 'courses_in_specialisation') // Remplacez par le nom de la colonne que vous souhaitez
            ->distinct()
            ->get();
        $specialisationsCount = $allSpecialisations->count();

        $getcompleteSpecialisation = CourseraSpecialisation::leftJoin('coursera_members', 'coursera_members.id', '=', 'coursera_specialisations.coursera_member_id')->select([
            'coursera_members.name',
            'coursera_members.email',
            'coursera_specialisations.specialisaton',
            'coursera_specialisations.university',
            'coursera_specialisations.last_specialisation_activity',
            'coursera_specialisations.completed',
            'coursera_members.external_id',
        ])->where('completed', 'Yes')->get();

        ////////////////////////////////////////specialisations obtenues par province//////////////////////////////////////////////////////////////////////////////////////////////////////
        $getcompleteKin1 = $getcompleteSpecialisation->filter(function ($member) {
            return preg_match('/^[10]\d*/', $member->external_id);
        });



        $getcompleteKan1 = $getcompleteSpecialisation->filter(function ($member) {
            return preg_match('/^[2]\d*/', $member->external_id);
        });

        $getcompleteLub1 = $getcompleteSpecialisation->filter(function ($member) {
            return preg_match('/^[3]\d*/', $member->external_id);
        });


        $getcompleteMat1 = $getcompleteSpecialisation->filter(function ($member) {
            return preg_match('/^[4]\d*/', $member->external_id);
        });


        $getcomplete_count = $getcompleteSpecialisation->count();

        $getcompleteKin_count = $getcompleteKin1->count();
        $getcompleteLub_count = $getcompleteLub1->count();
        $getcompleteMat_count = $getcompleteMat1->count();
        $getcompleteKan_count = $getcompleteKan1->count();

        $completedSpecialisations = CourseraSpecialisation::where('completed', 'Yes')->count();

        $uncompletedSpecialisations = CourseraSpecialisation::where('completed', 'NO')->count();

        $licence_en_cours = CourseraUsage::leftJoin('coursera_members as cm', 'cm.id', '=', 'coursera_usages.coursera_member_id')
            ->where('coursera_usages.removed_from_program', 'Yes')
            ->select('cm.email', 'cm.name', 'coursera_usages.course', 'coursera_usages.course_slug', 'coursera_usages.university', 'cm.external_id')
            ->get();


        $licenceKinEnCours = $licence_en_cours->filter(function ($member) {
            return preg_match('/^[10]\d*/', $member->external_id);
        });

        $licenceKinEnCours_count = $licenceKinEnCours->count();


        $licenceLubEnCours = $licence_en_cours->filter(function ($member) {
            return preg_match('/^2\d*/', $member->external_id);
        });
        $licenceLubEnCours_count = $licenceLubEnCours->count();

        $licenceKanEnCours = $licence_en_cours->filter(function ($member) {
            return preg_match('/^4\d*/', $member->external_id);
        });
        $licenceKanEnCours_count = $licenceKanEnCours->count();

        $licenceMatEnCours = $licence_en_cours->filter(function ($member) {
            return preg_match('/^3\d*/', $member->external_id);
        });

        $licenceMatEnCours_count = $licenceMatEnCours->count();

        $licence_en_cours_count = $licence_en_cours->count();

        //nombres de ceux qui ont obtenues les certificats
        $certificats = CourseraUsage::leftJoin('coursera_members as cm', 'cm.id', '=', 'coursera_usages.coursera_member_id')
            ->where('course_certificate_url', '!=', '')
            ->select('cm.name', 'cm.email', 'cm.external_id', 'coursera_usages.university', 'coursera_usages.course', 'coursera_usages.course_slug')
            ->get();

        //count pour ceux qui ont obtenues les certificats
        $certificat_count = $certificats->count();

        //obtenue certificats à kinshasa
        $certificat_obtenue_kinshasa = $certificats->filter(function ($member) {
            return preg_match('/^[10]\d*/', $member->external_id);
        });
        $certificat_obtenue_kinshasa_count = $certificat_obtenue_kinshasa->count();

        //obtenue certificat à lubumbashi
        $certificat_obtenue_lubumbashi = $certificats->filter(function ($member) {
            return preg_match('/^[2]\d*/', $member->external_id);
        });
        $certificat_obtenue_lubumbashi_count = $certificat_obtenue_lubumbashi->count();
        //obtenue certificat à matadi
        $certificat_obtenue_matadi = $certificats->filter(function ($member) {
            return preg_match('/^[3]\d*/', $member->external_id);
        });
        $certificat_obtenue_matadi_count = $certificat_obtenue_matadi->count();
        //obtenue certificat à kananga
        $certificat_obtenue_kananga = $certificats->filter(function ($member) {
            return preg_match('/^[4]\d*/', $member->external_id);
        });
        $certificat_obtenue_kananga_count = $certificat_obtenue_kananga->count();

        $thirtyDaysAgo = Carbon::now()->subDays(30);


        $apprenants_30day = CourseraMember::select('coursera_members.name', 'coursera_members.external_id', 'coursera_members.email', 'cu.university', 'cu.course', 'cu.course_slug', 'cu.course_certificate_url')
            ->leftJoin('coursera_usages as cu', 'coursera_members.id', '=', 'cu.coursera_member_id')
            ->where('coursera_members.join_date', '>=', Carbon::now()->subDays(30))
            ->where(function ($query) {
                $query->where('cu.course_certificate_url', '=', '')
                    ->orWhereNull('cu.course_certificate_url');
            })
            ->get();
        $apprenants_30day_count = $apprenants_30day->count();

        //apprenants 30 jours pas de certificat à kinshasa
        $apprenants_30day_kinshasa = $apprenants_30day->filter(function ($member) {
            return preg_match('/^[10]\d*/', $member->external_id);
        });
        $apprenants_30day_kinshasa_count = $apprenants_30day_kinshasa->count();

        //obtenue 30 jours pas de certificat à lubumbashi
        $apprenants_30day_lubumbashi = $apprenants_30day->filter(function ($member) {
            return preg_match('/^[2]\d*/', $member->external_id);
        });
        $certificat_30day_lubumbashi_count = $apprenants_30day_lubumbashi->count();
        //obtenue certificat à matadi
        $apprenants_30day_matadi = $apprenants_30day->filter(function ($member) {
            return preg_match('/^[3]\d*/', $member->external_id);
        });
        $apprenants_30day_matadi_count = $apprenants_30day_matadi->count();
        //obtenue certificat à kananga
        $apprenants_30day_kananga = $apprenants_30day->filter(function ($member) {
            return preg_match('/^[4]\d*/', $member->external_id);
        });
        $apprenants_30day_kananga_count = $apprenants_30day_kananga->count();


        $non_inscrit_cours = CourseraMember::select('coursera_members.external_id', 'coursera_members.name', 'coursera_members.email', 'cu.university', 'cu.course', 'cu.course_slug', 'cu.course_certificate_url')
            ->leftJoin('coursera_usages as cu', 'coursera_members.id', '=', 'cu.coursera_member_id')
            ->where('coursera_members.join_date', '>', Carbon::now()->subDays(7))
            ->where('coursera_members.member_state', '=', 'INVITED')
            ->get();

        ///////////////////////////////non_inscrit par province////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $non_inscritKin = $non_inscrit_cours->filter(function ($member) {
            return preg_match('/^1\d*/', $member->external_id);
        });


        $non_inscritLub = $non_inscrit_cours->filter(function ($member) {
            return preg_match('/^2\d*/', $member->external_id);
        });


        $non_inscritMat = $non_inscrit_cours->filter(function ($member) {
            return preg_match('/^3\d*/', $member->external_id);
        });


        $non_inscritKan = $non_inscrit_cours->filter(function ($member) {
            return preg_match('/^4\d*/', $member->external_id);
        });

        $non_inscritKin_count = $non_inscritKin->count();
        $non_inscritLub_count = $non_inscritLub->count();
        $non_inscritMat_count = $non_inscritMat->count();
        $non_inscritKan_count = $non_inscritKan->count();


        $non_inscrit_cours_count = $non_inscrit_cours->count();

        $last_activity = CourseraMember::select([
            'name',
            'email',
            'join_date',
            'latest_program_activity_date',
            'external_id'

        ])->where('latest_program_activity_date', '>', '2024-09-01')->get();

        $last_activity_count = $last_activity->count();


        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $last_activityKin = $last_activity->filter(function ($member) {
            return preg_match('/^1\d*/', $member->external_id);
        });

        $last_activityLub = $last_activity->filter(function ($member) {
            return preg_match('/^2\d*/', $member->external_id);
        });

        $last_activityMat = $last_activity->filter(function ($member) {
            return preg_match('/^3\d*/', $member->external_id);
        });

        $last_activityKan = $last_activity->filter(function ($member) {
            return preg_match('/^4\d*/', $member->external_id);
        });



        $last_activityKin_count = $last_activityKin->count();
        $last_activityMat_count = $last_activityMat->count();
        $last_activityLub_count = $last_activityLub->count();
        $last_activityKan_count = $last_activityKan->count();


        $taux_utilisation = CourseraUsage::select('cm.email', 'cm.name', 'cm.external_id', 'coursera_usages.university', 'coursera_usages.course', 'coursera_usages.course_slug', 'coursera_usages.last_course_activity')
            ->leftJoin('coursera_members AS cm', 'cm.id', '=', 'coursera_usages.coursera_member_id')
            ->where('coursera_usages.removed_from_program', '=', 'Yes')
            ->where('coursera_usages.last_course_activity', '>', Carbon::now()->subDays(21)) // Assurez-vous que 'last_course_activity' est dans 'coursera_usages'
            ->get();

        //////////////////////////////////////////////////////////taux d'utilisation par province///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $taux_util_kin = $taux_utilisation->filter(function ($member) {
            return preg_match('/^1\d*/', $member->external_id);
        });

        $taux_util_lub = $taux_utilisation->filter(function ($member) {
            return preg_match('/^2\d*/', $member->external_id);
        });

        $taux_util_mat = $taux_utilisation->filter(function ($member) {
            return preg_match('/^3\d*/', $member->external_id);
        });

        $taux_util_kan = $taux_utilisation->filter(function ($member) {
            return preg_match('/^4\d*/', $member->external_id);
        });


        $taux_count = $taux_utilisation->count();
        $taux = ($taux_count * 100) / 125;


        $taux_util_kin_count = $taux_util_kin->count();
        $taux_util_lub_count = $taux_util_lub->count();
        $taux_util_mat_count = $taux_util_mat->count();
        $taux_util_kan_count = $taux_util_kan->count();


        $taux_kin = $taux_utilisation->count() > 0 ? ($taux_util_kin_count * 100) / $taux_utilisation->count() : 0;

        $membersKinshasa = CourseraMember::where('external_id', 'REGEXP', '^[10]\d*')
            ->get();
        $membersKinshasa_count = $membersKinshasa->count();

        $membersLubumbashi = CourseraMember::where('external_id', 'REGEXP', '^2\d*')
            ->get();
        $membersLubumbashi_count = $membersLubumbashi->count();

        $membersMatadi = CourseraMember::where('external_id', 'REGEXP', '^3\d*')
            ->get();
        $membersMatadi_count = $membersMatadi->count();

        $membersKananga = CourseraMember::where('external_id', 'REGEXP', '^4\d*')
            ->get();
        $membersKananga_count = $membersKananga->count();

        $resultats = CourseraMember::selectRaw("SUBSTRING(external_id, 1, 1) AS premier_chiffre")
            ->limit(50)
            ->where('external_id', 'REGEXP', '^[0-9]')
            ->get();


        return view('coursera.coursera_rapports', compact(
            'datasets',
            'labels',
            "coursera_members",
            "specialisationsCount",
            "coursera_usages",
            "completedSpecialisations",
            "uncompletedSpecialisations",
            "uncompletedUsages",
            "getCompletedUsages",
            "licence_en_cours",
            "licence_en_cours_count",
            "certificats",
            "certificat_count",
            "apprenants_30day",
            "apprenants_30day_count",
            "non_inscrit_cours",
            "non_inscrit_cours_count",
            "last_activity",
            "last_activity_count",
            "taux_utilisation",
            "taux_count",
            "taux",
            "allMembers",
            "allUsages",
            "allSpecialisations",
            "getcompleteSpecialisation",
            "getcomplete_count",
            "getcompleteKin_count",
            "getcompleteKan_count",
            "getcompleteMat_count",
            "getcompleteLub_count",
            "getcompleteKin1",
            "getcompleteKan1",
            "getcompleteMat1",
            "getcompleteLub1",
            "non_inscritKin",
            "non_inscritKan",
            "non_inscritMat",
            "non_inscritLub",
            "non_inscritKin_count",
            "non_inscritKan_count",
            "non_inscritLub_count",
            "non_inscritMat_count",

            "membersKinshasa_count",
            "membersKinshasa",
            "membersLubumbashi_count",
            "membersLubumbashi",
            "membersMatadi_count",
            "membersMatadi",
            "membersKananga_count",
            "membersKananga",
            "nombre_cours",
            "licenceKinEnCours_count",
            "licenceLubEnCours_count",
            "licenceKanEnCours_count",
            "licenceMatEnCours_count",
            "licenceKinEnCours",
            "licenceLubEnCours",
            "licenceKanEnCours",
            "licenceMatEnCours",
            "last_activityKin",
            "last_activityKan",
            "last_activityMat",
            "last_activityLub",
            "certificat_obtenue_kinshasa",
            "certificat_obtenue_lubumbashi",
            "certificat_obtenue_matadi",
            "certificat_obtenue_kananga",
            "certificat_obtenue_kinshasa_count",
            "certificat_obtenue_lubumbashi_count",
            "certificat_obtenue_matadi_count",
            "certificat_obtenue_kananga_count",
            "apprenants_30day_kinshasa_count",
            "certificat_30day_lubumbashi_count",
            "apprenants_30day_matadi_count",
            "apprenants_30day_kananga_count",
            "apprenants_30day_kinshasa",
            "apprenants_30day_lubumbashi",
            "apprenants_30day_matadi",
            "apprenants_30day_kananga",
            "total_cours",

            "last_activityKin_count",
            "last_activityKan_count",
            "last_activityMat_count",
            "last_activityLub_count",
            "taux_util_kin",
            "taux_util_kan",
            "taux_util_mat",
            "taux_util_lub",

            "taux_util_kin_count",
            "taux_util_kan_count",
            "taux_util_mat_count",
            "taux_util_lub_count",
            "getAllParticipants",
            "getAllParticipants_count",

            "getAllParticipants_kin",
            "getAllParticipants_kan",
            "getAllParticipants_lub",
            "getAllParticipants_mat",

            "getAllParticipants_kin_count",
            "getAllParticipants_kan_count",
            "getAllParticipants_lub_count",
            "getAllParticipants_mat_count",
        ));
    }

    public function memberexcel()
    {

        $allMembers = CourseraMember::all();

        //vériefie si les members ont été trouvés
        if ($allMembers->isEmpty()) {
            return response()->json(['message' => 'Aucun membre trouvé.'], 404);
        }

        $spreadsheet = new Spreadsheet();
        $worksheet = $spreadsheet->getActiveSheet();

        $worksheet->setCellValue('A1', 'Name');
        $worksheet->getStyle('A1')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('D3D3D3'));

        $worksheet->setCellValue('B1', 'Email');
        $worksheet->getStyle('B1')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('D3D3D3'));

        $worksheet->setCellValue('C1', 'External Id');
        $worksheet->getStyle('C1')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('D3D3D3'));

        $worksheet->setCellValue('D1', 'Enrolled Courses');
        $worksheet->getStyle('D1')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('D3D3D3'));

        $worksheet->setCellValue('E1', 'Completed Courses');
        $worksheet->getStyle('E1')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('D3D3D3'));

        $worksheet->setCellValue('F1', 'Member State');
        $worksheet->getStyle('F1')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('D3D3D3'));

        $worksheet->setCellValue('G1', 'Join Date');
        $worksheet->getStyle('G1')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('D3D3D3'));


        $worksheet->setCellValue('H1', 'Invitation Date');
        $worksheet->getStyle('H1')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('D3D3D3'));

        $worksheet->setCellValue('I1', 'Lastest Program ACtivity Date');
        $worksheet->getStyle('I1')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('D3D3D3'));

        $row = 2;

        foreach ($allMembers as $member) {
            $worksheet->setCellValue('A' . $row, $member->name)
                ->getStyle('A' . $row)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $worksheet->setCellValue('B' . $row, $member->email)
                ->getStyle('B' . $row)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $worksheet->setCellValue('C' . $row, $member->external_id)
                ->getStyle('C' . $row)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $worksheet->setCellValue('D' . $row, $member->enrolled_courses)
                ->getStyle('D' . $row)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $worksheet->setCellValue('E' . $row, $member->completed_courses)
                ->getStyle('E' . $row)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $worksheet->setCellValue('F' . $row, $member->member_state)
                ->getStyle('F' . $row)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $worksheet->setCellValue('G' . $row, $member->join_date)
                ->getStyle('G' . $row)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $worksheet->setCellValue('H' . $row, $member->invitation_date)
                ->getStyle('H' . $row)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $worksheet->setCellValue('I' . $row, $member->latest_program_activity_date)
                ->getStyle('I' . $row)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $row++;
        }
        // On crée le fichier Excel
        $writer = new Xlsx($spreadsheet);
        $fileName = "Tous_les_members_Coursera.xlsx";
        $tempFile = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($tempFile);

        // On renvoie le fichier Excel au navigateur
        return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
    }


    public function licence_encours()
    {
        $licence_en_cours = CourseraUsage::leftJoin('coursera_members as cm', 'cm.id', '=', 'coursera_usages.coursera_member_id')
            ->where('coursera_usages.removed_from_program', 'Yes')
            ->select('cm.email', 'cm.name', 'coursera_usages.course', 'coursera_usages.course_slug', 'coursera_usages.university')
            ->get();

        // Vérifie si des membres ont été trouvés
        if ($licence_en_cours->isEmpty()) {
            return response()->json(['message' => 'Aucune invitation trouvée.'], 404);
        }

        $spreadsheet = new Spreadsheet();
        $worksheet = $spreadsheet->getActiveSheet();

        $worksheet->setCellValue('A1', 'Name');
        $worksheet->getStyle('A1')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('D3D3D3'));

        $worksheet->setCellValue('B1', 'Email');
        $worksheet->getStyle('B1')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('D3D3D3'));

        $worksheet->setCellValue('C1', 'University');
        $worksheet->getStyle('C1')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('D3D3D3'));

        $worksheet->setCellValue('D1', 'Invitation_Date');
        $worksheet->getStyle('D1')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('D3D3D3'));

        // Définition des bordures
        $worksheet->getStyle('A1:D1')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $row = 2;

        foreach ($licence_en_cours as $member) {
            $worksheet->setCellValue('A' . $row, $member->name)
                ->getStyle('A' . $row)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $worksheet->setCellValue('B' . $row, $member->email)
                ->getStyle('B' . $row)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $worksheet->setCellValue('C' . $row, $member->course)
                ->getStyle('C' . $row)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $worksheet->setCellValue('D' . $row, $member->university)
                ->getStyle('D' . $row)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $row++;
        }

        // On crée le fichier Excel
        $writer = new Xlsx($spreadsheet);
        $fileName = "Coursera_licence_en_cours.xlsx";
        $tempFile = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($tempFile);

        // On renvoie le fichier Excel au navigateur
        return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
    }

    public function memmbre_30day()
    {
        $apprenants_30day = CourseraMember::select('coursera_members.name', 'coursera_members.email', 'cu.university', 'cu.course', 'cu.course_slug', 'cu.course_certificate_url')
            ->leftJoin('coursera_usages as cu', 'coursera_members.id', '=', 'cu.coursera_member_id')
            ->where('coursera_members.join_date', '>=', Carbon::now()->subDays(30))
            ->where(function ($query) {
                $query->where('cu.course_certificate_url', '=', '')
                    ->orWhereNull('cu.course_certificate_url');
            })
            ->get();
        // Vérifie si des membres ont été trouvés
        if ($apprenants_30day->isEmpty()) {
            return response()->json(['message' => 'Aucune invitation trouvée.'], 404);
        }

        $spreadsheet = new Spreadsheet();
        $worksheet = $spreadsheet->getActiveSheet();

        $worksheet->setCellValue('A1', 'Name');
        $worksheet->getStyle('A1')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('D3D3D3'));

        $worksheet->setCellValue('B1', 'Email');
        $worksheet->getStyle('B1')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('D3D3D3'));

        $worksheet->setCellValue('C1', 'University');
        $worksheet->getStyle('C1')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('D3D3D3'));

        $worksheet->setCellValue('D1', 'Invitation_Date');
        $worksheet->getStyle('D1')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('D3D3D3'));

        // Définition des bordures
        $worksheet->getStyle('A1:D1')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $row = 2;

        foreach ($apprenants_30day as $member) {
            $worksheet->setCellValue('A' . $row, $member->name)
                ->getStyle('A' . $row)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $worksheet->setCellValue('B' . $row, $member->email)
                ->getStyle('B' . $row)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $worksheet->setCellValue('C' . $row, $member->course)
                ->getStyle('C' . $row)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $worksheet->setCellValue('D' . $row, $member->university)
                ->getStyle('D' . $row)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $row++;
        }

        // On crée le fichier Excel
        $writer = new Xlsx($spreadsheet);
        $fileName = "coursera_membre_depuis_30jours_pas_de_certificat.xlsx";
        $tempFile = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($tempFile);

        // On renvoie le fichier Excel au navigateur
        return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
    }
    public function certificat_obtenue()
    {
        $certificats = CourseraUsage::leftJoin('coursera_members as cm', 'cm.id', '=', 'coursera_usages.coursera_member_id')
            ->where('course_certificate_url', '!=', '')
            ->select('cm.name', 'cm.email', 'coursera_usages.university', 'coursera_usages.course', 'coursera_usages.course_slug')
            ->get();

        // Vérifie si des membres ont été trouvés
        if ($certificats->isEmpty()) {
            return response()->json(['message' => 'Aucune invitation trouvée.'], 404);
        }

        $spreadsheet = new Spreadsheet();
        $worksheet = $spreadsheet->getActiveSheet();

        $worksheet->setCellValue('A1', 'Name');
        $worksheet->getStyle('A1')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('D3D3D3'));

        $worksheet->setCellValue('B1', 'Email');
        $worksheet->getStyle('B1')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('D3D3D3'));

        $worksheet->setCellValue('C1', 'University');
        $worksheet->getStyle('C1')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('D3D3D3'));

        $worksheet->setCellValue('D1', 'Invitation_Date');
        $worksheet->getStyle('D1')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('D3D3D3'));

        // Définition des bordures
        $worksheet->getStyle('A1:D1')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $row = 2;

        foreach ($certificats as $member) {
            $worksheet->setCellValue('A' . $row, $member->name)
                ->getStyle('A' . $row)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $worksheet->setCellValue('B' . $row, $member->email)
                ->getStyle('B' . $row)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $worksheet->setCellValue('C' . $row, $member->course)
                ->getStyle('C' . $row)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $worksheet->setCellValue('D' . $row, $member->university)
                ->getStyle('D' . $row)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $row++;
        }

        // On crée le fichier Excel
        $writer = new Xlsx($spreadsheet);
        $fileName = "certificat_obtenue_coursera.xlsx";
        $tempFile = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($tempFile);

        // On renvoie le fichier Excel au navigateur
        return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
    }
    public function non_inscrit_cours()
    {
        $non_inscrit_cours = CourseraMember::select('coursera_members.name', 'coursera_members.email', 'cu.university', 'cu.course', 'cu.course_slug', 'cu.course_certificate_url')
            ->leftJoin('coursera_usages as cu', 'coursera_members.id', '=', 'cu.coursera_member_id')
            ->where('coursera_members.join_date', '>', Carbon::now()->subDays(7))
            ->where('coursera_members.member_state', '=', 'INVITED')
            ->get();

        // Vérifie si des membres ont été trouvés
        if ($non_inscrit_cours->isEmpty()) {
            return response()->json(['message' => 'Aucune invitation trouvée.'], 404);
        }

        $spreadsheet = new Spreadsheet();
        $worksheet = $spreadsheet->getActiveSheet();

        $worksheet->setCellValue('A1', 'Name');
        $worksheet->getStyle('A1')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('D3D3D3'));

        $worksheet->setCellValue('B1', 'Email');
        $worksheet->getStyle('B1')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('D3D3D3'));

        $worksheet->setCellValue('C1', 'University');
        $worksheet->getStyle('C1')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('D3D3D3'));

        $worksheet->setCellValue('D1', 'Invitation_Date');
        $worksheet->getStyle('D1')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('D3D3D3'));

        // Définition des bordures
        $worksheet->getStyle('A1:D1')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $row = 2;

        foreach ($non_inscrit_cours as $member) {
            $worksheet->setCellValue('A' . $row, $member->name)
                ->getStyle('A' . $row)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $worksheet->setCellValue('B' . $row, $member->email)
                ->getStyle('B' . $row)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $worksheet->setCellValue('C' . $row, $member->course)
                ->getStyle('C' . $row)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $worksheet->setCellValue('D' . $row, $member->university)
                ->getStyle('D' . $row)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $row++;
        }

        // On crée le fichier Excel
        $writer = new Xlsx($spreadsheet);
        $fileName = "liste_non_inscrit_aux_cours.xlsx";
        $tempFile = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($tempFile);

        // On renvoie le fichier Excel au navigateur
        return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
    }
    public function taux_utilisation()
    {
        $taux_utilisation = CourseraUsage::select('cm.email', 'cm.name', 'coursera_usages.university', 'coursera_usages.course', 'coursera_usages.course_slug', 'coursera_usages.last_course_activity')
            ->leftJoin('coursera_members AS cm', 'cm.id', '=', 'coursera_usages.coursera_member_id')
            ->where('coursera_usages.removed_from_program', '=', 'Yes')
            ->where('coursera_usages.last_course_activity', '>', Carbon::now()->subDays(21)) // Assurez-vous que 'last_course_activity' est dans 'coursera_usages'
            ->get();

        // Vérifie si des membres ont été trouvés
        if ($taux_utilisation->isEmpty()) {
            return response()->json(['message' => 'Aucune invitation trouvée.'], 404);
        }

        $spreadsheet = new Spreadsheet();
        $worksheet = $spreadsheet->getActiveSheet();

        $worksheet->setCellValue('A1', 'Name');
        $worksheet->getStyle('A1')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('D3D3D3'));

        $worksheet->setCellValue('B1', 'Email');
        $worksheet->getStyle('B1')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('D3D3D3'));

        $worksheet->setCellValue('C1', 'University');
        $worksheet->getStyle('C1')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('D3D3D3'));

        $worksheet->setCellValue('D1', 'Invitation_Date');
        $worksheet->getStyle('D1')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('D3D3D3'));

        // Définition des bordures
        $worksheet->getStyle('A1:D1')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $row = 2;

        foreach ($taux_utilisation as $member) {
            $worksheet->setCellValue('A' . $row, $member->name)
                ->getStyle('A' . $row)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $worksheet->setCellValue('B' . $row, $member->email)
                ->getStyle('B' . $row)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $worksheet->setCellValue('C' . $row, $member->course)
                ->getStyle('C' . $row)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $worksheet->setCellValue('D' . $row, $member->university)
                ->getStyle('D' . $row)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $row++;
        }

        // On crée le fichier Excel
        $writer = new Xlsx($spreadsheet);
        $fileName = "taux_utilisation.xlsx";
        $tempFile = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($tempFile);

        // On renvoie le fichier Excel au navigateur
        return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
    }
    public function last_activity()
    {
        $last_activity = CourseraMember::where('latest_program_activity_date', '>', '2024-09-01')->get();

        // Vérifie si des membres ont été trouvés
        if ($last_activity->isEmpty()) {
            return response()->json(['message' => 'Aucune invitation trouvée.'], 404);
        }

        $spreadsheet = new Spreadsheet();
        $worksheet = $spreadsheet->getActiveSheet();

        $worksheet->setCellValue('A1', 'Name');
        $worksheet->getStyle('A1')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('D3D3D3'));

        $worksheet->setCellValue('B1', 'Email');
        $worksheet->getStyle('B1')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('D3D3D3'));

        $worksheet->setCellValue('C1', 'Date de debut');
        $worksheet->getStyle('C1')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('D3D3D3'));

        $worksheet->setCellValue('D1', 'Date activité');
        $worksheet->getStyle('D1')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('D3D3D3'));

        // Définition des bordures
        $worksheet->getStyle('A1:D1')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $row = 2;

        foreach ($last_activity as $member) {
            $worksheet->setCellValue('A' . $row, $member->name)
                ->getStyle('A' . $row)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $worksheet->setCellValue('B' . $row, $member->email)
                ->getStyle('B' . $row)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $worksheet->setCellValue('C' . $row, $member->join_date)
                ->getStyle('C' . $row)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $worksheet->setCellValue('D' . $row, $member->latest_program_activity_date)
                ->getStyle('D' . $row)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $row++;
        }

        // On crée le fichier Excel
        $writer = new Xlsx($spreadsheet);
        $fileName = "last_activity.xlsx";
        $tempFile = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($tempFile);

        // On renvoie le fichier Excel au navigateur
        return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
    }

    public function complete_specialisation()
    {
        $complete_specialisation = CourseraSpecialisation::leftJoin('coursera_members', 'coursera_members.id', '=', 'coursera_specialisations.coursera_member_id')->select([
            'coursera_members.name',
            'coursera_members.email',
            'coursera_specialisations.specialisaton',
            'coursera_specialisations.university',
            'coursera_specialisations.last_specialisation_activity',
            'coursera_specialisations.completed',
        ])->where('completed', 'Yes')->get();;

        // Vérifie si des membres ont été trouvés
        if ($complete_specialisation->isEmpty()) {
            return response()->json(['message' => 'Aucune invitation trouvée.'], 404);
        }

        $spreadsheet = new Spreadsheet();
        $worksheet = $spreadsheet->getActiveSheet();

        $worksheet->setCellValue('A1', 'Name');
        $worksheet->getStyle('A1')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('D3D3D3'));

        $worksheet->setCellValue('B1', 'Email');
        $worksheet->getStyle('B1')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('D3D3D3'));

        $worksheet->setCellValue('C1', 'specialisaton');
        $worksheet->getStyle('C1')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('D3D3D3'));

        $worksheet->setCellValue('D1', 'University');
        $worksheet->getStyle('D1')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('D3D3D3'));

        $worksheet->setCellValue('D1', 'last_specialisation_activity');
        $worksheet->getStyle('D1')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('D3D3D3'));

        $worksheet->setCellValue('D1', 'completed');
        $worksheet->getStyle('D1')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('D3D3D3'));
        // Définition des bordures
        $worksheet->getStyle('A1:D1')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $row = 2;

        foreach ($complete_specialisation as $member) {
            $worksheet->setCellValue('A' . $row, $member->name)
                ->getStyle('A' . $row)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $worksheet->setCellValue('B' . $row, $member->email)
                ->getStyle('B' . $row)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $worksheet->setCellValue('C' . $row, $member->specialisaton)
                ->getStyle('C' . $row)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $worksheet->setCellValue('C' . $row, $member->university)
                ->getStyle('C' . $row)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $worksheet->setCellValue('D' . $row, $member->last_specialisation_activity)
                ->getStyle('D' . $row)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $worksheet->setCellValue('D' . $row, $member->completed)
                ->getStyle('D' . $row)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $row++;
        }

        // On crée le fichier Excel
        $writer = new Xlsx($spreadsheet);
        $fileName = "Invitater.xlsx";
        $tempFile = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($tempFile);

        // On renvoie le fichier Excel au navigateur
        return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
    }



    public function participants_coursera()
    {
        $getAllParticipants = CourseraUsage::leftjoin('coursera_members as cmem', 'cmem.id', '=', 'coursera_usages.coursera_member_id')
            ->leftJoin('odcusers as us', 'us.email', '=', 'cmem.email')
            ->select([
                'cmem.name',
                'cmem.email',
                'us.email as odcmail',
                'coursera_usages.class_start_time',
                'coursera_usages.class_end_time',
                'coursera_usages.course',
                'coursera_usages.completed',
                'cmem.external_id',
                'us.gender',
                'us.first_name',
                'us.last_name'
            ])->get();

        // Vérifie si des membres ont été trouvés
        if ($getAllParticipants->isEmpty()) {
            return response()->json(['message' => 'Aucune invitation trouvée.'], 404);
        }


        $spreadsheet = new Spreadsheet();
        $worksheet = $spreadsheet->getActiveSheet();

        $worksheet->setCellValue('A1', 'Name');
        $worksheet->getStyle('A1')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('D3D3D3'));

        $worksheet->setCellValue('B1', 'last_name');
        $worksheet->getStyle('B1')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('D3D3D3'));

        $worksheet->setCellValue('C1', 'Email');
        $worksheet->getStyle('C1')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('D3D3D3'));

        $worksheet->setCellValue('D1', 'gender');
        $worksheet->getStyle('D1')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('D3D3D3'));

        $worksheet->setCellValue('E1', 'course');
        $worksheet->getStyle('E1')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('D3D3D3'));

        $worksheet->setCellValue('F1', 'class_start_time');
        $worksheet->getStyle('F1')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('D3D3D3'));

        $worksheet->setCellValue('G1', 'class_end_time');
        $worksheet->getStyle('G1')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('D3D3D3'));

        $worksheet->setCellValue('H1', 'completed');
        $worksheet->getStyle('H1')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('D3D3D3'));

        // Définition des bordures
        $worksheet->getStyle('A1:D1')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $row = 2;

        foreach ($getAllParticipants as $member) {
            if ($member->email == $member->odcmail) {
                $worksheet->setCellValue('A' . $row, $member->first_name)
                    ->getStyle('A' . $row)
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_LEFT);
                $worksheet->setCellValue('B' . $row, $member->last_name)
                    ->getStyle('B' . $row)
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_LEFT);
            }else{
                $worksheet->setCellValue('A' . $row, $member->name)
                    ->getStyle('A' . $row)
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_LEFT);
            }
            $worksheet->setCellValue('C' . $row, $member->email)
                ->getStyle('C' . $row)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $worksheet->setCellValue('D' . $row, $member->gender)
                ->getStyle('D' . $row)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $worksheet->setCellValue('E' . $row, $member->course)
                ->getStyle('E' . $row)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $worksheet->setCellValue('F' . $row, $member->class_start_time)
                ->getStyle('F' . $row)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $worksheet->setCellValue('G' . $row, $member->class_end_time)
                ->getStyle('G' . $row)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $worksheet->setCellValue('H' . $row, $member->completed)
                ->getStyle('H' . $row)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);
            $row++;
        }

        // On crée le fichier Excel
        $writer = new Xlsx($spreadsheet);
        $fileName = "participants_coursera.xlsx";
        $tempFile = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($tempFile);

        // On renvoie le fichier Excel au navigateur
        return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
    }
    //----------------------------------------------------------------------------------------------------
}
