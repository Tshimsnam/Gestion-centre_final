<?php

namespace App\Http\Controllers\Api;

use DateTime;
use Carbon\Carbon;
use DateTimeImmutable;
use App\Models\Activite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\Facades\DataTables;

class ActiviteController extends Controller
{

    private $id_event;
    private $candidat;
    public function index()
    {
        $activite = Activite::all();
        return response()->json($activite);
    }

    public function store(Request $request)
    {
        $url = env('API_URL');
        foreach ($request->input('content') as $content) {
            if ($content['type'] === 'paragraph') {
                $activite = [
                    "title" => $request->title,
                    "categories" => $request->categories,
                    "hashtags" => $request->hashtags,
                    "content" => $request->contents,
                    "form" => $request->form,
                    "thumbnail_url" => $request->thumbnailURL,
                    "endDate" => $request->endDate,
                    "startDate" => $request->startDate,
                    "location" => $request->location,
                    "contents" => [
                        [
                            'id' => uniqid(),
                            'type' => 'paragraphe',
                            'data' => [
                                'text' => $content['text'],

                            ],
                        ],

                        [
                            'id' => uniqid(),
                            'type' => 'contents',
                            'data' => [
                                'content' => $request->contents,

                            ],
                        ]


                    ],

                ];

                try {

                    $requette = Http::timeout(100)
                        ->post("$url/events/create", $activite);

                    // Check if the request was successful
                    if ($requette->successful()) {
                        return response()->json(['success' => true, 'data' => $requette->json()], 201);
                    } else {
                        return response()->json(['success' => false, 'message' => 'Erreur lors de la création de l\'événement', 'error' => $requette->body()], $requette->status());
                    }
                } catch (\Exception $e) {

                    return response()->json(['success' => false, 'message' => 'Request failed', 'error' => $e->getMessage()], 500);
                }
            } elseif ($content['type'] === 'socialMedia') {
                $activite = [
                    "title" => $request->title,
                    "categories" => $request->categories,
                    "hashtags" => $request->hashtags,
                    "content" => $request->contents,
                    "form" => $request->form,
                    "thumbnailURL" => $request->thumbnailURL,
                    "endDate" => $request->endDate,
                    "startDate" => $request->startDate,
                    "location" => $request->location,
                    "contents" => [
                        'id' => uniqid(),
                        'type' => 'socialmedia',
                        'data' => [
                            'link' => $content['link'],

                        ],
                    ],


                ];

                try {

                    $requette = Http::timeout(100)
                        ->post("$url/events/create", $activite);

                    // Check if the request was successful
                    if ($requette->successful()) {
                        return response()->json(['success' => true, 'data' => $requette->json()], 201);
                    } else {
                        return response()->json(['success' => false, 'message' => 'Erreur lors de la création de l\'événement', 'error' => $requette->body()], $requette->status());
                    }
                } catch (\Exception $e) {

                    return response()->json(['success' => false, 'message' => 'Request failed', 'error' => $e->getMessage()], 500);
                }
            }
        }
    }

    public function show(Activite $activite)
    {
        return response()->json($activite);
    }

    public function getActiviteRecent()
    {

        $activiteRecent = Activite::select('id', 'title', 'content', 'start_date', 'end_date')
            ->where('start_date', '<', now())
            ->latest()
            ->paginate(5);


        $activitefutur = Activite::select('id', 'title', 'content', 'start_date', 'end_date')
            ->where('start_date', '>', now())
            ->latest()
            ->paginate(5);


        $activites = $activiteRecent->merge($activitefutur);

        return response()->json($activites);
    }


    public function get(Request $request)
    {
        try {
            $query = Activite::query()->latest();

            if ($request->has('start_date') && $request->has('end_date')) {
                $query->whereBetween('start_date', [$request->start_date, $request->end_date]);
            }
            return DataTables::eloquent($query)
                ->editColumn('message', function ($activite) {
                    $today = Carbon::today();
                    $startDate = Carbon::parse($activite->start_date);
                    $endDate = Carbon::parse($activite->end_date);

                    if ($today >= $startDate && $today <= $endDate) {
                        return 'En cours';
                    } elseif ($today < $startDate) {
                        $differenceInDays = $startDate->diffInDays($today);
                        return "Jour j-$differenceInDays";
                    } else {
                        $differenceInDays = $endDate->diffInDays($today);
                        return "Terminée ($differenceInDays jours)";
                    }
                })
                ->editColumn('status', function ($activite) {
                    if ($activite->status == 1) {
                        return '✔️';
                    } else {
                        return '❌';
                    }
                })

                ->editColumn('start_date', function ($activite) {
                    $date = new DateTimeImmutable($activite->start_date);
                    return $date->format('j F Y H:i:s');
                })

                ->editColumn('end_date', function ($activite) {
                    $date = new DateTimeImmutable($activite->end_date);
                    return $date->format('j F Y H:i:s');
                })

                ->editColumn('book_a_seat', function ($activite) {
                    if ($activite->book_a_seat == 1) {
                        return '✔️';
                    } else {
                        return '❌';
                    }
                })
                ->editColumn('categorie_id', function ($activite) {
                    return $activite->categorie->name;
                })
                ->editColumn('typEvent', function ($activite) {
                    foreach ($activite->typEvent as $value) {
                        return $value->title;
                    }
                })
                ->addColumn('action', function ($activite) {
                    return view('partials.action-buttons', ['activite' => $activite])->render();
                })

                ->make(true);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Une erreur est survenue : ' . $e->getMessage()], 500);
        }
    }

    public function parcours(Activite $event)
    {
        $this->id_event = $event->id;

        try {
            // Récupérer les candidats ayant participé à des formations avec "parcours"
            $candidats = DB::table('candidats')
                ->join('odcusers', 'candidats.odcuser_id', '=', 'odcusers.id')
                ->where('candidats.status', 'accept')
                ->where('candidats.activite_id', $event->id)
                ->whereIn('candidats.odcuser_id', function ($query) use ($event) {
                    $query->select('candidats.odcuser_id')
                        ->from('candidats')
                        ->join('activites', 'candidats.activite_id', '=', 'activites.id')
                        ->where('activites.title', 'like', '%parcours%')
                        ->where('candidats.activite_id', '<>', $event->id);
                })
                ->select('odcusers.first_name', 'odcusers.last_name', 'odcusers.gender', 'candidats.id', 'candidats.odcuser_id')
                ->get();

            // Ajouter les événements pour chaque candidat
            $candidats->map(function ($candidat) use ($event) {
                $events = Activite::select('title', 'id')
                    ->where('title', 'like', '%parcours%')
                    ->where('id', '<>', $event->id)
                    ->whereHas('candidat', function ($query) use ($candidat) {
                        $query->where('odcuser_id', $candidat->odcuser_id);
                    })
                    ->get();

                // Attacher les événements au candidat
                $candidat->events = $events;
            });

            // Si aucun candidat n'est trouvé, retourner une réponse vide
            if ($candidats->isEmpty()) {
                return response()->json([]);
            }

            return response()->json($candidats, 200);
        } catch (\Throwable $th) {
            // Gérer les erreurs
            return response()->json(['error' => 'Une erreur est survenue'], 500);
        }
    }


    public function nouveaux(Activite $event)
    {
        try {
            $candidats = DB::table('candidats')
                ->join('odcusers', 'candidats.odcuser_id', '=', 'odcusers.id')
                ->where('candidats.activite_id', $event->id)
                ->where('candidats.status', 'accept') // Filtrer uniquement les candidats acceptés
                ->whereNotExists(function ($query) use ($event) {
                    $query->select('odcuser_id')
                        ->from('candidats as c')
                        ->whereColumn('c.odcuser_id', 'candidats.odcuser_id')
                        ->where('c.activite_id', '<>', $event->id);
                })
                ->select('odcusers.first_name', 'odcusers.last_name', 'odcusers.gender', 'candidats.id', 'candidats.odcuser_id')
                ->get();

          
            if ($candidats->isEmpty()) {
                return response()->json([]);
            }

            return response()->json($candidats, 200);
        } catch (\Throwable $th) {

            Log::error('Erreur dans la méthode nouveaux : ' . $th->getMessage());

            return response()->json([
                'error' => 'Une erreur est survenue lors de la récupération des candidats.'
            ], 500);
        }
    }


    public function candidatsAvecCinqFormations(Activite $event)
    {
        try {
            $candidats = DB::table('candidats')
                ->where('candidats.activite_id', $event->id)
                ->where('candidats.status', 'accept')
                ->join('odcusers', 'candidats.odcuser_id', '=', 'odcusers.id')
                ->select('odcusers.first_name', 'odcusers.last_name', 'odcusers.gender', DB::raw('COUNT(candidats.id) as total_formations'))
                ->groupBy('candidats.odcuser_id', 'odcusers.first_name', 'odcusers.last_name', 'odcusers.gender')
                ->having('total_formations', '>=', 5)
                ->get();

            if ($candidats->isEmpty()) {
                return response()->json([]);
            }

            return response()->json($candidats, 200);
        } catch (\Throwable $th) {
            Log::error('Erreur dans la méthode candidatsAvecCinqFormations : ' . $th->getMessage());

            return response()->json([
                'error' => 'Une erreur est survenue lors de la récupération des candidats.'
            ], 500);
        }
    }
}
