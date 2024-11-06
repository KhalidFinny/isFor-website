<?php

namespace app\controllers;

use app\services\LoginService;

require_once __DIR__ . '/../services/LoginService.php';
require_once __DIR__ . '/../configs/Connection.php';

class LoginController
{
    private ?\mysqli $db;
    private LoginService $loginService;

    public function __construct()
    {
        $database = new \app\configs\Connection();
        $this->db = $database->getConnection();
        $this->loginService = new \app\services\LoginService($this->db);
    }

    // app/controllers/LoginController.php

    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->loginService->login($username, $password);
            if ($user) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }

                session_regenerate_id(true);
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['role_id'] = $user['role_id'];
                $_SESSION['username'] = $user['username'];

                // Redirect based on role
                if ($user['role_id'] == 1) {
                    header('Location: /isFor-website/php/public/index.php?page=admin_dashboard');
                    exit(); // Tambahkan exit() di sini
                } elseif ($user['role_id'] == 2) {
                    header('Location: /isFor-website/php/public/index.php?page=user_dashboard');
                    exit();
                }

            } else {
                require_once __DIR__ . '/../views/error.php';
            }
        } else {
            require_once __DIR__ . '/../views/login.php';
        }
    }
}