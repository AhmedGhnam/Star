<?php

namespace App\Middleware;

use App\helpers\Session;

class GuestMiddleware {

    public static function handle() {
        Session::start();
        if(Session::isLogged()) {
            header('Location: /star/dashboard');
            exit;
        }
    }



}