<?php

use App\Connect\Connect;

class BannedManager
{
    public static function addBannedUser(string $mail, string $username) {
        $insert = Connect::getPDO()->prepare("INSERT INTO fpm03_banned (mail) value ('$mail')");

        if ($insert->execute()) {
            $alert = [];
            $alert[] = '<div class="alert-succes">Vous avez banni '. $username .'!</div>';
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('LOCATION: ?c=espace-admin');
            }
        }
    }

    public static function getMailBanned(string $mail) {
        $get = Connect::getPDO()->prepare("SELECT * FROM fpm03_banned WHERE mail = '$mail'");
        if ($get->execute()) {
            $datas = $get->fetchAll();
            foreach ($datas as $data) {
                if ($data['mail'] === $mail) {
                    $alert = [];
                    $alert[] = '<div class="alert-error">L\'utilisateur est déjà banni !</div>';
                    if (count($alert) > 0) {
                        $_SESSION['alert'] = $alert;
                        header('LOCATION: ?c=espace-admin');
                    }
                }
            }
        }

    }
}