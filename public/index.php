<?php

use App\Routing\Router\Router;
use App\Controller\ErrorController\ErrorController;


require __DIR__ . '/../require.php';

if (isset($_SESSION['alert']) && count($_SESSION['alert']) > 0) {
    $alerts = $_SESSION['alert'];
    unset($_SESSION['alert']);

    foreach ($alerts as $alert) {
        echo $alert;
    }
}

$page = isset($_GET['c']) ? Router::secureUrl($_GET['c']) : 'home';
$action = isset($_GET['a']) ? Router::secureUrl($_GET['a']) : 'index';


switch ($page) {
    case 'home':
        Router::route('HomeController');
        break;
    case 'article':
        Router::route('ArticleController');
        break;
    case 'espace-moderateur':
        Router::route('ModoController');
        break;
    case 'inscription':
        Router::route('UserController', $action);
        break;
    case 'contact':
        Router::route('ContactController');
        break;
    case 'espace-admin':
        Router::route('AdminController', $action);
        break;
    case 'connect':
        Router::route('ConnectController', $action);
        break;
    default:
        ErrorController::error404($page);
}
