<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Codi de Recuperació</title>
    <style>
        h2 {
            color: black;
            text-align: center;
        }

        p {
            font-size: 16px;
            text-align: center;
            margin: 10px 0;
            color: black;
        }

        .container {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            text-align: center;
        }
        .code {
            font-size: 20px;
            font-weight: bold;
            color: #0056b3;
            margin: 20px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Codi de recuperació de contrasenya</h2>
        <p>El teu codi de recuperació és:</p>
        <div class="code">{{ $code }}</div>
    </div>
</body>

</html>
