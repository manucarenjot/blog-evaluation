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
}