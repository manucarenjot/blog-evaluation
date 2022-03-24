<?php
class HomeController extends AbstactController

{

    public function index()
    {
        $this->render('public/home');


    }

    public function getRole() {
        $this->render('user/role');
        if (isset($_SESSION['user'])) {
            $alert = [];
            ModoManager::getModo();
            AdminManager::getAdmin();

            $alert[] = '<div class="alert-succes">Vous êtes connecté ! '.$_SESSION['user']["username"].'</div>';
            if(count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('LOCATION: ?c=home');
            }
        }
    }
}