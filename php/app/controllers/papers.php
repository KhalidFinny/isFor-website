<?php

class Papers extends Controller{
    public function index(){
        
    }

    public function addPaperView(){
        $this->checkLogin();
        $role = $this->checkRole();
        $this->checkSessionTimeOut();
        if($role == 2){
            $this->saveLastVisitedPage();
            $this->view('user/submitLetter');
        }else{
            header('Location: ' . $this->getLastVisitedPage());
        }
    }

    public function verifyPaperview(){
        $this->checkLogin();
        $role = $this->checkRole();
        $this->checkSessionTimeOut();
        if($role == 1){
            $this->saveLastVisitedPage();
            $this->view('admin/verifyLetters');
        }else{
            header('Location: ' . $this->getLastVisitedPage());
        }
    }
}