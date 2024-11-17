<?php

class Middleware{
    private const SESSION_TIMEOUT = 3600;

    function isLoggedIn() {
        session_start();
        return isset($_SESSION['user_id']);
    }

    function checkRole() {
        if(isset($_SESSION['role_id'])){
            return $_SESSION['role_id'];
        }else{
            return 0;
        }
    }

    public function saveLastVisitedPage() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        return $_SESSION['last_visited'] = $_SERVER['REQUEST_URI'];
    }

    public function getLastVisitedPage() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        return isset($_SESSION['last_visited']) ? $_SESSION['last_visited'] : BASEURL . '/home';
    }

    public static function checkSessionTimeout()
    {
        if (isset($_SESSION['LAST_ACTIVITY'])) {
            $timeInactive = time() - $_SESSION['LAST_ACTIVITY'];
            if ($timeInactive > self::SESSION_TIMEOUT) {
                session_unset();
                session_destroy();
                header("Location: " . BASEURL . "/home");
                exit();
            }
        }
        $_SESSION['LAST_ACTIVITY'] = time();
    }
}