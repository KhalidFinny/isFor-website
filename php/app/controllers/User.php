<?php

class User extends Controller
{
    public function index()
    {
        $this->checkLogin();
        $role = $this->checkRole();
        $this->checkSessionTimeOut();

        if ($role == 1) {
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $limit = 5;
            $offset = ($page - 1) * $limit;

            $usersModel = $this->model('UsersModel');
            $data['limit'] = $limit;
            $data['allUsersWithPagination'] = $usersModel->getUsersWithPagination($limit, $offset);
            $data['totalUsers'] = $usersModel->getTotalUsers();
            $data['currentPage'] = $page;
            $data['totalPages'] = ceil($data['totalUsers'] / $limit);
            $this->saveLastVisitedPage();
            $this->view('admin/users', $data);
        } else {
            header('Location: ' . $this->getLastVisitedPage());
        }
    }

    public function editView($id)
    {
        $this->checkLogin();
        $role = $this->checkRole();
        $this->checkSessionTimeOut();
        if ($role == 1) {
            $this->saveLastVisitedPage();
            $data['user'] = $this->model('UsersModel')->getUserById($id);
            $this->view('admin/editUser', $data);
        } else {
            header('Location: ' . $this->getLastVisitedPage());
        }
    }

    public function create()
    {
        session_start();

        // Validate required fields
        if (empty($_POST['name']) || empty($_POST['username']) || empty($_POST['email'])) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Nama, username, dan email wajib diisi.'
            ]);
            return;
        }

        $photo = $this->upload();
        if ($photo === false) {
            return;
        }

        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $name = $_POST['name'] ?? '';
        $username = $_POST['username'] ?? '';

        if (!$email) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Format email tidak valid.'
            ]);
            return;
        }

        $validationResult = $this->model('UsersModel')->validateUser($name, $username, $email);

        if ($validationResult['name_exists']) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Nama sudah terdaftar.'
            ]);
            return;
        }
        if ($validationResult['username_exists']) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Username sudah terdaftar.'
            ]);
            return;
        }
        if ($validationResult['email_exists']) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Email sudah terdaftar.'
            ]);
            return;
        }

        if ($this->model('UsersModel')->addUser($email, $_POST, $photo) > 0) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Tambah data berhasil.'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Tambah data gagal. Silakan coba lagi.'
            ]);
        }
    }

    public function upload()
    {
        $nameFile = $_FILES['profile_picture']['name'] ?? '';
        $sizeFile = $_FILES['profile_picture']['size'] ?? 0;
        $error = $_FILES['profile_picture']['error'] ?? 4;
        $tmpName = $_FILES['profile_picture']['tmp_name'] ?? '';

        if (empty($nameFile) || $error === 4) {
            return null;
        }

        $extensionImageValid = ['jpg', 'jpeg', 'png'];
        $extensionImage = explode('.', $nameFile);
        $extensionImage = strtolower(end($extensionImage));

        if (!in_array($extensionImage, $extensionImageValid)) {
            echo json_encode([
                'status' => 'error',
                'message' => 'File tidak didukung. Hanya file JPG, JPEG, dan PNG yang diperbolehkan.'
            ]);
            return false;
        }

        if ($sizeFile > 5000000) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Ukuran gambar terlalu besar. Maksimal 5MB.'
            ]);
            return false;
        }

        if (!is_uploaded_file($tmpName)) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat mengunggah file.'
            ]);
            return false;
        }

        $newFileName = uniqid() . '.' . $extensionImage;
        if (!move_uploaded_file($tmpName, '../app/img/profile/' . $newFileName)) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Gagal menyimpan file gambar.'
            ]);
            return false;
        }
        return $newFileName;
    }

    public function edit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = $this->model('UsersModel');
            $email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
            $id = $_POST['user_id'] ?? null;
            $oldPhoto = $_POST['oldImage'] ?? '';
            $oldPass = $_POST['oldPass'] ?? '';
            $newPass = $_POST['password'] ?? '';
            $username = $_POST['username'] ?? '';

            if (empty($id) || empty($username) || empty($_POST['email'])) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Data tidak lengkap. Semua field wajib diisi.'
                ]);
                return;
            }

            if (!$email) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Format email tidak valid.'
                ]);
                return;
            }

            if ($userModel->isEmailExists($email, $id)) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Email telah terdaftar.'
                ]);
                return;
            }

            if ($userModel->isUsernameExists($username, $id)) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Username telah terdaftar.'
                ]);
                return;
            }

            $password = !empty($newPass) ? password_hash($newPass, PASSWORD_DEFAULT) : $oldPass;

            if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
                $newPhoto = $this->upload();
                if ($newPhoto === false) {
                    exit();
                } else {
                    $imageData = $this->model('UsersModel')->deleteImage($id);
                    if ($imageData['profile_picture'] && file_exists('../app/img/profile/' . $imageData['profile_picture'])) {
                        unlink('../app/img/profile/' . $imageData['profile_picture']);
                    }
                    $photo = $newPhoto;
                }
            } else {
                $photo = $oldPhoto;
            }

            if ($userModel->editUser($email, $id, $_POST, $photo, $password) > 0) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Data berhasil diperbarui.',
                    'profile_picture' => basename($photo)
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Data tidak berhasil diperbarui. Silakan coba lagi.'
                ]);
            }
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Metode request tidak valid.'
            ]);
        }
    }

    private function redirectWithError($error)
    {
        $_SESSION['error'] = $error;
        header('Location: ' . BASEURL . '/User/edit/' . $_POST['user_id']);
        exit;
    }

    public function delete($id)
    {
        $image_name = $this->model('UsersModel')->deleteImage($id);

        if ($image_name['profile_picture'] && file_exists('../app/img/profile/' . $image_name['profile_picture'])) {
            unlink('../app/img/profile/' . $image_name['profile_picture']);
        }

        if ($this->model('UsersModel')->deleteUser($id) > 0) {
            header('Location: ' . BASEURL . '/user');
            echo "tambah data berhasil";
        } else {
            echo "delete user gagal";
        }
    }

    public function search()
    {
        if (isset($_POST['keyword'])) {
            $keyword = $_POST['keyword'];
            $pageNumber = $_POST['pageNumber'] ?? 1;
            $pageSize = $_POST['pageSize'] ?? 5;

            $userModel = $this->model('UsersModel');
            try {
                $results = $userModel->searchUsers($keyword, $pageNumber, $pageSize);

                header('Content-Type: application/json');
                echo json_encode([
                    'data' => $results['data'],
                    'totalCount' => $results['totalCount'],
                    'pageNumber' => $pageNumber,
                    'pageSize' => $pageSize
                ]);
            } catch (Exception $e) {
                error_log($e->getMessage());
                echo json_encode(['error' => 'Terjadi kesalahan di server.']);
            }
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Kata kunci pencarian wajib diisi.'
            ]);
        }
    }
}
