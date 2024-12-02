<?php

class DashboardAdmin extends Controller{
    public function index(){
        $this->checkLogin();
        $role = $this->checkRole();
        $this->checkSessionTimeOut();
        if($role == 1){
            $this->saveLastVisitedPage();
            $data['no'] = 1;
            $data['user'] = $this->model('UsersModel')->getUserByUsername($_SESSION['username']);
            $data['allUser'] = $this->model('UsersModel')->getUser();
            $data['pending'] = $this->model('LettersModel')->countPending();
            $data['verify'] = $this->model('LettersModel')->countVerify();
            $this->view('admin/adminDashboard', $data);
        }else{
            header('Location: ' . $this->getLastVisitedPage());
        }
    }
}