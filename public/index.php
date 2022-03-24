<?php
session_start();
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog</title>
</head>
<body>
<div class="menu">
    <a href="?c=home">|Home|</a>
    <a href="?c=user&a=register">S'inscrire|</a>
    <a href="?c=user&a=login">Se connecter|</a>
    <a href="?c=user">Profil|</a>
    <a href="?c=espace-moderation">Espace-moderation|</a>
    <a href="?c=espace-admin">Espace-admin|</a>
    <a href="?c=contact">Contact|</a>
</div>

<?php
//Todo vérifier le chemin pour faire une page de profil, ?c=user&a=profil&id=$id
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
        Router::route('ArticleController', $action);
        break;
    case 'espace-moderation':
        Router::route('ModoController');
        break;
    case 'user':
        Router::route('UserController', $action);
        break;
    case 'contact':
        Router::route('ContactController');
        break;
    case 'espace-admin':
        Router::route('AdminController', $action);
        break;
    default:
        ErrorController::error404($page);
}

?>
</body>
</html>




