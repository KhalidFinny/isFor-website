<?php

// Start session if needed
session_start();

// Autoload classes using Composer (if you use Composer)
// require '../vendor/autoload.php';

// Include the necessary files if not using Composer
require_once __DIR__ . '/../app/controllers/RegisterController.php';
require_once __DIR__ . '/../app/controllers/LoginController.php';

// Simple routing logic
$page = $_GET['page'] ?? 'register';  // Default page is 'register'

// Route the request to the appropriate controller
switch ($page) {
    case 'register':
        $controller = new \app\controllers\RegisterController();
        $controller->register();
        break;

    case 'login':
        $controller = new \app\controllers\LoginController();
        $controller->login();
        break;

    case 'dashboard':
        require_once __DIR__ . '/../app/views/dashboard.php';
        break;

//    default:
//        $controller = new \app\controllers\LoginController();
//        $controller->login();
//        break;
}
