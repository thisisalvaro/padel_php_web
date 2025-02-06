<?php
require_once './config/config.php';

// obtenemos la url actual
$page = isset($_GET['page']) ? $_GET['page'] : trim($_SERVER['REQUEST_URI'], '/');

// si el usuario ingresa solo "localhost/padel/", mostrar login
if ($page == '' || $page == 'index.php') {
    render_view('auth/login'); 
    exit;
}

$action = isset($_GET['action']) ? $_GET['action'] : 'index';

try {
    switch ($page) {
        case 'reservations/make':
            render_view('reservations/makeReservation');
            break;
        
        case 'reservations/view':
            render_view('reservations/viewReservations');
            break;

        case 'tips':
            render_view('tips/tipsList');
            break;

        case 'ecommerce':
            render_view('ecommerce/productList'); // enviar filtros por método GET
            break;

        case 'ecommerce/product':
            render_view('ecommerce/productDetail'); // enviar el id del producto
            break;
        
        case 'ecommerce/cart':
            render_view('ecommerce/cart');
            break;

        case 'register':
            render_view('auth/register');
            break;

        default:
            render_view('auth/login'); // vista por defecto
            break;
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}