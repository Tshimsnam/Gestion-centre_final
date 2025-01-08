<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('img/orange.webp') }}" type="image/x-icon">
    <title>{{ $title ?? 'Gestion Centre' }}</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/html5-qrcode"></script>
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
        <div id="result" class="text-center text-lg font-semibold text-green-500 my-4"></div>
        <div class="bg-white dark:bg-[#1E293B] shadow-lg rounded-lg p-4 flex flex-col items-center">
            <div id="qr_reader" class="w-full h-[400px]"></div>
            <div class="mt-4 space-x-4">
                <button id="startScan"
                    class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition">
                    Start Scan
                </button>
                <button id="stopScan"
                    class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition">
                    Stop Scan
                </button>
            </div>
        </div>

        <!-- Retour Button -->
        <div class="mt-6 text-center">
            <button onclick="window.location.href='/';"
                class="px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition">
                Retour à la page d'accueil
            </button>
        </div>
    </div>

    <script>
        let scannerInstance = null;

        document.addEventListener("DOMContentLoaded", () => {
            const resultElement = document.getElementById('result');
            const startScanButton = document.getElementById('startScan');
            const stopScanButton = document.getElementById('stopScan');

            function onScanSuccess(decodedText) {
                resultElement.textContent = `QR Code détecté : ${decodedText}`;
                if (decodedText.startsWith("http")) {
                    setTimeout(() => {
                        window.location.href = decodedText;
                    }, 2000);
                } else {
                    alert(`Contenu du QR Code : ${decodedText}`);
                }
            }

            function startScanner() {
                if (!scannerInstance) {
                    scannerInstance = new Html5Qrcode("qr_reader");
                }
                scannerInstance.start({
                        facingMode: "environment"
                    }, // Caméra arrière
                    {
                        fps: 10,
                        qrbox: 250
                    },
                    onScanSuccess,
                    (errorMessage) => {
                        console.warn(`Erreur de scan : ${errorMessage}`);
                    }
                ).catch(err => {
                    console.error("Erreur de démarrage : ", err);
                });
            }

            function stopScanner() {
                if (scannerInstance) {
                    scannerInstance.stop().then(() => {
                        scannerInstance.clear();
                        resultElement.textContent = "";
                    }).catch(err => {
                        console.error("Erreur d'arrêt : ", err);
                    });
                }
            }

            startScanButton.addEventListener('click', startScanner);
            stopScanButton.addEventListener('click', stopScanner);
        });
    </script>
</body>

</html>
