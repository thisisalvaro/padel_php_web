<?php
require_once '../config/config.php';

// obtener la ruta desde la URL
$page = isset($_GET['page']) ? $_GET['page'] : '';
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

        default:
            renderView('auth/login'); // vista por defecto
            break;
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}