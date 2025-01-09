<x-app-layout>
    <!-- Display errors if any -->
    @if ($errors->any())
        @foreach ($errors->all() as $i => $error)
            <div id="alert-border-2{{ $i }}"
                class="flex items-center p-4 mb-4 text-red-800 border-t-4 border-red-300 bg-red-50 dark:text-red-400 dark:bg-gray-800 dark:border-red-800"
                role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <div class="ms-3 text-sm font-medium">
                    {{ $error }}
                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
                    data-dismiss-target="#alert-border-2{{ $i }}" aria-label="Close">
                    <span class="sr-only">Dismiss</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @endforeach
    @endif

    <style>
        #candidatpresence tbody tr:hover,
        #participantTable tbody tr:hover,
        #candidatTable tbody tr:hover {
            background-color: #f1f1f1;
        }

        /* Styles pour les états des onglets */
        [role="tab"].active {
            @apply bg-white dark:bg-gray-800 text-gray-900 dark:text-white;
        }

        [role="tab"]:not(.active) {
            @apply text-gray-600 dark:text-gray-300 hover:bg-white/80 dark:hover:bg-gray-700/80;
        }
    </style>

    <!-- Header section -->
    <x-slot name="header">
        <li class="inline-flex items-center">
            <a href="#"
                class="inline-flex space-x-2 items-center text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                @yield('svg')
            </a>
            <div class="flex justify-between items-center">
                <div>
                    <!-- Title of the page -->
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight hover:cursor-pointer"
                        id="dropDownListActivities" data-dropdown-toggle="otherEvents">
                        Activités
                    </h2>

                    <div id="otherEvents"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="dropDownListActivities">
                            {{-- @foreach ($otherActivities as $event)
                                <li>
                                    <a href="{{ route('activites.show', $event->id) }}"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                        {{ $event->title }}
                                    </a>
                                </li>
                            @endforeach --}}
                        </ul>
                        <div class="py-2">
                            <a href="{{ route('activites.index') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                Voir toutes les autres activités
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div class="flex items-center">
                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd">
                    </path>
                </svg>
            </div>
        </li>
        <li class="inline-flex items-center">
            <a href="#"
                class="inline-flex space-x-2 items-center text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                @yield('svg')
            </a>
            <div class="flex justify-between items-center">
                <div>
                    <!-- Title of the page -->
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{ __($activite->title) }}
                    </h2>
                </div>
            </div>
        </li>
    </x-slot>

    @if (Session('success'))
        <div id="alert-border-3"
            class="flex items-center p-4 my-6 text-green-800 border-t-4 border-green-300 bg-green-50 dark:text-green-400 dark:bg-gray-800 dark:border-green-800"
            role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <div class="ms-3 text-sm font-medium">
                {{ Session('success') }}
            </div>
            <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                data-dismiss-target="#alert-border-3" aria-label="Close">
                <span class="sr-only">Dismiss</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    @endif

    <!-- Tab navigation -->
    <div class="inline-flex rounded-lg shadow-sm bg-gray-100 dark:bg-gray-700 p-1 my-5">
        <button id="details-btn"
            class="tab-btn inline-flex items-center px-4 py-2 text-sm font-medium rounded-md transition-all duration-200"
            data-view="details">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Details
        </button>

        <button id="candidats-btn"
            class="tab-btn inline-flex items-center px-4 py-2 text-sm font-medium rounded-md transition-all duration-200"
            data-view="candidats">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            Candidats
        </button>

        <button id="participants-btn"
            class="tab-btn inline-flex items-center px-4 py-2 text-sm font-medium rounded-md transition-all duration-200"
            data-view="participants">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            Participants
        </button>

        <button id="presences-btn"
            class="tab-btn inline-flex items-center px-4 py-2 text-sm font-medium rounded-md transition-all duration-200"
            data-view="presences">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
            </svg>
            Présences
        </button>

        <button id="import-btn"
            class="tab-btn inline-flex items-center px-4 py-2 text-sm font-medium rounded-md transition-all duration-200"
            data-view="import">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
            </svg>
            Import
        </button>
    </div>


    <div class="flex space-x-2">
        <a href="#" id="acceptAllBtn" data-status="accept"
            class="hidden py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-[#FF7322] text-white hover:bg-[#FF6822] focus:outline-none focus:ring-2 focus:ring-[#FF6822] transition duration-200">Accepter</a>
        <a href="#" id="rejectAllBtn" data-status="decline"
            class="hidden py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-[#FF7322] text-white hover:bg-[#FF6822] focus:outline-none focus:ring-2 focus:ring-[#FF6822] transition duration-200">Rejeter</a>
        <a href="#" id="awaitAllBtn" data-status="wait"
            class="hidden py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-[#FF7322] text-white hover:bg-[#FF6822] focus:outline-none focus:ring-2 focus:ring-[#FF6822] transition duration-200">Mettre
            en attente</a>
    </div>

    <!-- Tab content -->
    <div id="details-view" class="tab-view p-4 rounded-lg bg-white dark:bg-gray-800 shadow-sm">

        <x-activitesShow :nbj="$nbj" :event="$activite" :candidats="$candidats" :total_ih="$total_ih" :total_if="$total_if"
            :total_ph="$total_ph" :total_pf="$total_pf" :total_p="$total_p" />

    </div>

    <div id="candidats-view" class="tab-view hidden p-4 rounded-lg bg-white dark:bg-gray-800 shadow-sm">
        <x-show-candidates-event :activite="$activite" :labels="$labels" :candidatsData="$candidatsData" :odcusers="$odcusers"
            :id="$id" />
    </div>

    <div id="participants-view" class="tab-view hidden p-4 rounded-lg bg-white dark:bg-gray-800 shadow-sm">
        <x-show-participants-event :participantsData="$participantsData" :activite="$activite" :labels="$labels" :candidatsData="$candidatsData"
            :odcusers="$odcusers" :id="$id" :modelMail="$modelMail" />
    </div>

    <div id="presences-view" class="tab-view hidden p-4 rounded-lg bg-white dark:bg-gray-800 shadow-sm">
        <x-activite-presence-component :fullDates="$fullDates" :dates="$dates" :presencesData="$presencesData" />
    </div>

    <div id="import-view" class="tab-view hidden p-4 rounded-lg bg-white dark:bg-gray-800 shadow-sm">
        <x-activite-import :activite="$activite" />
    </div>




    @php
        $url = env('API_URL');
    @endphp

    @section('script')
        <script src="https://cdn.datatables.net/fixedcolumns/5.0.4/js/dataTables.fixedColumns.js"></script>
        <script src="https://cdn.datatables.net/fixedcolumns/5.0.4/js/fixedColumns.dataTables.js"></script>
        <script>
            $(document).ready(function() {
                $('#createUserBtn').click(function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: "Ajouter un participant",
                        html: `
                            <div class="mx-auto">
                                <form id="newUserForm" class="p-4 mx-auto md:p-5" action="{{ route('userlocal') }}" method="POST">
                                    @csrf
                                    <div class="grid gap-5 mb-4 grid-cols-2">
                                        <div class="col-span-2 flex items-center space-x-4">
                                            <label for="first_name"
                                                class="block mb-2 text-sm w-52 font-medium text-left text-gray-900 dark:text-white">Prénom</label>
                                            <input type="text" name="first_name" id="first_name"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-72 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                placeholder="Prénom" required>
                                        </div>
                                        <div class="col-span-2 flex items-center space-x-4">
                                            <label for="last_name"
                                                class="block mb-2 text-sm w-52 font-medium text-left text-gray-900 dark:text-white">Nom</label>
                                            <input type="text" name="last_name" id="last_name"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-72 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                placeholder="Nom" required>
                                        </div>
                                        <div class="col-span-2 flex items-center space-x-4">
                                            <label for="email"
                                                class="block mb-2 text-sm w-52 font-medium text-left text-gray-900 dark:text-white">
                                                Adresse mail (facultatif)
                                                </label>
                                            <input type="email" name="email" id="email"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-72 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                placeholder="nom@exemple.com">
                                        </div>
                                        <div class="col-span-2 flex items-center space-x-4">
                                            <label for="gender"
                                                class="block mb-2 text-sm w-52 font-medium text-left text-gray-900 dark:text-white">
                                                Genre
                                            </label>
                                            <select id="gender" name="gender" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-72 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                                <option value="">Choisir une option</option>
                                                <option value="male">Homme</option>
                                                <option value="female">Femme</option>
                                            </select>
                                        </div>
                                        <div class="col-span-2 flex items-center space-x-4">
                                            <label for="phone"
                                                class="block mb-2 text-sm w-52 font-medium text-left text-gray-900 dark:text-white">
                                                Numéro de téléphone (obligatoire)
                                            </label>
                                            <input type="phone" name="phone" id="phone"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-72 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                placeholder="+216 00 000 000" required>
                                        </div>
                                        <input type="hidden" name="activite" id="activite" value="{{ $activite->id }}">
                                        <input type="hidden" name="createdByAdmin" value="true">
                                    </div>
                                    <div class=" flex justify-end mt-4 mb-4">
                                        <button type="submit" id="submitNewUserForm"
                                            class="col-span-2 w-52 text-center space-x-2 mx-auto text-white inline-flex items-center bg-odcolor hover:bg-odcolor/75 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-md px-5 py-2.5 dark:bg-orange-500 dark:hover:bg-orange-400 dark:focus:ring-wite-800">
                                            <svg class="w-6 h-6 text-white space-x-4" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M9 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H7Zm8-1a1 1 0 0 1 1-1h1v-1a1 1 0 1 1 2 0v1h1a1 1 0 1 1 0 2h-1v1a1 1 0 1 1-2 0v-1h-1a1 1 0 0 1-1-1Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span>Enregistrer</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        `,
                        showClass: {
                            popup: `
                            animate__animated
                            animate__fadeInUp
                            animate__faster
                            `
                        },
                        hideClass: {
                            popup: `
                            animate__animated
                            animate__fadeOutDown
                            animate__faster
                            `
                        },
                        showConfirmButton: false,
                        preConfirm: () => {
                            const formData = new FormData($('#newUserForm')[0]);

                            const first_name = formData.get('first_name');
                            const last_name = formData.get('last_name');
                            const email = formData.get('email');
                            const createdByAdmin = true;

                            formData.append('createdByAdmin', createdByAdmin);
                            if (!first_name || !last_name || !email) {
                                Swal.showValidationMessage(
                                    'Veuillez remplir tous les champs requis.');
                                return false;
                            }

                            formData.append('_token',
                                '{{ csrf_token() }}');


                            return {
                                first_name: first_name,
                                last_name: last_name,
                                email: email,
                                createdByAdmin: createdByAdmin,
                                _token: formData.get('_token')
                            };
                        }
                    });
                });
            })
        </script>
        <script>
            const parcours = async (id) => {
                $('#parcours-modal table tbody').html('')
                let rep = await fetch('{{ route('events.api.parcours', $activite->id) }}')
                    .then(response => response.json());

                console.log('parcours', rep)

                rep.map((data, i) => {
                    var te = []
                    var events = data.events
                    for (let i = 0; i < events.length; i++) {
                        te.push("<li> " + events[i].title + "</li>")
                    }

                    var ve = te.join('<br> ')

                    $('#parcours-modal table tbody').append(`
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-gray-800 dark:text-white">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        ${i+1}
                                    </th>
                                    <td class="px-6 py-4">
                                        ${data.first_name}
                                    </td>
                                    <td class="px-6 py-4">
                                        ${data.last_name}
                                    </td>
                                    <td class="px-6 py-4">
                                        ${data.gender}
                                    </td>

                                    <td class="px-6 py-4">
                                        <ul>
                                        ${ve}
                                        </ul>
                                    </td>
                                </tr>
                `)
                })
            }
        </script>

        <script>
            const cinq_event = async (id) => {
                $('#cinq-modal table tbody').html('')
                let rep = await fetch('{{ route('events.api.cinq', $activite->id) }}')
                    .then(response => response.json());

                console.log('cinq', rep)

                rep.map((data, i) => {
                    var te = []
                    var events = data.events
                    for (let i = 0; i < events.length; i++) {
                        te.push("<li> " + events[i].title + "</li>")
                    }

                    var ve = te.join('<br> ')

                    $('#cinq-modal table tbody').append(`
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-gray-800 dark:text-white">
                                    <th scope="row" class="px-6 py-4 font-medium  whitespace-nowrap ">
                                        ${i+1}
                                    </th>
                                    <td class="px-6 py-4">
                                        ${data.first_name}
                                    </td>
                                    <td class="px-6 py-4">
                                        ${data.last_name}
                                    </td>
                                    <td class="px-6 py-4">
                                        ${data.gender}
                                    </td>

                                    <td class="px-6 py-4">
                                        <ul>
                                        ${ve}
                                        </ul>
                                    </td>
                                </tr>
                `)
                })
            }
        </script>

        <script>
            const nouveau = async (id) => {
                $('#news-modal table tbody').html('')
                let rep = await fetch('{{ route('events.api.nouveaux', $activite->id) }}')
                    .then(response => response.json());

                console.log('Nouveau', rep)

                rep.map((data, i) => {


                    $('#news-modal table tbody').append(`
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-gray-800 dark:text-white">
                                    <th scope="row" class="px-6 py-4 font-medium  whitespace-nowrap ">
                                        ${i+1}
                                    </th>
                                    <td class="px-6 py-4">
                                        ${data.first_name}
                                    </td>
                                    <td class="px-6 py-4">
                                        ${data.last_name}
                                    </td>
                                    <td class="px-6 py-4">
                                        ${data.gender}
                                    </td>

                                </tr>
                `)
                })
            }
        </script>
        <script>
            function showUserCV(event, cvUrl, prenom, nom) {
                event.preventDefault(); // Empêche le lien de se comporter normalement

                // Extraire l'extension du fichier
                const extension = cvUrl.split('.').pop().toLowerCase();

                let content;

                // Vérifiez si l'extension est .pdf
                if (extension === 'pdf') {
                    content = `
                        <iframe src="${cvUrl}" style="width: 100%; height: 800px;" frameborder="0"></iframe>
                    `;
                } else if (['jpg', 'jpeg', 'png', 'avif', 'gif'].includes(extension)) {
                    // Si c'est une image, créez une balise img
                    content = `
                        <img src="${cvUrl}" alt="CV de l'utilisateur" style="width: 50%; margin: 0 auto; height: auto;"/>
                    `;
                } else {
                    // Si ce n'est pas un PDF ou une image, affichez un message d'erreur
                    content = '<p>Ce fichier n\'est pas un PDF ni une image et ne peut pas être affiché ici.</p>';
                }

                // Affichez le modal avec SweetAlert
                Swal.fire({
                    title: 'CV de ' + prenom + ' ' + nom,
                    html: content,
                    customClass: {
                        popup: 'bg-gray-800 text-white w-full',
                        confirmButton: 'bg-[#FF7322] text-white rounded px-4 py-2 hover:bg-[#FF7322] focus:outline-none focus:ring focus:ring-[#FF7322]',
                    },
                    showCloseButton: true,
                    confirmButtonText: 'Fermer'
                });
            }
        </script>

        <script>
            $(document).ready(function() {
                $('#participationsTable').css('width', '100%');
                $('.dt-container').addClass('text-lg text-gray-800 dark:text-gray-400 leading-tight')
                $('.dt-buttons').addClass('mt-4')
                $('.dt-buttons buttons').addClass('cursor-pointer mt-5 bg-slate-600 p-2 rounded-sm font-bold')

                $("#dt-length-0").addClass('text-gray-700 dark:text-gray-200 w-24 bg-white');
                $("label[for='dt-length-0']").addClass('text-gray-700 dark:text-gray-200').text(
                    ' Records par page');
                $("label[for='dt-search-0']").addClass('text-gray-700 dark:text-gray-200');
                $('.dt-input').addClass('text-gray-700 dark:text-gray-200');
            });
        </script>
        <script>
            $(document).ready(function() {
                // Vérifier la présence des éléments dans le DOM avant de les utiliser
                let selectAllCheckbox = document.getElementById('select-all');
                let selectedCandidats = new Set();
                let rowCheckboxes = document.querySelectorAll('.row-select');
                let selectedCountDisplay = document.createElement('span');
                selectedCountDisplay.className = "text-gray-200 ms-5";
                selectedCountDisplay.id = "selected-count";

                // Vérifiez si 'select-all' existe avant d'ajouter l'événement
                if (selectAllCheckbox) {
                    selectAllCheckbox.addEventListener('change', function() {
                        rowCheckboxes.forEach(checkbox => {
                            checkbox.checked = selectAllCheckbox.checked;
                            const id = checkbox.dataset
                                .id; // Supposant que chaque checkbox a un data-id
                            if (selectAllCheckbox.checked) {
                                selectedCandidats.add(id); // Ajouter à l'ensemble si sélectionné
                            } else {
                                selectedCandidats.delete(id); // Retirer de l'ensemble si désélectionné
                            }
                        });
                        updateSelectionDisplay(); // Mettre à jour l'affichage après changement
                    });
                }

                // Vérifiez si les checkboxes de ligne existent avant de leur ajouter des événements
                if (rowCheckboxes.length > 0) {
                    rowCheckboxes.forEach(checkbox => {
                        checkbox.addEventListener('change', function() {
                            const id = checkbox.dataset
                                .id; // Supposant que chaque checkbox a un data-id
                            if (checkbox.checked) {
                                selectedCandidats.add(id); // Ajouter à l'ensemble si coché
                            } else {
                                selectedCandidats.delete(id); // Retirer de l'ensemble si décoché
                            }
                            // Vérifier si "Sélectionner tout" doit être cochée ou décochée
                            selectAllCheckbox.checked = Array.from(rowCheckboxes).every(cb => cb
                                .checked);
                            updateSelectionDisplay(); // Mettre à jour l'affichage après changement
                        });
                    });
                }

                // Vérifiez si les boutons existent avant d'ajouter les événements
                $('#acceptAllBtn, #rejectAllBtn, #awaitAllBtn').each(function() {
                    if (this) {
                        $(this).on('click', function() {
                            const action = $(this).data(
                                'status'); // Récupérer l'action (accept, reject, wait)
                            const candidats = Array.from(
                                selectedCandidats); // Convertir le Set en tableau

                            if (candidats.length) {
                                $.ajax({
                                    url: `/candidat/${action}`,
                                    type: 'POST',
                                    contentType: 'application/json',
                                    data: JSON.stringify({
                                        ids: candidats
                                    }),
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    },
                                    success: function(data) {
                                        const Toast = Swal.mixin({
                                            toast: true,
                                            position: "top-end",
                                            showConfirmButton: false,
                                            timer: 3000,
                                            timerProgressBar: true,
                                            didOpen: (toast) => {
                                                toast.onmouseenter = Swal
                                                    .stopTimer;
                                                toast.onmouseleave = Swal
                                                    .resumeTimer;
                                            }
                                        });
                                        Toast.fire({
                                            icon: "success",
                                            title: data.message
                                        });
                                        selectedCandidats.clear(); // Réinitialiser le Set
                                        updateSelectionDisplay
                                            (); // Mettre à jour l'affichage
                                    },
                                    error: function(xhr) {
                                        const errorMessage = xhr.responseJSON?.error ||
                                            'Une erreur est survenue';
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Erreur',
                                            text: errorMessage,
                                        });
                                    }
                                });
                            }
                        });
                    }
                });

                // Fonction pour mettre à jour l'affichage des boutons et le compte des sélections
                function updateSelectionDisplay() {
                    const selectedCount = selectedCandidats.size; // Utiliser la taille du Set
                    selectedCountDisplay.textContent = selectedCount ? `${selectedCount} ligne(s) sélectionnée(s)` : '';

                    // Afficher ou cacher les boutons
                    if (selectedCount > 0) {
                        $('#acceptAllBtn').removeClass('hidden');
                        $('#rejectAllBtn').removeClass('hidden');
                        $('#awaitAllBtn').removeClass('hidden');
                    } else {
                        $('#acceptAllBtn').addClass('hidden');
                        $('#rejectAllBtn').addClass('hidden');
                        $('#awaitAllBtn').addClass('hidden');
                    }

                    // Mettre à jour l'affichage du compteur
                    $('#candidatTable_info').append(selectedCountDisplay);
                }
            });
        </script>
        {{-- Script for presence data table --}}
        <script>
            $(document).ready(function() {
                $('#candidatpresence').DataTable({
                    fixedColumns: {
                        start: 3,
                    },
                    paging: false,
                    scrollCollapse: true,
                    scrollX: true,
                    scrollY: 300
                });

                $('#candidatpresence').css('width', '100%');
            });
        </script>

        {{-- Script for participants data table --}}
        <script>
            function generer(event) {
                event.preventDefault()
                $('#loading').removeClass('hidden');
                $('#loading').addClass('inline');

                let id_event = @json($id);
                try {
                    setTimeout(function() {
                        window.location.href = "{{ route('generate_excel', '') }}/" + id_event;
                    }, 1000);

                    setTimeout(function() {
                        $('#loading').addClass('hidden');
                        $('#loading').removeClass('inline');
                    }, 2000);

                } catch (error) {
                    console.log(error)
                }
            }


            $(document).ready(function() {
                let event = @json($activite->title);
                var id_event = @json($activite->id);

                $('#participantTable').DataTable({
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, "Tout"]
                    ],
                    columnDefs: [{
                        targets: '.label',
                        visible: false
                    }],
                    language: {
                        lengthMenu: 'Afficher _MENU_',
                        info: 'Affichage de la page _PAGE_ sur _PAGES_',
                        search: 'Recherche : ',
                        infoEmpty: "Affichage de 0 participants sur 0",
                        emptyTable: 'Aucun participant n\'a été trouvé sur cette activité !',
                        loadingRecords: 'Chargment des participants...',
                        zeroRecords: 'Aucun participant correspondant à votre recherche n\'a été trouvé',
                        aria: {
                            "orderable": "Trier sur cette colonne",
                            "orderableReverse": "Inverser l'ordre de tri de cette colonne"
                        }
                    }
                });

                $('body').on('click', function(event) {
                    if (!$(event.target).closest('.modalp, .btnModal').length) {
                        $('.modalp').hide();
                    }
                });


                $(document).on('click', '.btnModal', function(event) {
                    event.stopPropagation();
                });

                $('#participantTable').css('width', '100%');
                $("#dt-length-1").addClass('text-gray-700 dark:text-gray-200 w-24 bg-white')

            });
        </script>

        {{-- Script for candidates data table --}}
        <script>
            var tr = null;
            var statusCell = null;

            function readMore(event) {
                event.preventDefault();
                let value = event.target.previousElementSibling.innerHTML;

                var td = $(event.target).closest('td');
                $(td).text(value);
            }

            function showDetail(event, idCandidat) {
                event.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "/api/candidat/show",
                    data: {
                        'candidat_id': idCandidat
                    },
                    dataType: "json",
                    success: function(response) {
                        // Vérifiez que la réponse contient du HTML
                        if (response.html) {
                            Swal.fire({
                                title: 'Détails du Candidat',
                                html: response.html,
                                customClass: {
                                    // popup: 'custom-swal'
                                    popup: 'bg-gray-800 text-white w-full',
                                    confirmButton: 'bg-[#FF7322] text-white rounded px-4 py-2 hover:bg-[#FF7322] focus:outline-none focus:ring focus:ring-[#FF7322]',
                                },
                                showCloseButton: true,
                                confirmButtonText: 'Fermer'
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Erreur',
                                text: 'Aucun détail à afficher.',
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Erreur',
                            text: xhr.responseJSON.message || 'Une erreur est survenue.',
                        });
                    }
                });
            }

            $(document).ready(function() {
                let event = @json($activite->title);
                var id_event = @json($activite->id);

                $('#candidatTable').DataTable({
                    pageLength: 10,
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, "Tous"]
                    ],
                    columnDefs: [{
                        targets: '.label',
                        visible: false
                    }, {
                        orderable: false,
                        targets: 0
                    }],
                    language: {
                        lengthMenu: 'Afficher _MENU_',
                        info: 'Affichage de la page _PAGE_ sur _PAGES_',
                        search: 'Recherche : ',
                        infoEmpty: "Affichage de 0 candidats sur 0",
                        emptyTable: 'Aucun candidat n\'a été trouvé sur cette activité !',
                        loadingRecords: 'Chargment des candidats...',
                        zeroRecords: 'Aucun candidat correspondant à votre recherche n\'a été trouvé',
                        aria: {
                            "orderable": "Trier sur cette colonne",
                            "orderableReverse": "Inverser l'ordre de tri de cette colonne"
                        }
                    },
                });


                $(document).on('click', '.btnAction', function(event) {
                    let id = $(this).data('dropdown-toggle');
                    $('.modal').not('#' + id).hide();
                    $('#' + id).toggle();
                    event.stopPropagation();
                });

                $('body').on('click', function(event) {
                    if (!$(event.target).closest('.modal, .btnAction').length) {
                        $('.modal').hide();
                    }
                });


                $(document).on('click', '.modal', function(event) {
                    event.stopPropagation();
                });


                $('#candidatTable').css('width', '100%');

                $('.dt-container').addClass('text-lg text-gray-800 dark:text-gray-400 leading-tight')

                $('.dt-buttons').addClass('mt-4')

                $('.dt-buttons buttons').addClass(
                    'cursor-pointer mt-5 bg-slate-600 p-2 rounded-sm font-bold')

                $("#dt-length-2").addClass('text-gray-700 dark:text-gray-200 w-24 bg-white')

            })

            function tooltip(event) {
                event.preventDefault();
                const tooltip = document.getElementById('tooltip');
                $(tooltip).show();
            }

            function remove(event, id) {
                event.preventDefault();
                let status = 'decline';
                $('#popup-title-decline').text(
                    "Confirmez-vous le retrait de " + firstname + " ?");
                $.ajax({
                    type: 'POST',
                    url: '/candidat/' + status,
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        // Update the UI or display a success message
                        // Update the table cell with the new status
                        $(statusCell[0]).text(status);
                        console.log('Status updated successfully!');
                    },
                    error: function(xhr, status, error) {
                        console.log('Error updating status: ' + error);
                    }
                });
            }

            function actionStatus(event, type, id, firstname, lastname) {
                tr = $(event.target.closest('tr'));
                statusCell = tr.find('#statusCell');

                switch (type) {
                    case 'accept':
                        $('#accept-link').attr('data', id);
                        $('#popup-title-accept').text("Confirmez-vous la validation de la candidature de " + firstname + " ?");
                        $('#popup-accept').removeClass('hidden'); // Show the modal
                        break;
                    case 'decline':
                        $('#decline-link').attr('data', id);
                        $('#popup-title-decline').text("Confirmez-vous l'annulation de la candidature de " + firstname + " ?");
                        $('#popup-decline').removeClass('hidden'); // Show the modal
                        break;
                    case 'wait':
                        $('#wait-link').attr('data', id);
                        $('#popup-title-wait').text("Confirmez-vous la mise en attente de " + firstname + " ?");
                        $('#popup-wait').removeClass('hidden'); // Show the modal
                        break;
                    default:
                        break;
                }
            }

            function changeStatus(event, status) {
                event.preventDefault();

                var ids = []
                let id = $(event.target).attr('data')
                ids.push(id)
                $.ajax({
                    type: 'POST',
                    url: '/candidat/' + status,
                    data: {
                        ids: ids,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        // Update the UI or display a success message
                        // Update the table cell with the new status
                        $(statusCell[0]).text(status);
                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            }
                        });
                        Toast.fire({
                            icon: "success",
                            title: data.message
                        });

                        console.log('Status updated successfully!');
                    },
                    error: function(xhr, status, error) {
                        console.log('Error updating status: ' + error);
                    }
                });
            }
        </script>

        {{-- Script for storing candidates --}}
        <script>
            let url = @json(env('API_URL'));
            let id = @json($id);
            let idEvent = @json($activite->_id);
            let idUsers = @json($odcusers);
            let user = {};

            // Initialisation de l'objet utilisateur
            idUsers.forEach(element => {
                user[element._id] = element.id;
            });

            function reload() {
                // Afficher le toast de synchronisation dès le début
                const syncToast = showSyncToast();

                if (idEvent) {
                    $.ajax({
                        url: `${url}/events/show/${idEvent}`,
                        method: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            let results = data;
                            if (data.code && data.code == 401) {
                                refreshToken();

                                $.ajax({
                                    url: `${url}/events/show/${idEvent}`,
                                    method: 'GET',
                                    dataType: 'json',
                                    success: function(data) {
                                        results = data;
                                    }
                                })
                            }

                            let events = results.data;

                            let candidats = [];

                            events.forEach(event => {
                                let userId = event.user._id;
                                if (user[userId]) {
                                    let candidat = {
                                        'odcuser_id': user[userId],
                                        'activite_id': id,
                                        'status': 'new'
                                    };
                                    if (event.formRegistrationData) {
                                        candidat.formRegistrationData = event.formRegistrationData;
                                    }
                                    candidats.push(candidat);
                                }
                            });

                            // Affichage d'un toast avec le nombre de candidats à synchroniser
                            if (candidats.length > 0) {
                                const candidatesToast = showCandidatesToast(
                                    `${candidats.length} candidats prêts à être synchronisés...`);

                                // Envoi des candidats à l'API
                                storeCandidats(candidats, candidatesToast, syncToast);
                            } else {
                                showErrorToast("Aucun candidat à synchroniser.");
                                syncToast.close(); // Fermer le toast de synchronisation
                                return; // Sortir si aucun candidat
                            }
                        },
                        error: function(jqxhr, textStatus, error) {
                            console.error('Erreur lors de la récupération des événements:', textStatus,
                                error);
                            showErrorToast("Erreur lors de la récupération des candidats.");
                            syncToast.close(); // Fermer le toast de synchronisation en cas d'erreur
                        }
                    });
                } else {
                    showErrorToast("Désolé, une erreur s'est produite lors de la synchronisation des candidats.");
                    syncToast.close(); // Fermer le toast de synchronisation si idEvent est manquant
                }
            }

            function refreshToken() {
                $.ajax({
                    url: `${url}/generer/token`,
                    method: 'POST'
                });
            }

            function storeCandidats(candidats, candidatesToast, syncToast) {
                let requests = candidats.map(candidat => {
                    return $.ajax({
                        url: '/api/candidat',
                        method: 'POST',
                        contentType: 'application/json',
                        data: JSON.stringify(candidat)
                    }).then(response => {
                        // Récupérer les attributs associés après la création du candidat
                        return storeCandidateAttributes(candidat, response.candidat.id);;
                    });
                });

                let completedRequests = 0;

                $.when(...requests)
                    .done(function(...responses) {
                        responses.forEach(response => {
                            console.log('Candidat stocké avec succès');
                            completedRequests++;
                        });
                        // Fermer le toast de synchronisation et afficher le toast final
                        syncToast.close();
                        candidatesToast.close()
                        showFinalSuccessToast(completedRequests);
                    })
                    .fail(function(jqxhr, textStatus, error) {
                        console.error('Erreur lors du stockage des candidats:', textStatus, error);
                        syncToast.close();
                        candidatesToast.close()
                        showErrorToast("Erreur lors du stockage des candidats.");
                    });
            }

            function showSyncToast() {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                return Toast.fire({
                    icon: "info",
                    willOpen: () => {
                        Swal.showLoading();
                    },
                    title: "Synchronisation en cours..."
                });
            }

            function showCandidatesToast(message) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timerProgressBar: true, // Pas de timer
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                        toast.showClass = {
                            open: 'animate__animated animate__fadeInRight',
                            close: 'animate__animated animate__fadeOutRight'
                        };
                    }
                });
                return Toast.fire({
                    icon: "info",
                    willOpen: () => {
                        Swal.showLoading();
                    },
                    title: message
                });
            }

            function showSuccessToast(message) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: "success",
                    title: message
                });
            }

            function showFinalSuccessToast(count) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: "success",
                    title: `${count} candidats stockés avec succès`
                });
            }

            function showErrorToast(message) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: "error",
                    title: message
                });
            }

            function storeCandidateAttributes(candidat, candidateId) {
                if (candidat.formRegistrationData) {
                    let att = 0;
                    const inputs = candidat.formRegistrationData.inputs;

                    inputs.forEach(input => {
                        // Récupérer la valeur de l'entrée
                        let value = input.value || "";

                        if (input.translations && input.translations.fr && input.translations.fr.input.options) {
                            const options = input.translations.fr.input.options;

                            if (Array.isArray(input.value)) {
                                // Gérer le cas du tableau
                                const values = input.value.map(v => {
                                    const inputValue = (parseInt(v) - 1);
                                    return options[inputValue]?.label || "";
                                });
                                value = values.join(', ');
                            } else if (typeof input.value === "number") {
                                const v = parseInt(input.value) - 1;
                                value = options[v]?.label || "";
                            }
                        }

                        // Créer un tableau des informations d'attribut du candidat
                        const candidateAttributes = {
                            _id: input._id,
                            label: input.translations.fr.input.label,
                            value: value,
                            candidat_id: candidateId // Utiliser l'id du candidat nouvellement créé
                        };

                        // Créer ou mettre à jour l'attribut du candidat
                        $.ajax({
                                url: '/api/candidat/attributes',
                                method: 'POST',
                                contentType: 'application/json',
                                data: JSON.stringify(candidateAttributes)
                            })
                            .done(() => {
                                console.log(`Attribut ${att} sauvegardé `);
                                att++;
                            })
                            .fail(error => {
                                console.error('Erreur lors du stockage de l\'attribut du candidat:', error);
                            });
                    });
                }
            }


            function redirectToPresence() {
                window.location.href = '{{ route('presences.index') }}';
            }
        </script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script>
            function activer(event) {
                event.preventDefault();
                let link = event.target.getAttribute('href');
                document.querySelector('#desactiveStatus form').setAttribute('action', link);
            }

            function desactiver(event) {
                event.preventDefault();
                let link = event.target.getAttribute('href');
                document.querySelector('#activeStatus form').setAttribute('action', link);
            }
        </script>

        <script>
            function choix_certificat(event) {
                event.preventDefault();
                const lien = event.target.getAttribute("href");
                document.querySelector("#choixCertificat-modal form").setAttribute("action", lien);
            }
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('model-mail').addEventListener('change', function() {
                    var selectedMessage = this.value;
                    document.getElementById('message').value = selectedMessage;
                });
            });
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const tabBtns = document.querySelectorAll('.tab-btn');
                const tabViews = document.querySelectorAll('.tab-view');

                function switchView(view) {
                    console.log('Switching to view:', view);

                    // Masquer toutes les vues sauf details au début
                    tabViews.forEach(v => {
                        if (v.id !== 'details-view' || view !== 'details') {
                            v.classList.add('hidden');
                        }
                    });

                    // Désactiver tous les boutons
                    tabBtns.forEach(b => b.classList.remove('active'));

                    // Afficher la vue sélectionnée et activer le bouton correspondant
                    const selectedView = document.getElementById(`${view}-view`);
                    const selectedBtn = document.querySelector(`[data-view="${view}"]`);

                    if (selectedView && selectedBtn) {
                        selectedView.classList.remove('hidden');
                        selectedBtn.classList.add('active');
                        localStorage.setItem('selectedActivityView', view);
                    }
                }

                // Initialisation : s'assurer que details est visible par défaut
                const detailsView = document.getElementById('details-view');
                if (detailsView) {
                    detailsView.classList.remove('hidden');
                }

                // Restaurer la vue précédemment sélectionnée ou utiliser 'details' par défaut
                const savedView = localStorage.getItem('selectedActivityView') || 'details';
                switchView(savedView);

                // Gestionnaires d'événements pour les boutons
                tabBtns.forEach(btn => {
                    btn.addEventListener('click', () => switchView(btn.dataset.view));
                });

                // Activer l'onglet details par défaut si aucun onglet n'est actif
                if (!document.querySelector('.tab-btn.active')) {
                    const detailsBtn = document.querySelector('[data-view="details"]');
                    if (detailsBtn) {
                        detailsBtn.classList.add('active');
                    }
                }
            });
        </script>
    @endsection

    <style>
        .active {
            background: rgba(255, 255, 255, 0.932);
            border-radius: 6px;
            color: #e38407;
        }
    </style>



</x-app-layout>
