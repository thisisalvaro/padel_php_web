<?php
session_start();
class RegisterController {
    public function index() {
        renderView('auth/register');
    }

    public function register() {
        require_once '../../config/db.php';
        require_once '../../config/config.php';

        if (is_post()) {
            $name = $_POST['name'] ?? '';
            $lastname = $_POST['lastname'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            // validar que todos los campos estén llenos
            if (empty($name) || empty($lastname) || empty($email) || empty($password)) {
                $_SESSION['register_error'] = "Todos los campos son obligatorios.";
                header('Location: ' . base_url('/register'));
            }

            // hash de la contraseña usando bcrypt
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);

            // obtener la conexión a la base de datos
            $db = Database::getConnection();

            // insertar el nuevo usuario en la base de datos
            $query = "INSERT INTO users (name, last_name, email, password) VALUES ('$name', '$lastname', '$email', '$passwordHash')";
            $result = pg_query($db, $query);

            if ($result) {
                header('Location: ' . base_url('/'));
            } else {
                $_SESSION['register_error'] = "Error al registrar el usuario: " . pg_last_error($db);
                header('Location: ' . base_url('/register'));
            }
        } else {
            $this->index();
        }
    }
}

$registerController = new RegisterController();
$registerController->register();