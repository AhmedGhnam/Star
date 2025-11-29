<?php

namespace App\Middleware;

use App\helpers\Session;

class AuthMiddleware {

    public static function handle() {
        Session::start();
        if(!Session::isLogged()) {
            Session::setRedirectAfterLogin($_SERVER['REQUEST_URI']);
            header('Location: /star/login');
            exit;
        }
    }



}