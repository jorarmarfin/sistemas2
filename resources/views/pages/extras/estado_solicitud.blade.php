<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado de Matricula</title>
</head>
<body>
    <div class="wrapper">
        <h4>¡Hola {{$texto->nombres.' '.$texto->primer_apellido.' '.$texto->segundo_apellido}}!</h4>
        <p>Actualmente su matricula se encuentra <strong> {{ $texto->estado }} </strong> </p>
        <p>
            {{ $texto->comentario }}
        </p>
    </div>
</body>
</html>