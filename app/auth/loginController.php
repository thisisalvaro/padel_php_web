<?php

class LoginController {
    // Método para mostrar la vista de login
    public function index() {
        // Renderizar la vista de login
        renderView('auth/login');
    }

    // Método para procesar el formulario de login
    public function login() {
        // Verificar si la solicitud es de tipo POST
        if (is_post()) {
            // Obtener los datos del formulario
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            // Validar los datos (aquí puedes agregar validaciones más complejas)
            if (empty($email) || empty($password)) {
                // Mostrar un mensaje de error si los campos están vacíos
                renderView('auth/login', ['error' => 'Por favor, completa todos los campos.']);
                return;
            }

            // Aquí iría la lógica para verificar las credenciales en la base de datos
            // Por ahora, simulamos una autenticación exitosa
            if ($email === 'usuario@example.com' && $password === 'password123') {
                // Redirigir al usuario a la página de inicio después del login
                redirect('reservations/make');
            } else {
                // Mostrar un mensaje de error si las credenciales son incorrectas
                renderView('auth/login', ['error' => 'Credenciales incorrectas.']);
            }
        } else {
            // Si no es una solicitud POST, mostrar la vista de login
            $this->index();
        }
    }
}