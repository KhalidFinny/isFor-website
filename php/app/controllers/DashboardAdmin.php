<?php

class DashboardAdmin extends Controller
{
    public function index()
    {
        $this->checkLogin();
        $role = $this->checkRole();
        $this->checkSessionTimeOut();
        if ($role == 1) {
            $this->saveLastVisitedPage();
            $data['no'] = 1;
            $data['user'] = $this->model('UsersModel')->getUserByUsername($_SESSION['username']);
            $data['pending'] = $this->model('LettersModel')->countPending();
            $data['pendingFiles'] = $this->model('ResearchOutputModel')->countPendingFiles();
            $data['verify'] = $this->model('LettersModel')->countVerify();
            $data['rejectedLetters'] = $this->model('LettersModel')->countRejectedLetters();
            $data['rejectedFiles'] = $this->model('ResearchOutputModel')->countRejectedFiles();
            $data['totalRejected'] = $data['rejectedLetters'] + $data['rejectedFiles'];
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Halaman saat ini, default 1
            $limit = 5; // Jumlah pengguna per halaman
            $data['limit'] = $limit;
            $offset = ($page - 1) * $limit; // Hitung offset untuk query
            $usersModel = $this->model('UsersModel');
            $data['allUsersWithPagination'] = $usersModel->getUsersWithPagination($limit, $offset); // Pengguna pada halaman ini
            $data['totalUsers'] = $usersModel->getTotalUsers(); // Total pengguna
            // Hitung jumlah halaman
            $data['currentPage'] = $page;
            $data['totalPages'] = ceil($data['totalUsers'] / $limit);
            $this->view('admin/adminDashboard', $data);
        } else {
            header('Location: ' . $this->getLastVisitedPage());
        }
    }
}
