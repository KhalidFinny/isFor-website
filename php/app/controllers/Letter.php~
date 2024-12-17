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
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Halaman saat ini, default 1
            $limit = 4; // Jumlah surat per halaman
            $offset = ($page - 1) * $limit; // Hitung offset untuk query

            $lettersModel = $this->model('LettersModel');
            $data['allLetters'] = $lettersModel->getPendingLettersWithPagination($limit, $offset); // Surat pada halaman ini
            $totalLetters = $lettersModel->getTotalPendingLetters(); // Total surat pending

            // Hitung jumlah halaman
            $data['currentPage'] = $page;
            $data['totalPages'] = ceil($totalLetters / $limit);

            // Kirim data ke view
            $this->view('admin/verifyLetters', $data);
        } else {
            header('Location: ' . $this->getLastVisitedPage());
        }
    }

    //untuk admin
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

    // // function untuk merubah path file
    // public function changePathFile($status, $fileName){
    //     // Tentukan path sumber dan tujuan
    //     if ($status == 2) {  // Status Verified
    //         $sourcePath = realpath(__DIR__ . '/../letters/pending/' . $fileName);
    //         $destPath = realpath(__DIR__ . '/../letters/verified/' . $fileName);
    //     } else if ($status == 3) {  // Status Rejected
    //         $sourcePath = realpath(__DIR__ . '/../letters/pending/' . $fileName);
    //         $destPath = realpath(__DIR__ . '/../letters/reject/' . $fileName);
    //     }
    //     // Pastikan file ada sebelum mencoba untuk memindahkannya
    //     if (file_exists($sourcePath)) {
    //         if (copy($sourcePath, $destPath)) {
    //             return true;  // Cukup mengembalikan true atau false
    //         } else {
    //             // Jika gagal memindahkan file
    //             return false;
    //         }
    //     } else {
    //         // Jika file sumber tidak ditemukan
    //         return false;
    //     }
    // }

    public function letterHistoryView()
    {
        $this->checkLogin();
        $role = $this->checkRole();
        $this->checkSessionTimeOut();
        if ($role == 2) {
            $this->saveLastVisitedPage();
            $jumlahDataperhalaman = 3;
            $jumlahData = count($this->model('LettersModel')->getLetterByUserId($_SESSION['user_id']));
            $jumlahHalaman = ceil($jumlahData / $jumlahDataperhalaman);
            $halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
            $awalData = ($jumlahDataperhalaman * $halamanAktif) - $jumlahDataperhalaman;

            $data['jumlahHalaman'] = $jumlahHalaman;
            $data['halamanAktif'] = $halamanAktif;
            $data['letter'] = $this->model('LettersModel')->countAllLeterbyUserId($_SESSION['user_id']);
            $data['allLetters'] = $this->model('LettersModel')->getLetterByUserIdPaginate($_SESSION['user_id'], $awalData, $jumlahDataperhalaman);
            $this->view('user/letter-history', $data);
        } else {
            header('Location: ' . $this->getLastVisitedPage());
        }
    }

    public function adminLetterHistoryView()
    {
        $this->checkLogin();
        $role = $this->checkRole();
        $this->checkSessionTimeOut();

        $jumlahDataperhalaman = 3;
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
        $userId = $_SESSION['user_id']; // Mengambil user ID dari sesi

        switch ($status) {
            case 0: // Semua surat
                $letters = $this->model('LettersModel')->getLetterByUserId($userId);
                break;
            case 1: // Surat tertunda
                $letters = $this->model('LettersModel')->getLetterByUserIdPending($userId);
                break;
            case 2: // Surat disetujui
                $letters = $this->model('LettersModel')->getLetterByUserIdVerify($userId);
                break;
            case 3: // Surat ditolak
                $letters = $this->model('LettersModel')->getLetterByUserIdReject($userId);
                break;
            default:
                echo json_encode(['error' => 'Invalid status']);
                return;
        }

        // error_log(json_encode($letters)); // Debug output
        echo json_encode($letters);
    }

    public function search()
    {
        session_start();
        $session = $_SESSION['user_id'];
        $keyword = $_POST['keyword'];

        $letters = $this->model('LettersModel')->searchLetter($session, $keyword);
        // Lakukan pencarian berdasarkan keyword dan kirimkan hasilnya dalam format JSON
        echo json_encode($letters);
    }
}