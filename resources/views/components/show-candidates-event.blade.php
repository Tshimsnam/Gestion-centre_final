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

    <div class="flex justify-between mb-4">
        <div class="flex space-x-2">
            <a href="#" onclick="reload()"
                class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-[#FF7322] text-white hover:bg-[#FF6822] focus:outline-none focus:ring-2 focus:ring-[#FF6822] transition duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17.65 6.35A7.96 7.96 0 0 0 12 4c-4.42 0-7.99 3.58-7.99 8s3.57 8 7.99 8c3.73 0 6.84-2.55 7.73-6h-2.08A5.99 5.99 0 0 1 12 18c-3.31 0-6-2.69-6-6s2.69-6 6-6c1.66 0 3.14.69 4.22 1.78L13 11h7V4z" />
                </svg>
                Synchroniser
            </a>
            <a href="#" onclick="event.preventDefault(); location.reload();"
                class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-[#FF7322] text-white hover:bg-[#FF6822] focus:outline-none focus:ring-2 focus:ring-[#FF6822] transition duration-200">
                <span>Actualiser la page</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17.65 6.35A7.96 7.96 0 0 0 12 4c-4.42 0-7.99 3.58-7.99 8s3.57 8 7.99 8c3.73 0 6.84-2.55 7.73-6h-2.08A5.99 5.99 0 0 1 12 18c-3.31 0-6-2.69-6-6s2.69-6 6-6c1.66 0 3.14.69 4.22 1.78L13 11h7V4z" />
                </svg>
            </a>
        </div>

    </div>

    <div class="py-6 relative overflow-x-auto">
        @if ($candidatsData)
            <table id="candidatTable"
                class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 cell-border">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th  class="p-4">
                            <div class="flex items-center">
                                {{-- <input id="select-all" type="checkbox"
                                    class="w-4 h-4 text-[#FF7322] hover:cursor-pointer bg-gray-100 border-gray-300 rounded focus:ring-[#FF7322] dark:focus:ring-[#FF7322] dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"> --}}
                                <label for="select-all" class="sr-only">checkbox</label>
                            </div>
                        </th>
                        <th class="group px-6 py-3 text-left">
                            <div class="flex items-center gap-2">
                                <span
                                    class="text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Profile</span>
                                <svg class="w-4 h-4 text-gray-400 opacity-0 group-hover:opacity-100 transition-opacity"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M5 12l5-5 5 5H5z" />
                                </svg>
                            </div>
                        </th>
                        <th 
                            class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">Prénom</th>
                        <th 
                            class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">Nom</th>
                        @if (
                            !in_array('Email', $labels) &&
                                !in_array('E-mail', $labels) &&
                                !in_array('E-mail(obligatoire)', $labels) &&
                                !in_array('Adresse Email', $labels))
                            <th 
                                class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">Email</th>
                        @endif
                        <th 
                            class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">Genre</th>
                        @foreach (array_unique($labels) as $label)
                            @if (isset($label))
                                <th 
                                    class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $label }}</th>
                            @endif
                        @endforeach
                        <th 
                            class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">Status</th>
                        <th 
                            class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($candidatsData as $candidat)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-600 hover:cursor-pointer">
                            <td class="w-4 p-4">
                                <div class="flex items-center">
                                    <input id="checkbox{{ $candidat['id'] }}" data-id="{{ $candidat['id'] }}"
                                        type="checkbox"
                                        class="row-select w-4 h-4 hover:cursor-pointer text-[#FF7322] bg-gray-100 border-gray-300 rounded focus:ring-[#FF7322] dark:focus:ring-[#FF7322] dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="checkbox{{ $candidat['id'] }}" class="sr-only">checkbox</label>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="h-10 w-10 flex-shrink-0">
                                    @if (empty($candidat['odcuser']['picture']))
                                        <img class="h-10 w-10 rounded-full object-cover"
                                            src="{{ asset('img/placeholder-event.webp') }}" alt="">
                                    @else
                                        <img class="h-10 w-10 rounded-full object-cover"
                                            src="{{ $candidat['odcuser']['picture'] }}" alt="">
                                    @endif
                                </div>
                            </td>
                            <td onclick="showDetail(event, '{{ $candidat['id'] }}')" class="px-6 py-3">
                                {{ $candidat['odcuser']['first_name'] }}</td>
                            <td onclick="showDetail(event, '{{ $candidat['id'] }}')" class="px-6 py-3">
                                {{ $candidat['odcuser']['last_name'] }}</td>
                            @if (
                                !in_array('Email', $labels) &&
                                    !in_array('E-mail', $labels) &&
                                    !in_array('E-mail(obligatoire)', $labels) &&
                                    !in_array('Adresse Email', $labels))
                                <td>{{ $candidat['odcuser']['email'] }}</td>
                            @endif
                            <td>{{ $candidat['odcuser']['gender'] }}</td>
                            @foreach (array_unique($labels) as $label)
                                <td class="px-6 py-3">{{ $candidat[$label] ?? 'N/A' }}</td>
                            @endforeach
                            <td onclick="showDetail(event, '{{ $candidat['id'] }}')" class="px-6 py-3">
                                {{ $candidat['status'] }}</td>
                            <td class="px-6 py-3 flex space-x-3">
                                <!-- Actions -->
                                <button
                                    onclick="actionStatus(event, 'accept', '{{ $candidat['id'] }}', '{{ $candidat['odcuser']['first_name'] }}')"
                                    class="text-gray-800 dark:text-white hover:text-[#FF7322]">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 11.917 9.724 16.5 19 7.5" />
                                    </svg>
                                </button>
                                <button
                                    onclick="actionStatus(event, 'decline', '{{ $candidat['id'] }}', '{{ $candidat['odcuser']['first_name'] }}', '{{ $candidat['odcuser']['last_name'] }}')"
                                    class="text-gray-800 dark:text-white hover:text-[#FF7322]">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                        viewBox="0 0 2048 2048">
                                        <path fill="currentColor"
                                            d="m1115 1024l690 691l-90 90l-691-690l-691 690l-90-90l690-691l-690-691l90-90l691 690l691-690l90 90z" />
                                    </svg>
                                </button>
                                <button
                                    onclick="actionStatus(event, 'wait', '{{ $candidat['id'] }}', '{{ $candidat['odcuser']['first_name'] }}', '{{ $candidat['odcuser']['last_name'] }}')"
                                    class="text-gray-800 dark:text-white hover:text-[#FF7322]">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 9v6m4-6v6m7-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
