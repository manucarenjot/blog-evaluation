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
        $insert = Connect::getPDO()->prepare("INSERT INTO fpm03_modo (username, mail, date) value ('$username','$mail',NOW())");

        if ($insert->execute()) {
            $alert = [];
            $alert[] = '<div class="alert-succes">Vous avez attribuer le role de modérateur à '. ucfirst($username) .'!</div>';
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
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
                    $alert[] = '<div class="alert-error">L\'utilisateur '. ucfirst($username)  .' est déjà modérateur !</div>';
                    if (count($alert) > 0) {
                        $_SESSION['alert'] = $alert;
                    }
                }
            }
        }
    }

    public static function getAllModo() {
        $get = Connect::getPDO()->prepare("SELECT * FROM fpm03_modo");

        if ($get->execute()) {
            $datas = $get->fetchAll();
            ?>
            <div class="bannedList">
                <h3>Liste des Modérateurs</h3>
                <?php
                foreach ($datas as $data) {

                    ?>
                    <table>
                        <tbody>
                        <tr>
                            <th>Nom</th>
                            <th>Adresse e-mail</th>
                            <th>Date d'attribuation du rôle</th>
                        </tr>
                        <tr>   <td><?=$data['username']?></td>
                            <td><?=$data['mail']?></td>
                            <td><?= date('d-m-y', strtotime($data['date'])) ?></td>
                        </tbody>
                    </table>
                    <form action="?c=espace-admin" method="post" style="display: inline">
                        <input type="text" name="username" value="<?=$data['username']?>" style="display: none">
                        <input type="text" name="mail" value="<?=$data['mail']?>" style="display: none">
                        <input type="submit" name="delete" class="submit" id="deleteModo" value="❌" alt="Retirer les droits" title="Retirer les droits">
                    </form>


                    <?php

                }
                ?>
            </div>
            <?php
        }
    }

    public static function deleteRole(string $mail, string $username) {
        $delete = Connect::getPDO()->prepare("DELETE  FROM fpm03_modo WHERE mail = '$mail'");

        if ($delete->execute()) {
            $alert = [];
            $alert[] = '<div class="alert-succes">Vous avez retiré le rôle de modérateur de '. ucfirst($username) .'</div>';
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
            }
        }
    }
}