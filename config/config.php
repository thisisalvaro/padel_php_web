<?
// habilitar errores (solo durante el desarrollo)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// constantes para las rutas
define('BASE_URL', 'http://localhost:8000/public');
define('CONTROLLER_PATH', __DIR__.'/../app/');
define('VIEW_PATH', __DIR__ . '/../views/');
define('PUBLIC_PATH', BASE_URL . 'public/');

// conexión a la base de datos
require_once 'db.php';

// cargar automaticamente controladores y modelos
spl_autoload_register(function ($className) {
    $paths = [
        CONTROLLER_PATH . 'auth/',
        CONTROLLER_PATH . 'reservations/',
        CONTROLLER_PATH . 'tips/',
        CONTROLLER_PATH . 'ecommerce/',
        CONTROLLER_PATH . 'models/',
    ];

    foreach ($paths as $path) {
        $file = $path . $className . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// función para cargar vistas fácilmente
function renderView($view, $data = []) {
    extract($data); // convertir las claves del array $data en variables
    include VIEW_PATH . $view . '.php';
}

function redirect($url) {
    header("Location: " . BASE_URL . "/$url");
    exit();
}

// Función para obtener la URL base
function base_url($path = '') {
    return BASE_URL . '/' . ltrim($path, '/');
}

// Función para cargar un controlador
function loadController($controllerName, $action = 'index', $params = []) {
    $controllerClass = ucfirst($controllerName) . 'Controller';
    if (class_exists($controllerClass)) {
        $controller = new $controllerClass();
        if (method_exists($controller, $action)) {
            call_user_func_array([$controller, $action], $params);
        } else {
            throw new Exception("La acción '$action' no existe en el controlador '$controllerClass'.");
        }
    } else {
        throw new Exception("El controlador '$controllerClass' no existe.");
    }
}

// Función para cargar un modelo
function loadModel($modelName) {
    $modelClass = ucfirst($modelName) . 'Model';
    if (class_exists($modelClass)) {
        return new $modelClass();
    } else {
        throw new Exception("El modelo '$modelClass' no existe.");
    }
}

// Función para obtener la ruta actual
function current_url() {
    return BASE_URL . $_SERVER['REQUEST_URI'];
}

// Función para obtener el método HTTP actual
function request_method() {
    return $_SERVER['REQUEST_METHOD'];
}

// Función para verificar si la solicitud es de tipo POST
function is_post() {
    return request_method() === 'POST';
}

// Función para verificar si la solicitud es de tipo GET
function is_get() {
    return request_method() === 'GET';
}