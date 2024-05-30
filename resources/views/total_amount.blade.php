<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total del Fondo General</title>
</head>
<body>
    <h1>Total del Fondo General</h1>
    @if(isset($totalAmount))
        <p>El monto total del Fondo General es: {{ $totalAmount }}</p>
    @else
        <p>No se encontró ningún registro de FondoGeneral</p>
    @endif
</body>
</html>

