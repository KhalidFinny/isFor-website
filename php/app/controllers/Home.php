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
        if (isset($_SERVER['CONTENT_TYPE']) && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== false) {
            $input = json_decode(file_get_contents('php://input'), true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                echo json_encode(['error' => 'Invalid JSON format']);
                return;
            }
            $_POST = $input;
        } else {
            echo json_encode(['error' => 'Invalid Content-Type, expected application/json']);
            return;
        }

        $status = $_POST['status'] ?? null;
        $page = $_POST['page'] ?? 1;
        $limit = $_POST['limit'] ?? 6;

        $categoryMap = [
            1 => 'DIPA SWADANA',
            2 => 'DIPA PNBP',
            3 => 'Tesis Magister',
        ];

        if (!isset($status) || !is_numeric($status) || $status < 0 || $status > 3) {
            echo json_encode(['error' => 'Invalid status']);
            return;
        }

        if (array_key_exists($status, $categoryMap)) {
            $category = $categoryMap[$status];
            $total = $this->model('ResearchOutputModel')->getTotalFilesByCategory($category);
            $data = $this->model('ResearchOutputModel')->getFilesByCategory($category, $page, $limit);
            $result = [
                'total' => $total,
                'data' => $data,
                'page' => $page,
                'limit' => $limit,
                'totalPages' => ceil($total / $limit),
            ];
        } else if ($status === 0) {
            $result = $this->model('ResearchOutputModel')->getAllPaginateFiles($page, $limit);
            $total = $result['total'];
            $data = $result['data'];
            $result = [
                'total' => $total,
                'data' => $data,
                'page' => $page,
                'limit' => $limit,
                'totalPages' => ceil($total / $limit),
            ];
        } else {
            echo json_encode(['error' => 'Invalid status']);
            return;
        }

        echo json_encode($result);
    }

    public function filterGallery()
    {
        if (isset($_SERVER['CONTENT_TYPE']) && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== false) {
            $input = json_decode(file_get_contents('php://input'), true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                echo json_encode(['error' => 'Invalid JSON format']);
                return;
            }
            $_POST = $input;
        } else {
            echo json_encode(['error' => 'Invalid Content-Type, expected application/json']);
            return;
        }

        $status = $_POST['status'] ?? null;
        $page = $_POST['page'] ?? 1;
        $limit = $_POST['limit'] ?? 6;

        $categoryMap = [
            1 => 'DIPA SWADANA',
            2 => 'DIPA PNBP',
            3 => 'Tesis Magister',
            4 => 'Berita',
        ];

        if (!isset($status) || !is_numeric($status) || $status < 0 || $status > 4) {
            echo json_encode(['error' => 'Invalid status']);
            return;
        }

        if (array_key_exists($status, $categoryMap)) {
            $category = $categoryMap[$status];
            $total = $this->model('GalleryModel')->getTotalGalleriesByCategory($category);
            $data = $this->model('GalleryModel')->getGaleryByCategory($category, $page, $limit);
            $result = [
                'total' => $total,
                'data' => $data,
                'page' => $page,
                'limit' => $limit,
                'totalPages' => ceil($total / $limit),
            ];
        } else if ($status === 0) {
            $result = $this->model('GalleryModel')->getAllPaginateGallery($page, $limit);
            $total = $result['total'];
            $data = $result['data'];
            $result = [
                'total' => $total,
                'data' => $data,
                'page' => $page,
                'limit' => $limit,
                'totalPages' => ceil($total / $limit),
            ];
        } else {
            echo json_encode(['error' => 'Invalid status']);
            return;
        }

        echo json_encode($result);
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
