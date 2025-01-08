<!DOCTYPE html>
<html>
<head>
    <title>Confirmació de Classe</title>
</head>
<body>
    <h2>Confirmació de Classe</h2>

    <div>
        <p><strong>Títol de la classe:</strong> {{ $classDetalles['titol'] }}</p>
        <p><strong>Data:</strong> {{ $classDetalles['data_publicacio'] }}</p>
        <p><strong>Hora inici:</strong> {{ $classDetalles['hora_inici'] }}</p>
        <p><strong>Hora final:</strong> {{ $classDetalles['hora_final'] }}</p>
    </div>

    <p>Gràcies per registrar-te a la classe!</p>
</body>
</html>
