<?php

use App\Connect\Connect;

class ModoManager
{
    public static function getModo() {
        $select = Connect::getPDO()->prepare("SELECT * FROM  fpm03_modo WHERE mail = '{$_SESSION['user']['mail']}'");

        if ($select->execute()) {
            $datas = $select->fetchAll();
            foreach ($datas as $data) {
                $_SESSION['modo'] = $data['mail'];
            }
        }
    }


    public static function addModoUser(string $mail, string $username) {
        $insert = Connect::getPDO()->prepare("INSERT INTO fpm03_modo (mail) value ('$mail')");

        if ($insert->execute()) {
            $alert = [];
            $alert[] = '<div class="alert-succes">Vous avez attribuer le role de modérateur à '. $username .'!</div>';
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('LOCATION: ?c=espace-admin');
            }
        }
    }

    public static function getMailModo(string $mail, string $username) {
        $get = Connect::getPDO()->prepare("SELECT * FROM fpm03_modo WHERE mail = '$mail'");
        if ($get->execute()) {
            $datas = $get->fetchAll();
            foreach ($datas as $data) {
                if ($data['mail'] === $mail) {
                    $alert = [];
                    $alert[] = '<div class="alert-error">L\'utilisateur '. $username .' est déjà modérateur !</div>';
                    if (count($alert) > 0) {
                        $_SESSION['alert'] = $alert;
                        header('LOCATION: ?c=espace-admin');
                    }
                }
            }
        }

    }
}