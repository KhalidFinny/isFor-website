<?php

class DashboardAdmin extends Controller{
    public function index(){
        $this->checkLogin();
        $role = $this->checkRole();
        $this->checkSessionTimeOut();
        if($role == 1){
            $this->saveLastVisitedPage();
            $this->view('admin/admin_dashboard');
        }else{
            header('Location: ' . $this->getLastVisitedPage());
        }
    }
}