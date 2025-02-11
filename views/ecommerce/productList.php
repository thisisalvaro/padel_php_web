<?php
// vista (html) para mostrar todos los productos disponibles, incluyendo opciones de filtrado por categoría y precio
session_start();
require_once '../../app/ecommerce/productController.php';
require_once '../../config/config.php';
$productController = new ListProductController();

// Capturar filtros
$search = $_GET['search'] ?? '';
$categoria = $_GET['categoria'] ?? '';
$minPrice = $_GET['minPrice'] ?? '';
$maxPrice = $_GET['maxPrice'] ?? '';

// Obtener productos filtrados
$productos = $productController->listProduct($search, $categoria, $minPrice, $maxPrice);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('css/ecommerce.css') . '?v=' . time(); ?>">
    <title>Product List</title>
</head>
<body>
    <header>
        <h1>Product List</h1>
        <div class="cart-home-icons">
            <a href=""><img src="../../images/home-icon-32.png"></a>
            <a href=""><img src="../../images/shopping-cart-icon-32.png"></a>
        </div>
    </header>
    <!-- Barra de búsqueda y filtros -->
    <section class="filter-bar">
        <form method="GET">
            <input type="text" name="search" placeholder="Buscar producto..." value="<?= htmlspecialchars($search) ?>">

            <select name="categoria">
                <option value="">Todas las categorías</option>
                <option value="palas" <?= $categoria == 'palas' ? 'selected' : '' ?>>Pala</option>
                <option value="zapatillas" <?= $categoria == 'zapatillas' ? 'selected' : '' ?>>Zapatillas</option>
                <option value="bolsos" <?= $categoria == 'bolsos' ? 'selected' : '' ?>>Bolsos</option>
                <option value="accesorios" <?= $categoria == 'accesorios' ? 'selected' : '' ?>>Accesorios</option>
            </select>

            <input type="number" name="minPrice" placeholder="Precio mínimo (€)" value="<?= htmlspecialchars($minPrice) ?>">
            <input type="number" name="maxPrice" placeholder="Precio máximo (€)" value="<?= htmlspecialchars($maxPrice) ?>">

            <button type="submit">Filtrar</button>
        </form>
    </section>

    <main>
    <?php if (empty($productos)): ?>
        <p class="no-results">No se encontraron productos.</p>
    <?php else: ?>
        <div class="product-grid">
            <?php foreach ($productos as $producto): ?>
                <div class="product-card">
                    <div class="image-slider" onmouseenter="showArrows(this)" onmouseleave="hideArrows(this)">
                        <?php if (!empty($producto['imagenes'])): ?>
                            <?php foreach ($producto['imagenes'] as $index => $imagen): ?>
                                <img class="slide" src="<?= $imagen ?>" alt="Imagen de <?= $producto['nombre'] ?>" <?= $index === 0 ? 'style="display:block;"' : 'style="display:none;"' ?>>
                            <?php endforeach; ?>
                            <button class="prev" onclick="prevSlide(this)">&#10094;</button>
                            <button class="next" onclick="nextSlide(this)">&#10095;</button>
                        <?php else: ?>
                            <img src="ruta/default.jpg" alt="Imagen no disponible">
                        <?php endif; ?>
                    </div>
                    <h2><?= $producto['nombre'] ?></h2>
                    <p><?= $producto['descripcion'] ?></p>
                    <p class="price">€<?= number_format($producto['precio'], 2) ?></p>
                    <a href="<?php echo base_url('app/ecommerce/addCart.php')."?id=".$producto['id'] ?>" class="buy-btn">Comprar</a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    </main>

</body>

<script>
    function nextSlide(button) {
        let slider = button.parentElement;
        let slides = slider.getElementsByClassName("slide");
        let currentIndex = [...slides].findIndex(img => img.style.display === "block");

        slides[currentIndex].style.display = "none";
        let nextIndex = (currentIndex + 1) % slides.length;
        slides[nextIndex].style.display = "block";
    }

    function prevSlide(button) {
        let slider = button.parentElement;
        let slides = slider.getElementsByClassName("slide");
        let currentIndex = [...slides].findIndex(img => img.style.display === "block");

    slides[currentIndex].style.display = "none";
    let prevIndex = (currentIndex - 1 + slides.length) % slides.length;
    slides[prevIndex].style.display = "block";
}

</script>
</html>
