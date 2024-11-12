<?php

class addUser extends Controller{
    public function index(){
        $this->checkLogin();
        $role = $this->checkRole();
        $this->checkSessionTimeOut();
        if($role == 1){
            $this->saveLastVisitedPage();
            $this->view('admin/addUser');
        }else{
            header('Location: ' . $this->getLastVisitedPage());
        }
    }

    public function register(){
        if ($_POST['confirm_password'] == $_POST['password']) {
            if ($this->model('User_Model')->addUser($_POST) > 0) {
                header('Location: ' . BASEURL . '/addUser');
                echo "tambah data berhasil";
            }
        }else{
            echo 
            '<script/>
                alert("password salah mohon coba lagi");
            </script>';
        }
    }
}