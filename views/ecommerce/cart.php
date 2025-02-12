<?php
session_start();
require_once __DIR__ . '/../../app/ecommerce/CartController.php';

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user']['id'])) {

    echo "Por favor, inicie sesión para ver su carrito.";
    exit;
}

$userId = $_SESSION['user']['id'];
$cartController = new CartController();
$total = $cartController->calcTotal($userId);

$cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="<?php echo base_url('css/cart.css'); ?>">
</head>
<body>
    <h1>🛒 Tu Carrito de Compras</h1>

    <?php if (!empty($cartItems)): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cartItems as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['nombre']); ?></td>
                        <td><?php echo $item['cantidad']; ?></td>
                        <td><?php echo number_format($item['precio'], 2); ?> €</td>
                        <td><?php echo number_format($item['precio'] * $item['cantidad'], 2); ?> €</td>
                        <td>
                            <form action="remove_from_cart.php" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $item['producto_id']; ?>">
                                <button type="submit">❌ Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Total: <?php echo number_format($total, 2); ?> €</h2>

        <button onclick="window.location.href='checkout.php'">🛍 Finalizar Compra</button>

    <?php else: ?>
        <p>Tu carrito está vacío. <a href="index.php">Seguir comprando</a></p>
    <?php endif; ?>

</body>
</html>
