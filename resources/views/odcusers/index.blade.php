<x-app-layout>
    <style>
        #usersTable tbody tr:hover {
            background-color: #f1f1f1;
        }
    </style>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="w-full">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight text-left">
                    {{ __('Liste des apprenants') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="w-full bg-[#fcdab40a] darj p-4 rounded-lg bg-opacity-5 relative shadow-lg">
        <!-- Header -->
        <div
            class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200 dark:border-neutral-700 shadow-md border-l-8 hover:border-l-10">
            <div>
                <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                    Apprenants
                </h2>
                <p class="text-sm text-gray-600 dark:text-neutral-400">
                    Consultez tous les apprenants ayant un compte à l'Orange Digital Center et voyez les détails pour
                    chacun.
                </p>
            </div>

            <div>
                <div class="inline-flex gap-x-2">
                    <form class="w-full mx-auto">
                        <label for="default-search"
                            class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="search" onclick="openModal()" data-modal-target="search-user"
                                data-modal-toggle="search-user"
                                class="block w-60 p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Rechercher un utilisateur" required />
                        </div>
                    </form>

                    @section('modal')
                        <!-- Main modal -->
                        <div id="search-user" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div
                                        class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                        <input type="search" id="search"
                                            class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Recherchez en saisissant un prénom, nom, un email..." required />
                                        <button type="button"
                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                            data-modal-hide="search-user">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="p-4 md:p-5 space-y-4 relative overflow-x-auto" id="resultsContainer">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endsection
                </div>
            </div>
        </div>

        <div class="py-6 relative overflow-x-auto">
            <table id="usersTable"
                class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 cell-border">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr class=" dark:bg-gray-800 dark:border-gray-700">
                        <th scope="col"
                            class="px-6 py-3 dark:bg-gray-800 dark:border-gray-700 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Prénom
                        </th>
                        <th scope="col"
                            class="px-6 py-3 dark:bg-gray-800 dark:border-gray-700 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Nom
                        </th>
                        <th scope="col"
                            class="px-6 py-3 dark:bg-gray-800 dark:border-gray-700 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Email
                        </th>
                        <th scope="col"
                            class="px-6 py-3 dark:bg-gray-800 dark:border-gray-700 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Sexe
                        </th>
                        <th scope="col"
                            class="px-6 py-3 dark:bg-gray-800 dark:border-gray-700 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Date de naissance
                        </th>
                        <th scope="col"
                            class="px-6 py-3 dark:bg-gray-800 dark:border-gray-700 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Profession
                        </th>
                        <th scope="col"
                            class="px-6 py-3 dark:bg-gray-800 dark:border-gray-700 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Spécialité
                        </th>
                        <th scope="col"
                            class="px-6 py-3 dark:bg-gray-800 dark:border-gray-700 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Voir
                        </th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    @section('script')
        <script>
            $(document).ready(function() {
                var typingTimer;
                var doneTypingInterval = 500;

                $('#search').on('keyup', function() {
                    clearTimeout(typingTimer);
                    typingTimer = setTimeout(searchOdcusers);
                });

                $('#search').on('keydown', function() {
                    clearTimeout(typingTimer);
                });

                function searchOdcusers() {
                    var formData = $('#search').serialize();
                    var searchInput = $('#search').val()
                        .trim();

                    if (searchInput === '') {
                        $('#resultsContainer').html('<p>Veuillez entrer un terme de recherche.</p>');
                        return;
                    }

                    if (searchInput.length < 3) {
                        $('#resultsContainer').html('<p>Veuillez entrer au moins 3 caractères.</p>');
                        return;
                    }

                    $.ajax({
                        url: "{{ route('odcusers.search') }}",
                        method: 'GET',
                        data: {
                            search: searchInput
                        },
                        success: function(response) {
                            var resultsContainer = $('#resultsContainer');
                            resultsContainer.html('');

                            if (response.length == 0) {
                                resultsContainer.html(
                                    '<p class=" text-red-500">Aucun résultat trouvé.</p>');
                            } else {
                                var htmlContent = '';
                                let host = window.location.origin;
                                response.forEach(function(odcuser) {
                                    htmlContent += `
                                                    <a href="${host}/odcusers/${odcuser.id}"
                                                        class="inline-flex items-center justify-center p-5 text-base font-medium text-gray-500 rounded-lg bg-gray-50 hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white">

                                                        <span class="w-full">${odcuser.first_name} ${odcuser.last_name}</span>
                                                        <svg class="w-4 h-4 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            fill="none" viewBox="0 0 14 10">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                                                        </svg>
                                                        <br>
                                                    </a>
                    `;
                                });
                                resultsContainer.html(htmlContent);
                            }
                        },
                        error: function(xhr) {
                            console.error('Erreur de la requête AJAX', xhr);
                        }
                    });
                }
            });
        </script>
        <script>
            function openModal() {
                const modal = document.getElementById('search-user').classList.remove('hidden');
                const inputField = document.getElementById('search').focus();
            }
        </script>


        <script type="text/javascript">
            $(document).ready(function() {
                $('#usersTable').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        "url": "{{ route('getdata') }}",
                        "dataType": "json",
                        "type": "GET"
                    },
                    layout: {
                        topStart: {
                            pageLength: {
                                menu: [10, 25, 50, 100, 200]
                            }
                        },
                        bottomEnd: {
                            paging: {
                                numbers: 3
                            }
                        },

                    },
                    columns: [{
                            data: 'first_name',
                            name: 'first_name'
                        },
                        {
                            data: 'last_name',
                            name: 'last_name'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'gender',
                            name: 'gender'
                        },
                        {
                            data: 'birth_date',
                            name: 'birth_date'
                        },
                        {
                            data: 'profession',
                            name: 'profession'
                        },
                        {
                            data: 'detail_profession',
                            name: 'detail_profession'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ],
                    pageLength: 10,
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ]
                });

                $('#usersTable').css('width', '100%');

                //$('#usersTable_info').css('color', 'red');

                $('.dt-container').addClass('text-base text-gray-800 dark:text-gray-400 leading-tight')

                $('.dt-buttons').addClass('mt-4')
                $('.dt-buttons buttons').addClass('cursor-pointer mt-5 bg-slate-600 p-2 rounded-sm font-bold')

                $("#dt-length-0").addClass('text-gray-700 dark:text-gray-400 w-24 bg-white');
                $("label[for='dt-length-0']").addClass('text-gray-700 dark:text-gray-400').text(
                    ' Enregistrements par page');

                $('.dt-input').addClass('w-24')

                $('.dt-search').css('display', 'none')

                $("label[for='dt-search-0']").text('Recherche : ')
                $('#dt-search-0').css('width', '200px');
                $('#dt-search-0').css('margin-left', '20px');
            });
        </script>
    @endsection
</x-app-layout>
