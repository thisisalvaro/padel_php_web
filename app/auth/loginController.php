<?php
require_once '../../config/config.php';

class LoginController  {
    // método para mostrar la vista de login
    public function index() {
        renderView('auth/login');
    }

    // método para procesar el formulario de login
    public function login() {
        // require_once '../../config/db.php';

        if (is_post()) {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            Database::login($email, $password);
            
            // // simulación de autenticación
            // if ($email === 'usuario@example.com' && $password === 'password123') {
            //     redirect('reservations/make');
            // } else {
            //     renderView('auth/login', ['error' => 'Credenciales incorrectas.']);
            // }
        } else {
            $this->index();
        }
    }
}

$login = new LoginController();
$login->login();