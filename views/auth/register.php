<?php
// require_once '/config/config.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Padel Page - Registro</title>
    <link rel="stylesheet" href="<?php echo base_url('css/auth.css'); ?>">
    <link rel="icon" href="<?php echo base_url('images/raqueta-de-padel.png'); ?>">
</head>
<body class="form-body">
    <main class="main-container">
        <section class="form-container">
            <h1>Registro</h1>
            <span>Crea tu cuenta</span>
            <form class="login-form" action="<?php echo base_url('app/auth/registerController.php'); ?>" method="post">
                <?php if (isset($_SESSION['register_error'])): ?>
                    <div style="color: red;">
                        <?php 
                        echo $_SESSION['register_error']; 
                        unset($_SESSION['register_error']);
                        ?>
                    </div>
                <?php endif; ?>
                <label for="name">
                    Nombre
                    <input type="text" name="name" id="name" placeholder="Tu nombre">
                </label>

                <label for="lastname">
                    Apellido
                    <input type="text" name="lastname" id="lastname" placeholder="Tu apellido">
                </label>
                
                <label for="email">
                    Email
                    <input type="email" name="email" id="email" placeholder="Correo electrónico">
                </label>

                <label for="password">
                    Password
                    <input type="password" name="password" id="password" placeholder="****">
                </label>

                <input type="submit" value="Registrarse">
            </form>
            <a href="<?php echo base_url(''); ?>">¿Ya tienes cuenta? Inicia sesión</a>
        </section>
    </main>
</body>
</html>
