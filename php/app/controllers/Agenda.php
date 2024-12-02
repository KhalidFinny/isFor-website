<?php 

class Agenda extends Controller{
    public function index(){
        $this->checkLogin();
        $role = $this->checkRole();
        $this->checkSessionTimeOut();
        if($role == 1){
            $this->saveLastVisitedPage();
            $this->view('admin/manage-agenda');
        }else{
            header('Location: ' . $this->getLastVisitedPage());
        }
    }
}