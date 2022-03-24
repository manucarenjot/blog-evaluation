<?php
namespace App\Controller\ErrorController;

class ErrorController
{

    public static function error404($page) {
        require __DIR__ . '/../View/error/404-not-found.php';
    }
}