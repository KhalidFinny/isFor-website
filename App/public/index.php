<?php 
require_once './vendor/autoload.php'; // Ensure this is correct
require_once '../core/router.php'; // Adjust the path if necessary

$router = new Router();

// Define your routes here
$router->add('login', function () {
    require_once '../../App/views/auth/loginpage.php';
});

$router->add('admin/dashboard', function () {
    require_once '../../App/views/admin/admindashboard.php';
});

// Dispatch the route
$router->dispatch($_SERVER['REQUEST_URI']);
?>

