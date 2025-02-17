<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Aplicación</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Geist:wght@100..900&display=swap">
    <style>
        :root {
            --black: #1F1F21;
            --white: #F3F3F3;
            --yellow: #FED700;
            --dark-gray: #353638;
            --gray: #50545D;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Geist', sans-serif;
            color: var(--white);
        }

        body {
            background-color: var(--black);
        }

        /* Burbuja flotante */
        .nav-bubble {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 80px;
            height: 80px;
            background: var(--yellow);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .nav-bubble:hover {
            transform: scale(1.1);
        }

        .nav-bubble img {
            width: 30px;
            height: 30px;
        }

        /* Menú oculto */
        .nav-menu {
            position: fixed;
            bottom: 90px;
            right: 20px;
            background: var(--dark-gray);
            border-radius: 10px;
            padding: 10px 0;
            width: 200px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            display: none;
            flex-direction: column;
        }

        .nav-menu a {
            text-decoration: none;
            display: block;
            padding: 12px 20px;
            transition: background 0.2s;
            color: var(--white);
        }

        .nav-menu a:hover {
            background: var(--gray);
        }

        /* Mostrar el menú cuando está activo */
        .nav-menu.active {
            display: flex;
        }
    </style>
</head>
<body>
    <?php if (!in_array($view, ['auth/login', 'auth/register'])): ?>
        <!-- Burbuja flotante -->
        <div class="nav-bubble" onclick="toggleMenu()">
            <img src="<?= base_url('images/menu.svg') ?>" alt="Menu">
        </div>

        <!-- Menú oculto -->
        <div class="nav-menu" id="navMenu">
            <a href="<?= base_url('reservations/make') ?>">Reservar</a>
            <a href="<?= base_url('reservations/view') ?>">Mis Reservas</a>
            <a href="<?= base_url('tips') ?>">Consejos</a>
            <a href="<?= base_url('ecommerce') ?>">Tienda</a>
            <a href="<?= base_url('ecommerce/cart') ?>">Carrito</a>
            <a href="<?= base_url('auth/logout') ?>">Cerrar sesión</a>
        </div>
    <?php endif; ?>

    <main>
        <?php include $content; ?>
    </main>

    <script>
        function toggleMenu() {
            document.getElementById('navMenu').classList.toggle('active');
        }

        // Cerrar menú si se hace clic fuera de él
        document.addEventListener('click', function(event) {
            let menu = document.getElementById('navMenu');
            let bubble = document.querySelector('.nav-bubble');

            if (!menu.contains(event.target) && !bubble.contains(event.target)) {
                menu.classList.remove('active');
            }
        });
    </script>
</body>
</html>
