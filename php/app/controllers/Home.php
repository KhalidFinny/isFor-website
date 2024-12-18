<?php

require_once "Roadmap.php";

class Home extends Controller
{

    // Fungsi untuk menginisialisasi user default
    private function initializeDefaultUser()
    {
        $userModel = $this->model('UsersModel');

        // Cek apakah user sudah ada
        if (!$userModel->checkUserExists()) {
            // Jika belum ada, tambahkan user default
            $userModel->addDefaultUser();
        }
    }

    public function index()
    {
        $this->initializeDefaultUser();
        $roadmapController = new Roadmap();
        $data['roadmaps'] = $roadmapController->groupingRoadmap();
        $data['allUser'] = $this->model('UsersModel')->getUserByRole(2);
        $this->view('main/home', $data);
    }

    public function agenda()
    {
        $data['agenda'] = $this->model('AgendaModel')->getAllAgenda();
        $data['no'] = 1;
        $this->view('main/agenda', $data);
    }

    public function galeri()
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Halaman saat ini (default 1)
        $limit = 6; // Jumlah data per halaman
        $offset = ($page - 1) * $limit; // Hitung offset

        $galleriesModel = $this->model('GalleryModel');
        $data['galleries'] = $galleriesModel->getGalleriesWithPagination($limit, $offset);
        $data['totalGalleries'] = $galleriesModel->getTotalGalleries();
        $data['limit'] = $limit;
        $data['currentPage'] = $page;
        $data['totalPages'] = ceil($data['totalGalleries'] / $limit); // Total halaman

        $this->view('main/galeriweb', $data);
    }

//    public function hasilPenelitian(){
//        $data['researchoutput'] = $this->model('ResearchOutputModel')->getAll();
//        $this->view('main/hasilpenelitian', $data);
//    }

    public function getOriginalFileName($fileNameWithExt)
    {
        $metaDir = __DIR__ . '/../files/meta/';
        $metaFilePath = $metaDir . $fileNameWithExt . '.meta';

        // Debugging jalur metadata (opsional)
        error_log("Accessing Metadata: $metaFilePath");

        if (file_exists($metaFilePath)) {
            return file_get_contents($metaFilePath);
        } else {
            return 'Judul tidak ditemukan';
        }
    }

    public function hasilPenelitian()
    {
        $researchModel = $this->model('ResearchOutputModel');
//        $data['researchOutputs'] = $researchModel->getVerifyFiles();
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Halaman saat ini
        $limit = 6; // Jumlah data per halaman
        $offset = ($page - 1) * $limit; // Offset untuk query

        $researchOutputModel = $this->model('ResearchOutputModel');
        $data['researchOutputs'] = $researchOutputModel->getVerifiedResearchOutputs($limit, $offset); // Data yang diverifikasi
        $data['totalOutputs'] = $researchOutputModel->getTotalVerifiedResearchOutputs(); // Total data diverifikasi
        $data['limit'] = $limit;
        $data['currentPage'] = $page;
        $data['totalPages'] = ceil($data['totalOutputs'] / $limit);

        // Jika ingin menambahkan pengolahan data, seperti menambahkan `original_name`:
        foreach ($data['researchOutputs'] as &$researchOutput) {
            $fileNameWithExt = pathinfo(basename($researchOutput['file_url']), PATHINFO_BASENAME);
            $metaFilePath = __DIR__ . '/../files/meta/' . $fileNameWithExt . '.meta';

            $researchOutput['original_name'] = file_exists($metaFilePath)
                ? $this->getOriginalFileName($fileNameWithExt)
                : 'Judul tidak ditemukan';
        }

        $this->view('main/hasilpenelitian', $data);
    }

    public function filterHasilPenelitian(){

        
        $status = $_POST['status'];

        switch ($status) {
            case 0: // Semua hasil penelitian
                $hasil = $this->model('ResearchOutputModel')->getAll();
                break;
            case 1: // DIPA SWADANA
                $hasil = $this->model('ResearchOutputModel')->getresearchDIPASWA();
                break;
            case 2: // DIPA PNBP
                $hasil = $this->model('ResearchOutputModel')->getresearchDIPAPNBP();
                break;
            case 3: // Tesis Magister
                $hasil = $this->model('ResearchOutputModel')->getresearchTesis();
                break;
            default:
                echo json_encode(['error' => 'Invalid status']);
                return;
        }

        // error_log(json_encode($letters)); // Debug output
        echo json_encode($hasil);
    }

    public function filterGaleri(){

        // echo json_encode($_POST);
        
        $status = $_POST['status'];

        switch ($status) {
            case 0: // Semua hasil penelitian
                $hasil = $this->model('GalleryModel')->getAll();
                break;
            case 1: // DIPA SWADANA
                $hasil = $this->model('GalleryModel')->getGaleryDIPASWA();
                break;
            case 2: // DIPA PNBP
                $hasil = $this->model('GalleryModel')->getGaleryDIPAPNBP();
                break;
            case 3: // Tesis Magister
                $hasil = $this->model('GalleryModel')->getGaleryTesis();
                break;
            default:
                echo json_encode(['error' => 'Invalid status']);
                return;
        }

        // error_log(json_encode($letters)); // Debug output
        echo json_encode($hasil);
    }

    public function archives()
    {
        $this->view('main/dokumen');
    }

}