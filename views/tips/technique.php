<?php
require_once __DIR__ .'/../../app/tips/tipsController.php';
$tipsController = new TipsController();
$result = $tipsController->listHelpsByCategoriesId(1);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Técnica - Padel Tips</title>
  <link rel="stylesheet" href="<?php echo base_url('css/tips.css'); ?>">
  <link rel="icon" href="<?php echo base_url('images/raqueta-de-padel.png'); ?>">
  <style>
    /* Estilos para mostrar en filas de tres columnas */
    .row {
      display: flex;
      justify-content: space-around;
      margin-bottom: 20px;
    }
    .producto {
      flex: 0 0 calc(33.333% - 10px); /* Cada producto ocupa 1/3 del ancho, con un pequeño margen */
      box-sizing: border-box;
      text-align: center;
      margin: 5px;
    }
    .producto img {
      width: 100%;
      height: auto;
      object-fit: cover;
    }
  </style>
</head>
<body>
  <h2>Lista de Tips</h2>
  <?php
    // Divide el array $result en fragmentos de 3 elementos cada uno.
    $chunks = array_chunk($result, 3);
    foreach ($chunks as $chunk) {
        echo "<div class='row'>";
        foreach ($chunk as $producto) {
            echo "<div class='producto'>";
            echo "<a href='tipDetails.php?id=" . $producto->getId() . "'>";
            echo "<img src='".base_url('images/raqueta-de-padel.png')."' alt='" . $producto->getTitulo() . "'>";

            echo "<p>" . $producto->getTitulo() . "</p>";
            echo "</a>";
            echo "</div>";
        }
        echo "</div>";
    }
  ?>
</body>
</html>
