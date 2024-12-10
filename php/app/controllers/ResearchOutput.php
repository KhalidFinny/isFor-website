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
            $files = $researchModel->getPendingFiles();

            // Tambahkan judul asli file ke dalam data
            foreach ($files as &$file) {
                if (isset($file['file_url']) && !empty($file['file_url'])) {
                    // Ambil nama file lengkap (misal: '67532969ef71e.jpg')
                    $fileNameWithExt = pathinfo(basename($file['file_url']), PATHINFO_BASENAME);

                    // Tentukan jalur metadata
                    $metaFilePath = __DIR__ . '/../files/meta/' . $fileNameWithExt . '.meta';

                    // Cek keberadaan metadata
                    if (file_exists($metaFilePath)) {
                        $file['original_name'] = $this->getOriginalFileName($fileNameWithExt);
                    } else {
                        $file['original_name'] = 'Judul tidak ditemukan';
                    }
                } else {
                    $file['original_name'] = 'File URL tidak valid';
                }
            }

            $this->view('admin/verify-file', compact('files'));
        } else {
            header('Location: ' . $this->getLastVisitedPage());
            exit;
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

    public function researchHistoryView($status = 'all')
    {
        $this->checkLogin();
        $role = $this->checkRole();
        $this->checkSessionTimeOut();

        if ($role == 2) {
            $this->saveLastVisitedPage();

            $galleryModel = $this->model('ResearchOutputModel');
            $userId = $_SESSION['user_id'];

            // Filter berdasarkan status
            if ($status === 'all') {
                $files = $galleryModel->getFilesByUser($userId);
            } else {
                $files = $galleryModel->getFilesByUserAndStatus($userId, $status);
            }

            $totalFiles = count($files);

            $this->view('user/files-history', [
                'totalFiles' => $totalFiles,
                'files' => $files,
                'selectedStatus' => $status
            ]);
        } else {
            header('Location: ' . $this->getLastVisitedPage());
        }
    }

    public function uploadFile()
    {
        $this->checkLogin();
        $uploaded_by = $_SESSION['user_id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $response = ['success' => false, 'message' => ''];

            // Validasi field input
            $title = htmlspecialchars(trim($_POST['fileTitle'] ?? ''));
            $category = htmlspecialchars(trim($_POST['category'] ?? ''));
            $description = htmlspecialchars(trim($_POST['description'] ?? ''));

            if (empty($title) || empty($category) || empty($description)) {
                $response['message'] = 'Semua field wajib diisi.';
                echo json_encode($response);
                return;
            }

            // Validasi file
            if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
                $file = $_FILES['file'];

                // Tentukan direktori tujuan untuk file dan metadata
                $uploadDir = __DIR__ . '/../files/research_output/';
                $metaDir = __DIR__ . '/../files/meta/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                if (!is_dir($metaDir)) {
                    mkdir($metaDir, 0777, true);
                }

                // Dapatkan ekstensi file
                $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                $allowedExtensions = ['pdf', 'jpg', 'jpeg', 'png', 'gif', 'doc', 'docx', 'xlsx'];

                if (in_array($fileExtension, $allowedExtensions)) {
                    // Nama file unik
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
                            // Hapus file dan metadata jika gagal menyimpan ke database
                            unlink($filePath);
                            unlink($metaFilePath);
                            $response['message'] = 'Gagal menyimpan data ke database.';
                        }
                    } else {
                        $response['message'] = 'Gagal memindahkan file.';
                    }
                } else {
                    $response['message'] = 'Ekstensi file tidak didukung.';
                }
            } else {
                $response['message'] = 'Tidak ada file yang diunggah atau terjadi kesalahan.';
            }

            echo json_encode($response);
        } else {
            echo json_encode(['success' => false, 'message' => 'Metode tidak valid.']);
        }
    }

    public function verifyFile($id)
    {
        $this->checkLogin();
        $role = $this->checkRole();
        $this->checkSessionTimeOut();

        if ($role == 1) { // Pastikan hanya admin yang bisa memverifikasi
            $model = $this->model("ResearchOutputModel");
            $files = $model->getPendingFiles();
            if ($model->updateStatus($id, 2)) { // Status 2 untuk verified
                echo json_encode(['success' => true, 'message' => 'Image verified successfully.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to verify image.']);
            }
        } else {
            http_response_code(403);
            echo json_encode(['success' => false, 'message' => 'Unauthorized action.']);
        }
    }

    public function rejectFile($id)
    {
        $this->checkLogin();
        $role = $this->checkRole();
        $this->checkSessionTimeOut();

        if ($role == 1) { // Pastikan hanya admin yang bisa menolak
            $model = $this->model("ResearchOutputModel");
            if ($model->updateStatus($id, 3)) { // Status 3 untuk rejected
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
        // Ambil `status` dari permintaan POST
        $status = isset($_POST['status']) ? $_POST['status'] : null;
        $userId = $_SESSION['user_id']; // Ambil user ID dari sesi

        // Filter data berdasarkan status
        $model = $this->model('ResearchOutputModel'); // Sesuaikan nama model
        switch ($status) {
            case 0: // Semua data
                $outputs = $model->getFilesByUser($userId);
                break;
            case 1: // Data tertunda
                $outputs = $model->getFilesByUserAndStatus($userId, 'pending');
                break;
            case 2: // Data disetujui
                $outputs = $model->getFilesByUserAndStatus($userId, 'approved');
                break;
            case 3: // Data ditolak
                $outputs = $model->getFilesByUserAndStatus($userId, 'rejected');
                break;
            default:
                echo json_encode(['error' => 'Invalid status']);
                return;
        }

        // Kembalikan data dalam format JSON
        echo json_encode($outputs);
    }

//    public function delete($id)
//    {
//        if ($this->model('ResearchOutputModel')->delete($id) > 0) {
//            echo json_encode(['success' => true]);
//        } else {
//            echo json_encode(['success' => false, 'message' => 'Failed to delete the image.']);
//        }
//        exit();
//    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;

            if ($id && $this->model('ResearchOutputModel')->delete($id) > 0) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to delete the file.']);
            }
        } else {
            http_response_code(405); // Method not allowed
            echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
        }
        exit();
    }

}