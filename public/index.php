<?php

use App\Routing\Router\Router;
use App\Controller\ErrorController\ErrorController;

session_start();


?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Blog</title>
</head>
<body>
<div class="header">
    <div class="menu">
        <a href="?c=home">Home</a>
        <?php
        if (!isset($_SESSION['user'])) {
            ?>
            <a href="?c=user&a=register">S'inscrire</a>
            <a href="?c=user&a=login">Se connecter</a>
            <?php
        } else {
            ?>
            <a href="?c=user&id=<?= $_SESSION['user']['id'] ?>">Profil</a>
            <a href="?c=user&a=logout">Se déconnecter</a>
            <?php
        }


        if (isset($_SESSION['admin']) or isset($_SESSION['modo'])) {


            ?>
            <a href="?c=espace-moderation">Espace-moderation</a>


            <?php

        }
        ?>
        <?php
        if (isset($_SESSION['admin'])) {
            ?>
            <a href="?c=espace-admin">Espace-admin</a>
            <?php
        }
        ?>
    </div>
</div>
<?php


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
        Router::route('HomeController', $action);
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

<footer>
    <h1>vive la sapologie !</h1>
</footer>
</body>
</html>




