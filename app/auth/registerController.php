<?php
// controlador para manejar la lógica del registro
class RegisterController {
    public function index() {
        renderView('auth/register');
    }

    public function register() {
        // require_once '../../config/db.php';

        if (is_post()) {
            $name = $_POST['name'] ?? '';
            $lastname = $_POST['lastname'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            Database::register($name, $lastname, $email, $password);

            // make the logic of the registration in this method
            
        } else {
            $this->index();
        }
    }
}

$registerController = new RegisterController();
$registerController->register();