<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Odcuser;
use App\Models\Activite;
use App\Models\Candidat;
use App\Models\Presence;
use Illuminate\Http\Request;
use function PHPSTORM_META\type;

use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreOdcuserRequest;
use App\Http\Requests\UpdateOdcuserRequest;

class OdcuserController extends Controller
{
    public function index()
    {
        return view('odcusers.index');
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $searchTerms = explode(' ', $searchTerm);

        $query = Odcuser::query();

        foreach ($searchTerms as $term) {
            $query->where(function ($q) use ($term) {
                $q->where('first_name', 'LIKE', "%{$term}%")
                ->orWhere('last_name', 'LIKE', "%{$term}%");
            });
        }

        $odcusers = $query->take(4)
            ->latest()
            ->get();

        return response()->json($odcusers);
    }


    public function getUsers(Request $request)
    {
        $users = Odcuser::latest()->get();
        try {
            $query = Odcuser::query()->latest();

            return DataTables::eloquent($query)
                ->editColumn('firstname', function ($odcuser) {
                    return $odcuser->first_name;
                })
                ->editColumn('lastname', function ($odcuser) {
                    return $odcuser->last_name;
                })
                ->editColumn('email', function ($odcuser) {
                    return $odcuser->email;
                })

                ->editColumn('gender', function ($odcuser) {
                    return $odcuser->gender;
                })

                ->editColumn('birth_date', function ($odcuser) {
                    $birthd = strtotime($odcuser->birth_date);
                    $birth_date = date('d-m-Y', $birthd);
                    return $birth_date;
                })

                ->editColumn('profession', function ($odcuser) {
                    $profession = json_decode($odcuser->profession, true);
                    return $profession['translations']['fr']['profession'] ?? '';
                })
                ->editColumn('detail_profession', function ($odcuser) {
                    $detail_profession = json_decode($odcuser->detail_profession, true);
                    return $detail_profession['speciality'] ?? '';
                })

                ->addColumn('action', function ($odcuser) {
                    return view('partials.users-btn-action', ['odcuser' => $odcuser])->render();
                })

                ->make(true);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Une erreur est survenue : ' . $e->getMessage()], 500);
        }
    }


    public function show(Odcuser $odcuser)
    {
        $nbrEvents = Candidat::where('odcuser_id', $odcuser->id)->count();
        $nbrParticipation = $odcuser->candidat()->where('status', 'accept')->count();

        $userId = $odcuser->id;
        $activitesP = DB::select(
            '
            SELECT act.*, cat.name
            FROM activites act
            JOIN candidats c ON act.id = c.activite_id
            JOIN categories cat ON act.categorie_id = cat.id
            WHERE c.odcuser_id = ? AND (c.status = ?)
            ORDER BY c.createdAt
            LIMIT 3',
            [$userId, 'accept']
        );


        $activitespAll = DB::select(
            '
           SELECT act.*, cat.name
            FROM activites act
            JOIN candidats c ON act.id = c.activite_id
            JOIN categories cat ON act.categorie_id = cat.id
            WHERE c.odcuser_id = ? AND (c.status = ?)
            ORDER BY c.createdAt
            LIMIT 3',
            [$userId, 'accept']
        );

        $activitesC = DB::select(
            '
            SELECT act.*, cat.name
            FROM activites act
            JOIN categories cat ON act.categorie_id = cat.id
            JOIN candidats c ON act.id = c.activite_id
            WHERE c.odcuser_id = ?
            ORDER BY c.createdAt
            ',
            [$userId]
        );

        $taux_presence = null;
        $total_dates_presences = Presence::count();
        $candidats = Candidat::where('odcuser_id', $odcuser->id)->with('candidat_attribute')->get();
        if (isset($candidats)) {
            $odcuserDatas = [];
            $labels = [];
            foreach ($candidats as $candidat) {
                $array = $candidat->toArray();
                $total_presences = $candidat->presence()->count();
                $taux_presence = ($total_presences / $total_dates_presences) * 100;
                if (isset($candidat->candidat_attribute)) {
                    foreach ($candidat->candidat_attribute as $attribute) {
                        $array[$attribute->label] = $attribute->value;
                        if (!in_array($attribute->label, $labels)) {
                            $labels[] = $attribute->label;
                        }
                    }
                    $odcuserDatas[] = $array;
                }
            }
        } else {
            echo "Sorry the user does not exist.";
        }
        return view('odcusers.show', compact('taux_presence', 'activitespAll', 'nbrParticipation', 'activitesC', 'activitesP', 'odcuser', 'candidats', 'nbrEvents', 'odcuserDatas', 'labels'));
    }

    public function edit(Odcuser $odcuser)
    {
        return view('odcusers.edit', compact('odcuser'));
    }


    public function update(UpdateOdcuserRequest $request, Odcuser $odcuser)
    {
        $odcuser->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'bithdate' => $request->bithdate,
            'linkedin' => $request->linkedin,
            'profession' => $request->profession,
            'company' => $request->company,
            'university' => $request->university,
            'speciality' => $request->speciality,
            'country' => $request->country,
        ]);

        return redirect()->route('odcusers.index')->with('success', 'Odcuser updated successfully');
    }
}