<?php

class Galleries extends Controller{
    public function index(){
        $this->view("main/galeri");
    }

    public function uploadImgView(){
        $this->checkLogin();
        $role = $this->checkRole();
        $this->checkSessionTimeOut();
        if($role == 2){
            $this->saveLastVisitedPage();
            $this->view('user/uploadImage');
        }else{
            header('Location: ' . $this->getLastVisitedPage());
        }
    }

    public function verifyImgview(){
        $this->checkLogin();
        $role = $this->checkRole();
        $this->checkSessionTimeOut();
        if($role == 1){
            $this->saveLastVisitedPage();
            $this->view('admin/verifyImages');
        }else{
            header('Location: ' . $this->getLastVisitedPage());
        }
    }

    public function imgHistoryView(){
        $this->checkLogin();
        $role = $this->checkRole();
        $this->checkSessionTimeOut();
        if($role == 2){
            $this->saveLastVisitedPage();
            $this->view('user/image-history');
        }else{
            header('Location: ' . $this->getLastVisitedPage());
        }
    }

    

    public function uploadImg(){
        $this->view('admin/upload-image');
    }
}