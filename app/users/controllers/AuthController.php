<?php

namespace App\users\controllers;

require __DIR__ . '/../../../vendor/autoload.php';

use App\users\Models\User;
use App\helpers\Session;

class AuthController extends BaseController {
    public function __construct() {
        parent::__construct(false);
    }

    public function loginForm(array $data = []) {
        $this->render('login', $data);
    }

    public function login() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

            $errors = [];

            if($username === '' || $password === '') {
                $errors[] = 'ALL RECORDS ARE REQUIRED';
            }

            $user = User::find(null, $username);


            if($user) {
                Session::set('user', $user);
                $redirect = Session::getRedirectAfterLogin() ?? '/star/users';
                header("Location: $redirect");
                exit;
            }

            $errors[] = 'Invalid Username Or Password';

            $this->loginForm(['errors' => $errors, 'old' => ['username' => $username]]);

        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header('location: /star/login');
        exit;
    }





    // public function render(string $view, array $data) {

    //     $default = ['errors' => [], 'old' => []];

    //     extract(array_merge($default, $data));

    //     $viewPath = __DIR__ . "/../views/authPages/{$view}.php";

    //     require __DIR__ . '/../views/layout/header.php';
    //     require $viewPath;
    //     require __DIR__ . '/../views/layout/footer.php';
    // }
}