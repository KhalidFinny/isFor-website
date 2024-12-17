<?php
//
//namespace app\helpers;
//
//class SessionHelper
//{
//    private const BASE_URL = '/isFor-website/php/public/index.php';
//    private const SESSION_TIMEOUT = 3600;
//    private const SESSION_WARNING = 3300;
//
//    public static function initSession(): void
//    {
//        if (session_status() == PHP_SESSION_NONE) {
//            session_start();
//        }
//    }
//
//    public static function redirectIfNotLoggedInOrNotAdmin(int $requiredRoleId): void
//    {
//        self::initSession();
//        if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] !== $requiredRoleId) {
//            header("Location: " . self::BASE_URL . "?page=login");
//            exit();
//        }
//    }
//
//    public static function redirectIfLoggedIn(): void
//    {
//        self::initSession();
//        if (isset($_SESSION['user_id'])) {
//            // Redirect berdasarkan role_id
//            if ($_SESSION['role_id'] == 1) {
//                header("Location: " . self::BASE_URL . "?page=admin_dashboard");
//            } elseif ($_SESSION['role_id'] == 2) {
//                header("Location: " . self::BASE_URL . "?page=user_dashboard");
//            }
//            exit();
//        }
//    }
//
//    public static function checkSessionTimeout(): void
//    {
//        if (isset($_SESSION['LAST_ACTIVITY'])) {
//            $timeInactive = time() - $_SESSION['LAST_ACTIVITY'];
//            if ($timeInactive > self::SESSION_TIMEOUT) {
//                session_unset();
//                session_destroy();
//                header("Location: " . self::BASE_URL . "?page=login");
//                exit();
//            } elseif ($timeInactive > self::SESSION_WARNING) {
//                echo "<script>alert('Sesi Anda akan segera berakhir, silakan perbarui.');</script>";
//            }
//        }
//        $_SESSION['LAST_ACTIVITY'] = time();
//    }
//
//    public static function logout(): void
//    {
//        self::initSession();
//        session_unset();
//        session_destroy();
//        header("Location: " . self::BASE_URL . "?page=login");
//        exit();
//    }
//
//}