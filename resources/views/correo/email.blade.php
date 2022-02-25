<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Se te asigno un nuevo ticket {{ $registro->name }}</title>
</head>
<body>
    <p>Se ha registrado un nuevo ticket el dia: {{$registro->fecha_envio }}.</p>
    <p>Estos son los datos del ticket:</p>
    <ul>
        <li>Nombre del quien te lo asigno: {{ $registro->solicitante }}</li>
        <li>Descripción: {{ $registro->descripcion }}</li>
    </ul>
</body>
</html>