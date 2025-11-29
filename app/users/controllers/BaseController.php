<?php

namespace App\users\controllers;

use App\helpers\Session;
use App\helpers\ErrorsPages;


abstract class BaseController {
   public function __construct(bool $authRequired = true, bool $isAdmin = false) {

     //    if($authRequired && !Session::isLogged()) {
     //        Session::setRedirectAfterLogin($_SERVER['REQUEST_URI']);
     //        header('Location: /star/login');
     //        exit;
     //    }

     //    if($isAdmin && !Session::isAdmin()) {
     //        ErrorsPages::errorShow(403);
     //        exit;
     //    }
   }

   public function render(string $view, array $data) {

        $default = ['errors' => [], 'old' => []];

        extract(array_merge($default, $data));

        $viewPath = __DIR__ . "/../views/authPages/{$view}.php";
        
        require __DIR__ . '/../views/layout/header.php';
        require $viewPath;
        require __DIR__ . '/../views/layout/footer.php';
    }
}