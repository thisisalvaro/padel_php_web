<?php
require_once __DIR__ . '/../../app/tips/tipsController.php';
$tipsController = new TipsController();
$result = $tipsController->listHelpsByCategoriesId(1);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Técnica - Padel Tips</title>
  <link rel="stylesheet" href="<?php echo base_url('css/index.css'); ?>">
  <link rel="icon" href="<?php echo base_url('images/raqueta-de-padel.png'); ?>">
  <style>
    body {
      background-color: var(--black);
      font-family: Arial, sans-serif;
      margin: 20px;
    }
    
    h2 {
      text-align: center;
      color: var(--white);
      font-size: 65px;
      margin: 35px;
      margin-bottom: 50px;
    }

    .container {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between; /* Cambiado de center a space-between */
      gap: 20px;
      margin: 10px;
    }

    .tip-card {
      width: calc(33.333% - 20px); 
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      text-align: center;
      transition: transform 0.2s, box-shadow 0.2s;
      box-sizing: border-box; 
    }

    .tip-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }

    .tip-card img {
      width: 100%;
      height: 200px;
      object-fit: cover;
    }

    .tip-title {
      padding: 15px;
      font-size: 18px;
      font-weight: bold;
      color: #333;
    }

    a {
      text-decoration: none;
      color: inherit;
    }
  </style>
</head>
<body>
  <h2>Lista de Tips</h2>
  <div class="container">
    <?php foreach ($result as $producto): ?>
      <div class="tip-card">
        <a href="tipDetails.php?id=<?php echo $producto->getId(); ?>">
          <img src="<?php echo base_url('images/raqueta-de-padel.png'); ?>" alt="<?php echo $producto->getTitulo(); ?>">
          <div class="tip-title"><?php echo $producto->getTitulo(); ?></div>
        </a>
      </div>
    <?php endforeach; ?>
  </div>
</body>
</html>
