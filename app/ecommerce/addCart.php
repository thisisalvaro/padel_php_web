<?php
session_start();
require_once 'productController.php';
require_once '../../config/config.php';
$productController = new ListProductController();

// Verificar si el cart ya existe en la sesión, si no, crearlo
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Verificar si el producto a agregar está presente en la URL
if (isset($_GET['id'])) {
    $producto_id = $_GET['id'];

    // Aquí puedes obtener los detalles del producto de la base de datos o de una estructura de datos previamente cargada
    // Asumiremos que tienes un array de productos que contiene los detalles de cada uno.
    // Por ejemplo, $productos es un array que contiene todos los productos.
    $producto = $productController->listProductById($producto_id); // Implementa esta función para obtener el producto.

    if ($producto) {
        // Verificar si el producto ya está en el cart
        if (isset($_SESSION['cart'][$producto_id])) {
            $_SESSION['cart'][$producto_id]['cantidad'] += 1;
        } else {
            $_SESSION['cart'][$producto_id] = [
                'id' => $producto['id'],
                'nombre' => $producto['nombre'],
                'precio' => $producto['precio'],
                'cantidad' => 1
            ];
        }
    }
}

// Redirigir de nuevo a la página de productos o al cart
header('Location: /padel/ecommerce');
exit();
