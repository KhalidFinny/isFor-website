<?php

//membuat method untuk memanggil view dan model
class Controller{
    public function view($view, $data = []){
        require_once '../app/views/' . $view . '.php';
    }

    public function model($model){
        require_once '../app/models/' . $model . '.php';
        return new $model;
    }

    public function middleware(){
        require_once '../app/helpers/Middleware.php';
        $middleware = new Middleware;
        return $middleware;
    }

    public function checkLogin(){
        if(!$this->middleware()->isLoggedIn()){
            header('Location: ' . BASEURL . '/login');
        }
    }

    public function checkRole(){
        return $this->middleware()->checkRole();
    }

    public function saveLastVisitedPage(){
        return $this->middleware()->saveLastVisitedPage();
    }
    
    public function getLastVisitedPage(){
        return $this->middleware()->getLastVisitedPage();
    }

    public function checkSessionTimeOut(){
        return $this->middleware()->checkSessionTimeOut();
    }
}