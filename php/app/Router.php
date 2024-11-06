<?php

namespace app;

use app\controllers\RegisterController;
use app\controllers\LoginController;
use app\helpers\SessionHelper;

class Router
{
    public function route(string $page): void
    {
        SessionHelper::initSession();
        SessionHelper::checkSessionTimeout();

        switch ($page) {
            case 'register':
                SessionHelper::redirectIfNotLoggedInOrNotAdmin(1);
                $controller = new RegisterController();
                $controller->register();
                break;

            case 'login':
                SessionHelper::redirectIfLoggedIn();
                $controller = new LoginController();
                $controller->login();
                break;

            case 'logout':
                SessionHelper::logout();
                break;

            case 'admin_dashboard':
                SessionHelper::redirectIfNotLoggedInOrNotAdmin(1);
                $controller = new RegisterController();
                $controller->listUsers(); // Panggil listUsers untuk mengirim data ke tampilan
                break;

            case 'add_user':
                SessionHelper::redirectIfNotLoggedInOrNotAdmin(1);
                $controller = new RegisterController();
                $controller->showAddUserForm(); // Menampilkan form add user
                break;

            case 'process_add_user':
                SessionHelper::redirectIfNotLoggedInOrNotAdmin(1);
                $controller = new RegisterController();
                $controller->register(); // Memanggil fungsi register untuk menambahkan user baru
                break;


            case 'user_dashboard':
                SessionHelper::redirectIfNotLoggedInOrNotAdmin(2);
                require_once __DIR__ . '/views/user_dashboard.php';
                break;

            case 'edit_user':
                SessionHelper::redirectIfNotLoggedInOrNotAdmin(1);
                $controller = new RegisterController();
                $controller->editUser();
                break;

            case 'update_user':
                SessionHelper::redirectIfNotLoggedInOrNotAdmin(1);
                $controller = new RegisterController();
                $controller->updateUser();
                break;

            case 'delete_user':
                SessionHelper::redirectIfNotLoggedInOrNotAdmin(1);
                $controller = new RegisterController();
                $controller->deleteUser();
                break;

            default:
                header('HTTP/1.0 404 Not Found');
                require_once __DIR__ . '/views/error.php';
                break;
        }
    }
}