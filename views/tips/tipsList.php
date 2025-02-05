<?php
// vista (html) para mostrar una lista de tips disponibles, incluyendo opciones para filtrar o buscar tips
require_once '../../config/config.php';

// $id = $_GET['tip']
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Padel Page - Tips</title>
    <link rel="stylesheet" href="<?php echo base_url('css/tips.css'); ?>">
    <link rel="icon" href="<?php echo base_url('images/raqueta-de-padel.png'); ?>">
</head>
<body>

    <div class="container">
        <h1>Ayudas Padel</h1>
        <div class="buttons">
            <button class="btn tecnica">TECNICA</button>
            <button class="btn tactica">TACTICA</button>
        </div>
    </div>

</body>
</html>