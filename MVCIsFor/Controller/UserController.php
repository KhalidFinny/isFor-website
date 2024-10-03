<?php

namespace Controller;

use Config\Connection;
use Model\User;
use Service\UserService;

require_once '../Model/User.php';
require_once '../Service/UserService.php';
require_once '../Config/Connection.php';

class UserController
{
    private ?\mysqli $db;
    private UserService $user_model;

    public function __construct()
    {
        $database = new \Config\Connection();
        $this->db = $database->getConnection();
        $this->user_model = new \Service\UserService($this->db);  // Perbaiki ini
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
                $register_success = $this->user_model->register($username, $email, $password);
                if ($register_success) {
                    header('Location: ../View/login.php');
                } else {
                    require_once '../View/error_register.php';
                }
            } else {
                echo "Passwords do not match!";
            }
        } else {
            require_once '../View/register.php';
        }
    }

    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->user_model->login($username, $password);
            if ($user) {
                session_start();
                session_regenerate_id(true);
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['username'];
                header('Location: ../View/landingPage.php');
            } else {
                require_once '../View/error.php';
            }
        } else {
            require_once '../View/login.php';
        }
    }
}