<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $subject }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        .email-container {
            max-width: 600px;
            margin: auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }



        .header img {
            max-width: 150px;
            margin-bottom: 10px;
        }

        .content {
            padding: 20px;
        }

        h2 {
            color: #ff7900;
        }

        .details {
            background-color: #f2f2f2;
            padding: 10px;
            border-radius: 5px;
        }

        .details li {
            margin: 5px 0;
            list-style-type: circle;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #666;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <img src="https://upload.wikimedia.org/wikipedia/commons/d/d7/Orange_small_logo.png"
                alt="{{ $title ?? 'Orange Digital Center' }}">
        </div>

        <div class="content">
            <p>Bonjour {{ $prenom }} {{ $nom }},</p>

            <p>{!! $body !!}</p>

            <h2>Détails de l'activité :</h2>
            <ul class="details">
                <li>Date : {{ $date }}</li>
                <li>Lieu : {{ $lieu }}</li>
            </ul>

            <p>Pour faciliter l'organisation et vérifier votre présence à l'événement, veuillez présenter ce code QR
                lors de votre arrivée.</p>

            <img src="{{ $image }}" alt="">

            <p>Veuillez garder ce message et le code QR, car il sera utilisé pour pointer votre présence à l'activité.
            </p>

            <p>Merci encore de votre participation !</p>
        </div>

        <div class="footer">
            <p>Orange Digital Center</p>
            <p>Ce message a été envoyé automatiquement, merci de ne pas répondre directement.</p>
        </div>
    </div>
</body>

</html>
