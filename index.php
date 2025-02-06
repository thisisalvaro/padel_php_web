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
        case 'reservations/make':
            renderView('reservations/makeReservation');
            break;
        
        case 'reservations/view':
            renderView('reservations/viewReservations');
            break;

        case 'tips':
            renderView('tips/tipsList');
            break;

        case 'ecommerce':
            renderView('ecommerce/productList'); // enviar filtros por método GET
            break;

        case 'ecommerce/product':
            renderView('ecommerce/productDetail'); // enviar el id del producto
            break;
        
        case 'ecommerce/cart':
            renderView('ecommerce/cart');
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