<?php
session_start();

if (!isset($_SESSION['user']['id'])) {
    echo "Por favor, inicie sesión para ver su carrito.";
    exit;
}

$cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total = 0;

foreach ($cartItems as $item) {
    $total += $item['precio'] * $item['cantidad'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="<?php echo base_url('css/cart.css') . '?v=' . time(); ?>">
</head>
<body>
    <h1>🛒 Tu Carrito de Compras</h1>

    <div class="cart-container">
        <?php if (!empty($cartItems)): ?>
            <div class="product-grid">
                <?php foreach ($cartItems as $item): ?>
                    <div class="product-card">
                        <div class="product-info">
                            <h3><?php echo htmlspecialchars($item['nombre']); ?></h3>
                            <p>Cantidad: <?php echo $item['cantidad']; ?></p>
                            <p>Precio: <?php echo number_format($item['precio'], 2); ?> €</p>
                            <p>Total: <?php echo number_format($item['precio'] * $item['cantidad'], 2); ?> €</p>
                        </div>
                        <div class="product-actions">
                            <form action="add_to_cart.php" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                                <button type="submit">➕ Añadir otro</button>
                            </form>
                            <form action="remove_from_cart.php" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                                <button type="submit">❌ Eliminar</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="total">
                <h2>Total: <?php echo number_format($total, 2); ?> €</h2>
            </div>

            <button class="checkout-button" onclick="window.location.href='checkout.php'">
                🛍 Finalizar Compra
            </button>

        <?php else: ?>
            <div class="empty-cart">
                <p>Tu carrito está vacío. <a href="index.php">Seguir comprando</a></p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
