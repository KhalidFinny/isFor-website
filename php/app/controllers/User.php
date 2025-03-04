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
            $data['totalUsers'] = $usersModel->getTotalUsers(); // Total pengguna
            $data['currentPage'] = $page;
            $data['totalPages'] = ceil($data['totalUsers'] / $limit);
            $this->saveLastVisitedPage();
            $this->view('admin/users', $data);
        } else {
            header('Location: ' . $this->getLastVisitedPage());
        }
    }


    public function create()
    {
        session_start();

        $photo = $this->upload();

        // if (!$photo) {
        //     return false;
        // }

        // var_dump($_POST);
        // var_dump($photo);
        // exit;
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $name = $_POST['name'];
        $username = $_POST['username'];

        // Validasi data pengguna (nama, username, email)
        $validationResult = $this->model('UsersModel')->validateUser($name, $username, $email);

        if ($validationResult['name_exists']) {
            $_SESSION['message'] = "Nama sudah terdaftar.";
            header('Location: ' . BASEURL . '/User');
            return false;
        }
        if ($validationResult['username_exists']) {
            $_SESSION['message'] = "Username sudah terdaftar.";
            header('Location: ' . BASEURL . '/User');
            return false;
        }
        if ($validationResult['email_exists']) {
            $_SESSION['message'] = "Email sudah terdaftar.";
            header('Location: ' . BASEURL . '/User');
            return false;
        }

        if ($this->model('UsersModel')->addUser($email, $_POST, $photo) == 0) {
            $_SESSION['message'] = "Tambah data berhasil.";
        } else {
            $_SESSION['message'] = "Tambah data gagal.";
        }

        // var_dump($_SESSION['message']);
        header('Location: ' . BASEURL . '/User');
    }

    public function upload()
    {
     //        var_dump($_FILES);
//        file_put_contents('debug.log', print_r($_FILES, true));
        $nameFile = $_FILES['profile_picture']['name'];
        $sizeFile = $_FILES['profile_picture']['size'];
        $error = $_FILES['profile_picture']['error'];
        $tmpName = $_FILES['profile_picture']['tmp_name'];

        if (!isset($nameFile) || $error === 4) {
            return null; // Tidak ada file yang diunggah
        }

        //cek yang diupload adalah gambar
        $extensionImageValid = ['jpg', 'jpeg', 'png'];
        $extensionImage = explode('.', $nameFile);
        $extensionImage = strtolower(end($extensionImage));

        if (!in_array($extensionImage, $extensionImageValid)) {
            echo "yang anda upload bukan gambar";
            return false;
        }

        //cek jika ukurannya terlalu besar
        if ($sizeFile > 5000000) {
            echo "ukuran gambar terlalu besar";
            return false;
        }

        //lolos pengecekan, gambar siap diupload
        // generate nama file baru
        $newFileName = uniqid();
        $newFileName .= '.';
        $newFileName .= $extensionImage;

        move_uploaded_file($tmpName, '../app/img/profile/' . $newFileName);

        return $newFileName;
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

            if (!$email || !$id || !$username) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Data tidak lengkap atau email tidak valid.'
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
                $photo = $this->upload();
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
                    'message' => 'Data tidak berhasil diperbarui.'
                ]);
            }
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
            header('Location: ' . BASEURL . '/dashboardAdmin');
            echo "tambah data berhasil";
        } else {
            echo "delete user gagal";
        }
    }

    public function search()
    {
        if (isset($_POST['keyword'])) {
            $keyword = $_POST['keyword'];
            $pageNumber = $_POST['pageNumber'] ?? 1; // Default to page 1
            $pageSize = $_POST['pageSize'] ?? 5;    // Default to 10 items per page

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
        }
    }

}