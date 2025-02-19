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

<!DOCTYPE html<?php
session_start();
require_once __DIR__ . '/../../app/ecommerce/CartController.php';

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
    <meta charset="UTF-<?php
session_start();
require_once __DIR__ . '/../../app/ecommerce/CartController.php';

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
    <link rel="stylesheet" href="cart.css">
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
                            <form action="remove_from_cart.php" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $item['producto_id']; ?>">
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
<?php
session_start();
require_once __DIR__ . '/../../app/ecommerce/CartController.php';

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
    <link rel="stylesheet" href="cart.css">
</head>
<body>
    <h1>🛒 Tu Carrito de Compras</h1>

    <div class="cart-container">
        <?php if (!empty($cartItems)): ?>
            <div class="product-grid">
                <?php foreach ($cartItems as $item): ?>
                    <div class="product-card">
                        <div class="product-info">
                            <img src="<?php echo htmlspecialchars($item['imagen']); ?>" alt="<?php echo htmlspecialchars($item['nombre']); ?>" class="product-image">
                            <h3><?php echo htmlspecialchars($item['nombre']); ?></h3>
                            <p>Cantidad: <?php echo $item['cantidad']; ?></p>
                            <p>Precio: <?php echo number_format($item['precio'], 2); ?> €</p>
                            <p>Total: <?php echo number_format($item['precio'] * $item['cantidad'], 2); ?> €</p>
                        </div>
                        <div class="product-actions">
                            <form action="add_to_cart.php" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $item['producto_id']; ?>">
                                <button type="submit">➕ Añadir otro</button>
                            </form>
                            <form action="remove_from_cart.php" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $item['producto_id']; ?>">
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
:root {
    --black: #1F1F21;
    --white: #F3F3F3;
    --yellow: #FED700;
    --gray: #50545D;
    --dark-gray: #353638;
}

body {
    font-family: Arial, sans-serif;
    background-color: var(--white);
    color: var(--black);
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

h1 {
    text-align: center;
    color: var(--black);
    margin-bottom: 40px;
}

.cart-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
}

.product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    width: 100%;
    margin-bottom: 30px;
}

.product-card {
    border: 1px solid var(--gray);
    border-radius: 8px;
    padding: 20px;
    background: var(--white);
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.product-info {
    font-size: 1.2em;
    margin-bottom: 15px;
}

.product-image {
    max-width: 100%;
    height: auto;
    margin-bottom: 15px;
}

.product-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

button {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    background-color: var(--yellow);
    color: var(--black);
    cursor: pointer;
    font-size: 1.1em;
}

button:hover {
    background-color: var(--dark-gray);
    color: var(--white);
}

.total {
    font-size: 1.5em;
    margin: 20px 0;
    text-align: center;
}

.checkout-button {
    font-size: 1.2em;
    padding: 15px 30px;
    background-color: var(--yellow);
    color: var(--black);
}

.checkout-button:hover {
    background-color: var(--dark-gray);
    color: var(--white);
}

.empty-cart {
    text-align: center;
    font-size: 1.2em;
}
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
    <link rel="stylesheet" href="cart.css">
</head>
<body>
    <h1>🛒 Tu Carrito de Compras</h1>

    <div class="cart-container">
        <?php if (!empty($cartItems)): ?>
            <div class="product-grid">
                <?php foreach ($cartItems as $item): ?>
                    <div class="product-card">
                        <div class="product-info">
                            <img src="<?php echo htmlspecialchars($item['imagen']); ?>" alt="<?php echo htmlspecialchars($item['nombre']); ?>" class="product-image">
                            <h3><?php echo htmlspecialchars($item['nombre']); ?></h3>
                            <p>Cantidad: <?php echo $item['cantidad']; ?></p>
                            <p>Precio: <?php echo number_format($item['precio'], 2); ?> €</p>
                            <p>Total: <?php echo number_format($item['precio'] * $item['cantidad'], 2); ?> €</p>
                        </div>
                        <div class="product-actions">
                            <form action="add_to_cart.php" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $item['producto_id']; ?>">
                                <button type="submit">➕ Añadir otro</button>
                            </form>
                            <form action="remove_from_cart.php" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $item['producto_id']; ?>">
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
:root {
    --black: #1F1F21;
    --white: #F3F3F3;
    --yellow: #FED700;
    --gray: #50545D;
    --dark-gray: #353638;
}

body {
    font-family: Arial, sans-serif;
    background-color: var(--white);
    color: var(--black);
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

h1 {
    text-align: center;
    color: var(--black);
    margin-bottom: 40px;
}

.cart-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
}

.product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    width: 100%;
    margin-bottom: 30px;
}

.product-card {
    border: 1px solid var(--gray);
    border-radius: 8px;
    padding: 20px;
    background: var(--white);
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.product-info {
    font-size: 1.2em;
    margin-bottom: 15px;
}

.product-image {
    max-width: 100%;
    height: auto;
    margin-bottom: 15px;
}

.product-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

button {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    background-color: var(--yellow);
    color: var(--black);
    cursor: pointer;
    font-size: 1.1em;
}

button:hover {
    background-color: var(--dark-gray);
    color: var(--white);
}

.total {
    font-size: 1.5em;
    margin: 20px 0;
    text-align: center;
}

.checkout-button {
    font-size: 1.2em;
    padding: 15px 30px;
    background-color: var(--yellow);
    color: var(--black);
}

.checkout-button:hover {
    background-color: var(--dark-gray);
    color: var(--white);
}

.empty-cart {
    text-align: center;
    font-size: 1.2em;
}
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
    <link rel="stylesheet" href="cart.css">
</head>
<body>
    <h1>🛒 Tu Carrito de Compras</h1>

    <div class="cart-container">
        <?php if (!empty($cartItems)): ?>
            <div class="product-grid">
                <?php foreach ($cartItems as $item): ?>
                    <div class="product-card">
                        <div class="product-info">
                            <img src="<?php echo htmlspecialchars($item['imagen']); ?>" alt="<?php echo htmlspecialchars($item['nombre']); ?>" class="product-image">
                            <h3><?php echo htmlspecialchars($item['nombre']); ?></h3>
                            <p>Cantidad: <?php echo $item['cantidad']; ?></p>
                            <p>Precio: <?php echo number_format($item['precio'], 2); ?> €</p>
                            <p>Total: <?php echo number_format($item['precio'] * $item['cantidad'], 2); ?> €</p>
                        </div>
                        <div class="product-actions">
                            <form action="add_to_cart.php" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $item['producto_id']; ?>">
                                <button type="submit">➕ Añadir otro</button>
                            </form>
                            <form action="remove_from_cart.php" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $item['producto_id']; ?>">
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
:root {
    --black: #1F1F21;
    --white: #F3F3F3;
    --yellow: #FED700;
    --gray: #50545D;
    --dark-gray: #353638;
}

body {
    font-family: Arial, sans-serif;
    background-color: var(--white);
    color: var(--black);
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

h1 {
    text-align: center;
    color: var(--black);
    margin-bottom: 40px;
}

.cart-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
}

.product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    width: 100%;
    margin-bottom: 30px;
}

.product-card {
    border: 1px solid var(--gray);
    border-radius: 8px;
    padding: 20px;
    background: var(--white);
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.product-info {
    font-size: 1.2em;
    margin-bottom: 15px;
}

.product-image {
    max-width: 100%;
    height: auto;
    margin-bottom: 15px;
}

.product-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

button {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    background-color: var(--yellow);
    color: var(--black);
    cursor: pointer;
    font-size: 1.1em;
}

button:hover {
    background-color: var(--dark-gray);
    color: var(--white);
}

.total {
    font-size: 1.5em;
    margin: 20px 0;
    text-align: center;
}

.checkout-button {
    font-size: 1.2em;
    padding: 15px 30px;
    background-color: var(--yellow);
    color: var(--black);
}

.checkout-button:hover {
    background-color: var(--dark-gray);
    color: var(--white);
}

.empty-cart {
    text-align: center;
    font-size: 1.2em;
}
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
    <link rel="stylesheet" href="cart.css">
</head>
<body>
    <h1>🛒 Tu Carrito de Compras</h1>

    <div class="cart-container">
        <?php if (!empty($cartItems)): ?>
            <div class="product-grid">
                <?php foreach ($cartItems as $item): ?>
                    <div class="product-card">
                        <div class="product-info">
                            <img src="<?php echo htmlspecialchars($item['imagen']); ?>" alt="<?php echo htmlspecialchars($item['nombre']); ?>" class="product-image">
                            <h3><?php echo htmlspecialchars($item['nombre']); ?></h3>
                            <p>Cantidad: <?php echo $item['cantidad']; ?></p>
                            <p>Precio: <?php echo number_format($item['precio'], 2); ?> €</p>
                            <p>Total: <?php echo number_format($item['precio'] * $item['cantidad'], 2); ?> €</p>
                        </div>
                        <div class="product-actions">
                            <form action="add_to_cart.php" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $item['producto_id']; ?>">
                                <button type="submit">➕ Añadir otro</button>
                            </form>
                            <form action="remove_from_cart.php" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $item['producto_id']; ?>">
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
:root {
    --black: #1F1F21;
    --white: #F3F3F3;
    --yellow: #FED700;
    --gray: #50545D;
    --dark-gray: #353638;
}

body {
    font-family: Arial, sans-serif;
    background-color: var(--white);
    color: var(--black);
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

h1 {
    text-align: center;
    color: var(--black);
    margin-bottom: 40px;
}

.cart-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
}

.product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    width: 100%;
    margin-bottom: 30px;
}

.product-card {
    border: 1px solid var(--gray);
    border-radius: 8px;
    padding: 20px;
    background: var(--white);
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.product-info {
    font-size: 1.2em;
    margin-bottom: 15px;
}

.product-image {
    max-width: 100%;
    height: auto;
    margin-bottom: 15px;
}

.product-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

button {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    background-color: var(--yellow);
    color: var(--black);
    cursor: pointer;
    font-size: 1.1em;
}

button:hover {
    background-color: var(--dark-gray);
    color: var(--white);
}

.total {
    font-size: 1.5em;
    margin: 20px 0;
    text-align: center;
}

.checkout-button {
    font-size: 1.2em;
    padding: 15px 30px;
    background-color: var(--yellow);
    color: var(--black);
}

.checkout-button:hover {
    background-color: var(--dark-gray);
    color: var(--white);
}

.empty-cart {
    text-align: center;
    font-size: 1.2em;
}
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
    <link rel="stylesheet" href="cart.css">
</head>
<body>
    <h1>🛒 Tu Carrito de Compras</h1>

    <div class="cart-container">
        <?php if (!empty($cartItems)): ?>
            <div class="product-grid">
                <?php foreach ($cartItems as $item): ?>
                    <div class="product-card">
                        <div class="product-info">
                            <img src="<?php echo htmlspecialchars($item['imagen']); ?>" alt="<?php echo htmlspecialchars($item['nombre']); ?>" class="product-image">
                            <h3><?php echo htmlspecialchars($item['nombre']); ?></h3>
                            <p>Cantidad: <?php echo $item['cantidad']; ?></p>
                            <p>Precio: <?php echo number_format($item['precio'], 2); ?> €</p>
                            <p>Total: <?php echo number_format($item['precio'] * $item['cantidad'], 2); ?> €</p>
                        </div>
                        <div class="product-actions">
                            <form action="add_to_cart.php" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $item['producto_id']; ?>">
                                <button type="submit">➕ Añadir otro</button>
                            </form>
                            <form action="remove_from_cart.php" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $item['producto_id']; ?>">
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
:root {
    --black: #1F1F21;
    --white: #F3F3F3;
    --yellow: #FED700;
    --gray: #50545D;
    --dark-gray: #353638;
}

body {
    font-family: Arial, sans-serif;
    background-color: var(--white);
    color: var(--black);
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

h1 {
    text-align: center;
    color: var(--black);
    margin-bottom: 40px;
}

.cart-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
}

.product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    width: 100%;
    margin-bottom: 30px;
}

.product-card {
    border: 1px solid var(--gray);
    border-radius: 8px;
    padding: 20px;
    background: var(--white);
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.product-info {
    font-size: 1.2em;
    margin-bottom: 15px;
}

.product-image {
    max-width: 100%;
    height: auto;
    margin-bottom: 15px;
}

.product-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

button {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    background-color: var(--yellow);
    color: var(--black);
    cursor: pointer;
    font-size: 1.1em;
}

button:hover {
    background-color: var(--dark-gray);
    color: var(--white);
}

.total {
    font-size: 1.5em;
    margin: 20px 0;
    text-align: center;
}

.checkout-button {
    font-size: 1.2em;
    padding: 15px 30px;
    background-color: var(--yellow);
    color: var(--black);
}

.checkout-button:hover {
    background-color: var(--dark-gray);
    color: var(--white);
}

.empty-cart {
    text-align: center;
    font-size: 1.2em;
}
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
    <link rel="stylesheet" href="cart.css">
</head>
<body>
    <h1>🛒 Tu Carrito de Compras</h1>

    <div class="cart-container">
        <?php if (!empty($cartItems)): ?>
            <div class="product-grid">
                <?php foreach ($cartItems as $item): ?>
                    <div class="product-card">
                        <div class="product-info">
                            <img src="<?php echo htmlspecialchars($item['imagen']); ?>" alt="<?php echo htmlspecialchars($item['nombre']); ?>" class="product-image">
                            <h3><?php echo htmlspecialchars($item['nombre']); ?></h3>
                            <p>Cantidad: <?php echo $item['cantidad']; ?></p>
                            <p>Precio: <?php echo number_format($item['precio'], 2); ?> €</p>
                            <p>Total: <?php echo number_format($item['precio'] * $item['cantidad'], 2); ?> €</p>
                        </div>
                        <div class="product-actions">
                            <form action="add_to_cart.php" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $item['producto_id']; ?>">
                                <button type="submit">➕ Añadir otro</button>
                            </form>
                            <form action="remove_from_cart.php" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $item['producto_id']; ?>">
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
:root {
    --black: #1F1F21;
    --white: #F3F3F3;
    --yellow: #FED700;
    --gray: #50545D;
    --dark-gray: #353638;
}

body {
    font-family: Arial, sans-serif;
    background-color: var(--white);
    color: var(--black);
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

h1 {
    text-align: center;
    color: var(--black);
    margin-bottom: 40px;
}

.cart-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
}

.product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    width: 100%;
    margin-bottom: 30px;
}

.product-card {
    border: 1px solid var(--gray);
    border-radius: 8px;
    padding: 20px;
    background: var(--white);
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.product-info {
    font-size: 1.2em;
    margin-bottom: 15px;
}

.product-image {
    max-width: 100%;
    height: auto;
    margin-bottom: 15px;
}

.product-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

button {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    background-color: var(--yellow);
    color: var(--black);
    cursor: pointer;
    font-size: 1.1em;
}

button:hover {
    background-color: var(--dark-gray);
    color: var(--white);
}

.total {
    font-size: 1.5em;
    margin: 20px 0;
    text-align: center;
}

.checkout-button {
    font-size: 1.2em;
    padding: 15px 30px;
    background-color: var(--yellow);
    color: var(--black);
}

.checkout-button:hover {
    background-color: var(--dark-gray);
    color: var(--white);
}

.empty-cart {
    text-align: center;
    font-size: 1.2em;
}
8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 40px;
        }

        .cart-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            width: 100%;
            margin-bottom: 30px;
        }

        .product-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            background: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .product-info {
            font-size: 1.2em;
            margin-bottom: 15px;
        }

        .product-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            font-size: 1.1em;
        }

        button:hover {
            background-color: #0056b3;
        }

        .total {
            font-size: 1.5em;
            margin: 20px 0;
            text-align: center;
        }

        .checkout-button {
            font-size: 1.2em;
            padding: 15px 30px;
            background-color: #28a745;
        }

        .empty-cart {
            text-align: center;
            font-size: 1.2em;
        }
    </style>
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
                            <form action="remove_from_cart.php" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $item['producto_id']; ?>">
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
body {
    font-family: Arial, sans-serif;
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

h1 {
    text-align: center;
    color: #333;
    margin-bottom: 40px;
}

.cart-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
}

.product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    width: 100%;
    margin-bottom: 30px;
}

.product-card {
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    background: #fff;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.product-info {
    font-size: 1.2em;
    margin-bottom: 15px;
}

.product-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

button {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    background-color: #007bff;
    color: white;
    cursor: pointer;
    font-size: 1.1em;
}

button:hover {
    background-color: #0056b3;
}

.total {
    font-size: 1.5em;
    margin: 20px 0;
    text-align: center;
}

.checkout-button {
    font-size: 1.2em;
    padding: 15px 30px;
    background-color: #28a745;
}

.empty-cart {
    text-align: center;
    font-size: 1.2em;
}
<?php
session_start();
require_once __DIR__ . '/../../app/ecommerce/CartController.php';

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
    <link rel="stylesheet" href="cart.css">
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
                            <form action="remove_from_cart.php" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $item['producto_id']; ?>">
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
>
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
