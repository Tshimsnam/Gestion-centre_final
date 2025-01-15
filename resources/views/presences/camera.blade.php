<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('img/orange.webp') }}" type="image/x-icon">
    <title>{{ $title ?? 'Gestion Centre' }}</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.10/dist/sweetalert2.min.css">
    <script src="https://unpkg.com/html5-qrcode"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200 flex items-center justify-center min-h-screen">
    <div class="container mx-auto max-w-4xl p-6">
        <div>
            <a href="{{ route('dashboard') }}" class="flex items-center justify-center w-mx-auto">
                <x-application-logo class="text-gray-500 fill-current w-50 h-50" />
            </a>
        </div>
        <div class="text-center">
            <h1 class="text-2xl font-extrabold mb-2 text-black dark:text-white">Scanner QR Code</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Démarrez la caméra pour scanner un QR Code.</p>
        </div>

        <!-- QR Code Scanner -->
        {{-- <div id="result" class="text-center text-lg font-semibold text-green-500 my-4" role="alert"></div> --}}
        <div class="bg-white dark:bg-[#1E293B] shadow-lg rounded-lg p-4 flex flex-col items-center">
            <div id="qr_reader" class="w-full h-[400px]" aria-label="QR Code Scanner"></div>
            <div class="mt-4 space-x-4">
                <button id="startScan"
                    class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition transform hover:scale-105"
                    aria-label="Démarrer le scan">
                    Start Scan
                </button>
                <button id="stopScan"
                    class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition transform hover:scale-105"
                    aria-label="Arrêter le scan">
                    Stop Scan
                </button>
            </div>
        </div>

        <!-- Retour Button -->
        <div class="mt-6 text-center">
            <button onclick="window.location.href='/security';"
                class="px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition">
                Retour à la page d'accueil
            </button>
        </div>
    </div>

    <!-- Modal de confirmation -->
    <div id="confirmationModal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg max-w-sm w-full">
            <h3 class="text-lg font-semibold text-center">Confirmation de présence pour à l'activité <span
                    id="activityName"></span></h3>

            <div id="modalContent" class="mt-4  p-4">

                <header class="px-2 py-4 mt-16 flex flex-col justify-center items-center text-center">
                    <img class="inline-flex object-cover border-4 border-[#ff7900] rounded-full shadow-[5px_5px_0_0_rgba(0,0,0,1)] shadow-[#ff7700d8] bg-indigo-50 text-indigo-600 h-24 w-24 !h-48 !w-48"
                        src="" alt="" id="candidateProfilePicture">
                    <h1 class="text-2xl text-gray-500 font-bold mt-2" id="candidateName" data-id>

                    </h1>
                    <h2 class="text-base md:text-xl text-gray-500 font-bold" id="emailcandidat">
                        Lead Software Engineer @
                        <a href="" target="_blank"
                            class="text-indigo-900 hover:text-indigo-600 font-bold border-b-0 hover:border-b-4 hover:border-b-indigo-300 transition-all mb-2">
                            XYZ
                        </a>
                    </h2>

                </header>


            </div>
            <div class="flex justify-center space-x-4 mt-4">
                <button id="confirmPresence" class="px-6 py-2 bg-[#ff7900] text-white rounded-lg">Confirmer</button>
                <button id="closeModal" class="px-6 py-2 bg-gray-600 text-white rounded-lg"
                    onclick="closemodal()">Annuler</button>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.10/dist/sweetalert2.all.min.js"></script>
    <script>
        const candidateNameElement = document.getElementById('candidateName') || null;
        const activityNameElement = document.getElementById('activityName') || null;
        const candidateInfo = document.getElementById('candidateInfo') || null;
        const activityInfo = document.getElementById('activityInfo') || null;
        const confirmPresenceButton = document.getElementById('confirmPresence') || null;

        function closemodal() {
            const modal = document.getElementById('confirmationModal');
            modal.classList.add('hidden');
            document.getElementById('result').innerText =' ';
            qrReader.stop().then(ignore => {
                qrReader.clear();
            }).catch((err) => {
                console.error(`Erreur d'arrêt: ${err}`);
            });
        }

        document.addEventListener("DOMContentLoaded", function() {
            const qrReader = new Html5Qrcode("qr_reader");

            // Démarrer le scan
            document.getElementById('startScan').addEventListener('click', () => {
                qrReader.start({
                        facingMode: "environment"
                    }, // Utilise la caméra arrière
                    {
                        fps: 5,
                        qrbox: 300,
                        disableFlip: true
                    },
                    (decodedText, decodedResult) => {
                        // Afficher le résultat
                        // document.getElementById('result').innerText =
                            // `Code détecté: ${decodedText} ${decodedResult}`;

                        fetch(`${decodedText}`, {
                                method: 'GET',
                                headers: {
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json',
                                }
                            }).then(response => response.json())
                            .then(responseData => {

                                if (responseData.candidateName) {
                                    candidateNameElement.textContent = responseData.candidateName;
                                    activityNameElement.textContent = responseData.activityName;
                                    document.getElementById('candidateProfilePicture').src =
                                        responseData.profile;
                                    document.getElementById('emailcandidat').textContent =
                                        responseData.email;

                                    document.getElementById('candidateName').setAttribute('data-id',
                                        responseData.candidatId);


                                    confirmationModal.classList.remove('hidden');
                                } else {
                                    alert("Erreur lors de la récupération des informations : " +
                                        responseData.error);
                                }
                            })
                            .catch(error => {
                                console.error("Erreur lors de la requête : ", error);
                                alert(
                                    "Une erreur est survenue lors de la récupération des informations." +
                                    error);
                            });

                    },
                    (errorMessage) => {
                        // Gérer les erreurs
                        console.warn(`Erreur de scan: ${errorMessage}`);
                    }
                ).catch((err) => {
                    // Gérer les erreurs d'initialisation
                    console.error(`Erreur d'initialisation: ${err}`);
                });
            });

            // Arrêter le scan
            document.getElementById('stopScan').addEventListener('click', () => {
                qrReader.stop().then(ignore => {
                    // Nettoyer le conteneur
                    qrReader.clear();
                }).catch((err) => {
                    // Gérer les erreurs d'arrêt
                    console.error(`Erreur d'arrêt: ${err}`);
                });
            });
        });
    </script>

    <script>
        document.getElementById('confirmPresence').addEventListener('click', function() {
            const candidateId = document.getElementById('candidateName').getAttribute('data-id');
            const confirmButton = document.getElementById('confirmPresence');

            if (!candidateId) {
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: "ID du candidat non trouvé.",
                    toast: true,
                    position: 'center',
                    timer: 3000,
                    showConfirmButton: false,
                    timerProgressBar: true,
                });
                return;
            }


            confirmButton.disabled = true;
            confirmButton.textContent = 'Chargement...';

            fetch(`/confirm-presence/${candidateId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        date: new Date().toISOString().split('T')[0]
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Succès',
                            text: data.message,
                            toast: true,
                            position: 'top-end',
                            timer: 3000,
                            showConfirmButton: false,
                            timerProgressBar: true,
                        }).then(() => {
                            document.getElementById('closeModal')
                                .click();
                        });
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Information',
                            text: data.message,
                            toast: true,
                            position: 'center',
                            timer: 3000,
                            showConfirmButton: false,
                            timerProgressBar: true,
                        });
                    }
                })
                .catch(error => {
                    console.error("Erreur lors de la requête :", error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        text: "Une erreur est survenue lors de la confirmation de votre présence.",
                        toast: true,
                        position: 'center',
                        timer: 3000,
                        showConfirmButton: false,
                        timerProgressBar: true,
                    });
                })
                .finally(() => {

                    confirmButton.disabled = false;
                    confirmButton.textContent = 'Confirmer';
                });
        });
    </script>

</body>

</html>
