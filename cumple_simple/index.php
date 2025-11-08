<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contador de Cumpleaños</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Bienvenido al Contador de Cumpleaños</h1>
        <form method="post" action="cumple.php">
            <label for="nombre">Introduce tu nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
            <label for="fecha">Selecciona tu fecha de cumpleaños:</label>
            <input type="date" id="fecha" name="fecha" required>
            <input type="submit" value="Calcular">
        </form>
    </div>
</body>
</html>