@props([
    'event',
    'nbj',
    'candidats',
    'total_ih',
    'total_if',
    'total_ph',
    'total_pf',
    'total_p',
    'participants',
    'nbj',
    'criteres',
])

<div class="hidden p-4 rounded-lg bg-[#eaeaebf3] dark:bg-gray-800" id="styled-details" role="tabpanel"
    aria-labelledby="details-tab">
    <div class="k-state-active k-content" style="opacity: 1; display: block;">
        <div class="weather">
            <div class="flex flex-row">
                <div class="basis-2/4 p-5">
                    @if ($event->thumbnailURL)
                        <img class="" src="{{ $event->thumbnailURL }}" alt="event">
                    @else
                        <img class=""
                            src="{{ asset('https://activites-etudiantes.hec.ca/wp-content/uploads/2024/07/Placeholder_evenement_externe_2024_CALENDRIER.jpg') }}"
                            alt="image">
                    @endif

                    <h2 style="font-size:30px;margin-top:30px;text-decoration:underline;"></h2>

                    <div id="accordion-collapse" data-accordion="collapse">
                        <h2 id="accordion-collapse-heading-1">
                            <button type="button"
                                class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3"
                                data-accordion-target="#accordion-collapse-body-1" aria-expanded="true"
                                aria-controls="accordion-collapse-body-1">
                                <span>{{ $event->title }}</span>
                                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M9 5 5 1 1 5" />
                                </svg>
                            </button>
                        </h2>
                        <div id="accordion-collapse-body-1" class="hidden"
                            aria-labelledby="accordion-collapse-heading-1">
                            <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                                <p class="mb-2 text-gray-500 dark:text-gray-400"> {!! $event->content ?? null !!}</p>

                            </div>
                        </div>

                    </div>

                    <div>
                        <div class="py-5 text-justify">

                            <!-- $item->data->content -->
                        </div>
                    </div>
                </div>
                <div class="basis-2/4">
                    <div class="p-5">
                        @if ($event->status)
                            <span id="badge-dismiss-green"
                                class="inline-flex items-center px-2 py-1 me-2 text-sm font-medium text-green-800 bg-green-100 rounded dark:bg-green-900 dark:text-green-300">
                                Status
                                <button type="button"
                                    class="inline-flex items-center p-1 ms-2 text-sm text-green-400 bg-transparent rounded-sm hover:bg-green-200 hover:text-green-900 dark:hover:bg-green-800 dark:hover:text-green-300"
                                    aria-label="Remove">
                                    <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 16 12">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5" />
                                    </svg>
                                    <span class="sr-only">Remove badge</span>
                                </button>
                            </span>
                        @else
                            <span id="badge-dismiss-red"
                                class="inline-flex items-center px-2 py-1 me-2 text-sm font-medium text-red-800 bg-red-100 rounded dark:bg-red-900 dark:text-red-300">
                                status
                                <button type="button"
                                    class="inline-flex items-center p-1  ms-2 text-sm text-red-400 bg-transparent rounded-sm hover:bg-red-200 hover:text-red-900 dark:hover:bg-red-800 dark:hover:text-red-300"
                                    aria-label="Remove">
                                    <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Remove badge</span>
                                </button>
                            </span>
                        @endif


                        @if ($event->deleted)
                            <span id="badge-dismiss-green"
                                class="inline-flex items-center px-2 py-1 me-2 text-sm font-medium text-green-800 bg-green-100 rounded dark:bg-green-900 dark:text-green-300">
                                Deleted
                                <button type="button"
                                    class="inline-flex items-center p-1 ms-2 text-sm text-green-400 bg-transparent rounded-sm hover:bg-green-200 hover:text-green-900 dark:hover:bg-green-800 dark:hover:text-green-300"
                                    aria-label="Remove">
                                    <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 16 12">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5" />
                                    </svg>
                                    <span class="sr-only">Remove badge</span>
                                </button>
                            </span>
                        @else
                            <span id="badge-dismiss-red"
                                class="inline-flex items-center px-2 py-1 me-2 text-sm font-medium text-red-800 bg-red-100 rounded dark:bg-red-900 dark:text-red-300">
                                Deleted
                                <button type="button"
                                    class="inline-flex items-center p-1  ms-2 text-sm text-red-400 bg-transparent rounded-sm hover:bg-red-200 hover:text-red-900 dark:hover:bg-red-800 dark:hover:text-red-300"
                                    aria-label="Remove">
                                    <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Remove badge</span>
                                </button>
                            </span>
                        @endif


                        @if ($event->showInCalendar)
                            <span id="badge-dismiss-green"
                                class="inline-flex items-center px-2 py-1 me-2 text-sm font-medium text-green-800 bg-green-100 rounded dark:bg-green-900 dark:text-green-300">
                                Calendrier
                                <button type="button"
                                    class="inline-flex items-center p-1 ms-2 text-sm text-green-400 bg-transparent rounded-sm hover:bg-green-200 hover:text-green-900 dark:hover:bg-green-800 dark:hover:text-green-300"
                                    aria-label="Remove">
                                    <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 16 12">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5" />
                                    </svg>
                                    <span class="sr-only">Remove badge</span>
                                </button>
                            </span>
                        @else
                            <span id="badge-dismiss-red"
                                class="inline-flex items-center px-2 py-1 me-2 text-sm font-medium text-red-800 bg-red-100 rounded dark:bg-red-900 dark:text-red-300">
                                Calendrier
                                <button type="button"
                                    class="inline-flex items-center p-1  ms-2 text-sm text-red-400 bg-transparent rounded-sm hover:bg-red-200 hover:text-red-900 dark:hover:bg-red-800 dark:hover:text-red-300"
                                    aria-label="Remove">
                                    <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Remove badge</span>
                                </button>
                            </span>
                        @endif

                        @if ($event->showInSlider)
                            <span id="badge-dismiss-green"
                                class="inline-flex items-center px-2 py-1 me-2 text-sm font-medium text-green-800 bg-green-100 rounded dark:bg-green-900 dark:text-green-300">
                                Slide
                                <button type="button"
                                    class="inline-flex items-center p-1 ms-2 text-sm text-green-400 bg-transparent rounded-sm hover:bg-green-200 hover:text-green-900 dark:hover:bg-green-800 dark:hover:text-green-300"
                                    aria-label="Remove">
                                    <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 16 12">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5" />
                                    </svg>
                                    <span class="sr-only">Remove badge</span>
                                </button>
                            </span>
                        @else
                            <span id="badge-dismiss-red"
                                class="inline-flex items-center px-2 py-1 me-2 text-sm font-medium text-red-800 bg-red-100 rounded dark:bg-red-900 dark:text-red-300">
                                Slide
                                <button type="button"
                                    class="inline-flex items-center p-1  ms-2 text-sm text-red-400 bg-transparent rounded-sm hover:bg-red-200 hover:text-red-900 dark:hover:bg-red-800 dark:hover:text-red-300"
                                    aria-label="Remove">
                                    <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Remove badge</span>
                                </button>
                            </span>
                        @endif

                        @if ($event->bookASeat)
                            <span id="badge-dismiss-green"
                                class="inline-flex items-center px-2 py-1 me-2 text-sm font-medium text-green-800 bg-green-100 rounded dark:bg-green-900 dark:text-green-300">
                                Formulaire
                                <button type="button"
                                    class="inline-flex items-center p-1 ms-2 text-sm text-green-400 bg-transparent rounded-sm hover:bg-green-200 hover:text-green-900 dark:hover:bg-green-800 dark:hover:text-green-300"
                                    aria-label="Remove">
                                    <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 16 12">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5" />
                                    </svg>
                                    <span class="sr-only">Remove badge</span>
                                </button>
                            </span>
                        @else
                            <span id="badge-dismiss-red"
                                class="inline-flex items-center px-2 py-1 me-2 text-sm font-medium text-red-800 bg-red-100 rounded dark:bg-red-900 dark:text-red-300">
                                Formulaire
                                <button type="button"
                                    class="inline-flex items-center p-1  ms-2 text-sm text-red-400 bg-transparent rounded-sm hover:bg-red-200 hover:text-red-900 dark:hover:bg-red-800 dark:hover:text-red-300"
                                    aria-label="Remove">
                                    <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Remove badge</span>
                                </button>
                            </span>
                        @endif

                    </div>
                    <hr>
                    <div class="columns-4 p-4 bg-slate-100" style="font-variant:small-caps;font-size:1.1em">
                        <div>
                            <div class=""><b>Date de création</b></div>
                            <div class="text-xs">{{ $event->createdAt }}</div>
                        </div>
                        <div>
                            <div class=""><b>Date Début</b></div>
                            <div class="text-xs">{{ $event->start_date }}</div>
                        </div>
                        <div>
                            <div class=""><b>Date Fin</b></div>
                            <div class="text-xs">{{ $event->end_date }}</div>
                        </div>

                        <div>
                            <div class=""><b>Durée</b></div>
                            <div class="text-xs">{{ $nbj }}</div>
                        </div>

                    </div>
                    @php
                        $temps = null;
                        $date = new DateTime();
                        $date0 = new DateTime($event->createdAt);
                        $date1 = new DateTime($event->start_date);
                        $date2 = new DateTime($event->end_date);
                        $d1 = date_diff($date1, $date)->days;
                        $d2 = date_diff($date2, $date)->days;
                        $d3 = date_diff($date1, $date2)->days;
                        $d0 = date_diff($date, $date0)->days;
                        $d10 = date_diff($date1, $date0)->days;
                        $check = $d1 - $d2; // Affiche 9

                        if (($date1 <= $date) & ($date2 >= $date)) {
                            if ((int) $d3 - (int) $d1 > 0) {
                                $percent = ($d1 * 100) / $d3;
                            } else {
                                $percent = 100;
                            }
                            $temps =
                                '<div class="flex justify-between mb-1">
                                    <span class="text-base font-medium text-green-700 dark:text-white">En cours</span>
                                    <span class="text-sm font-medium text-green-700 dark:text-white">' .
                                $percent .
                                '</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                    <div class="bg-green-600 h-2.5 rounded-full" style="width: ' .
                                $percent .
                                '%"></div>
                                </div>';
                        } elseif ($date1 > $date) {
                            if ((int) $d0 > 0) {
                                $percent = ($d0 * 100) / $d10;
                            } else {
                                $percent = 100;
                            }

                            if ($d1 == 1) {
                                $temps =
                                    '<div class="flex justify-between mb-1">
                                    <span class="text-base font-medium text-blue-700 dark:text-white">Dans 1 jour</span>
                                    <span class="text-sm font-medium text-blue-700 dark:text-white">' .
                                    $percent .
                                    '%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: ' .
                                    $percent .
                                    '%"></div>
                                </div>';
                            } else {
                                $temps =
                                    '<div class="flex justify-between mb-1">
                                    <span class="text-base font-medium text-blue-700 dark:text-white">' .
                                    $d1 .
                                    ' jours</span>
                                    <span class="text-sm font-medium text-blue-700 dark:text-white">' .
                                    $percent .
                                    '%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: ' .
                                    $percent .
                                    '%"></div>
                                </div>';
                            }
                        } else {
                            if ($d2 == -1) {
                                $temps = '<div class="flex justify-between mb-1">
                                    <span class="text-base font-medium text-orange-700 dark:text-white">il y a 1 jour</span>
                                    <span class="text-sm font-medium text-orange-700 dark:text-white">100%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                    <div class="bg-orange-600 h-2.5 rounded-full" style="width: 100%"></div>
                                </div>';
                            } else {
                                $temps =
                                    '<div class="flex justify-between mb-1">
                                    <span class="text-base font-medium text-gray-400 dark:text-white">il y a ' .
                                    $d2 .
                                    ' jours</span>
                                    <span class="text-sm font-medium text-gray-400 dark:text-white">100%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                    <div class="bg-silver-600 h-2.5 rounded-full" style="width: 100%"></div>
                                </div>';
                            }
                        }

                    @endphp
                    <div class="py-2">
                        {!! $temps !!}
                    </div>
                    <hr>
                    <div class="columns-3 btt my-5 text-center">
                        <div
                            class="text-center bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transform hover:scale-105 duration-500 p-3">
                            <h4>{{ $candidats->count() }}</h4>
                            <p>Total Inscrits</p>
                        </div>
                        <div
                            class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transform hover:scale-105 duration-500 p-3">
                            <h4>{{ $total_ih }}</h4>
                            <p>Total Hommes</p>
                        </div>
                        <div
                            class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transform hover:scale-105 duration-500 p-3">

                            <h4>{{ $total_if }}</h4>
                            <p>Total Femmes</p>
                        </div>
                    </div>



                    <div class="columns-3 btt2 my-5 text-center">
                        <div
                            class="text-center bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transform hover:scale-105 duration-500 p-3">
                            <h4>{{ $total_p }}</h4>
                            <p>Total Participants</p>
                        </div>
                        <div
                            class="text-center bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transform hover:scale-105 duration-500 p-3">
                            <h4>{{ $total_ph }}</h4>
                            <p>Total Participants Hommes</p>
                        </div>
                        <div
                            class=" text-center bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transform hover:scale-105 duration-500 p-3">
                            <h4>{{ $total_pf }}</h4>
                            <p>Total Participants Femmes</p>
                        </div>
                    </div>

                    <hr>

                    <div class="grid grid-cols-2 gap-2">

                        <div data-modal-target="parcours-modal" data-modal-toggle="parcours-modal"
                            onclick="parcours({{ $event->id }})" style="cursor: pointer;"
                            class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 ">
                            Les candidats ayants participés à un parcours</div>




                        <div data-modal-target="news-modal" data-modal-toggle="news-modal"
                            onclick="nouveau({{ $event->id }})" style="cursor: pointer;"
                            class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                            Les nouveaux candidats</div>




                        <div data-modal-target="cinq-modal" data-modal-toggle="cinq-modal"
                            onclick="cinq_event({{ $event->id }})" style="cursor: pointer;"
                            class="text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 shadow-lg shadow-cyan-500/50 dark:shadow-lg dark:shadow-cyan-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                            Les candidats ayants participés à 5 formations ou plus</div>

                        <a href="{{ route('activites.update', $event->id) }}"
                            class="text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 shadow-lg shadow-cyan-500/50 dark:shadow-lg dark:shadow-cyan-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                            Modifier Activite</a>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
