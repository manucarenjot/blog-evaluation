<?php

namespace App\Routing\Router;






class Router
{

    public static function route(string $controller, ?string $action = null) {
        $control = new $controller();
        $control->index();
        switch ($action) {
            case 'logout':
                $control->logout();
                break;
            case 'login':
                $control->login();
                break;
            case 'register':
                $control->register();
                break;
            case 'add-role':
                $control->addRole();
                break;
            case 'add-article':
                $control->addArticle();
                break;



        }
    }


    public static function secureUrl(?string $param): ?string
    {
        if(null === $param) {
            return null;
        }

        $param = strip_tags($param);
        $param =  trim($param);
        return strtolower($param);
    }
}