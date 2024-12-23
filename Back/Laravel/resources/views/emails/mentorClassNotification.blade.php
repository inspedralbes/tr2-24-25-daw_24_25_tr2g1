<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Inscripció</title>
</head>
<body>
    <div>
        <h2>Nova Inscripció a la Teva Classe</h2>
        <p>Hola</p>
        <p>Tens una nova inscripció a la teva classe:</p>
        <ul>
            <li>Classe: {{ $classDetalles->titol }}</li>
            <li>Data: {{ $classDetalles->data_publicacio }}</li>
            <li>Horari: {{ $classDetalles->hora_inici }}h - {{ $classDetalles->hora_final }}h</li>
        </ul>
        <p>Gràcies per utilitzar AlumNet!</p>
    </div>
</body>
</html>
