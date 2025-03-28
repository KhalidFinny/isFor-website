<?php

class DashboardUser extends Controller
{
    public function index()
    {
        $this->checkLogin();
        $role = $this->checkRole();
        $this->checkSessionTimeOut();

        if ($role == 2) {
            $this->saveLastVisitedPage();
            $data['user'] = $this->model('UsersModel')->getUserByUsername($_SESSION['username']);

            // Ambil parameter page dari URL, default ke 1
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $limit = 4; // Jumlah surat per halaman
            $offset = ($page - 1) * $limit;

            // Hitung total surat
            $data['totalLetters'] = $this->model('LettersModel')->countLettersByUserId($_SESSION['user_id']);
            $data['totalPages']   = ceil($data['totalLetters'] / $limit);
            $data['currentPage']  = $page;
            $data['limit']        = $limit; // <-- tambahkan ini

            // Ambil surat sesuai limit & offset
            $data['letter'] = $this->model('LettersModel')->getLettersByUserIdPaginate($_SESSION['user_id'], $limit, $offset);

            // Statistik status
            $data['pending'] = $this->model('LettersModel')->countPendingStat($_SESSION['user_id']);
            $data['verify']  = $this->model('LettersModel')->countVerifyStat($_SESSION['user_id']);
            $data['reject']  = $this->model('LettersModel')->countRejectStat($_SESSION['user_id']);

            $this->view('user/userDashboard', $data);
        } else {
            header('Location: ' . $this->getLastVisitedPage());
        }
    }
}
