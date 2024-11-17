<?php
session_start();
require_once __DIR__ . '/../core/database.php';
require_once __DIR__ . '/../models/UserModel.php';
use Core\Database;

class AuthController {
    private $db;
    private $userModel;

    public function __construct() {
        $this->db = new Database();
        $this->userModel = new UserModel($this->db);
    }

    public function login($username, $password) {
        try {
            $user = $this->userModel->getUserByUsername($username);

            if ($user && password_verify($password, $user['password'])) {
                // Set session variables
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['avatar'] = $user['avatar'] ?? './isfor-web/App/public/assets/images/coding-image.png';

                // Redirect based on role
                if ($user['role'] === 'admin') {
                    header('Location: /isfor-web/App/views/main/admindashboard.php');
                    exit();
                }
                header('Location: /isfor-web/dashboard');
                exit();
            }
            $_SESSION['error'] = 'Invalid username or password';
            header('Location: /isfor-web/App/views/auth/loginpage.php');
            exit();
        } catch (PDOException $e) {
            $_SESSION['error'] = 'Database error: ' . $e->getMessage();
            header('Location: /isfor-web/App/views/auth/loginpage.php');
            exit();
        }
    }

    public function logout() {
        session_destroy();
        header('Location: /isfor-web/login');
        exit();
    }

    public function isAuthenticated() {
        return isset($_SESSION['user_id']);
    }

    public function isAdmin() {
        return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $auth = new AuthController();
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'login':
                $auth->login($_POST['username'], $_POST['password']);
                break;
            case 'logout':
                $auth->logout();
                break;
        }
    }
}