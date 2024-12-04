@props(['labels', 'candidatsData', 'url', 'id', 'odcusers', 'activite'])

<div id="alert-success"
    class="hidden items-center p-4 mb-4 text-green-800 border-t-4 border-green-300 bg-green-50 dark:text-green-400 dark:bg-gray-800 dark:border-green-800"
    role="alert">
    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
        viewBox="0 0 20 20">
        <path
            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
    </svg>
    <div class="ms-3 text-sm font-medium" id="div-success">
        <p></p>
    </div>
    <button type="button"
        class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
        data-dismiss-target="#alert-success" aria-label="Close">
        <span class="sr-only">Dismiss</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
        </svg>
    </button>
</div>
<div class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-candidats" role="tabpanel"
    aria-labelledby="candidats-tab">

    <div class="flex justify-between">
        <a href="#" onclick="reload()"
            class="self-center py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-[#FF7322] text-white hover:bg-[#FF6822] focus:outline-none focus:bg-[#FF6822] disabled:opacity-50 disabled:pointer-events-none">Synchroniser</a>
        <a href="#" onclick="event.preventDefault(); location.reload();"
            class="self-center py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-[#FF7322] text-white hover:bg-[#FF6822] focus:outline-none focus:bg-[#FF6822] disabled:opacity-50 disabled:pointer-events-none">
            <span class="">Actualiser la page</span>
            <svg class="" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M17.65 6.35A7.96 7.96 0 0 0 12 4c-4.42 0-7.99 3.58-7.99 8s3.57 8 7.99 8c3.73 0 6.84-2.55 7.73-6h-2.08A5.99 5.99 0 0 1 12 18c-3.31 0-6-2.69-6-6s2.69-6 6-6c1.66 0 3.14.69 4.22 1.78L13 11h7V4z" />
            </svg>
        </a>
        <div>
            <a href="#" id="acceptAllBtn" data-status="accept"
                class="hidden self-center py-2 px-3 items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-[#FF7322] text-white hover:bg-[#FF6822] focus:outline-none focus:bg-[#FF6822] disabled:opacity-50 disabled:pointer-events-none">Accepter</a>
            <a href="#" id="rejectAllBtn" data-status="decline"
                class="hidden self-center py-2 px-3 items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-[#FF7322] text-white hover:bg-[#FF6822] focus:outline-none focus:bg-[#FF6822] disabled:opacity-50 disabled:pointer-events-none">Rejeter</a>
            <a href="#" id="awaitAllBtn" data-status="wait"
                class="hidden self-center py-2 px-3 items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-[#FF7322] text-white hover:bg-[#FF6822] focus:outline-none focus:bg-[#FF6822] disabled:opacity-50 disabled:pointer-events-none">Mettre
                en attente</a>

        </div>
    </div>

    <div class="py-6 relative overflow-x-auto">
        @if ($candidatsData)
            <table id="candidatTable"
                class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 cell-border">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="p-4">
                            <div class="flex items-center">
                                <input id="select-all" type="checkbox"
                                    class="w-4 h-4 text-[#FF7322] hover:cursor-pointer bg-gray-100 border-gray-300 rounded focus:ring-[#FF7322] dark:focus:ring-[#FF7322] dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="select-all" class="sr-only">checkbox</label>
                            </div>
                        </th>
                        <th scope="col"
                            class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Prénom
                        </th>
                        <th scope="col"
                            class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Nom
                        </th>
                        <!-- Email column -->
                        @if (
                            !in_array('Email', $labels) &&
                                !in_array('E-mail', $labels) &&
                                !in_array('E-mail(obligatoire)', $labels) &&
                                !in_array('Adresse Email', $labels))
                            <th scope="col"
                                class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                Email
                            </th>
                        @endif
                        <!-- Genre column -->
                        <th scope="col"
                            class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Genre
                        </th>
                        <!-- Dynamic labels -->
                        @foreach (array_unique($labels) as $label)
                            @if (isset($label))
                                @if (in_array($label, [
                                        'Civilié',
                                        'Civilité',
                                        'Email',
                                        'E-mail',
                                        'E-mail(obligatoire)',
                                        'Adresse Email',
                                        'Téléphone',
                                        'Téléphone de l\'encadreur ',
                                        'Numéro de téléphone',
                                        'Numéro téléphone',
                                        'Téléphone (obligatoire)',
                                        'Numéro de téléphone Whastapp (+243 800 000 000.)',
                                        'Numéro de l\'encadreur',
                                        'Tranche d\'âge',
                                        'Adresse',
                                        'Adresse de domicile',
                                        'Adresse de domicile (n°, avenue, Quartier, Commune)',
                                        'Profession',
                                        'Spécialité ou domaine (étude ou profession)',
                                        'Spécialité ou domaine',
                                        'Niveau d\'étude',
                                        'Niveau ou année d\'étude',
                                        'Nom de l\'Etablissement / Université',
                                        'Université',
                                        'Université/Etablissement ou Structure',
                                    ]))
                                    <th scope="col"
                                        class="display-label px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $label }}
                                    </th>
                                @elseif ($label !== 'Cv de votre parcours (Obligatoire)')
                                    <th scope="col"
                                        class="label px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $label }}
                                    </th>
                                @endif
                            @endif
                        @endforeach
                        <th scope="col"
                            class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Status
                        </th>
                        <th scope="col"
                            class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($candidatsData as $candidat)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-600 hover:cursor-pointer hover:underline">
                            <td class="w-4 p-4">
                                <div class="flex items-center">
                                    <input id="checkbox{{ $candidat['id'] }}" data-id="{{ $candidat['id'] }}"
                                        type="checkbox"
                                        class="row-select w-4 h-4 hover:cursor-pointer text-[#FF7322] bg-gray-100 border-gray-300 rounded focus:ring-[#FF7322] dark:focus:ring-[#FF7322] dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="checkbox{{ $candidat['id'] }}" class="sr-only">checkbox</label>
                                </div>
                            </td>
                            <td onclick="showDetail(event,  '{{ $candidat['id'] }}')" class="px-6 py-3">
                                {{ $candidat['odcuser']['first_name'] }}</td>
                            <td onclick="showDetail(event,  '{{ $candidat['id'] }}')" class="px-6 py-3">
                                {{ $candidat['odcuser']['last_name'] }}</td>
                            <!-- Email Column -->
                            @if (
                                !in_array('Email', $labels) &&
                                    !in_array('E-mail', $labels) &&
                                    !in_array('E-mail(obligatoire)', $labels) &&
                                    !in_array('Adresse Email', $labels))
                                <td>{{ $candidat['odcuser']['email'] }}</td>
                            @endif
                            <!-- Genre Column -->
                            <td>{{ $candidat['odcuser']['gender'] }}</td>
                            @foreach (array_unique($labels) as $label)
                                @if (isset($label))
                                    @if (in_array($label, [
                                            'Civilié',
                                            'Civilité',
                                            'Email',
                                            'E-mail',
                                            'E-mail(obligatoire)',
                                            'Adresse Email',
                                            'Téléphone',
                                            'Téléphone de l\'encadreur ',
                                            'Numéro de téléphone',
                                            'Numéro téléphone',
                                            'Téléphone (obligatoire)',
                                            'Numéro de téléphone Whastapp (+243 800 000 000.)',
                                            'Numéro de l\'encadreur',
                                            'Tranche d\'âge',
                                            'Adresse',
                                            'Adresse de domicile',
                                            'Adresse de domicile (n°, avenue, Quartier, Commune)',
                                            'Profession',
                                            'Spécialité ou domaine (étude ou profession)',
                                            'Spécialité ou domaine',
                                            'Niveau d\'étude',
                                            'Niveau ou année d\'étude',
                                            'Nom de l\'Etablissement / Université',
                                            'Université',
                                            'Université/Etablissement ou Structure',
                                        ]))
                                        <td class="px-6 py-3">
                                            @if (!isset($candidat[$label]) && in_array($label, ['Email', 'E-mail', 'E-mail(obligatoire)', 'Adresse Email']))
                                                {{ $candidat['odcuser']['email'] }}
                                            @else
                                                {{ $candidat[$label] ?? 'N/A' }}
                                            @endif
                                        </td>
                                    @elseif($label !== 'Cv de votre parcours (Obligatoire)')
                                        <td onclick="showDetail(event,  '{{ $candidat['id'] }}')"
                                            class="label px-6 py-3">
                                            @if (!isset($candidat[$label]) && in_array($label, ['Email', 'E-mail', 'E-mail(obligatoire)', 'Adresse Email']))
                                                {{ $candidat['odcuser']['email'] }}
                                            @else
                                                {{ $candidat[$label] ?? 'N/A' }}
                                            @endif
                                        </td>
                                    @endif
                                @endif
                            @endforeach

                            <td onclick="showDetail(event,  '{{ $candidat['id'] }}')" class="px-6 py-3"
                                id="statusCell">{{ $candidat['status'] }}</td>
                            <td class="px-6 py-3 flex space-x-3">
                                <!-- Si le statut est decline, on peut donc soit accepter soit mettre en attente -->
                                @if ($candidat['status'] == 'decline')
                                    <svg data-tooltip-target="tooltip-accept{{ $candidat['id'] }}"
                                        class="text-gray-800 dark:text-white hover:text-[#FF7322] cursor-pointer"
                                        onclick="actionStatus(event, 'accept', '{{ $candidat['id'] }}', '{{ $candidat['odcuser']['first_name'] }}')"
                                        class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                                    </svg>
                                    <div id="tooltip-accept{{ $candidat['id'] }}" role="tooltip"
                                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                        Accepter
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>

                                    <svg data-tooltip-target="tooltip-await{{ $candidat['id'] }}"
                                        class="text-gray-800 dark:text-white hover:text-[#FF7322] cursor-pointer"
                                        onclick="actionStatus(event, 'wait', '{{ $candidat['id'] }}', '{{ $candidat['odcuser']['first_name'] }}', '{{ $candidat['odcuser']['last_name'] }}')"
                                        class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <div id="tooltip-await{{ $candidat['id'] }}" role="tooltip"
                                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                        Mettre en attente
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>
                                    {{-- Si le statut est new, on affiche tout --}}
                                @elseif ($candidat['status'] == 'new')
                                    <svg data-tooltip-target="tooltip-accept{{ $candidat['id'] }}"
                                        class="text-gray-800 dark:text-white hover:text-[#FF7322] cursor-pointer"
                                        onclick="actionStatus(event, 'accept', '{{ $candidat['id'] }}', '{{ $candidat['odcuser']['first_name'] }}')"
                                        class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                                    </svg>
                                    <div id="tooltip-accept{{ $candidat['id'] }}" role="tooltip"
                                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                        Accepter
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>

                                    <svg data-tooltip-target="tooltip-await{{ $candidat['id'] }}"
                                        class="text-gray-800 dark:text-white hover:text-[#FF7322] cursor-pointer"
                                        onclick="actionStatus(event, 'wait', '{{ $candidat['id'] }}', '{{ $candidat['odcuser']['first_name'] }}', '{{ $candidat['odcuser']['last_name'] }}')"
                                        class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <div id="tooltip-await{{ $candidat['id'] }}" role="tooltip"
                                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                        Mettre en attente
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>

                                    <svg data-tooltip-target="tooltip-reject{{ $candidat['id'] }}"
                                        onclick="actionStatus(event, 'decline', '{{ $candidat['id'] }}', '{{ $candidat['odcuser']['first_name'] }}', '{{ $candidat['odcuser']['last_name'] }}')"
                                        class="text-gray-800 dark:text-white hover:text-[#FF7322] cursor-pointer"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 2048 2048">
                                        <path fill="currentColor"
                                            d="m1115 1024l690 691l-90 90l-691-690l-691 690l-90-90l690-691l-690-691l90-90l691 690l691-690l90 90z" />
                                    </svg>
                                    <div id="tooltip-reject{{ $candidat['id'] }}" role="tooltip"
                                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                        Rejeter
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>

                                    <!-- Si le statut est wait, on peut donc soit accepter soit rejeter -->
                                @elseif ($candidat['status'] == 'wait')
                                    <svg data-tooltip-target="tooltip-accept{{ $candidat['id'] }}"
                                        class="text-gray-800 dark:text-white hover:text-[#FF7322] cursor-pointer"
                                        onclick="actionStatus(event, 'accept', '{{ $candidat['id'] }}', '{{ $candidat['odcuser']['first_name'] }}')"
                                        class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                                    </svg>
                                    <div id="tooltip-accept{{ $candidat['id'] }}" role="tooltip"
                                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                        Accepter
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>
                                    <svg data-tooltip-target="tooltip-reject{{ $candidat['id'] }}"
                                        onclick="actionStatus(event, 'decline', '{{ $candidat['id'] }}', '{{ $candidat['odcuser']['first_name'] }}', '{{ $candidat['odcuser']['last_name'] }}')"
                                        class="text-gray-800 dark:text-white hover:text-[#FF7322] cursor-pointer"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 2048 2048">
                                        <path fill="currentColor"
                                            d="m1115 1024l690 691l-90 90l-691-690l-691 690l-90-90l690-691l-690-691l90-90l691 690l691-690l90 90z" />
                                    </svg>
                                    <div id="tooltip-reject{{ $candidat['id'] }}" role="tooltip"
                                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                        Rejeter
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>

                                    <!-- Si le statut est accept, on peut donc soit rejeter soit mettre en attente -->
                                @elseif ($candidat['status'] == 'accept')
                                    <svg data-tooltip-target="tooltip-reject{{ $candidat['id'] }}"
                                        onclick="actionStatus(event, 'decline', '{{ $candidat['id'] }}', '{{ $candidat['odcuser']['first_name'] }}', '{{ $candidat['odcuser']['last_name'] }}')"
                                        class="text-gray-800 dark:text-white hover:text-[#FF7322] cursor-pointer"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 2048 2048">
                                        <path fill="currentColor"
                                            d="m1115 1024l690 691l-90 90l-691-690l-691 690l-90-90l690-691l-690-691l90-90l691 690l691-690l90 90z" />
                                    </svg>
                                    <div id="tooltip-reject{{ $candidat['id'] }}" role="tooltip"
                                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                        Rejeter
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>
                                    <svg data-tooltip-target="tooltip-await{{ $candidat['id'] }}"
                                        class="text-gray-800 dark:text-white hover:text-[#FF7322] cursor-pointer"
                                        onclick="actionStatus(event, 'wait', '{{ $candidat['id'] }}', '{{ $candidat['odcuser']['first_name'] }}', '{{ $candidat['odcuser']['last_name'] }}')"
                                        class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <div id="tooltip-await{{ $candidat['id'] }}" role="tooltip"
                                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                        Mettre en attente
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <button type="button" data-modal-target="popup-accept" id="first-modal"
                data-modal-toggle="popup-accept" hidden>
                Launch Modal
            </button>
            <button type="button" data-modal-target="popup-decline" id="second-modal"
                data-modal-toggle="popup-decline" hidden>
                Launch Modal
            </button>
            <button type="button" data-modal-target="popup-wait" id="third-modal" data-modal-toggle="popup-wait"
                hidden>
                Launch Modal
            </button>
        @else
            <div class="flex justify-center items-center">
                <div class="text-center">
                    <p class="dark:text-gray-400 text-black">Aucun candidat n'a été trouvé sur cette activité !</p>
                </div>
            </div>
        @endif
    </div>
</div>
@section('modal')
    @if (isset($candidatsData))
        <div id="popup-accept" tabindex="-1"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button"
                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-[#FF7322] hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="popup-accept">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close</span>
                    </button>
                    <div class="p-4 md:p-5 text-center">
                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-[#FF7322]" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400" id="popup-title-accept">
                        </h3>
                        <button id="accept-link" data-text="accept" data-modal-hide="popup-accept" type="button"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center"
                            onclick="changeStatus(event, 'accept')">
                            Confirmer
                        </button>
                        <button data-modal-hide="popup-accept" type="button"
                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Annuler</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="popup-decline" tabindex="-1"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button"
                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="popup-decline">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close</span>
                    </button>
                    <div class="p-4 md:p-5 text-center">
                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400" id="popup-title-decline">
                        </h3>
                        <button id="decline-link" data-text="decline" data-modal-hide="popup-decline" type="button"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center"
                            onclick="changeStatus(event, 'decline')">
                            Confirmer
                        </button>
                        <button data-modal-hide="popup-decline" type="button"
                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Annuler</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="popup-wait" tabindex="-1"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button"
                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="popup-wait">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close</span>
                    </button>
                    <div class="p-4 md:p-5 text-center">
                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400" id="popup-title-wait">
                        </h3>
                        <button id="wait-link" data-text="wait" data-modal-hide="popup-wait" type="button"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center"
                            onclick="changeStatus(event, 'wait')">
                            Confirmer
                        </button>
                        <button data-modal-hide="popup-wait" type="button"
                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                            Annuler
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
