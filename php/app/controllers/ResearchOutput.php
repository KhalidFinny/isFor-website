<?php

class ResearchOutput extends Controller
{
    public function index()
    {
        $this->view("main/hasilpenelitian");
    }

    public function uploadResearchView()
    {
        $this->checkLogin();
        $role = $this->checkRole();
        $this->checkSessionTimeOut();
        if ($role == 2) {
            $this->saveLastVisitedPage();
            $this->view('user/upload-file');
        } else {
            header('Location: ' . $this->getLastVisitedPage());
        }
    }

    public function verifyResearchView()
    {
        $this->checkLogin();
        $role = $this->checkRole();
        $this->checkSessionTimeOut();

        if ($role == 1) {
            $this->saveLastVisitedPage();

            $researchModel = $this->model('ResearchOutputModel');

            // Ambil parameter halaman dari URL, default ke halaman 1
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $limit = 4; // Jumlah data per halaman
            $offset = ($page - 1) * $limit; // Hitung offset berdasarkan halaman saat ini

            // Dapatkan total jumlah file pending
            $totalFiles = $researchModel->getTotalPendingFiles();
            $totalPages = ceil($totalFiles / $limit); // Total halaman

            // Ambil file berdasarkan pagination
            $files = $researchModel->getPendingFilesWithPagination($limit, $offset);

            foreach ($files as &$file) {
                if (isset($file['file_url']) && !empty($file['file_url'])) {
                    $fileNameWithExt = pathinfo(basename($file['file_url']), PATHINFO_BASENAME);
                    $metaFilePath = __DIR__ . '/../files/meta/' . $fileNameWithExt . '.meta';
                    if (file_exists($metaFilePath)) {
                        $file['original_name'] = $this->getOriginalFileName($fileNameWithExt);
                    } else {
                        $file['original_name'] = 'Judul tidak ditemukan';
                    }
                } else {
                    $file['original_name'] = 'File URL tidak valid';
                }

                // Tambahkan data nama pengguna berdasarkan uploaded_by (user_id)
                $file['name'] = $researchModel->getNameById($file['uploaded_by']);

                // Menambahkan ID Research Output (ID file)
                $file['research_output_id'] = $file['research_output_id']; // Pastikan kolom research_output_id ada dalam data

            }

            // Kirim data ke view
            $this->view('admin/verify-file', compact('files', 'page', 'totalPages'));
        } else {
            header('Location: ' . $this->getLastVisitedPage());
            exit;
        }
    }

    public function researchHistoryView($status = 'all')
    {
        $this->checkLogin();
        $role = $this->checkRole();
        $this->checkSessionTimeOut();

        if ($role == 2) {
            $this->saveLastVisitedPage();

            $researchOutputModel = $this->model('ResearchOutputModel');
            $userId = $_SESSION['user_id'];

            // Pagination setup
            $itemsPerPage = 1; // Jumlah file per halaman
            $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $offset = ($currentPage - 1) * $itemsPerPage;

            // Filter berdasarkan status
            if ($status === 'all') {
                // Total files (tanpa pagination)
                $totalFiles = $researchOutputModel->countFilesByUser($userId);
                // Files dengan pagination
                $files = $researchOutputModel->getPaginatedFilesByUser($userId, $itemsPerPage, $offset);
            } else {
                // Total files berdasarkan status (tanpa pagination)
                $totalFiles = $researchOutputModel->countFilesByUserAndStatus($userId, $status);
                // Files dengan pagination
                $files = $researchOutputModel->getPaginatedFilesByUserAndStatus($userId, $status, $itemsPerPage, $offset);
            }

            $totalPages = ceil($totalFiles / $itemsPerPage);

            $this->view('user/files-history', [
                'totalFiles' => $totalFiles,
                'files' => $files,
                'selectedStatus' => $status,
                'currentPage' => $currentPage,
                'totalPages' => $totalPages,
            ]);
        } else {
            header('Location: ' . $this->getLastVisitedPage());
        }
    }

    public function adminHistoryView($status = 'all')
    {
        $this->checkLogin();
        $role = $this->checkRole();
        $this->checkSessionTimeOut();

        if ($role == 1) {
            $this->saveLastVisitedPage();
            $researchOutputModel = $this->model('ResearchOutputModel');
            $itemsPerPage = 6;
            $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $offset = ($currentPage - 1) * $itemsPerPage;

            if ($status === 'all') {
                $totalFiles = $researchOutputModel->countAllFiles();
                $files = $researchOutputModel->getAllPaginatedFiles($itemsPerPage, $offset);
            } else {
                $totalFiles = $researchOutputModel->countAllFilesByStatus($status);
                $files = $researchOutputModel->getAllPaginatedFilesByStatus($status, $itemsPerPage, $offset);
            }

            $totalPages = ceil($totalFiles / $itemsPerPage);

            $this->view('admin/admin-files-history', [
                'totalFiles' => $totalFiles,
                'files' => $files,
                'selectedStatus' => $status,
                'currentPage' => $currentPage,
                'totalPages' => $totalPages,
            ]);
        } else {
            // Redirect untuk non-admin
            header('Location: ' . $this->getLastVisitedPage());
        }
    }

    private function getOriginalFileName($fileNameWithExt)
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

    public function uploadFile()
    {
        $this->checkLogin();
        $uploaded_by = $_SESSION['user_id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Pastikan header respons JSON
            header('Content-Type: application/json');

            $response = ['success' => false, 'message' => ''];

            // Validasi field input
            $title = htmlspecialchars(trim($_POST['fileTitle'] ?? ''));
            $category = htmlspecialchars(trim($_POST['category'] ?? ''));
            $description = htmlspecialchars(trim($_POST['description'] ?? ''));

            if (empty($title) || empty($category) || empty($description)) {
                $response['message'] = 'Semua field wajib diisi.';
                echo json_encode($response);
                exit;
            }

            // Validasi file
            if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
                $file = $_FILES['file'];

                // Tentukan direktori tujuan untuk file dan metadata
                $uploadDir = __DIR__ . '/../files/research_output/';
                $metaDir   = __DIR__ . '/../files/meta/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                if (!is_dir($metaDir)) {
                    mkdir($metaDir, 0777, true);
                }

                // Dapatkan ekstensi file dan validasi
                $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                $allowedExtensions = ['pdf', 'jpg', 'jpeg', 'png', 'gif', 'doc', 'docx', 'xlsx'];

                if (in_array($fileExtension, $allowedExtensions)) {
                    // Buat nama file unik
                    $fileName = uniqid() . '.' . $fileExtension;
                    $filePath = $uploadDir . $fileName;
                    $metaFilePath = $metaDir . $fileName . '.meta';

                    // Pindahkan file ke direktori tujuan
                    if (move_uploaded_file($file['tmp_name'], $filePath)) {
                        // Simpan metadata (nama asli file)
                        $originalName = $file['name'];
                        file_put_contents($metaFilePath, $originalName);

                        // Simpan ke database
                        $researchModel = $this->model('ResearchOutputModel');
                        $saveSuccess = $researchModel->create(
                            $fileName,
                            $uploaded_by,
                            $title,
                            $category,
                            $description
                        );

                        if ($saveSuccess) {
                            $response['success'] = true;
                            $response['message'] = 'File berhasil diunggah.';
                            echo json_encode($response);
                            exit;
                        } else {
                            // Hapus file & meta jika gagal simpan ke DB
                            unlink($filePath);
                            unlink($metaFilePath);
                            $response['message'] = 'Gagal menyimpan data ke database.';
                            echo json_encode($response);
                            exit;
                        }
                    } else {
                        $response['message'] = 'Gagal memindahkan file.';
                        echo json_encode($response);
                        exit;
                    }
                } else {
                    $response['message'] = 'Ekstensi file tidak didukung.';
                    echo json_encode($response);
                    exit;
                }
            } else {
                $response['message'] = 'Tidak ada file yang diunggah atau terjadi kesalahan.';
                echo json_encode($response);
                exit;
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Metode tidak valid.']);
            exit;
        }
    }

    public function verifyFile($id, $comment)
    {
        $this->checkLogin();
        $role = $this->checkRole();
        $this->checkSessionTimeOut();

        if ($role == 1) { // Pastikan hanya admin yang bisa memverifikasi
            $model = $this->model("ResearchOutputModel");
            $files = $model->getPendingFiles();
            if ($model->updateStatus($id, 2, $comment)) { // Status 2 untuk verified
                echo json_encode(['success' => true, 'message' => 'Image verified successfully.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to verify image.']);
            }
        } else {
            http_response_code(403);
            echo json_encode(['success' => false, 'message' => 'Unauthorized action.']);
        }
    }

    public function rejectFile($id, $comment)
    {
        $this->checkLogin();
        $role = $this->checkRole();
        $this->checkSessionTimeOut();

        if ($role == 1) {
            $model = $this->model("ResearchOutputModel");
            if ($model->updateStatus($id, 3, $comment)) { // Status 3 untuk rejected
                echo json_encode(['success' => true, 'message' => 'Image rejected successfully.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to reject image.']);
            }
        } else {
            http_response_code(403);
            echo json_encode(['success' => false, 'message' => 'Unauthorized action.']);
        }
    }

    public function filter()
    {
        session_start();
        $status = $_POST['status'] ?? null;
        $userId = $_SESSION['user_id'];

        $itemsPerPage = 1;

        // Get the total number of files based on status
        if ($status == 0) {
            $totalFiles = $this->model('ResearchOutputModel')->countFilesByUser($userId);
        } else {
            $totalFiles = $this->model('ResearchOutputModel')->countFilesByUserAndStatus($userId, $status)['total'];
        }
        $totalPages = ceil($totalFiles / $itemsPerPage);

        // Active page from POST, using activePage
        $activePage = isset($_POST['activePage']) ? (int)$_POST['activePage'] : 1;
        $offset = ($itemsPerPage * $activePage) - $itemsPerPage;

        // Validate status and fetch data
        if ($status == 0) {
            $files = $this->model('ResearchOutputModel')->getPaginatedFilesByUser($userId, $itemsPerPage, $offset);
        } else {
            $files = $this->model('ResearchOutputModel')->getFilesByUserAndStatus($userId, $status, $offset, $itemsPerPage);
        }

        // Send data to the frontend
        echo json_encode([
            'files' => $files,
            'pagination' => [
                'totalPages' => $totalPages,
                'activePage' => $activePage
            ]
        ]);
    }

    public function filterAdmin()
    {
        $status = $_POST['status'];
        $jumlahDataperhalaman = 6;

        if ($status == 0) {
            $jumlahData = $this->model('ResearchOutputModel')->countAllFiles();
        } else {
            $jumlahData = $this->model('ResearchOutputModel')->countAllFilesByStatus($status);
        }
        $jumlahHalaman = ceil($jumlahData / $jumlahDataperhalaman);

        $halamanAktif = isset($_POST['halamanAktif']) ? (int)$_POST['halamanAktif'] : 1;
        $awalData = ($jumlahDataperhalaman * $halamanAktif) - $jumlahDataperhalaman;

        if ($status == 0) {
            $files = $this->model('ResearchOutputModel')->getAllPaginatedFiles($jumlahDataperhalaman, $awalData);
        } else {
            $files = $this->model('ResearchOutputModel')->getFilesByStatus($status, $awalData, $jumlahDataperhalaman);
        }

        // Kirim data ke frontend
        echo json_encode([
            'files' => $files,
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
            $itemsPerPage = 6; // Jumlah item per halaman
            $offset = ($page - 1) * $itemsPerPage;

            $researchOutputModel = $this->model('ResearchOutputModel');

            try {
                $results = $researchOutputModel->searchResearchOutputs($keyword, $itemsPerPage, $offset);
                $totalResults = $researchOutputModel->countSearchResults($keyword);
                $totalPages = ceil($totalResults / $itemsPerPage);

                header('Content-Type: application/json');
                echo json_encode([
                    'results' => $results,
                    'totalPages' => $totalPages,
                    'currentPage' => $page,
                ]);
            } catch (Exception $e) {
                error_log($e->getMessage());
                echo json_encode(['error' => 'Terjadi kesalahan di server.']);
            }
        }
    }

    public function searchUser()
    {
        if (isset($_POST['keyword'])) {
            $keyword = $_POST['keyword'];
            $page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
            $itemsPerPage = 6;
            $offset = ($page - 1) * $itemsPerPage;

            session_start();
            if (!isset($_SESSION['user_id'])) {
                //                $_SESSION['user_id'] = 8;
                echo json_encode(['error' => 'User tidak terautentikasi.']);
                return;
            }
            $userId = $_SESSION['user_id'];

            $researchOutputModel = $this->model('ResearchOutputModel');

            try {
                $results = $researchOutputModel->searchFilesUser($keyword, $userId, $itemsPerPage, $offset);
                $totalResults = $researchOutputModel->countUserSearchResults($keyword, $userId);
                $totalPages = ceil($totalResults / $itemsPerPage);

                header('Content-Type: application/json');
                echo json_encode([
                    'results' => $results,
                    'totalPages' => $totalPages,
                    'currentPage' => $page,
                ]);
            } catch (Exception $e) {
                error_log($e->getMessage());
                echo json_encode(['error' => 'Terjadi kesalahan di server.']);
            }
        }
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;

            if ($id) {
                $result = $this->model('ResearchOutputModel')->delete($id);

                if ($result['dbDeleteSuccess']) {
                    if ($result['unlinkFileSuccess'] && $result['unlinkMetaSuccess']) {
                        echo json_encode(['success' => true, 'message' => 'File dan metadata berhasil dihapus.']);
                    } else {
                        echo json_encode([
                            'success' => false,
                            'message' => 'File berhasil dihapus dari database, tetapi ada kesalahan saat menghapus file atau metadata.',
                        ]);
                    }
                } else {
                    echo json_encode(['success' => false, 'message' => 'Gagal menghapus data dari database.']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'ID tidak valid.']);
            }
        } else {
            http_response_code(405); // Method not allowed
            echo json_encode(['success' => false, 'message' => 'Metode tidak valid.']);
        }
        exit();
    }
}
