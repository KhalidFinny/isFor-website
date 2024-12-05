<?php 

class Agenda extends Controller{
    public function index(){
        $this->checkLogin();
        $role = $this->checkRole();
        $this->checkSessionTimeOut();
        if($role == 1){
            $this->saveLastVisitedPage();
            $data['agenda'] = $this->model('AgendaModel')->getAllAgenda();
            $data['no'] =  1;
            $this->view('admin/manage-agenda', $data);
        }else{
            header('Location: ' . $this->getLastVisitedPage());
        }
    }
    
}