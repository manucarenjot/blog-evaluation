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
}