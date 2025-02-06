<?php
session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Padel Page - Login</title>
    <link rel="stylesheet" href="<?php echo base_url('css/auth.css'); ?>">
    <link rel="icon" href="<?php echo base_url('images/raqueta-de-padel.png'); ?>">
</head>
<body class="form-body">
    <main class="main-container">
        <section class="form-container">
            <h1>Login</h1>
            <span>Bienvenido de nuevo</span>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-error">
                    <?php echo $_SESSION['error']; ?>
                </div>
                <?php unset($_SESSION['error']);  ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <?php echo $_SESSION['success']; ?>
                </div>
                <?php unset($_SESSION['success']);?>
            <?php endif; ?>

            <form class="login-form" action="<?php echo base_url('app/auth/loginController.php'); ?>" method="post">
                <label for="email">
                    Email
                    <input type="email" name="email" id="email" placeholder="Correo electrónico">
                </label>

                <label for="password">
                    Password
                    <input type="password" name="password" id="password" placeholder="****">
                </label>

                <input type="submit" value="Enviar">
            </form>
            <a href="<?php echo base_url('register'); ?>">Si aún no estás registrado, regístrate</a>
        </section>
    </main>
</body>
</html>