<?php
// vista (html) para mostrar todos los productos disponibles, incluyendo opciones de filtrado por categoría y precio
require_once '../../app/ecommerce/productController.php';
require_once '../../config/config.php';
$productController = new ListProductController();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('css/ecommerce.css'); ?>">
    <title>Pruduct List</title>
</head>
<body>
    <header>
        <h1>Product List</h1>
    </header>

    <ul>
    <?php $productos = $productController->listProduct(); ?>
    <?php foreach ($productos as $producto): ?>
        <li><b>Nombre:</b> <?= $producto['nombre'] ?> </li>
        <li><b>Descripción:</b> <?= $producto['descripcion'] ?> </li>
        <li><b>Precio:</b> <?= $producto['precio'] ?> </li>
        <li><b>Categoría:</b> <?= $producto['categoria'] ?> </li>
        <li><b>Marca:</b> <?= $producto['marca'] ?> </li>
        <li><b>Stock:</b> <?= $producto['stock'] ?> </li>
        <li><b>Imágenes:</b> 
            <?php if (!empty($producto['imagenes'])): ?>
                <ul>
                    <?php foreach ($producto['imagenes'] as $imagen): ?>
                        <li><img src="<?= $imagen ?>" width="100" height="100"></li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <span>Sin imágenes.</span>
            <?php endif; ?>
        </li></li>
        <hr>
    <?php endforeach; ?>
</ul>
    

</body>
</html>