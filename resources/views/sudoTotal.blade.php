<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados</title>
</head>
<body>
    <h1>Resultados de las Operaciones</h1>


    <h2>Monto Agregado al Fondo General:</h2>
    <p>{{ $monto_fondo_general }}</p>
    <h2>Subir Monto al Fondo General:</h2>
    <form action="{{ route('guardar-monto') }}" method="POST">
    	@csrf
	    <label for="monto">Monto:</label>
	    <input type="number" id="monto" name="monto" required>
	    <button type="submit">Guardar</button>
	</form>

</body>
</html>

