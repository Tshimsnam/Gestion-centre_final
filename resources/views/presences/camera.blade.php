<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Générateur de QR Code</title>

</head>
<body>
    <h1>Scan qrcode</h1>
    <div id="qrcode"></div>
    <div id="result"></div>
    <div style="display: flex;justify-content: center;">
        <div class="" id="qr_reader" style="width: 500px;"></div>
    </div>
    <script src="https://unpkg.com/html5-qrcode"></script>
    <script>
        function domReady(fn) {
            if(document.readyState == "complete" || document.readyState == "interactive") {
                setTimeout(fn, 1)
            }
            else {
                document.addEventListener("DOMContentLoaded", fn)
            }
        }

        domReady(function() {
            var myqr = document.getElementById('result')
            var lastResult, countResult = 0

            function onScanSuccess(decodeText, decodeResult) {
                if(decodeText !== lastResult) {
                    ++countResult;
                    lastResult = decodeText

                    alert('Votre qrcode est '+decodeText, decodeResult)

                    myqr.innerHTML = `Vous avez scané  ${countResult} : ${decodeText}`
                }


            }

            var htmlscanner = new Html5QrcodeScanner("qr_reader", {fps:10, qrbox:250})
            htmlscanner.render(onScanSuccess)
        })
    </script>
</body>
</html>  
