<?php
// obtengo la fecha de cumpleaños del formulario
$fecha_cumple_input = $_POST['fecha'];
// Obtengo el nombre del formulario
$nombre = $_POST['nombre'];

// convierto la fecha a un objeto DateTime
$fecha_cumple = new DateTime($fecha_cumple_input);
$fecha_hoy = new DateTime();
$edad = $fecha_hoy->diff($fecha_cumple);
$ha_nacido = $fecha_cumple < $fecha_hoy;

// Calcular el próximo cumpleaños
$proximo_cumple = new DateTime($fecha_hoy->format('Y') . '-' . $fecha_cumple->format('m') . '-' . $fecha_cumple->format('d'));

// Si ya pasó este año, sumar 1 año
if ($proximo_cumple < $fecha_hoy) {
    $proximo_cumple->modify('+1 year');
}

// Calcular la diferencia
$diferencia = $fecha_hoy->diff($proximo_cumple);

// Obtener timestamp para JavaScript
$timestamp_proximo = $proximo_cumple->getTimestamp() * 1000;
$timestamp_cumple = $fecha_cumple->getTimestamp() * 1000;
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Edad</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Bienvenido, <?php echo $nombre. ' un placer verte por aquí'; ?>!</h1>
        <?php if ($nombre == "Paula"): ?>
            <button id="btnMensaje" onclick="mostrarMensaje()">💌 Mensaje especial para ti</button>
            <div class="mensaje-paula" id="mensajePaula" style="display: none;">
                <h2>¡Hola querida Paula!</h2>
                <p>¡Eres el amor de mi vida!</p>
                <p> Te dedico este mensaje con esta combinación de colores que tanto te gusta amarillo y azul.</p>
                <p>Me alegra mucho verte por aquí, solo decirte que eres increible y eres con total diferencia lo mejor que me ha pasado en la vida, por favor no cambies nunca. </p>
                <p>Siempre estaré aquí para apoyarte en lo que necesites.</p>
                <p>Un besazo enorme de tu chico (el creador de la web) que te adora.</p>
            </div>
        <?php endif; ?>

    
    <?php if ($ha_nacido): ?>
        <p id="edadTexto">
            Has nacido hace 
            <span id="edad-anos"><?php echo $edad->y; ?></span> años, 
            <span id="edad-meses"><?php echo $edad->m; ?></span> meses, 
            <span id="edad-dias"><?php echo $edad->d; ?></span> días,
            <span id="edad-horas"><?php echo $edad->h; ?></span> horas,
            <span id="edad-minutos"><?php echo $edad->i; ?></span> minutos y
            <span id="edad-segundos"><?php echo $edad->s; ?></span> segundos.
        </p>
    <?php else: ?>
        <p id="edadTexto">Aún no has nacido. Faltan 
            <span id="edad-anos"><?php echo $edad->y; ?></span> años, 
            <span id="edad-meses"><?php echo $edad->m; ?></span> meses, 
            <span id="edad-dias"><?php echo $edad->d; ?></span> días,
            <span id="edad-horas"><?php echo $edad->h; ?></span> horas,
            <span id="edad-minutos"><?php echo $edad->i; ?></span> minutos y
            <span id="edad-segundos"><?php echo $edad->s; ?></span> segundos.
        </p>
    <?php endif; ?>

    <h1>Cuenta regresiva</h1>
    <p>Tu próximo cumpleaños: <?php echo $proximo_cumple->format('d/m/Y'); ?></p>
    
    <div id="contador">
        <div>
            <span id="dias"><?php echo $diferencia->days; ?></span> días
        </div>
        <div>
            <span id="horas"><?php echo $diferencia->h; ?></span> horas
        </div>
        <div>
            <span id="minutos"><?php echo $diferencia->i; ?></span> minutos
        </div>
        <div>
            <span id="segundos"><?php echo $diferencia->s; ?></span> segundos
        </div>
    </div>
    <br>
    <a href="index.php">Calcular otra fecha</a>
    
    <script>
        // Pasar datos de PHP a JavaScript
        const proximoCumple = <?php echo $timestamp_proximo; ?>;
        const fechaCumple = <?php echo $timestamp_cumple; ?>;
        const haNacido = <?php echo $ha_nacido ? 'true' : 'false'; ?>;
    </script>
    <script src="actualizador.js"></script>
    </div>
</body>
</html>

