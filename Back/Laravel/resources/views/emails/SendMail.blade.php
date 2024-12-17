<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Benvingut a AlumNet</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            color: #333;
            border-radius: 10px;
        }

        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #444;
            color: #ffffff;
            text-align: center;
            padding: 20px;
            font-size: 24px;
            font-weight: bold;
        }

        .content {
            padding: 20px;
            text-align: center;
        }

        .content h1 {
            font-size: 28px;
            margin-bottom: 10px;
            color: #333;
        }

        .content p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 20px;
            color: #555;
        }

        .footer {
            background-color: #e0e0e0;
            padding: 15px;
            text-align: center;
            font-size: 14px;
            color: #777;
        }

        .cta-button {
            display: inline-block;
            background-color: #333;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 20px;
            transition: background-color 1s ease, color 0.3s ease;
        }

        .cta-button:hover {
            background-color: lightgray;
            color: black;
        }


        a {
            color: #333;
            text-decoration: none;
        }

        a:hover {
            color: #555;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            Benvingut a AlumNet
        </div>
        <div class="content">
            <h1>Hola {{ $userName }}</h1>
            <p>Ens alegra tenir-te a la nostra comunitat! Has completat el registre correctament.</p>
            <p>AlumNet és la xarxa educativa perfecta per connectar amb altres estudiants i recursos acadèmics. Aquí
                podràs trobar oportunitats per aprendre, compartir i créixer.</p>
            <a href="https://alumnet.example.com" class="cta-button">Comença ara</a>
        </div>
        <div class="footer">
            © 2024 AlumNet. Tots els drets reservats. Si tens algun dubte, no dubtis a <a
                href="mailto:support@alumnet.com">contactar-nos</a>.
        </div>
    </div>
</body>

</html>
