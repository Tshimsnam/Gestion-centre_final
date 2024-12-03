@props(['labels', 'participantsData', 'participantsData', 'url', 'id', 'odcusers', 'activite', 'modelMail'])


<div class="flex justify-between mt-1 ">
    <div>
        {{-- <a href="{{ route('allCertificat', $id) }}"
            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-[#FF7322] text-white hover:bg-[#FF6822] focus:outline-none focus:bg-[#FF6822] disabled:opacity-50 disabled:pointer-events-none">Generer
            tous les certificats
        </a> --}}
        {{-- Choix du model du certificat a generer --}}


        <div data-dial-init class="fixed flex   group">
            <div id="speed-dial-menu-horizontal" class="flex items-center hidden me-4 space-x-2 rtl:space-x-reverse">
                <a href="{{ route('allCertificat', $id) }}" type="button" data-tooltip-target="tooltip-share"
                    data-tooltip-placement="top" data-modal-target="choixCertificat-modal"
                    data-modal-toggle="choixCertificat-modal" onclick="choix_certificat(event)"
                    class="flex justify-center items-center w-[52px] h-[52px] text-gray-500 hover:text-gray-900 bg-white rounded-full border border-gray-200 dark:border-gray-600 shadow-sm dark:hover:text-white dark:text-gray-400 hover:bg-gray-50 dark:bg-gray-700 dark:hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:focus:ring-gray-400">
                    <svg class="w-5 h-5 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7h1v12a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h11.5M7 14h6m-6 3h6m0-10h.5m-.5 3h.5M7 7h3v3H7V7Z" />
                    </svg>

                    <span class="sr-only"> Choisir un model de certificat</span>
                </a>
                <div id="tooltip-share" role="tooltip"
                    class="absolute z-10 invisible inline-block w-auto px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    Choisir un model de certificat
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
                <a href="{{ route('syncandidats', $id) }}" data-tooltip-target="tooltip-print"
                    data-tooltip-placement="top"
                    class="flex justify-center items-center w-[52px] h-[52px] text-gray-500 hover:text-gray-900 bg-white rounded-full border border-gray-200 dark:border-gray-600 shadow-sm dark:hover:text-white dark:text-gray-400 hover:bg-gray-50 dark:bg-gray-700 dark:hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:focus:ring-gray-400">
                    <svg class="w-4 h-4 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m16 10 3-3m0 0-3-3m3 3H5v3m3 4-3 3m0 0 3 3m-3-3h14v-3" />
                    </svg>

                    <span class="sr-only">syncandidats</span>
                </a>
                <div id="tooltip-print" role="tooltip"
                    class="absolute z-10 invisible inline-block w-auto px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    syncandidats
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
                <button type="button" onclick="generer(event)" data-tooltip-target="tooltip-download"
                    data-tooltip-placement="top"
                    class="flex justify-center items-center w-[52px] h-[52px] text-gray-500 hover:text-gray-900 bg-white rounded-full border border-gray-200 dark:border-gray-600 shadow-sm dark:hover:text-white dark:text-gray-400 hover:bg-gray-50 dark:bg-gray-700 dark:hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:focus:ring-gray-400">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z" />
                        <path
                            d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z" />
                    </svg>
                    <svg aria-hidden="true" id="loading"
                        class="hidden w-6 h-6 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                        viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                            fill="currentColor" />
                        <path
                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                            fill="currentFill" />
                    </svg>
                    <span class="sr-only"> Exporter les participants pour la présence</span>
                </button>
                <div id="tooltip-download" role="tooltip"
                    class="absolute z-10 invisible inline-block w-auto px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    Exporter les participants pour la présence
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
                <form action="{{ route('exportParticipant') }}" method="POST">
                    @csrf
                    <input type="hidden" name="certif" value="{{ $activite->id }}">
                    <input type="hidden" name="certifTitle" value="{{ $activite->title }}">
                    <button type="submit" data-tooltip-target="tooltip-copy" data-tooltip-placement="top"
                        class="flex justify-center items-center w-[52px] h-[52px] text-gray-500 hover:text-gray-900 bg-white rounded-full border border-gray-200 dark:border-gray-600 dark:hover:text-white shadow-sm dark:text-gray-400 hover:bg-gray-50 dark:bg-gray-700 dark:hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:focus:ring-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                            fill="#e8eaed">
                            <path
                                d="M440-160v-326L336-382l-56-58 200-200 200 200-56 58-104-104v326h-80ZM160-600v-120q0-33 23.5-56.5T240-800h480q33 0 56.5 23.5T800-720v120h-80v-120H240v120h-80Z" />
                        </svg>
                        <span class="sr-only">Exporter pour l'evaluation</span>
                    </button>
                </form>
                <div id="tooltip-copy" role="tooltip"
                    class="absolute z-10 invisible inline-block w-auto px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    Exporter pour l'evaluation
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </div>
            <button type="button" data-dial-toggle="speed-dial-menu-horizontal"
                aria-controls="speed-dial-menu-horizontal" aria-expanded="false"
                class="flex items-center justify-center text-white bg-[#FF7322] rounded-full w-14 h-14 hover:bg-[#ff7322d0] dark:bg-[#FF7322] dark:hover:bg-[#ff7322d0] focus:ring-4 focus:ring-blue-300 focus:outline-none dark:focus:ring-blue-800">
                <svg class="w-5 h-5 transition-transform group-hover:rotate-45" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 1v16M1 9h16" />
                </svg>
                <span class="sr-only">Open actions menu</span>
            </button>
        </div>
    </div>

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
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </button>
    </div>

    <div class="flex justify-between items-center">
        <!-- Modal toggle -->
        <div class="flex justify-end mt-6 mr-4 center">
            <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-[#ff7322] text-white hover:bg-[#ff6822] focus:outline-none focus:bg-[#ff6822] disabled:opacity-50 disabled:pointer-events-none"
                type="button">Envoyer <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 4 4 4-4" />
                </svg>
            </button>
        </div>

        <!-- Dropdown menu -->
        <div id="dropdown"
            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-28 dark:bg-gray-700">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                <li>
                    <a href="#" data-modal-target="mail-modal" data-modal-toggle="mail-modal"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Mail</a>
                </li>
                <li>
                    <a href="#" data-modal-target="sms-modal" data-modal-toggle="sms-modal"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">SMS</a>
                </li>
            </ul>
        </div>

        @section('modalparticipants')
            <!-- Mail modal -->
            <div id="mail-modal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-5xl max-h-full p-4">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 border-b rounded-t md:p-5 dark:border-gray-600">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                Envoie des mails
                            </h3>
                            <button type="button"
                                class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-toggle="mail-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>

                        <!-- Modal body -->
                        <form action="{{ route('sendMailActivite') }}" class="p-4 md:p-5" method="post">
                            @csrf
                            @method('GET')
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div class="col-span-2">
                                    <label for="activity"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Activité</label>
                                    <select id="activity" name="activity"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <option value="{{ $activite->id }}">{{ $activite->title }}</option>
                                    </select>
                                </div>
                                <div id="model-mail-div" class="col-span-2">
                                    <label id="label-model-mail" for="model-mail"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Modèle de
                                        mail</label>
                                    <select id="model-mail" name="model-mail"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <option value="" selected="">Sélectionner un modèle de mail</option>

                                        @foreach ($modelMail as $item)
                                            <option value="{{ $item->message }}">{{ $item->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-span-2 sm:col-span-1">
                                    <label for="subject"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sujet</label>
                                    <input type="text" name="subject" id="subject"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Entrer un sujet de mail" required="">
                                </div>

                                {{ csrf_field() }}

                                <div class="col-span-2">
                                    <label for="message"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Message</label>
                                    <textarea id="message" name="message" rows="6"
                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Write your message here"></textarea>
                                </div>
                            </div>
                            <button type="submit"
                                class="text-white inline-flex w-full justify-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Envoyer
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sms modal -->
            <div id="sms-modal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-5xl max-h-full p-4">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 border-b rounded-t md:p-5 dark:border-gray-600">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                Envoie des sms
                            </h3>
                            <button type="button"
                                class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-toggle="sms-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>

                        <!-- Modal body -->
                        {{-- <form action="{{ route('sendSms') }}" class="p-4 md:p-5" method="post">
                            @csrf
                            @method('GET')
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div class="col-span-2">
                                    <label for="sms-activity"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Activité</label>
                                    <select id="sms-activity" name="sms-activity"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <option value="{{ $activite->id }}">{{ $activite->title }}</option>
                                    </select>
                                </div>
                                <div id="model-sms-div" class="col-span-2">
                                    <label id="label-model-sms" for="model-sms"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Modèle de
                                        sms</label>
                                    <select id="model-sms" name="model-sms"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <option value="" selected="">Sélectionner un modèle de sms</option>
                                        {{ $modelSms }}
                                        @foreach ($modelSms as $item)
                                            <option value="{{ $item->message }}">{{ $item->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-span-2">
                                    <label for="sms-cible"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cible</label>
                                    <select id="sms-cible" name="sms-cible"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <option value="tout-le-monde" selected="">Tous le monde</option>
                                        <option value="activité">Par rapport à une activité</option>
                                        <option value="age-cible">Age</option>
                                        <option value="sexe-cible">Genre</option>
                                        <option value="personnalise">Personnalisé</option>
                                    </select>
                                </div>
                                <div id="sms-per-activity-div" class="col-span-2">
                                    <label for="sms-per-activity"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Par rapport à
                                        une activité</label>
                                    <input type="text" list="sms-activity_name_list" name="sms-per-activity"
                                        id="sms-per-activity"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Entrer une activité">
                                    <div id="sms-activity_name_list" class="text-black bg-gray-300 rounded-lg "></div>
                                </div>

                                {{ csrf_field() }}

                                <div id="sms-age-div" class="col-span-2">
                                    <label for="sms-age"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Age</label>
                                    <select id="sms-age" name="sms-age"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <option value="" selected="">Sélectionner un âge</option>
                                        <option value=">18">> à 18</option>
                                        <option value="<18">
                                            < à 18</option>
                                        <option value=">25">> à 25</option>
                                        <option value=">30">> à 30</option>
                                    </select>
                                </div>
                                <div id="sms-sexe-div" class="col-span-2">
                                    <label for="sms-sexe"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Genre</label>
                                    <select id="sms-sexe" name="sms-sexe"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <option value="" selected="">Sélectionner un genre</option>
                                        <option value="M">Masculin</option>
                                        <option value="F">Feminin</option>
                                    </select>
                                </div>
                                <div id="sms-personnalise-div" class="col-span-2">
                                    <label for="sms-person"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Personnalisé</label>
                                    <input type="text" name="sms-person" id="sms-person"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="821002525, 821060509, ...">
                                </div>
                                <div class="col-span-2">
                                    <label for="sms-message"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Message</label>
                                    <textarea id="sms-message" name="sms-message" rows="6"
                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Write your message here"></textarea>
                                </div>
                            </div>
                            <button type="submit"
                                class="text-white inline-flex w-full justify-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Envoyer
                            </button>
                        </form> --}}
                    </div>
                </div>
            </div>
        @endsection

        <form action="{{ route('importAndgenerate') }}" method="POST" enctype="multipart/form-data"
            class="flex">
            @csrf
            {{-- <p class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">Importer et Generer les certificats</p> --}}
            <input type="hidden" name="activite" value="{{ $activite->id }}">
            <div class="ml-2">
                <input
                    class="block  w-full text-sm  text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    aria-describedby="user_avatar_help" id="file" type="file" accept=".xlsx"
                    name="file">

            </div>
            <div class="ml-2">
                <button type="submit"
                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-[#FF7322] text-white hover:bg-[#FF6822] focus:outline-none focus:bg-[#FF6822] disabled:opacity-50 disabled:pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                        fill="#e8eaed">
                        <path d=" M480-320 280-520l56-58 104 104v-326h80v326l104-104 56
                    58-200 200ZM240-160q-33 0-56.5-23.5T160-240v-120h80v120h480v-120h80v120q0 33-23.5
                    56.5T720-160H240Z" />
                    </svg>
                    Importer
                </button>
            </div>
        </form>

        <div class="ml-2">
            <button id="createUserBtn"
                class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-[#FF7322] text-white hover:bg-[#FF6822] focus:outline-none focus:bg-[#FF6822] disabled:opacity-50 disabled:pointer-events-none">
                <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 12h14m-7 7V5" />
                </svg>
                Ajouter un participant
            </button>
        </div>
    </div>
</div>


<!-- Modal choix certificat -->
@section('modalparticipants')
    <div id="choixCertificat-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Selectionner un model du certificat
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="choixCertificat-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="" method="post" class="p-4 md:p-5">
                    @method('GET')
                    <div class="flex justify-center  space-x-4">
                        <div class="col-span-2 sm:col-span-1">
                            <label for="semestre"
                                class="flex justify-center mb-2 text-sm font-medium text-gray-900 dark:text-white">Choisir
                                Model
                            </label>
                            <select id="certificat" name="certificat"
                                class="justify-center bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="1">Modèle Parcours Académique</option>
                                <option value="2">Modèle Parcours Fablab</option>
                                <option value="3">Modèle Standard</option>
                                <option value="4">Modèle Super codeurs</option>
                                <option value="5">Modèle maker junior</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-center mt-6">
                        <button type="submit"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-[#FF7322] text-white hover:bg-[#FF6822] focus:outline-none focus:bg-[#FF6822] disabled:opacity-50 disabled:pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                width="24px" fill="#e8eaed">
                                <path
                                    d="M480-320 280-520l56-58 104 104v-326h80v326l104-104 56 58-200 200ZM240-160q-33 0-56.5-23.5T160-240v-120h80v120h480v-120h80v120q0 33-23.5 56.5T720-160H240Z" />
                            </svg>
                            Télécharger
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


<div class="py-11 relative overflow-x-auto">
    <div class="success"></div>
    @if (isset($participantsData))
        <table id="participantTable"
            class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 cell-border">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        Firstname
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        Lastname
                    </th>
                    @foreach (array_unique($labels) as $label)
                        @if (isset($label))
                            @if (
                                $label == 'Civilié' ||
                                    $label == 'Civilité' ||
                                    $label == 'Email' ||
                                    $label == 'E-mail' ||
                                    $label == 'E-mail(obligatoire)' ||
                                    $label == 'Adresse Email' ||
                                    $label == 'Téléphone' ||
                                    $label == 'Numéro de téléphone' ||
                                    $label == 'Numéro de l\'encadreur' ||
                                    $label == 'Tranche d\'âge' ||
                                    $label == 'Adresse' ||
                                    $label == 'Adresse de domicile' ||
                                    $label == 'Adresse de domicile (n°, avenue, Quartier, Commune)' ||
                                    $label == 'Profession' ||
                                    $label == 'Spécialité ou domaine (étude ou profession)' ||
                                    $label == 'Spécialité ou domaine' ||
                                    $label == 'Niveau d\'étude' ||
                                    $label == 'Niveau ou année d\'étude' ||
                                    $label == 'Nom de l\'Etablissement / Université' ||
                                    $label == 'Université' ||
                                    $label == 'Université/Etablissement ou Structure')
                                <th scope="col"
                                    class="display-label px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $label }}
                                </th>
                            @elseif($label !== 'Cv de votre parcours (Obligatoire)')
                                <th scope="col"
                                    class="label px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $label }}
                                </th>
                            @endif
                        @endif
                    @endforeach
                    <th scope="col" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        Certificat
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($participantsData as $participant)
                    <tr>
                        <td class="px-6 py-3">{{ $participant['odcuser']['first_name'] }}</td>
                        <td class="px-6 py-3">{{ $participant['odcuser']['last_name'] }}</td>

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
                                        'Numéro de téléphone',
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
                                    <td class="px-6 py-3">{{ $participant[$label] ?? 'N/A' }}</td>
                                @elseif ($label !== 'Cv de votre parcours (Obligatoire)')
                                    <td class="label px-6 py-3">{{ $participant[$label] ?? 'N/A' }}</td>
                                @endif
                            @endif
                        @endforeach
                        <td>
                            @if ($participant['status'] == 'accept')
                                <a href="{{ route('certificat', $participant['id']) }}">Générer le Certificat</a>
                            @else
                                <button disabled>Non Certifiable</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="flex justify-center items-center">
            <div class="text-center">
                <p class="dark:text-gray-400 text-black">Aucun participant n'a été trouvé sur cette activité !</p>
            </div>
        </div>
    @endif
</div>
