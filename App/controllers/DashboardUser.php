<?php

class DashboardUser extends Controller{
    public function index(){
        $this->checkLogin();
        $role = $this->checkRole();
        $this->checkSessionTimeOut();
        if($role == 2){
            $this->saveLastVisitedPage();
            $this->view('user/user_dashboard');
        }else{
            header('Location: ' . $this->getLastVisitedPage());
        }
    }
}