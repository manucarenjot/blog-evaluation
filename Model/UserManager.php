<?php

use App\Connect\Connect;

class UserManager

{

    public static function addUser(string $username, string $mail, string $password)
    {
        $insert = Connect::getPDO()->prepare("INSERT INTO fpm03_user (username, mail, password, date) 
                                            VALUES('$username', '$mail', '$password', NOW())");

        if ($insert->execute()) {
            $alert = [];
            $alert[] = '<div class="alert-succes">Inscription réussi !</div>';
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('LOCATION: ?c=home');
            }

        }
    }

    public static function getMailExist(string $mail)
    {
        $get = Connect::getPDO()->prepare("SELECT * FROM fpm03_user WHERE mail = '$mail'");
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

    public static function getUsernameExist(string $username)
    {
        $get = Connect::getPDO()->prepare("SELECT * FROM fpm03_user WHERE username = '$username'");
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
        $result = Connect::getPDO()->prepare("SELECT * FROM fpm03_user WHERE mail = '$mail'");

        $result->execute();
        $data = $result->fetch();
        if ($data) {
            if (password_verify($password, $data['password'])) {
                $_SESSION['user'] = $data;
                header('LOCATION: ?c=home&a=role');
            } else {
                $alert[] = '<div class="alert-error">Adresse e-mail ou mot de passe invalide !</div>';
                if (count($alert) > 0) {
                    $_SESSION['alert'] = $alert;
                    header('LOCATION: ?c=user&a=login');
                }

            }
        } else {
            $alert[] = '<div class="alert-error">Adresse e-mail ou mot de passe invalide !</div>';
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('LOCATION: ?c=user&a=login');
            }
        }
    }

    public static function getDataUser($id)
    {
        $select = Connect::getPDO()->prepare("SELECT * FROM fpm03_user WHERE id = '$id'");

        if ($select->execute()) {
            ?>
            <div class="user">
                <?php
            $datas = $select->fetchAll();
            foreach ($datas as $data) {
                $_SESSION['user'] = $data
                ?>

                    <div class="userData">
                        <h1><?= ucfirst($data['username']) ?></h1>
                        <?php
                        if (isset($_SESSION['admin'])) {
                            ?>
                            <h4>Role : Administrateur</h4>
                            <?php
                        }
                        ?>
                        <?php
                        if (isset($_SESSION['modo'])) {
                            ?>
                            <h4>Role : Modérateur</h4>
                            <?php
                        }
                        ?>
                        <p> Adresse e-mail : <?= $data['mail'] ?></p>
                        <p>Inscrit depuis le : <?= date('d-m-y  à H:i', strtotime($data['date'])) ?></p>
                        <a href="?c=user&a=update&id=<?= $_SESSION['user']['id'] ?>">Modifier le profil</a>
                        <br>
                        <br>
                        <a href="?c=user&a=delete&id=<?= $_SESSION['user']['id'] ?>" style="color: darkred; font-size: 1em">Supprimer son compte utilisateur</a>
                    </div>

                <?php

            }
            ?>
            </div>
                <?php
        }
    }

    public static function profilUpdate(string $username, string $password)
    {
        $update = Connect::getPDO()->prepare("UPDATE fpm03_user 
                                                    SET username = '$username', password = '$password'
                                                    WHERE id = '{$_SESSION['user']['id']}'");
        if ($update->execute()) {
            $alert = [];
            $alert[] = '<div class="alert-succes">Profil modifié</div>';
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('LOCATION: ?c=user&id=' . $_SESSION['user']['id']);
            }
        }
    }

    public static function getAllUser()
    {
        $select = Connect::getPDO()->prepare("SELECT * FROM fpm03_user");

        if ($select->execute()) {
            ?>
            <div class="userList">
                <h3>Liste des utilisateurs</h3>
                <?php
                $datas = $select->fetchAll();
                foreach ($datas as $data) {
                    ?>

                    <table>
                        <tbody>
                        <tr>
                            <th>Nom</th>
                            <th>Date d'inscription</th>

                        </tr>
                        <tr>
                            <td><?= $data['username'] ?></td>
                            <td><?= date('d-m-y', strtotime($data['date'])) ?></td>

                        </tbody>
                    </table>
                    <div class="userInteraction">
                    <form action="?c=espace-admin" method="post" style="display: inline">
                        <input type="text" name="username" value="<?= $data['username'] ?>" style="display: none">
                        <input type="text" name="mail" value="<?= $data['mail'] ?>" style="display: none">
                        <input type="submit" name="addModo" class="submit" value="👑" alt="Ajouter modo"
                               title="Ajouter modo">
                    </form>

                    <form action="?c=espace-moderation" method="post" style="display: inline">
                        <input type="text" name="username" value="<?= $data['username'] ?>" style="display: none">
                        <input type="text" name="mail" value="<?= $data['mail'] ?>" style="display: none">
                        <input type="submit" name="banned" class="submit" value="❌" alt="Bannir l'utilisateur"
                               title="Bannir l'utilisateur">
                    </form>
                    </div>
                    <?php
                }
                ?>
            </div>
            <?php
        }
    }

    public static function deleteAccount($id) {
        $delete = Connect::getPDO()->prepare("DELETE  FROM fpm03_user Where id = '$id'");

        if ($delete->execute()) {
            session_destroy();
            session_start();
            $alert = [];
            $alert[] = '<div class="alert-succes">Votre compte a été supprimé au plaisir de vous revoir bientôt</div>';
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('LOCATION: ?c=home');
            }
        }
    }

}