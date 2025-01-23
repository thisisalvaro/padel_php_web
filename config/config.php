<?
// habilitar errores (solo durante el desarrollo)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// constantes para las rutas
define('BASE_URL', 'http://localhost/public');
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