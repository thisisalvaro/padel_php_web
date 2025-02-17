<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Aplicación</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body>
    <?php if (!in_array($view, ['auth/login', 'auth/register'])): ?>
        <nav>
            <ul>
                <li><a href="<?= base_url('reservations/make') ?>">Reservar</a></li>
                <li><a href="<?= base_url('reservations/view') ?>">Mis Reservas</a></li>
                <li><a href="<?= base_url('tips') ?>">Consejos</a></li>
                <li><a href="<?= base_url('ecommerce') ?>">Tienda</a></li>
                <li><a href="<?= base_url('ecommerce/cart') ?>">Carrito</a></li>
                <li><a href="<?= base_url('auth/logout') ?>">Cerrar sesión</a></li>
            </ul>
        </nav>
    <?php endif; ?>

    <main>
        <?php include $content; ?>
    </main>
</body>
</html>
