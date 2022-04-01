<?php

require __DIR__ . '/Router/Router.php';

require __DIR__ . '/Engine/Config.php';
require __DIR__ . '/Engine/Connect.php';

require __DIR__ . '/Model/AdminManager.php';
require __DIR__ . '/Model/ArticleManager.php';
require __DIR__ . '/Model/ModoManager.php';
require __DIR__ . '/Model/UserManager.php';
require __DIR__ . '/Model/BannedManager.php';

require __DIR__ . '/Controller/AbstactController.php';
require __DIR__ . '/Controller/AdminController.php';
require __DIR__ . '/Controller/ArticleController.php';
require __DIR__ . '/Controller/ValidationController.php';
require __DIR__ . '/Controller/ErrorController.php';
require __DIR__ . '/Controller/HomeController.php';
require __DIR__ . '/Controller/ModoController.php';
require __DIR__ . '/Controller/UserController.php';

