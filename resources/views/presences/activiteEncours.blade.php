<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Activités en cours</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="shortcut icon" href="{{ asset('img/orange.webp') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    <nav class="bg-white border-gray-200 dark:bg-gray-900 fixed top-0 left-0 w-full p-5">
        <a href="#" class="flex space-x-2">
            <img src="{{ asset('img/orange.png') }}" class="h-8" alt="LogoOrange Digital Center" />
            <span class="self-center text-1xl font-semibold whitespace-nowrap dark:text-white">Orange Digital
                Center</span>
        </a>
    </nav>
    <div class=" p-5">
        <h1
            class ="mb-2 mt-14 text-3xl text-center font-extrabold tracking-tight leading-none text-gray-900 md:text-3xl lg:text-4xl dark:text-white">
            Liste des activités en cours
        </h1>
    </div>
    <div class=" p-5">
        @if (session('error'))
            <div id="alert-border-2"
                class="flex items-center p-4 mb-4 text-red-800 border-t-4 border-red-300 bg-red-50 dark:text-red-400 dark:bg-gray-800 dark:border-red-800"
                role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <div class="ms-3 text-sm font-medium">
                    {{ session('error') }}
                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
                    data-dismiss-target="#alert-border-2" aria-label="Close">
                    <span class="sr-only">Dismiss</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @endif
        @if (session('errorCreate'))
            <div id="alert-2"
                class="flex items-center p-4 mb-4 text-red-800 border-t-4 border-red-300 bg-red-50 dark:text-red-400 dark:bg-gray-800 dark:border-red-800"
                role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <div class="ms-3 text-sm font-medium">
                    {{ session('errorCreate') }}
                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
                    data-dismiss-target="#alert-border-2" aria-label="Close">
                    <span class="sr-only">Dismiss</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @endif
        @if ($activites->isEmpty())
            <div class="p-4 mb-4 mt-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                role="alert">
                <span class="font-medium">Oops, désolé !</span> Modifiez quelques choses et essayez de soumettre à
                nouveau.
            </div>
        @else
            <div id="alert-additional-content-1"
                class="p-4 mb-4 mx-auto text-gray-800 border border-gray-300 rounded-lg bg-orange-50 dark:bg-gray-800 dark:text-orange-400 dark:border-gray-700"
                role="alert">
                <div
                    class="container w-full lg:max-w-3xl px-2 md:max-w-md max-w-sm mx-auto p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 dark:bg-gray-800 dark:border-gray-700">
                    <h5 class="mb-3 text-base font-semibold text-gray-900 md:text-xl dark:text-white">
                        Choisisissez une activité:
                    </h5>
                    <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Cliquez sur une activité pour
                        marquer votre présence.</p>
                    @foreach ($activites as $i => $item)
                        <ul class="my-4 space-y-3">
                            <li>
                                <a href="#" data-modal-target="crud-modal{{ $item->id }}"
                                    data-modal-toggle="crud-modal{{ $item->id }}"
                                    class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg hover:text-orange-400 bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                                    <svg class="flex-shrink-0 w-4 h-4 me-2" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                    </svg>
                                    <h3 class="text-lg font-normal font-">{{ $item->title }}</h3>
                                </a>
                            </li>
                        </ul>


                        {{-- Modal de confirmation de l'adresse mail --}}
                        <div id="crud-modal{{ $item->id }}" tabindex="-1" aria-hidden="true"
                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-sm md:max-w-xl lg:max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div
                                        class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white modal-title">
                                            Entrez votre email ou votre numéro de téléphone
                                        </h3>

                                        <button id="closeModal{{ $item->id }}" onclick="closeModal()"
                                            type="button"
                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                            data-modal-toggle="crud-modal{{ $item->id }}">
                                            <svg class="w-3 h-3" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <div class="grid gap-4 mb-4 grid-cols-2">
                                        <div class="col-span-2 p-4 md:p-5">
                                            <div class="filterForms">
                                                <div class="" id="emailDiv{{ $item->id }}">
                                                    <form class="validateForm" method="POST">
                                                        @csrf
                                                        <div class="flex items-center space-x-6 justify-center">
                                                            <input type="text" name="coordonnee" id="coordonnee"
                                                                data-id="{{ $item->id }}"
                                                                class="mb-5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                                                placeholder="Saisissez votre email ou votre numéro"
                                                                required>
                                                            <input type="text" value="{{ $item->id }}" hidden
                                                                name="id">
                                                        </div>
                                                        <button type="submit"
                                                            class="w-36 text-center mx-auto justify-center text-white inline-flex items-center bg-odcolor hover:bg-odcolor/75 focus:ring-4 focus:outline-none focus:ring-blue-300 font-bold rounded-lg text-md py-2.5 dark:bg-orange-500 dark:hover:bg-orange-400 dark:focus:ring-wite-800">
                                                            Confirmer
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                            <div id="alert-2"
                                                class="notfound hidden items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                                                role="alert">
                                                <span class="sr-only">Alert</span>
                                                <div class="ms-3 text-sm font-medium error">

                                                </div>
                                            </div>
                                            <div class="hidden" id="confirmDiv{{ $item->id }}">
                                                <form class="space-y-5" action="{{ route('presences.store') }}"
                                                    method="post" id="confirmForm{{ $item->id }}">
                                                    @csrf
                                                    <div class="flex items-center space-x-5">
                                                        <label for="firstname"
                                                            class="block mb-2 w-36 text-sm font-medium text-gray-900 dark:text-white">Prénom</label>
                                                        <input type="text" name="firstname"
                                                            id="firstname{{ $item->id }}"
                                                            class="bg-gray-50 border border-gray-300
                                 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600
                                 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600
                                  dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                            required="">
                                                    </div>
                                                    <div class="flex items-center mb-4 space-x-5">
                                                        <label for="lastname"
                                                            class="block mb-2 w-36 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                                                        <input type="text" name="lastname"
                                                            id="lastname{{ $item->id }}"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                            required="">
                                                    </div>
                                                    <div class="flex items-center mb-4 space-x-5">
                                                        <label for="email"
                                                            class="block mb-2 w-36 text-sm font-medium text-gray-900 dark:text-white">Adresse
                                                            mail</label>
                                                        <input type="text" name="email"
                                                            id="confirm-email{{ $item->id }}"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                            required="">
                                                    </div>

                                                    <div class="flex items-center mb-4 space-x-5 eventinputdiv">
                                                        <label for="activite"
                                                            class="block mb-2 w-36 text-sm font-medium text-gray-900 dark:text-white">Activite</label>
                                                        <input type="text" name="idactivite"
                                                            id="activite{{ $item->id }}"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                            required="" readonly>
                                                    </div>
                                                    <input type="text" value="{{ $item->id }}" hidden
                                                        name="id">

                                                    <button type="submit"
                                                        class=" w-full text-white bg-odcolor hover:bg-odcolor/75 focus:ring-4
                             focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2
                              dark:bg-odcolor dark:hover:bg-odcolor/75 focus:outline-none
                               dark:focus:ring-blue-900">Valider</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>


    {{-- La section des scripts --}}
    <script>
        function closeModal() {
            window.location.reload();
        }
    </script>
    <script>
        function confirmerMail(event) {
            event.preventDefault();
            const lien = event.target.getAttribute("href");
            console.log(lien);
            document.getElementByClassName('validateForm').setAttribute('action', lien)
        }
    </script>
    <script>
        function show(event, id) {
            if (event.target.getAttribute('id') === 'default-radio-1' + id) {
                $('#emailDiv' + id).show();
                $('#phoneDiv' + id).hide();
            } else {
                $('#emailDiv' + id).hide();
                $('#phoneDiv' + id).show();
            }
        }
    </script>

    <script>
        $('.validateForm').on("submit", function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            var activityId = $(this).find('input[name="id"]').val();
            $.ajax({
                type: 'POST',
                url: '/filtrer/' + activityId,
                data: formData,
                success: function(data) {
                    if (data.error ===
                        "Désole, vous n\'avez pas de compte. Contactez un agent de la sécurité pour vous créer un compte. Merci !"
                    ) {
                        $('.error').text(
                            "Désole, vous n'avez pas de compte. Contactez un agent de la sécurité pour vous créer un compte. Merci !"
                        )
                        $('.notfound').removeClass('hidden')
                        $('.filterForms').addClass('hidden');
                        $('.modal-title').text("Confirmation des informations")
                        $('.radiodiv').addClass('hidden');
                    } else if (data.error ===
                        "Désolé, vous n\'êtes pas enregistré sur cette activité. Merci !") {
                        $('.modal-title').text("Enregistrez vous     à l'activité")
                        $("#confirmDiv" + activityId).removeClass('hidden');
                        $('.filterForms').addClass('hidden');
                        $('#activite' + activityId).attr('value', data.title);
                    } else {
                        $('.filterForms').addClass('hidden');
                        $("#confirmDiv" + activityId).removeClass('hidden');
                        $('.modal-title').text("Confirmation des informations")
                        $('#firstname' + activityId).attr('value', data.prenom);
                        $('#lastname' + activityId).attr('value', data.nom);
                        $('#confirm-email' + activityId).attr('value', data.email);
                        $('#activite' + activityId).attr('value', data.activite);
                    }
                }
            });
        });
    </script>
</body>

</html>
