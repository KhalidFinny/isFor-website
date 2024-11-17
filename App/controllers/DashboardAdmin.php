<?php

class DashboardAdmin extends Controller
{
    public function index()
    {
        $this->checkLogin();
        $role = $this->checkRole();
        $this->checkSessionTimeOut();

        if ($role == 1) { // Role 1 adalah Admin
            $this->saveLastVisitedPage();
            echo "Redirecting to Astro admin page...";
            header('Location: http://localhost:4321/adminpage');
            exit;
        } else {
            header('Location: ' . $this->getLastVisitedPage());
            exit;
        }
    }
}
