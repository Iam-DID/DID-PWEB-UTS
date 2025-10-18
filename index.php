<?php
session_start();

$page = $_GET['page'] ?? 'login';

switch ($page) {
    case 'login':
        require_once 'Controllers/AuthController.php';
        $controller = new AuthController();
        $controller->login();
        break;

    case 'register':
        require_once 'Controllers/AuthController.php';
        $controller = new AuthController();
        $controller->register();
        break;

    case 'logout':
        require_once 'Controllers/AuthController.php';
        $controller = new AuthController();
        $controller->logout();
        break;

    case 'form':
        require_once 'Controllers/FormController.php';
        $controller = new FormController();
        $controller->showForm();
        break;

    case 'resultadmin':
        require_once 'Controllers/ResultAdminController.php';
        $controller = new ResultAdminController();
        $controller->index();
        break;


    default:
        echo "Halaman tidak ditemukan!";
        break;
}
