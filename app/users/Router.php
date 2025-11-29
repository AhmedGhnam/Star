<?php

namespace App\users;

use App\helpers\ErrorsPages;
use App\Middleware\AuthMiddleware;

class Router {
    private array $routes = [];

    public function add(string $method, string $path, callable|array $callback, array $middleWares = []) {
        $this->routes[] = compact('method', 'path', 'callback', 'middleWares');
    }

    public function dispatch() {
        $currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $currentMethod = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {
            if ($route['method'] === $currentMethod) {
                $callback = $route['callback'];
                if(preg_match('#^' . $route['path'] . '$#' , $currentPath, $matches)) {
                    array_shift($matches);

                    if(!empty($route['middleWares'])) {
                        $mws = $route['middleWares'];
                        foreach($mws as $mw) {
                            $mw::handle();
                        }
                    }

                    if(is_array($callback)) {

                        $controllerClass = 'App\\users\\controllers\\' . $callback[0];
                        $method = $callback[1];

                        if(class_exists($controllerClass)) {
                            $controller = new $controllerClass();
                            if(method_exists($controller ,$method)) {
                                call_user_func_array([$controller, $method], $matches);
                                return;
                            }
                        }

                        echo 'Controller Or Method Not Found';
                        return;
                    }

                    if(is_callable($callback)) {
                        call_user_func_array($callback, $matches);
                    }

                }
            }
        }
        http_response_code(404);
        ErrorsPages::errorShow(404);
    }
}