<?php

use App\Connect\Connect;

class AdminManager
{


    public static function getAdmin(): void {
        $select = Connect::getPDO()->prepare("SELECT * FROM  fpm03_admin WHERE mail = '{$_SESSION['user']['mail']}'");

        if ($select->execute()) {
            $datas = $select->fetchAll();
            foreach ($datas as $data) {
                $_SESSION['admin'] = $data['mail'];
            }
        }
    }
}