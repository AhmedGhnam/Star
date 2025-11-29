<?php
date_default_timezone_set('Africa/Cairo');
define('BASE_PATH', '/star');
define('VIEW_PATH', BASE_PATH . '/users/views');
define('CONTROLLER_PATH', BASE_PATH . '/controllers');

require __DIR__ . '/../../vendor/autoload.php';

use App\users\Router;
use App\helpers\Session;
use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;
Session::start();

// set_exception_handler(function($e) {
//     ErrorsPages::errorShow(500);
//     error_log($e->getMessage());
// });


$router = new Router();



$router->add('GET', BASE_PATH . '/users/create', ['UserController', 'create'], [AuthMiddleware::class]);
$router->add('GET',BASE_PATH . '/users', ['UserController', 'index'], [AuthMiddleware::class]);
$router->add('POST', BASE_PATH . '/users/store', ['UserController', 'store']);
$router->add('GET', BASE_PATH . '/users/edit/(\d+)', ['UserController', 'edit'], [AuthMiddleware::class]);
$router->add('POST', BASE_PATH . '/users/update/(\d+)', ['UserController', 'update']);
$router->add('GET', BASE_PATH . '/users/delete/(\d+)', ['UserController', 'remove'], [AuthMiddleware::class]);
$router->add('GET', BASE_PATH . '/users/search', ['UserController', 'index'], [AuthMiddleware::class]);
$router->add('GET', BASE_PATH . '/users/profile/(\d+)', ['UserController', 'profile'], [AuthMiddleware::class]);
$router->add('GET', BASE_PATH . '/login', ['AuthController', 'loginForm'], [GuestMiddleware::class]);
$router->add('POST', BASE_PATH . '/login', ['AuthController', 'login']);
$router->add('GET', BASE_PATH . '/logout', ['AuthController', 'logout']);
$router->add('GET', BASE_PATH . '/dashboard', ['DashboardController', 'index'], [AuthMiddleware::class]);
$router->dispatch();



?>

