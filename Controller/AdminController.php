<?php
class AdminController  extends AbstactController {

    public function index()
    {
        $this->render('admin/espace-admin');
        UserManager::getAllUser();
        BannedManager::getAllBannedUser();
        ModoManager::getAllModo();
        if ($this->getBanned()) {

            $mail = trim(strip_tags($_POST['mail']));
            $username = trim(strip_tags($_POST['username']));
            BannedManager::getMailBanned($mail, $username);
            BannedManager::addBannedUser($mail, $username);
        }

        if ($this->getModo()) {
            $mail = trim(strip_tags($_POST['mail']));
            $username = trim(strip_tags($_POST['username']));
            ModoManager::getMailModo($mail, $username);
            ModoManager::addModoUser($mail, $username);
        }

        if ($this->getDeleteBanned()) {
            $mail = trim(strip_tags($_POST['mail']));
            $username = trim(strip_tags($_POST['username']));
            BannedManager::debanned($mail, $username);
        }
        if ($this->getDelete()) {
            $mail = trim(strip_tags($_POST['mail']));
            $username = trim(strip_tags($_POST['username']));
            ModoManager::deleteRole($mail, $username);
        }
    }

    public function addRole()
    {
        $this->render('admin/addRole');
    }
}