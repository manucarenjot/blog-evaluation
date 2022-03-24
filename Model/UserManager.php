<?php

use App\Connect\Connect;

class UserManager

{

    public static function addUser(string $username, string $mail, string $password) {
        $insert = Connect::getPDO()->prepare("INSERT INTO fpm03_user (username, mail, password, date) 
                                            VALUES('{$username}', '{$mail}', '{$password}', NOW())");

       if ($insert->execute()) {
           $alert = [];
           $alert[] = '<div class="alert-succes">Inscription réussi !</div>';
           if (count($alert) > 0) {
               $_SESSION['alert'] = $alert;
               header('LOCATION: ?c=home');
           }

       }
    }

    public static function getMailExist(string $mail) {
        $get = Connect::getPDO()->prepare("SELECT * FROM fpm03_user WHERE mail = '{$mail}'");
        if ($get->execute()) {
            $datas = $get->fetchAll();
            foreach ($datas as $data) {
                if ($data['mail'] === $mail) {
                    $alert = [];
                    $alert[] = '<div class="alert-error">L\'adresse e-mail est déjà utilisé !</div>';
                    if (count($alert) > 0) {
                        $_SESSION['alert'] = $alert;
                        header('LOCATION: ?c=user&a=register');
                    }
                }
            }
        }

    }
    public static function getUsernameExist(string $username) {
        $get = Connect::getPDO()->prepare("SELECT * FROM fpm03_user WHERE username = '{$username}'");
        if ($get->execute()) {
            $datas = $get->fetchAll();
            foreach ($datas as $data) {
                if ($data['username'] === $username) {
                    $alert = [];
                    $alert[] = '<div class="alert-error">Le nom d\'utilisateur est déjà utilisé !</div>';
                    if (count($alert) > 0) {
                        $_SESSION['alert'] = $alert;
                        header('LOCATION: ?c=user&a=register');
                    }
                }
            }


        }

    }
}