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

    public static function connectUserWithMail(string $mail, string $password)
    {
        $alert = [];
        $result = Connect::getPDO()->prepare("SELECT * FROM fpm03_user WHERE mail = '{$mail}'");

        $result->execute();
        $data = $result->fetch();
        if ($data) {
            if (password_verify($password, $data['password'])) {
                $_SESSION['user'] = $data;
                header('LOCATION: ?c=home&a=role');
            }
            else {
                $alert[] = '<div class="alert-error">Adresse e-mail ou mot de passe invalide !</div>';
                if(count($alert) > 0) {
                    $_SESSION['alert'] = $alert;
                    header('LOCATION: ?c=user&a=login');
                }

            }
        }
        else {
            $alert[] = '<div class="alert-error">Adresse e-mail ou mot de passe invalide !</div>';
            if(count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('LOCATION: ?c=user&a=login');
            }
        }
    }

    public static function getDataUser($id) {
        $select = Connect::getPDO()->prepare("SELECT * FROM fpm03_user where id = '{$id}'");

        if ($select->execute()) {
            $datas = $select->fetchAll();
            foreach ($datas as $data) { ?>
            <div class="userData">
               <h1><?=ucfirst($data['username']) ?></h1>
                <?php
                if (isset($_SESSION['admin']))
                {
                ?>
                    <h4>Role : Administrateur</h4>
                    <?php
                }
                    ?>
                <?php
                if (isset($_SESSION['modo']))
                {
                    ?>
                    <h4>Role : Modérateur</h4>
                    <?php
                }
                ?>
                <p> Adresse e-mail : <?=$data['mail']?></p>
                <p>Inscrit depuis le : <?= date('d-m-y  à H:i', strtotime($data['date'])) ?></p>
            </div>
<?php

            }
        }
    }

    public static function profilUpdate(string $username, string $mail, string $password) {
        $update = Connect::getPDO()->prepare("UPDATE fpm03_user 
                                                    SET username = '{$username}', mail = '{$mail}', password = '{$password}'
                                                    WHERE id = '{$_SESSION['user']['id']}'");
        if ($update->execute()) {
            $alert = [];
            $alert[] = '<div class="alert-succes">Profil modifié</div>';
            if(count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('LOCATION: ?c=user&id='.$_SESSION['user']['id']);
            }
        }
    }
}