<?php

class DashboardUser extends Controller{
    public function index(){
        $this->checkLogin();
        $role = $this->checkRole();
        $this->checkSessionTimeOut();
        if($role == 2){
            $this->saveLastVisitedPage();
            $data['user'] = $this->model('UsersModel')->getUserByUsername($_SESSION['username']);
            $data['letter'] = $this->model('LettersModel')->getLetterByUserIdLimit($_SESSION['user_id']);
            $data['pending'] = $this->model('LettersModel')->countPendingStat($_SESSION['user_id']);
            $data['verify'] = $this->model('LettersModel')->countVerifyStat($_SESSION['user_id']);
            $data['reject'] = $this->model('LettersModel')->countRejectStat($_SESSION['user_id']);
            $this->view('user/userDashboard', $data);
        }else{
            header('Location: ' . $this->getLastVisitedPage());
        }
    }
}