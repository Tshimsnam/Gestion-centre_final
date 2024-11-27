<x-app-layout>
    @if (Auth()->user()->hasRole('superadmin'))


        <x-slot name="header">
            @section('svg')
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M10.83 5a3.001 3.001 0 0 0-5.66 0H4a1 1 0 1 0 0 2h1.17a3.001 3.001 0 0 0 5.66 0H20a1 1 0 1 0 0-2h-9.17ZM4 11h9.17a3.001 3.001 0 0 1 5.66 0H20a1 1 0 1 1 0 2h-1.17a3.001 3.001 0 0 1-5.66 0H4a1 1 0 1 1 0-2Zm1.17 6H4a1 1 0 1 0 0 2h1.17a3.001 3.001 0 0 0 5.66 0H20a1 1 0 1 0 0-2h-9.17a3.001 3.001 0 0 0-5.66 0Z" />
                </svg>
            @endsection
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Paramètres') }}
            </h2>
        </x-slot>

        <!-- Main modal -->
        @section('modal')
            <div id="crud-modal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-md max-h-full p-4">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 border-b rounded-t md:p-5 dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                INSERER LE MODEL DE ROLE
                            </h3>
                            <button type="button"
                                class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="rouless-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>

                        <!-- Modal body -->
                        <div class="p-4 md:p-5">
                            <form class="space-y-4" action="{{ route('role.store') }}" method="POST">
                                @csrf
                                <div>
                                    <label for="name"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        name</label>
                                    <input type="name" name="name" id="name"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                        placeholder="ex: superUser" required />
                                </div>


                                <button type="submit"
                                    class="w-full py-2 px-3 inline-flex items-center justify-center gap-x-2 font-medium rounded-lg border border-transparent bg-[#FF7322] text-white hover:bg-[#FF6822] focus:outline-none focus:bg-[#FF6822] disabled:opacity-50 disabled:pointer-events-none">
                                    Crée
                                </button>

                                <div
                                    class="flex items-center justify-center text-sm font-medium text-red-500 dark:text-gray-300">
                                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M11 10V12H9V14H7V12H5.8C5.4 13.2 4.3 14 3 14C1.3 14 0 12.7 0 11S1.3 8 3 8C4.3 8 5.4 8.8 5.8 10H11M3 10C2.4 10 2 10.4 2 11S2.4 12 3 12 4 11.6 4 11 3.6 10 3 10M16 14C18.7 14 24 15.3 24 18V20H8V18C8 15.3 13.3 14 16 14M16 12C13.8 12 12 10.2 12 8S13.8 4 16 4 20 5.8 20 8 18.2 12 16 12Z" />
                                    </svg>
                                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M12,8A1,1 0 0,1 13,9A1,1 0 0,1 12,10A1,1 0 0,1 11,9A1,1 0 0,1 12,8M21,11C21,16.55 17.16,21.74 12,23C6.84,21.74 3,16.55 3,11V5L12,1L21,5V11M12,6A3,3 0 0,0 9,9C9,10.31 9.83,11.42 11,11.83V18H13V16H15V14H13V11.83C14.17,11.42 15,10.31 15,9A3,3 0 0,0 12,6Z" />
                                    </svg>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        @endsection



        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-styled-tab"
                data-tabs-toggle="#default-styled-tab-content"
                data-tabs-active-classes="text-purple-600 hover:text-purple-600 dark:text-purple-500 dark:hover:text-purple-500 border-purple-600 dark:border-purple-500"
                data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300"
                role="tablist">
                <li class="me-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-styled-tab"
                        data-tabs-target="#styled-profile" type="button" role="tab" aria-controls="profile"
                        aria-selected="false">
                        Gestion des accès</button>
                </li>
                <li class="me-2" role="presentation">
                    <button
                        class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        id="dashboard-styled-tab" data-tabs-target="#styled-dashboard" type="button" role="tab"
                        aria-controls="dashboard" aria-selected="false">
                        Gestions des utilisateurs</button>
                </li>

                <li role="presentation">
                    <button
                        class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        id="contacts-styled-tab" data-tabs-target="#styled-typeevents" type="button" role="tab"
                        aria-controls="contacts" aria-selected="false">Gestion des types d'événèments</button>
                </li>

                <li role="presentation">
                    <button
                        class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        id="contacts-styled-tab" data-tabs-target="#styled-categories" type="button" role="tab"
                        aria-controls="contacts" aria-selected="false">Gestion des catégories                                                                               </button>
                </li>

                <li role="presentation">
                    <button
                        class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        id="contacts-styled-tab" data-tabs-target="#styled-tags" type="button" role="tab"
                        aria-controls="contacts" aria-selected="false">Gestion Tags</button>
                </li>

                <li role="presentation">
                    <button
                        class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        id="contacts-styled-tab" data-tabs-target="#styled-contacts" type="button" role="tab"
                        aria-controls="contacts" aria-selected="false">Contacts</button>
                </li>


            </ul>
        </div>
        <div id="default-styled-tab-content">
            <div class="hidden p-4 rounded-lg bg-[#eaeaebf3] dark:bg-[#0F172A]" id="styled-profile" role="tabpanel"
                aria-labelledby="profile-tab">
                <x-assign-roles-to-users></x-assign-roles-to-users>
            </div>
            <div class="hidden p-4 rounded-lg bg-[#eaeaebf3] dark:bg-[#0F172A]" id="styled-dashboard" role="tabpanel"
                aria-labelledby="dashboard-tab">
                <div class="py-12">
                    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                        <div class="overflow-hidden bg-transparent shadow-xl dark:bg-gray-800 sm:rounded-lg">
                            <div
                                class="p-6 bg-transparent border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                                <div class="text-gray-800 bg-transparent dark:text-gray-200">
                                    <div class="flex flex-col bg-transparent md:flex-row">
                                        <div class="p-6 lg:w-3/5 xl:w-1/2 sm:p-12">
                                            <div class="flex flex-col items-center mt-12">
                                                <div class="mb-8 text-center ">
                                                    <h1 class="text-2xl font-semibold leading-tight text-gray-700">
                                                        Formulaire d'inscription</h1>
                                                </div>

                                                <div class="flex-1 w-full mt-8">
                                                    <form method="POST" action="{{ route('register') }}">
                                                        @csrf

                                                        <!-- Name -->
                                                        <div>
                                                            <x-input-label for="name"
                                                                class="text-gray-800 dark:text-gray-200"
                                                                :value="__('Nom d\'utilisateur')" />
                                                            <x-text-input id="name" class="block w-full mt-1"
                                                                type="text" name="name" :value="old('name')"
                                                                required autofocus autocomplete="name" />
                                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                                        </div>

                                                        <!-- Email Address -->
                                                        <div class="mt-4">
                                                            <x-input-label for="email"
                                                                class="text-gray-800 dark:text-gray-200"
                                                                :value="__('Email')" />
                                                            <x-text-input id="email" class="block w-full mt-1"
                                                                type="email" name="email" :value="old('email')"
                                                                required autocomplete="username" />
                                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                                        </div>


                                                        <!-- Password -->
                                                        <div class="mt-4">
                                                            <x-input-label for="password"
                                                                class="text-gray-800 dark:text-gray-200"
                                                                :value="__('Mot de passe')" />

                                                            <x-text-input id="password" class="block w-full mt-1"
                                                                type="password" name="password" required
                                                                autocomplete="new-password" />

                                                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                                        </div>

                                                        <!-- Confirm Password -->
                                                        <div class="mt-4">
                                                            <x-input-label for="password_confirmation"
                                                                class="text-gray-800 dark:text-gray-200"
                                                                :value="__('Confirmez votre mot de passe')" />

                                                            <x-text-input id="password_confirmation"
                                                                class="block w-full mt-1" type="password"
                                                                name="password_confirmation" required
                                                                autocomplete="new-password" />

                                                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                                        </div>

                                                        <div class="flex items-center justify-end mt-4">

                                                            <x-primary-button class="ms-4">
                                                                {{ __('S\'enregistrer') }}
                                                            </x-primary-button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-1 bg-center bg-cover"
                                            style="background-image: url('/img/logo.jpg');">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informations de contact des développeurs -->
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-contacts" role="tabpanel"
                aria-labelledby="contacts-tab">
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Retrouvez ci-dessous les informations de contact des développeurs ayant contribué à la conception de
                    cette application.
                    N'hésitez pas à nous contacter en cas de panne ou de bug.
                </p> <br>
                <strong class="font-medium text-gray-800 dark:text-white">
                    Carlo Musongela : +33 1 23 45 67 89
                </strong>
                <p class="font-medium text-gray-800 dark:text-white">Idriss Elba : +33 1 23 45 67 89</p>
                <p class="font-medium text-gray-800 dark:text-white">Manasse Tshimanga : +33 1 23 45 67 89</p>
                <p class="font-medium text-gray-800 dark:text-white">Francine Magbia : +33 1 23 45 67 89</p>
                <p class="font-medium text-gray-800 dark:text-white">Vincent Tshipamba : +33 1 23 45 67 89</p>
                <p class="font-medium text-gray-800 dark:text-white">Junior Walker : +33 1 23 45 67 89</p>
                <p class="font-medium text-gray-800 dark:text-white">Josué Ndingambote : +33 1 23 45 67 89</p>
            </div>


            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-typeevents" role="tabpanel"
                aria-labelledby="contacts-tab">
                <x-typeevent :typEvent="$typEvent" />

            </div>

            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-categories" role="tabpanel"
                aria-labelledby="contacts-tab">
                <x-categories :categories="$categories" />

            </div>
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-tags" role="tabpanel"
                aria-labelledby="contacts-tab">
                <x-tags :tags="$tags" />

            </div>
        </div>
    @endif
    @section('script')
        <script>
            $(function() {
                if (document.getElementById("userRolesTable") && typeof simpleDatatables.DataTable !== 'undefined') {
                    const dataTable = new simpleDatatables.DataTable("#userRolesTable", {
                        searchable: false,
                        sortable: false,
                        pagging: false,
                        perPageSelect: false
                    })
                }
            })

            $(function() {
                getUsersRoles();
            });

            function getUsersRoles() {
                $.ajax({
                    url: "{{ route('users.roles.index') }}",
                    method: "GET",
                    success: function(response) {
                        var users = response.users;
                        var roles = response.roles;
                        var userRoles = response.userRoles;

                        // Create the table header with roles
                        var header = '<tr class="bg-gray-400 border-b border-gray-200 dark:border-gray-700"><th style="background-color: #d1d5db;"></th>';
                        roles.forEach(function(role) {
                            header +=
                                '<th class="text-center px-6 py-4">' + role.name + '</th>';
                        });
                        header += '</tr>';
                        $('#userRolesTable thead').html(header);

                        // Create the table body with users and checkboxes
                        var body = '';

                        // Initial rendering of the table
                        users.forEach(function(user) {
                            body +=
                                '<tr class="hover:bg-[#ff7900] border-b border-gray-300 dark:border-gray-700"><th class="scope="row" class="px-6 py-4 text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800"><a href="#" class="p-2" data-user-id="' +
                                user.id + '" data-user-name="' + user.name + '">' + user.name + '</a></th>';
                            roles.forEach(function(role) {
                                var checked = userRoles[user.id] && userRoles[user.id].includes(role
                                    .id) ? 'checked' : '';
                                body +=
                                    '<td class="text-center px-6 py-4"><input type="checkbox" class="user-checkbox" data-role-id="' +
                                    role.id + '" data-user-id="' + user.id +
                                    '" ' + checked + '></td>';
                            });
                            body += '</tr>';
                        });

                        $('#userRolesTable tbody').html(body);

                        // Attach change event listeners to checkboxes
                        var requestInProgress = false;

                        $('#userRolesTable').on('change', 'input.user-checkbox', function() {
                            if (requestInProgress) {
                                return;
                            }

                            requestInProgress = true;

                            var roleId = $(this).data('role-id');
                            var userId = $(this).data('user-id');
                            var checked = $(this).is(':checked');
                            // Your existing AJAX logic to update user's roles on the server
                            $.ajax({
                                url: "{{ route('users.roles.update') }}",
                                method: 'PUT',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    role_id: roleId,
                                    user_id: userId,
                                    assign: checked
                                },
                                success: function(response) {
                                    Swal.fire({
                                        title: 'Succès!',
                                        text: response.message,
                                        icon: 'success',
                                        timer: 2000,
                                        timerProgressBar: true,
                                        customClass: {
                                            popup: 'bg-gray-200 dark:bg-gray-800 text-black dark:text-white rounded-lg shadow-lg', // Classes Tailwind pour le popup
                                            confirmButton: 'bg-[#e38407] hover:bg-[#e38407] text-white font-bold py-2 px-4 rounded', // Bouton de confirmation
                                            cancelButton: 'bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded' // Bouton d'annulation
                                        },

                                    });
                                    requestInProgress = false;
                                },
                                error: function(error) {
                                    Swal.fire({
                                        title: 'Erreur!',
                                        text: 'Il y a eu une erreur lors de l\'assignation du rôle.',
                                        icon: 'error',
                                        confirmButtonText: 'OK',
                                        customClass: {
                                            popup: 'bg-gray-200 dark:bg-gray-800 text-black dark:text-white rounded-lg shadow-lg', // Classes Tailwind pour le popup
                                            confirmButton: 'bg-[#e38407] hover:bg-[#e38407] text-white font-bold py-2 px-4 rounded', // Bouton de confirmation
                                            cancelButton: 'bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded' // Bouton d'annulation
                                        },
                                    });
                                    requestInProgress = false;
                                }
                            });
                        });
                    },
                    error: function(error) {
                        console.error("There was an error fetching roles and permissions:", error);
                    }
                })
            }
        </script>
    @endsection
</x-app-layout>
