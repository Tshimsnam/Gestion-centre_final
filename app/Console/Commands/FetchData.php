<?php

namespace App\Console\Commands;

use Exception;
use App\Models\Hashtag;
use App\Models\Activite;
use App\Models\Categorie;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class FetchData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-events';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for fetching all active events from the API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Fetch data from the API
        try {

            $this->info('Fetch Events data from API and store in database........');

            $url = env('API_URL');

            $response = Http::timeout("100000")->get("http://10.143.41.70:8000/2024/odc/public/api/events/active");

            if ($response->successful()) {

                $data = $response->object();
                // Check if the API returned an error code (401: Unauthorized)
                if (isset($data->code) && $data->code === 401) {
                    $this->error("Token expired, refreshing...");

                    // Refresh the token and retry the request
                    $this->refreshToken();
                }

                $workshops = $response->json()['data'];

                $result = array_reverse($workshops);


                $i = 1;
                foreach ($result as $workshopData) {
                    $end = Carbon::parse($workshopData['endDate']);
                    $start = Carbon::parse($workshopData['startDate']);
                    $startD = Carbon::parse($workshopData['createdAt']);
                    $upD = Carbon::parse($workshopData['updatedAt']);

                    $existingActivity = Activite::where('updated_at', $upD)->first();
                    if ($existingActivity) {
                        $this->info("Workshop already exists: " . $workshopData['translations']['fr']['title']);
                        continue;
                    } else {
                        $this->info('Update Events from API ........');

                        $categoryName = isset($workshopData['categories'][0]) ? $workshopData['categories'][0] : "";
                        $category = Categorie::firstOrCreate(['name' => $categoryName]);

                        $contentFr = '';
                        if (isset($workshopData['translations']['fr']['content'])) {
                            foreach ($workshopData['translations']['fr']['content'] as $contentItem) {
                                if ($contentItem['type'] == 'content' && $contentItem['lang'] == 'fr') {
                                    $contentFr = $contentItem['data']['content'] ?? '';
                                    break;
                                }
                            }
                        }

                        $activityData = [
                            'title' => $workshopData['translations']['fr']['title'],
                            'content' => $contentFr,
                            'categorie_id' => $category->id,
                            'start_date' => $start,
                            'status' => $workshopData['status'],
                            '_id' => $workshopData['_id'],
                            'publish_status' => $workshopData['publishStatus'],
                            'show_in_slider' => $workshopData['showInSlider'],
                            'send' => $workshopData['send'],
                            'form_id' => rand(1, 23),
                            'miniature_color' => isset($workshopData['miniatureColor']) ? $workshopData['miniatureColor'] : '',
                            'show_in_calendar' => $workshopData['showInCalendar'],
                            'live_status' => $workshopData['liveStatus'],
                            'book_a_seat' => isset($workshopData['bookASeat']) ? $workshopData['bookASeat'] : false,
                            'is_events' => $workshopData['isEvents'],
                            'createdAt' => $startD,
                            'updatedAat' => $upD,
                            'creator' => json_encode($workshopData['creator']),
                            'end_date' => $end,
                            'location' => isset($workshopData['location']) ? $workshopData['location'] : '',
                            'thumbnail_url' => isset($workshopData['thumbnailURL']) ? $workshopData['thumbnailURL'] : '',
                        ];

                        $activites = Activite::firstOrCreate(['_id' => $workshopData['_id']], $activityData);

                        foreach ($workshopData['hashtags'] as $hashtagName) {
                            $hashtag = Hashtag::firstOrCreate(['name' => $hashtagName]);
                            $activites->hashtag()->attach($hashtag->id);
                        }
                    }
                    $this->info("Synchronisation {$i} " . $workshopData['translations']['fr']['title']);
                    $i++;
                }
                $this->info('Event data fetched and stored successfully.');
            } else {
                $this->error('Error fetching workshops data from API. Response status: ' . $response->status());
            }
        } catch (Exception $e) {
            // Handle any errors that occurred during the process
            $this->error('An error occurred: ' . $e->getMessage());
        }
    }

    private function refreshToken()
    {
        $url = env('API_URL');
        // Implement your token refresh logic here
        $response = Http::timeout(10000)->post("http://10.143.41.70:8000/2024/odc/public/api/generer/token");
    }
}
