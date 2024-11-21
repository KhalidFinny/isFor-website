<?php

class DashboardUser extends Controller{
    public function index(){
        $this->checkLogin();
        $role = $this->checkRole();
        $this->checkSessionTimeOut();
        if($role == 2){
            $this->saveLastVisitedPage();
            $data['user'] = $this->model('UsersModel')->getUserByUsername($_SESSION['username']);
            $this->view('user/userDashboard', $data);
        }else{
            header('Location: ' . $this->getLastVisitedPage());
        }
    }
}