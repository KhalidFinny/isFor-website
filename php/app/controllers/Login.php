<?php

class Login extends Controller
{
    public function index()
    {
        $this->view("main/login");
    }

    public function authentication()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            //lebih baik ganti md5 ke password_bcrypt untuk keamanan
            $user = $this->model('User_Model')->getUserByUsername($username);
            if ($user) {
                if (password_verify($password, $user['password'])) {

                    session_start();
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['username'] = $user['username'];

                    if ($user['role_id'] == 1) {
                        $_SESSION['role_id'] = $user['role_id'];
                        header('Location: http://localhost:4321/adminpage');
                        die();
                    } else {
                        $_SESSION['role_id'] = $user['role_id'];
                        header('Location: http://localhost:4321');
                        die();
                    }
                } else {
                    //kondisi jika password salah
                    echo "<script>
                            alert('password atau username salah coba lagi')
                            </script>";
                    header('Location: ' . BASEURL . '/login');
                    die();
                }
            } else {
                header('Location: http://localhost:4321/login');
                die();
            }
        }
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();

        header('Location: http://localhost:4321/login');
        exit;
    }
}