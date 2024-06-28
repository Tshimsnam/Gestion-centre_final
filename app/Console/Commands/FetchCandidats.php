<?php

namespace App\Console\Commands;

use App\Models\Activite;
use App\Models\Candidat;
use App\Models\CandidatAttribute;
use App\Models\Odcuser;
use Hamcrest\Type\IsInteger;
use Hamcrest\Type\IsString;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class FetchCandidats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    // What to type in the line-command for running the command
    protected $signature = 'sync:candidats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for fetching all the candidates from the api';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Display a message indicating that the syncing process has started
        $this->info('Syncing candidates from api...');

        // Set the API URL from the environment variable
        $url = env('API_URL');
        dd($url);
        // Fetch all the _id values for each event from the Activite model
        $activites = Activite::pluck('_id')->toArray();

        // Initialize a counter for the number of fetch operations
        $fetchCount = 1;

        // Loop through each event _id
        foreach ($activites as $key => $value) {
            // Display a message indicating which event is being fetched
            $this->info("Fetching the api url for event $fetchCount");

            // Send a GET request to the API with the current event _id
            $queryEvent = Http::timeout(10000)->get("$url/events/show/$value");

            // Check if the request was successful
            if ($queryEvent->successful()) {
                // Display a message indicating that the fetch was successful
                $this->info("Finished fetch $fetchCount");

                // Get the response data from the API
                $data = $queryEvent->object();

                // Check if the API returned an error code 401 (token expired)
                if (isset($data->code) && $data->code == 401) {
                    $this->error("Your token has expired, please reset it.");
                    exit;
                }

                // Get the "data" property from the API response
                $candidats = $data->data;

                // Initialize a counter for the number of candidates being saved
                $e = 1;

                // Loop through each candidate in the API response
                foreach ($candidats as $candidat) {
                    // Check if both the odcuser and event exist in the API response
                    $odcuser = Odcuser::where('_id', $candidat->user->_id)->first();
                    $activite = Activite::where('_id', $candidat->event->_id)->first();

                    // If both exist, create or update the candidate
                    if (isset($odcuser) && isset($activite)) {
                        $this->info("The odcuser and the activity exist in the fetch response, making the request...");

                        // Create an array of candidate information
                        $candidatInfo = [
                            'odcuser_id' => $odcuser->id,
                            'activite_id' => $activite->id,
                            'status' => 1
                        ];

                        // Display a message indicating that the candidate is being created
                        $this->info("Creating the candidate $e...");

                        // Create or update the candidate
                        $candidate = Candidat::firstOrCreate($candidatInfo);
                        $this->info("Candidate $e created successfully.");

                        // If the candidate has form registration data, loop through it
                        if (isset($candidat->formRegistrationData)) {
                            foreach ($candidat->formRegistrationData->inputs as $key => $input) {
                                // Get the options for the input field
                                if (isset($input->translations->fr->input->options)) {
                                    $options = $input->translations->fr->input->options;
                                    if (isset($input->value)) {
                                        // Get the selected option value
                                        $v = $input->value - 1;
                                        $str = isset($options) ? ($options[$v]->label) : ($input->value ? $input->value : "null");
                                        $val = is_string($str) || is_int($str);
                                        $value = ($val) ? $str : "";
                                    }
                                }
                                dump($value) ;

                                // Create an array of candidate attribute information
                                $candidateAttributes = [
                                    '_id' => $input->_id,
                                    'label' => $input->translations->fr->input->label,
                                    'value' => isset($value) ? ($value) : ($input->value ? $input->value : "null"),
                                    'candidat_id' => $candidate->id
                                ];

                                // Display a message indicating that the candidate attribute is being created
                                $this->info("Creating the candidate attribute...");

                                try {
                                    // Create or update the candidate attribute
                                    CandidatAttribute::firstOrCreate($candidateAttributes);
                                } catch (\Throwable $v) {
                                    dd($v->getMessage());
                                }

                                // Display a message indicating that the candidate attribute was created successfully
                                $this->info("Candidate attribute created successfully!");
                            }
                        }
                        $e++;
                    }
                }
                $this->info("Data synced successfully");
            } else {
                $this->info("Failed to retrieve candidates data! Please retry!");
            }
            // Increment the fetch count
            $fetchCount++;
        }
        $this->info("Operation succeded with error code 0.");
    }
}
