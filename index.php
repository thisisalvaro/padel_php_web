<?php
require_once './config/config.php';

// obtenemos la url actual
$page = isset($_GET['page']) ? $_GET['page'] : 'auth/login';

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

        case 'tips/tactic':
            render_view('tips/tactic');
            break;

        case 'tips/tipDetails':
            render_view('tips/tipDetails.php?id=' . $_GET['tip']);
            break;

        case 'tips/technique':
            render_view('tips/technique');
            break;

        case 'tips/tipDetail':
            render_view('tips/tipDetail');
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