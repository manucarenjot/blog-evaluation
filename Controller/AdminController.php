<?php
class AdminController  extends AbstactController {

    public function index()
    {
        $this->render('admin/espace-admin');
        UserManager::getAllUser();
        if ($this->getBanned()) {

            $mail = trim(strip_tags($_POST['mail']));
            $username = trim(strip_tags($_POST['username']));
            BannedManager::getMailBanned($mail);
            BannedManager::addBannedUser($mail, $username);
        }
    }

    public function addRole()
    {
        $this->render('admin/addRole');
    }
}