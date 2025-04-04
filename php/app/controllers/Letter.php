<?php

use Dompdf\Dompdf;
use Dompdf\Options;
use GuzzleHttp\Psr7\Query;
use Symfony\Component\VarDumper\VarDumper;

class Letter extends Controller
{
    public function index() {}

    public function addLetterView()
    {
        $this->checkLogin();
        $role = $this->checkRole();
        $this->checkSessionTimeOut();
        if ($role == 2) {
            $this->saveLastVisitedPage();
            $this->view('user/submitLetter');
        } else {
            header('Location: ' . $this->getLastVisitedPage());
        }
    }

    public function verifyLetterview()
    {
        $this->checkLogin();
        $role = $this->checkRole();
        $this->checkSessionTimeOut();

        if ($role == 1) {
            $this->saveLastVisitedPage();

            // Pagination setup
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $limit = 4;
            $offset = ($page - 1) * $limit;

            $lettersModel = $this->model('LettersModel');
            $data['allLetters'] = $lettersModel->getPendingLettersWithPagination($limit, $offset);
            $totalLetters = $lettersModel->getTotalPendingLetters();

            // Tambahkan nama pengguna ke setiap surat
            foreach ($data['allLetters'] as &$letter) {
                $letter['name'] = $lettersModel->getNameById($letter['user_id']);
            }

            // Hitung jumlah halaman
            $data['currentPage'] = $page;
            $data['totalPages'] = ceil($totalLetters / $limit);

            $this->view('admin/verifyLetters', $data);
        } else {
            header('Location: ' . $this->getLastVisitedPage());
        }
    }

    public function getLetter()
    {
        $id = $_POST['id'];
        $letter = $this->model('LettersModel')->getLetterById($id);

        $filePath = LETTER . '/pending/' . $letter['file_url'];

        echo json_encode($filePath);
    }

    public function createLetter($preview = false)
    {

        $researchTitle = $_POST["researchTitle"];
        $leadResearcher = $_POST["leadResearcher"];
        $researchScheme = $_POST["researchScheme"];
        $researchCenter = $_POST["researchCenter"];
        $researchTopic = $_POST["researchTopic"];
        $date = $this->tgl_indo(date('Y-m-d'));

        $options = new Options();
        $options->setIsRemoteEnabled(true);
        $options->setChroot(__DIR__);
        $dompdf = new Dompdf($options);

        $html = file_get_contents(ASSETS . "/components/Doc/styleSurat.html");
        $html = str_replace("{{ researchTitle }}", $researchTitle, $html);
        $html = str_replace("{{ leadResearcher }}", $leadResearcher, $html);
        $html = str_replace("{{ researchScheme }}", $researchScheme, $html);
        $html = str_replace("{{ researchCenter }}", $researchCenter, $html);
        $html = str_replace("{{ researchTopic }}", $researchTopic, $html);
        $html = str_replace("{{ tanggal }}", $date, $html);

        $title = "pengajuan_surat_" . $researchTitle . ".pdf";

        $dompdf->loadHtml($html);
        $dompdf->set_paper('A4', 'portrait');
        $dompdf->render();
        $dompdf->add_info("Title", $title);

        if ($preview) {
            $dompdf->stream($title);
            exit;
        } else {
            return $dompdf->output();
        }
        $dompdf->stream($title);
    }

    public function tgl_indo($tanggal)
    {
        $bulan = array(
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);

        return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
    }

    public function previewLetter()
    {
        $this->createLetter(true);
    }

    public function sendLetter()
    {
        $researchTitle = $_POST["researchTitle"];
        $pdf = $this->createLetter(false);

        // target direktori penyimpanan
        $targetDirectory = __DIR__ . '/../letters/pending/';

        if (!is_dir($targetDirectory)) {
            mkdir($targetDirectory, 0777, true); // Buat folder jika belum ada
        }

        $fileName = 'surat_pengajuan_' . $researchTitle . '.pdf';
        $filePath = $targetDirectory . $fileName;

        file_put_contents($filePath, $pdf);

        if ($this->model('LettersModel')->addLetter($_POST, $fileName) > 0) {
            header('Location: ' . BASEURL . '/dashboardUser');
            echo "tambah data berhasil";
        } else {
            echo "tambah data gagal";
        }
    }

    public function updateStatusLetter()
    {
        $id = $_POST['id'];
        $status = $_POST['status'];
        $comment = $_POST['comment'];

        $affectedRows = $this->model('LettersModel')->updateStatusLetter($id, $status, $comment);
        if ($affectedRows > 0) {
            // Ambil nama file berdasarkan ID
            $fileName = $this->model('LettersModel')->getLetterById($id);

            // Validasi fileName
            if (!$fileName) {
                echo json_encode(['success' => false, 'message' => 'File tidak ditemukan']);
                return;
            }

            // $pathUpdate = $this->changePathFile($status, $fileName);
            // if ($pathUpdate) {
            //     echo json_encode(['success' => true, 'message' => 'Status diperbarui dan file berhasil dipindahkan']);
            // } else {
            //     echo json_encode(['success' => false, 'message' => 'Gagal memindahkan file']);
            // }
            echo json_encode(['success' => true, 'message' => 'Status berhasil diperbarui']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Tidak ada perubahan status']);
        }
    }

    public function adminLetterHistoryView()
    {
        $this->checkLogin();
        $role = $this->checkRole();
        $this->checkSessionTimeOut();
        if ($role == 1) {
            $this->saveLastVisitedPage();
            $limit = 4;

            // Hitung jumlah total surat
            $totalLetters = $this->model('LettersModel')->countAllLetters();
            $totalPages = $totalLetters > 0 ? ceil($totalLetters / $limit) : 1;

            // Validasi currentPage
            $currentPage = (isset($_GET["halaman"]) && is_numeric($_GET["halaman"]) && $_GET["halaman"] > 0) ? (int)$_GET["halaman"] : 1;
            $currentPage = max(1, min($currentPage, $totalPages));
            $awalData = ($limit * $currentPage) - $limit;

            // Data untuk view
            $data['user_id'] = $_SESSION['user_id'];
            $data['totalPages'] = $totalPages;
            $data['currentPage'] = $currentPage;
            $data['totalLetters'] = $totalLetters; // Jumlah total surat
            $data['limit'] = $limit;
            $data['allLetters'] = $this->model('LettersModel')->getAllLettersPaginate($awalData, $limit);
            $this->view('admin/admin-letter-history', $data);
        } else {
            header('Location: ' . $this->getLastVisitedPage());
        }
    }

    public function filter()
    {
        session_start();
        $status = $_POST['status'];
        $userId = $_SESSION['user_id'];
        $halamanAktif = isset($_POST['halamanAktif']) && is_numeric($_POST['halamanAktif']) ? (int)$_POST['halamanAktif'] : 1;

        $jumlahDataperhalaman = 4;

        // Ambil jumlah total data sesuai status
        if ($status == 0) {
            $jumlahData = $this->model('LettersModel')->countAllLeterbyUserId($userId);
        } else {
            $jumlahData = $this->model('LettersModel')->countAllLettersByUserandStatus($userId, $status)['total'] ?? 0;
        }

        // Pastikan jumlahData adalah integer
        $jumlahData = (int)$jumlahData;
        $jumlahHalaman = $jumlahData > 0 ? ceil($jumlahData / $jumlahDataperhalaman) : 1;
        $halamanAktif = max(1, min($halamanAktif, $jumlahHalaman));
        $awalData = ($jumlahDataperhalaman * $halamanAktif) - $jumlahDataperhalaman;

        // Ambil data surat
        if ($status == 0) {
            $letters = $this->model('LettersModel')->getLetterByUserIdPaginate($userId, $awalData, $jumlahDataperhalaman);
        } else {
            $letters = $this->model('LettersModel')->getLetterByUserIdStatus($userId, $status, $awalData, $jumlahDataperhalaman);
        }

        // Pastikan letters adalah array
        $letters = $letters ?? [];

        // Kirim data ke frontend
        header('Content-Type: application/json');
        echo json_encode([
            'letters' => $letters,
            'totalLetters' => $jumlahData,
            'pagination' => [
                'jumlahHalaman' => $jumlahHalaman,
                'halamanAktif' => $halamanAktif
            ]
        ]);
        exit;
    }

    public function filterAdmin()
    {
        $this->checkLogin();
        $role = $this->checkRole();
        if ($role != 1) {
            echo json_encode(['error' => 'Akses ditolak. Hanya admin yang dapat mengakses.']);
            return;
        }

        $status = isset($_POST['status']) ? (int)$_POST['status'] : 0;
        $limit = 4;
        $currentPage = isset($_POST['halamanAktif']) && is_numeric($_POST['halamanAktif']) ? (int)$_POST['halamanAktif'] : 1;
        $offset = ($currentPage - 1) * $limit;

        $lettersModel = $this->model('LettersModel');

        if ($status == 0) {
            // Hitung semua surat tanpa memfilter status
            $totalItems = $lettersModel->countAllLetters();
        } else {
            // Hitung surat berdasarkan status saja
            $totalItems = $lettersModel->countAllLettersByStatus($status)['total'];
        }

        $totalPages = $totalItems > 0 ? ceil($totalItems / $limit) : 1;
        $currentPage = max(1, min($currentPage, $totalPages)); // Validasi halaman aktif
        $offset = ($currentPage - 1) * $limit; // Perbarui offset setelah validasi

        switch ($status) {
            case 0:
                // Ambil semua surat dengan paginasi
                $letters = $lettersModel->getAllLettersPaginate($offset, $limit);
                break;
            case 1:
            case 2:
            case 3:
                // Ambil surat berdasarkan status dengan paginasi
                $letters = $lettersModel->getLettersByStatus($status, $offset, $limit);
                break;
            default:
                echo json_encode(['error' => 'Invalid status']);
                return;
        }

        // Kirim data ke frontend
        echo json_encode([
            'letters' => $letters,
            'totalItems' => $totalItems,
            'pagination' => [
                'jumlahHalaman' => $totalPages,
                'halamanAktif' => $currentPage
            ]
        ]);
    }

    public function searchAdmin()
    {
        $this->checkLogin();
        $role = $this->checkRole();
        if ($role != 1) {
            echo json_encode(['error' => 'Akses ditolak. Hanya admin yang dapat mengakses.']);
            return;
        }

        $keyword = isset($_POST['keyword']) ? $_POST['keyword'] : '';
        $page = isset($_POST['page']) && is_numeric($_POST['page']) ? (int)$_POST['page'] : 1;
        $limit = 4;
        $offset = ($page - 1) * $limit;

        $lettersModel = $this->model('LettersModel');
        $results = $lettersModel->searchLetters($keyword, $limit, $offset);
        $totalLetters = $lettersModel->countSearchResults($keyword);
        $totalPages = $totalLetters > 0 ? ceil($totalLetters / $limit) : 1;
        $page = max(1, min($page, $totalPages)); // Validasi halaman

        echo json_encode([
            'results' => $results,
            'totalLetters' => $totalLetters,
            'totalPages' => $totalPages,
            'currentPage' => $page
        ]);
    }

    public function letterHistoryView()
    {
        $this->checkLogin();
        $role = $this->checkRole();
        $this->checkSessionTimeOut();
        if ($role == 2) {
            $this->saveLastVisitedPage();
            $limit = 4;
            $jumlahData = count($this->model('LettersModel')->getLetterByUserId($_SESSION['user_id']));
            $totalPages = ceil($jumlahData / $limit);
            $currentPage = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
            $awalData = ($limit * $currentPage) - $limit;

            $data['user_id'] = $_SESSION['user_id'];
            $data['totalPages'] = $totalPages;
            $data['currentPage'] = $currentPage;
            $data['letters'] = $jumlahData;
            $data['limit'] = $limit;
            $data['allLetters'] = $this->model('LettersModel')->getLetterByUserIdPaginate($_SESSION['user_id'], $awalData, $limit);
            $this->view('user/letter-history', $data);
        } else {
            header('Location: ' . $this->getLastVisitedPage());
        }
    }

    public function searchUser(){

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Validasi sesi
        if (!isset($_SESSION['user_id'])) {
            header('Content-Type: application/json');
            http_response_code(401);
            echo json_encode(['error' => 'User tidak terautentikasi.']);
            exit;
        }

        if (isset($_POST['keyword'])) {
            $keyword = trim($_POST['keyword']);
            $page = isset($_POST['page']) && is_numeric($_POST['page']) ? (int)$_POST['page'] : 1;
            $itemsPerPage = 4;
            $offset = ($page - 1) * $itemsPerPage;

            $userId = $_SESSION['user_id'];
            $researchOutputModel = $this->model('LettersModel');

            try {
                $results = $researchOutputModel->searchLettersUser($keyword, $userId, $itemsPerPage, $offset);
                $totalResults = $researchOutputModel->countUserSearchResults($keyword, $userId);
                $totalPages = $totalResults > 0 ? ceil($totalResults / $itemsPerPage) : 1;
                $page = max(1, min($page, $totalPages));

                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode([
                    'results' => $results ?? [],
                    'totalLetters' => $totalResults ?? 0, // Tambahkan totalLetters
                    'totalPages' => $totalPages,
                    'currentPage' => $page
                ]);
            } catch (Exception $e) {
                error_log("Error in searchUser function: " . $e->getMessage());
                error_log("Trace: " . $e->getTraceAsString());

                header('Content-Type: application/json');
                http_response_code(500);
                echo json_encode(['error' => 'Terjadi kesalahan di server: ' . $e->getMessage()]);
            }
        } else {
            header('Content-Type: application/json');
            http_response_code(400);
            echo json_encode(['error' => 'Parameter keyword tidak ditemukan.']);
        }
    }
}
