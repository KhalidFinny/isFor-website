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

    public function addAgenda(){
        if ($this->model('AgendaModel')->addAgenda($_POST) > 0) {
            header('Location: ' . BASEURL . '/agenda');
            echo "tambah data berhasil";
        } else {
            echo
            '<script/>
                    alert("tambah data gagal");
                </script>';
        }
    }

    public function getAgendaById(){
        echo json_encode($this->model('AgendaModel')->getAgendaById($_POST['agenda_id']));
    }

    public function editAgenda(){
        if ($this->model('AgendaModel')->editAgenda($_POST) > 0) {
            header('Location: ' . BASEURL . '/agenda');
            echo "ubah data berhasil";
        } else {
            echo
            '<script/>
                    alert("ubah data gagal");
                </script>';
        }
    }

    public function deleteAgenda($id){
        if ($this->model('AgendaModel')->deleteAgenda($id) > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal menghapus agenda']);
        }
        exit();
    }
}