<?php
require_once '../config/config.php'; 

// obtenemos la ruta desde la URL
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

try {
    echo $page;
    switch ($page) {
        case 'auth':
            $controller = new AuthController();
            if ($action === 'login') {
                $controller->login();
            } elseif ($action === 'register') {
                $controller->register();
            } else {
                throw new Exception('Acción no válida.');
            }
            break;

        case 'reservations':
            $controller = new ReservationController();
            if ($action === 'make') {
                $controller->makeReservation();
            } elseif ($action === 'view') {
                $controller->viewReservations();
            } else {
                throw new Exception('Acción no válida.');
            }
            break;

        case 'tips':
            $controller = new TipsController();
            $controller->showTips(); 
            break;

        case 'ecommerce':
            $controller = new ProductController();
            if ($action === 'list') {
                $controller->listProducts();
            } elseif ($action === 'cart') {
                $controller->viewCart();
            } else {
                throw new Exception('Acción no válida.');
            }
            break;

        default:
            renderView('index'); // vista por defecto
            break;
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}

