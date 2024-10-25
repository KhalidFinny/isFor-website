<?php

namespace app\controllers;

use app\services\LoginService;

require_once __DIR__ . '/../services/LoginService.php';
require_once __DIR__ . '/../configurations/Connection.php';

class LoginController
{
    private ?\mysqli $db;
    private LoginService $loginService;

    public function __construct()
    {
        $database = new \app\configurations\Connection();
        $this->db = $database->getConnection();
        $this->loginService = new \app\services\LoginService($this->db);
    }

    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->loginService->login($username, $password);
            if ($user) {
                session_start();
                session_regenerate_id(true);
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['username'];
                header('Location: ../views/dashboard.php');
            } else {
                require_once __DIR__ . '/../views/error.php';
            }
        } else {
            require_once __DIR__ . '/../views/login.php';
        }
    }
}
