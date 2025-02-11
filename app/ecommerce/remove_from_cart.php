<?php
session_start();
require_once __DIR__ .'/../../config/db.php';
require_once __DIR__ . '/../../app/ecommerce/CartController.php';

if (!isset($_SESSION['user_id'])) {
    echo "Debes iniciar sesión.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $userId = $_SESSION['user_id'];
    $productId = $_POST['product_id'];

    $cartController = new CartController();
    $cartController->removeProduct($productId, $userId);
}

header("Location: cart.php"); // Redirigir de nuevo al carrito
exit;
?>
