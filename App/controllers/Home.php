<?php

class Home extends Controller{

    // Fungsi untuk menginisialisasi user default
    private function initializeDefaultUser() {
        $userModel = $this->model('User_Model');
        
        // Cek apakah user sudah ada
        if (!$userModel->checkUserExists()) {
            // Jika belum ada, tambahkan user default
            $userModel->addDefaultUser();
        }
    }

    public function index(){
        $this->initializeDefaultUser();
        $this->view('main/home');
    }

}