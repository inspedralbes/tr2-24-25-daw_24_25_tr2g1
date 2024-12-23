<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmació de Classe</title>
</head>
<body>
    <div>
        <h2>Confirmació de reserva de classe</h2>
        <p>Hola {{ $nomEstudiants }},</p>
        <p>La teva reserva de classe ha estat confirmada:</p>
        <ul>
            <li>Classe: {{ $classDetalles->titol }}</li>
            {{-- <li>Mentor: {{ $mentorNom }}</li> --}}
            <li>Data: {{ $classDetalles->data_publicacio }}</li>
            <li>Horari: {{ $classDetalles->hora_inici }}h - {{ $classDetalles->hora_final }}h</li>
        </ul>
        <p>Gràcies per utilitzar AlumNet!</p>
    </div>
</body>
</html>
