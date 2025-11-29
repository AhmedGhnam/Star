<?php

namespace App\helpers;

class ErrorsPages {
    public static function errorShow($fileName) {
        require __DIR__ . '/../users/views/layout/header.php';
        require __DIR__ . "/../users/views/errors/{$fileName}.php";
        require __DIR__ . '/../users/views/layout/footer.php';
    }
}