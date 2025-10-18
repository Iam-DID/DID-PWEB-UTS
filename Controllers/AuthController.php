<?php
require_once 'Models/UserModel.php';

class AuthController {
    
    public function login() {
        // session_start(); // pastikan session aktif
        $error = '';

        // ✅ Jika user sudah login, langsung arahkan sesuai status
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user']['STATUS'] === 'admin') {
                header("Location: index.php?page=resultadmin");
            } else {
                header("Location: index.php?page=form");
            }
            exit;
        }

        // ✅ Proses login ketika form disubmit
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $model = new UserModel();
            $user = $model->cekLogin($_POST['username'], $_POST['password']);

            if ($user) {
                $_SESSION['user'] = $user;

                // Arahkan sesuai status user
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

        // ✅ Jika user sudah login, arahkan langsung
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user']['STATUS'] === 'admin') {
                header("Location: index.php?page=resultadmin");
            } else {
                header("Location: index.php?page=form");
            }
            exit;
        }

        // Proses registrasi
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
