<?php

namespace app\controllers;

use app\services\RegisterService;

require_once __DIR__ . '/../services/RegisterService.php';
require_once __DIR__ . '/../configurations/Connection.php';

class RegisterController
{
    private ?\mysqli $db;
    private RegisterService $registerService;

    public function __construct()
    {
        $database = new \app\configurations\Connection();
        $this->db = $database->getConnection();
        $this->registerService = new \app\services\RegisterService($this->db);
    }

    public function register(): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "Invalid email format!";
                return;
            }

            if ($password === $confirm_password) {
                $register_success = $this->registerService->register($username, $email, $password);
                if ($register_success) {
                    // Redirect to login after successful registration
                    header('Location: ../public/index.php?page=login');
                    exit();
                } else {
                    require_once __DIR__ . '/../views/error_register.php';
                }
            } else {
                echo "Passwords do not match!";
            }
        } else {
            require_once __DIR__ . '/../views/register.php';
        }
    }
}
