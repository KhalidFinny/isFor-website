<?php
require_once '../Controller/UserController.php';

$page = $_GET['page'] ?? 'register';

$userController = new \Controller\UserController();

switch ($page) {
    case 'login':
        $userController->login();
        break;
    case 'dashboard':
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?page=login");
            exit();
        }
        require_once './landingPage.php';
        break;
    case 'logout':
        session_start();
        session_destroy();
        header("Location: index.php?page=login");
        break;
    default:
        $userController->register();
        break;
}
