<?php
// habilitar errores (solo durante el desarrollo)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// cargar configuración local si existe
define('BASE_URL', 'http://localhost/padel/');

// otras constantes
define('CONTROLLER_PATH', __DIR__.'/../app/');
define('VIEW_PATH', __DIR__ . '/../views/');

// conexión a la base de datos
require_once 'db.php';

// función para cargar vistas fácilmente
function render_view($view, $data = []) {
    extract($data); // convertir las claves del array $data en variables
    include VIEW_PATH . $view . '.php';
}

function redirect($url) {
    header("Location: " . BASE_URL . $url);
    exit();
}

// función para obtener la URL base
function base_url($path = '') {
    return BASE_URL . ltrim($path, '/');
}

// HELPERS
// función para obtener el método HTTP actual
function request_method() {
    return $_SERVER['REQUEST_METHOD'];
}

// función para verificar si la solicitud es de tipo POST
function is_post() {
    return request_method() === 'POST';
}

// función para verificar si la solicitud es de tipo GET
function is_get() {
    return request_method() === 'GET';
}