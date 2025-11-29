<?php

namespace App\users\Controllers;

use App\users\controllers\BaseController;
use App\users\Models\User;
class DashboardController extends BaseController {

    public function index(): void {
        $totalUsers = User::count();

        $latestUsers = User::latest(5);

        $this->render('dashboard', compact('totalUsers', 'latestUsers'));
    }

    public function render(string $view, array $data) {

        $defaults = ['errors' => [], 'old' => []];

        extract(array_merge($defaults, $data));
        $viewPath = __DIR__ . "/../views/{$view}.php";
        require __DIR__ . "/../views/layout/header.php";
        require $viewPath;
        require __DIR__ . "/../views/layout/footer.php";
        
    }

    

}