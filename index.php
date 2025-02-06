<?php
require_once './config/config.php';

// obtenemos la url actual
$page = isset($_GET['page']) ? $_GET['page'] : trim($_SERVER['REQUEST_URI'], '/');

// si el usuario ingresa solo "localhost/padel/", mostrar login
if ($page == '' || $page == 'index.php') {
    renderView('auth/login'); 
    exit;
}

$action = isset($_GET['action']) ? $_GET['action'] : 'index';

try {
    switch ($page) {
        case 'auth':
            loadController('auth', $action);
            break;

        case 'reservations':
            loadController('reservations', $action);
            break;

        case 'tips':
            loadController('tips', $action);
            break;

        case 'ecommerce':
            loadController('ecommerce', $action);
            break;

        case 'register':
            renderView('auth/register');
            break;

        default:
            renderView('auth/login'); // vista por defecto
            break;
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}