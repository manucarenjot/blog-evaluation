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
}