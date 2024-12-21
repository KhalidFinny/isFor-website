<?php

require_once "Roadmap.php";

class Home extends Controller
{

    public function index()
    {
        $this->initializeDefaultUser();
        $roadmapController = new Roadmap();
        $data['roadmaps'] = $roadmapController->groupingRoadmap();
        $data['allUser'] = $this->model('UsersModel')->getUserByRole(2);
        $this->view('main/home', $data);
    }

    private function initializeDefaultUser()
    {
        $userModel = $this->model('UsersModel');

        if (!$userModel->checkUserExists()) {
            $userModel->addDefaultUser();
        }
    }

    public function getOriginalFileName($fileNameWithExt)
    {
        $metaDir = __DIR__ . '/../files/meta/';
        $metaFilePath = $metaDir . $fileNameWithExt . '.meta';
        error_log("Accessing Metadata: $metaFilePath");

        if (file_exists($metaFilePath)) {
            return file_get_contents($metaFilePath);
        } else {
            return 'Judul tidak ditemukan';
        }
    }

    public function filterHasilPenelitian()
    {
        $status = $_POST['status'];

        switch ($status) {
            case 0:
                $hasil = $this->model('ResearchOutputModel')->getAll();
                break;
            case 1:
                $hasil = $this->model('ResearchOutputModel')->getresearchDIPASWA();
                break;
            case 2:
                $hasil = $this->model('ResearchOutputModel')->getresearchDIPAPNBP();
                break;
            case 3:
                $hasil = $this->model('ResearchOutputModel')->getresearchTesis();
                break;
            default:
                echo json_encode(['error' => 'Invalid status']);
                return;
        }
        echo json_encode($hasil);
    }

    public function filterGaleri()
    {
        $status = $_POST['status'];

        switch ($status) {
            case 0:
                $hasil = $this->model('GalleryModel')->getAll();
                break;
            case 1:
                $hasil = $this->model('GalleryModel')->getGaleryDIPASWA();
                break;
            case 2:
                $hasil = $this->model('GalleryModel')->getGaleryDIPAPNBP();
                break;
            case 3:
                $hasil = $this->model('GalleryModel')->getGaleryTesis();
                break;
            case 4:
                $hasil = $this->model('GalleryModel')->getGaleryBerita();
                break;
            default:
                echo json_encode(['error' => 'Invalid status']);
                return;
        }
        echo json_encode($hasil);
    }

    public function agenda()
    {
        $data['agenda'] = $this->model('AgendaModel')->getAllAgenda();
        $data['no'] = 1;
        $this->view('main/agenda', $data);
    }

    public function galeri()
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 6;
        $offset = ($page - 1) * $limit;

        $galleriesModel = $this->model('GalleryModel');
        $data['galleries'] = $galleriesModel->getGalleriesWithPagination($limit, $offset);
        $data['totalGalleries'] = $galleriesModel->getTotalGalleries();
        $data['limit'] = $limit;
        $data['currentPage'] = $page;
        $data['totalPages'] = ceil($data['totalGalleries'] / $limit);

        $this->view('main/galeriweb', $data);
    }

    public function hasilPenelitian()
    {
        $researchOutputModel = $this->model('ResearchOutputModel');
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 6;
        $offset = ($page - 1) * $limit;

        $data['researchOutputs'] = $researchOutputModel->getVerifiedResearchOutputs($limit, $offset); // Data yang diverifikasi
        $data['totalOutputs'] = $researchOutputModel->getTotalVerifiedResearchOutputs(); // Total data diverifikasi
        $data['limit'] = $limit;
        $data['currentPage'] = $page;
        $data['totalPages'] = ceil($data['totalOutputs'] / $limit);

        foreach ($data['researchOutputs'] as &$researchOutput) {
            $fileNameWithExt = pathinfo(basename($researchOutput['file_url']), PATHINFO_BASENAME);
            $metaFilePath = __DIR__ . '/../files/meta/' . $fileNameWithExt . '.meta';

            $researchOutput['original_name'] = file_exists($metaFilePath)
                ? $this->getOriginalFileName($fileNameWithExt)
                : 'Judul tidak ditemukan';
        }

        $this->view('main/hasilpenelitian', $data);
    }

    public function archives()
    {
        $this->view('main/dokumen');
    }
}