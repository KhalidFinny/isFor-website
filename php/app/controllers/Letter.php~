<?php

use Dompdf\Dompdf;
use Dompdf\Options;
use GuzzleHttp\Psr7\Query;
use Symfony\Component\VarDumper\VarDumper;

class Letter extends Controller
{
    public function index()
    {

    }

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
            // Stream untuk preview di browser
            $dompdf->stream($title);
            exit; // Stop eksekusi setelah stream
        } else {
            // Kembalikan konten PDF untuk keperluan lain
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

        $affectedRows = $this->model('LettersModel')->updateStatusLetter($id, $status);
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
        $jumlahDataperhalaman = 4;
        $halamanAktif = (isset($_GET["halaman"])) ? (int)$_GET["halaman"] : 1;
        $awalData = ($jumlahDataperhalaman * $halamanAktif) - $jumlahDataperhalaman;
        $lettersModel = $this->model('LettersModel');
        if ($role == 1) {
            $jumlahData = $lettersModel->countAllLetters();
            $data['allLetters'] = $lettersModel->getAllLettersPaginate($awalData, $jumlahDataperhalaman);
        } else {
            header('Location: ' . $this->getLastVisitedPage());
            exit;
        }
        $jumlahHalaman = ceil($jumlahData / $jumlahDataperhalaman);
        $data['jumlahHalaman'] = $jumlahHalaman;
        $data['halamanAktif'] = $halamanAktif;
        $data['totalLetters'] = $jumlahData;
        $this->view('admin/admin-letter-history', $data);

    }

    public function filter()
    {
        session_start();
        $status = $_POST['status'];
        $userId = $_SESSION['user_id'];

        $jumlahDataperhalaman = 4;

        // Ambil jumlah total data sesuai status
        if($status == 0){
            $jumlahData = $this->model('LettersModel')->countAllLeterbyUserId($userId);
        }else{
            $jumlahData = $this->model('LettersModel')->countAllLettersByUserandStatus($userId, $status)['total'];
        }
        $jumlahHalaman = ceil($jumlahData / $jumlahDataperhalaman);

        // Halaman aktif dari POST, menggunakan halamanAktif
        $halamanAktif = isset($_POST['halamanAktif']) ? (int)$_POST['halamanAktif'] : 1;
        $awalData = ($jumlahDataperhalaman * $halamanAktif) - $jumlahDataperhalaman;

        // Validasi status dan ambil data
        if ($status == 0) {
            $letters = $this->model('LettersModel')->getLetterByUserIdPaginate($userId, $awalData, $jumlahDataperhalaman);
        } else {
            $letters = $this->model('LettersModel')->getLetterByUserIdStatus($userId, $status, $awalData, $jumlahDataperhalaman);
        }

        // Kirim data ke frontend
        echo json_encode([
            'letters' => $letters,
            'pagination' => [
                'jumlahHalaman' => $jumlahHalaman,
                'halamanAktif' => $halamanAktif
            ]
        ]);
    }

    public function filterAdmin() {
        $input = json_decode(file_get_contents('php://input'), true);
        $status = $input['status'] ?? null;
        $jumlahDataperhalaman = 4;

        if ($status == 0) {
            // Hitung semua surat tanpa memfilter status
            $jumlahData = $this->model('LettersModel')->countAllLetters();
        } else {
            // Hitung surat berdasarkan status saja
            $jumlahData = $this->model('LettersModel')->countAllLettersByStatus($status)['total'];
        }

        $jumlahHalaman = ceil($jumlahData / $jumlahDataperhalaman);

        $halamanAktif = isset($_POST['halamanAktif']) ? (int)$_POST['halamanAktif'] : 1;
        $awalData = ($jumlahDataperhalaman * $halamanAktif) - $jumlahDataperhalaman;

        switch ($status) {
            case 0:
                // Ambil semua surat dengan paginasi
                $letters = $this->model('LettersModel')->getAllLettersPaginate($awalData, $jumlahDataperhalaman);
                break;
            case 2:
            case 3:
            case 1:
                // Ambil surat berdasarkan status dengan paginasi
                $letters = $this->model('LettersModel')->getLettersByStatus($status, $awalData, $jumlahDataperhalaman);
                break;
            default:
                echo json_encode(['error' => 'Invalid status']);
                return;
        }

        // Kirim data ke frontend
        echo json_encode([
            'letters' => $letters,
            'pagination' => [
                'jumlahHalaman' => $jumlahHalaman,
                'halamanAktif' => $halamanAktif
            ]
        ]);
    }

    public function search()
    {
        if (isset($_POST['keyword'])) {
            $keyword = $_POST['keyword'];
            $page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
            $itemsPerPage = 6;
            $offset = ($page - 1) * $itemsPerPage;

            $lettersModel = $this->model('LettersModel');

            try {
                $results = $lettersModel->searchLetters($keyword, $itemsPerPage, $offset);
                $totalResults = $lettersModel->countSearchResults($keyword);
                $totalPages = ceil($totalResults / $itemsPerPage);

                header('Content-Type: application/json');
                http_response_code(200); // Success
                echo json_encode([
                    'results' => $results,
                    'totalPages' => $totalPages,
                    'currentPage' => $page,
                ]);
            } catch (Exception $e) {
                error_log("Error in search function: " . $e->getMessage());
                error_log("Trace: " . $e->getTraceAsString());

                header('Content-Type: application/json');
                http_response_code(500); // Server error
                echo json_encode(['error' => 'Terjadi kesalahan di server.']);
            }
        } else {
            header('Content-Type: application/json');
            http_response_code(400); // Bad request
            echo json_encode(['error' => 'Parameter tidak lengkap.']);
        }
    }

    public function letterHistoryView()
    {
        $this->checkLogin();
        $role = $this->checkRole();
        $this->checkSessionTimeOut();
        if ($role == 2) {
            $this->saveLastVisitedPage();
            $jumlahDataperhalaman = 4;
            $jumlahData = count($this->model('LettersModel')->getLetterByUserId($_SESSION['user_id']));
            $jumlahHalaman = ceil($jumlahData / $jumlahDataperhalaman);
            $halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
            $awalData = ($jumlahDataperhalaman * $halamanAktif) - $jumlahDataperhalaman;

            $data['user_id'] = $_SESSION['user_id'];
            $data['jumlahHalaman'] = $jumlahHalaman;
            $data['halamanAktif'] = $halamanAktif;
            $data['letter'] = $this->model('LettersModel')->countAllLeterbyUserId($_SESSION['user_id']);
            $data['allLetters'] = $this->model('LettersModel')->getLetterByUserIdPaginate($_SESSION['user_id'], $awalData, $jumlahDataperhalaman);
            $this->view('user/letter-history', $data);
        } else {
            header('Location: ' . $this->getLastVisitedPage());
        }
    }

    public function searchUser()
    {
        if (isset($_POST['keyword'])) {
            $keyword = $_POST['keyword'];
            $page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
            $itemsPerPage = 4;
            $offset = ($page - 1) * $itemsPerPage;

            session_start();
            if (!isset($_SESSION['user_id'])) {
//                $_SESSION['user_id'] = 8;
                echo json_encode(['error' => 'User tidak terautentikasi.']);
                return;
            }
            $userId = $_SESSION['user_id'];

            $researchOutputModel = $this->model('LettersModel');

            try {
                $results = $researchOutputModel->searchLettersUser($keyword, $userId, $itemsPerPage, $offset);
                $totalResults = $researchOutputModel->countUserSearchResults($keyword, $userId);
                $totalPages = ceil($totalResults / $itemsPerPage);

                header('Content-Type: application/json');
                echo json_encode([
                    'results' => $results,
                    'totalPages' => $totalPages,
                    'currentPage' => $page,
                ]);
            } catch (Exception $e) {
                echo json_encode(['error' => $e->getMessage()]);
            }
        }
    }

}

