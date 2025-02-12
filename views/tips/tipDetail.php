<?php
require_once __DIR__ . '/../../app/tips/tipsController.php';
$tipsController = new TipsController();

// Obtiene el ID del tip desde la URL
$tipId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Obtiene la información del tip a partir del ID
$tip = $tipsController->listHelpById($tipId);

// Si no se encuentra el tip, redirigir a la página de inicio o mostrar un mensaje de error
if (!$tip) {
    echo "<h2>Tip no encontrado.</h2>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo htmlspecialchars($tip->getTitulo()); ?> - Padel Tips</title>
  <link rel="stylesheet" href="<?php echo base_url('css/index.css'); ?>">
  <link rel="icon" href="<?php echo base_url('images/raqueta-de-padel.png'); ?>">
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
      background-color: var(--black);
      color: #333;
    }

    .tip-container {
      max-width: 800px;
      margin: 0 auto;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      padding: 20px;
      background-color: var(--gray);
    }

    .tip-title {
      color: var(--yellow);
      text-align: center;
      font-size: 50px;
      font-weight: bold;
      margin-bottom: 60px;
    }

    .tip-image {
      width: 100%;
      height: auto;
      border-radius: 10px;
      margin-bottom: 40px;
    }

    .tip-description {
      color: var(--white);
      font-size: 18px;
      line-height: 1.6;
      margin-bottom: 60px;
    }

    .tip-video {
      text-align: center;
    }

    .back-link {
      display: block;
      text-align: center;
      margin-top: 20px;
      font-size: 18px;
      text-decoration: none;
      color: var(--yellow);
    }

    .back-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <div class="tip-container">
    <!-- Título del tip -->
    <div class="tip-title"><?php echo htmlspecialchars($tip->getTitulo()); ?></div>

    <!-- Imagen del tip -->
    <img src="<?php echo base_url('images/'.$tip->getImagen()); ?>" alt="<?php echo htmlspecialchars($tip->getTitulo()); ?>" class="tip-image">

    <!-- Descripción del tip -->
    <div class="tip-description">
      <?php echo $tip->getDescripcion(); ?>
    </div>

    <!-- Video de YouTube -->
    <div class="tip-video">
      <?php
        // Extraer el ID del video de YouTube del enlace proporcionado
        // $youtubeLink = $tip->getEnlace();
        $youtubeLink = $tip->getEnlace();
        preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^\&\?\/]+)/', $youtubeLink, $matches);
        $youtubeId = $matches[1] ?? '';

        if ($youtubeId):
      ?>
        <iframe width="100%" height="400" src="https://www.youtube.com/embed/<?php echo $youtubeId; ?>" 
                frameborder="0" allowfullscreen></iframe>
      <?php else: ?>
        <p>No hay video disponible para este tip.</p>
      <?php endif; ?>
    </div>

    <!-- Enlace para volver atrás -->
    <a href="javascript:history.back()" class="back-link">← Volver a la lista de Tips</a>
  </div>

</body>
</html>
