<?php
class ModoController extends AbstactController
{

    public function index()
    {
        $this->render('modos/modo');
        UserManager::getAllUser();
        BannedManager::getAllBannedUser();
        if ($this->getBanned()) {
            $mail = trim(strip_tags($_POST['mail']));
            $username = trim(strip_tags($_POST['username']));
            BannedManager::getMailBanned($mail, $username);
            BannedManager::addBannedUser($mail, $username);
            header('LOCATION: ?c=espace-moderation');

        }
        if ($this->getDeleteBanned()) {
            $mail = trim(strip_tags($_POST['mail']));
            $username = trim(strip_tags($_POST['username']));
            BannedManager::debanned($mail, $username);
            header('LOCATION: ?c=espace-moderation');
        }
    }
}