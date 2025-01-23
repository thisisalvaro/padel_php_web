<?php

class LoginController {
    // método para mostrar la vista de login
    public function index() {
        renderView('auth/login');
    }

    // método para procesar el formulario de login
    public function login() {
        if (is_post()) {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                renderView('auth/login', ['error' => 'Por favor, completa todos los campos.']);
                return;
            }

            // simulación de autenticación
            if ($email === 'usuario@example.com' && $password === 'password123') {
                redirect('reservations/make');
            } else {
                renderView('auth/login', ['error' => 'Credenciales incorrectas.']);
            }
        } else {
            $this->index();
        }
    }
}