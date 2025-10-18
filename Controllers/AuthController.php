<?php
require_once 'Models/UserModel.php';

class AuthController {
    
    public function login() {
        $error = '';
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user']['STATUS'] === 'admin') {
                header("Location: index.php?page=resultadmin");
            } else {
                header("Location: index.php?page=form");
            }
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $model = new UserModel();
            $user = $model->cekLogin($_POST['username'], $_POST['password']);

            if ($user) {
                $_SESSION['user'] = $user;

                if ($_SESSION['user']['STATUS'] === 'admin') {
                    header("Location: index.php?page=resultadmin");
                } else {
                    header("Location: index.php?page=form");
                }
                exit;
            } else {
                $error = "Username atau password salah!";
            }
        }

        include 'Views/login.php';
    }

    public function register() {
        session_start();
        $msg = '';

        if (isset($_SESSION['user'])) {
            if ($_SESSION['user']['STATUS'] === 'admin') {
                header("Location: index.php?page=resultadmin");
            } else {
                header("Location: index.php?page=form");
            }
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $model = new UserModel();
            $hasil = $model->register($_POST['username'], $_POST['password']);

            if ($hasil) {
                $msg = 'success';
            } else {
                $msg = 'Username sudah digunakan.';
            }
        }

        include 'Views/register.php';
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: index.php?page=login');
        exit;
    }
}
?>

