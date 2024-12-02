<x-app-layout>
    <!-- Display errors if any -->
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-red-400"
                role="alert">
                <span class="font-medium">{{ $error }}</span>
            </div>
        @endforeach
    @endif

    <style>
        #candidatpresence tbody tr:hover,
        #participantTable tbody tr:hover,
        #candidatTable tbody tr:hover {
            background-color: #f1f1f1;
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
                            @foreach ($otherActivities as $event)
                                <li>
                                    <a href="{{ route('activites.show', $event->id) }}"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                        {{ $event->title }}
                                    </a>
                                </li>
                            @endforeach
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
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
            role="alert">
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Tab navigation -->
    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-styled-tab"
            data-tabs-toggle="#default-styled-tab-content"
            data-tabs-active-classes="text-purple-600 hover:text-purple-600 dark:text-purple-500 dark:hover:text-purple-500 border-purple-600 dark:border-purple-500"
            data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300"
            role="tablist">
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-styled-tab"
                    data-tabs-target="#styled-profile" type="button" role="tab" aria-controls="profile"
                    aria-selected="false">Detail</button>
            </li>
            <li class="me-2" role="presentation">
                <button
                    class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    id="dashboard-styled-tab" data-tabs-target="#styled-dashboard" type="button" role="tab"
                    aria-controls="dashboard" aria-selected="false">Candidats</button>
            </li>
            <li class="me-2" role="presentation">
                <button
                    class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    id="dashboard-styled-tab" data-tabs-target="#participants-tab" type="button" role="tab"
                    aria-controls="dashboard" aria-selected="false">Participants</button>
            </li>
            <li class="me-2" role="presentation">
                <button
                    class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    id="presence-styled-tab" data-tabs-target="#content-presence" type="button" role="tab"
                    aria-controls="presence" aria-selected="false">Presence</button>
            </li>
            <li class="me-2" role="presentation">
                <button
                    class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    id="import-styled-tab" data-tabs-target="#import" type="button" role="tab"
                    aria-controls="Importation" aria-selected="false">Import</button>
            </li>
        </ul>
    </div>

    <!-- Tab content -->
    <div id="default-styled-tab-content">
        <!-- Show activity details -->
        <x-activitesShow :datachart="$datachart" :show="$activite" />

        <!-- Show candidates for the activity -->
        <x-show-candidates-event :activite="$activite" :labels="$labels" :candidatsData="$candidatsData" :odcusers="$odcusers"
            :id="$id" />

        <!-- Participants tab content -->
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="participants-tab" role="tabpanel"
            aria-labelledby="participants-tab">
            <x-show-participants-event :participantsData="$participantsData" :activite="$activite" :labels="$labels" :candidatsData="$candidatsData"
                :odcusers="$odcusers" :id="$id" :modelMail="$modelMail" />
        </div>

        <!-- Presence tab content -->
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="content-presence" role="tabpanel"
            aria-labelledby="settings-tab">
            <x-activite-presence-component :fullDates="$fullDates" :dates="$dates" :presencesData="$presencesData" />
        </div>

        <!-- import tab content -->
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="import" role="tabpanel"
            aria-labelledby="contacts-tab">
            <p class="text-sm text-gray-500 dark:text-gray-400"><x-activite-import :activite="$activite" /></p>
        </div>
    </div>



    @php
        $url = env('API_URL');
    @endphp

    @section('script')
        <script src="https://cdn.datatables.net/fixedcolumns/5.0.4/js/dataTables.fixedColumns.js"></script>
        <script src="https://cdn.datatables.net/fixedcolumns/5.0.4/js/fixedColumns.dataTables.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Get all checkboxes in the table
                const checkboxes = document.querySelectorAll('.checkbox');
                const submitButton = document.querySelector("#submitPresenceButton");

                // Initially hide the submit button
                submitButton.style.display = 'none';

                // Function to check if any checkbox was changed
                function handleCheckboxChange() {
                    let anyChecked = false;
                    checkboxes.forEach(function(checkbox) {
                        if (checkbox.checked) {
                            anyChecked = true;
                        }
                    });
                    // Show the submit button if any checkbox is checked
                    submitButton.style.display = anyChecked ? 'inline-block' : 'none';
                }

                // Add event listeners to checkboxes
                checkboxes.forEach(function(checkbox) {
                    checkbox.addEventListener("change", handleCheckboxChange);
                });
            });
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
                        $('#accept-link').attr('data', id)
                        $('#popup-title-accept').text(
                            "Confirmez-vous la validation de la candidature de " + firstname + " ?")
                        document.getElementById('first-modal').click()
                        break;
                    case 'decline':
                        $('#decline-link').attr('data', id)
                        $('#popup-title-decline').text(
                            "Confirmez-vous l'annulation de la candidature de " + firstname + " ?");
                        document.getElementById('second-modal').click()
                        break;
                    case 'wait':
                        $('#wait-link').attr('data', id)
                        $('#popup-title-wait').text(
                            "Confirmez-vous la mise en attente de " + firstname + " ?")
                        document.getElementById('third-modal').click()
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
            const getChartOptions = () => {
                return {
                    series: [

                        @json([$datachart->sum('total_filles')]), // Total des filles
                        @json([$datachart->sum('total_garcons')]),
                        // Total des garçons
                    ],
                    colors: ["#1C64F2", "#16BDCA", "#FDBA8C"],
                    chart: {
                        height: "380px",
                        width: "100%",
                        type: "radialBar",
                        sparkline: {
                            enabled: true,
                        },
                    },
                    stroke: {
                        colors: ["transparent"],
                        lineCap: "round", // Use 'round' for the end caps of the radial bar
                    },
                    plotOptions: {
                        radialBar: {
                            track: {
                                background: '#E5E7EB',
                            },
                            dataLabels: {
                                show: false,
                            },
                            hollow: {
                                margin: 0,
                                size: "32%",
                            },
                            donut: {
                                labels: {
                                    show: true,
                                    name: {
                                        show: true,
                                        fontFamily: "Inter, sans-serif",
                                        offsetY: 20,
                                    },

                                    value: {
                                        show: true,
                                        fontFamily: "Inter, sans-serif",
                                        offsetY: -20,
                                        formatter: function(value) {
                                            return value; // Afficher la valeur brute
                                        },
                                    },
                                },
                                size: "70%",
                            },
                        },
                    },
                    grid: {
                        show: false,
                        strokeDashArray: 4,
                        padding: {
                            left: 2,
                            right: 2,
                            top: -23,
                            bottom: -20,
                        },
                    },
                    labels: ["Femme", "Homme"], // Étiquettes pour les séries
                    dataLabels: {
                        enabled: false,
                    },
                    legend: {

                        show: true,
                        position: "bottom",
                        fontFamily: "Inter, sans-serif",
                    },
                    tooltip: {
                        enabled: true,
                        x: {
                            show: false,
                        },
                    },
                    yaxis: {
                        show: false,

                    }
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                const options = getChartOptions();
                const chart = new ApexCharts(document.querySelector("#chart"), options);
                chart.render();
            });
        </script>

        </script>
        {{-- pour choisir le certificat a generer --}}
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
    @endsection
</x-app-layout>
