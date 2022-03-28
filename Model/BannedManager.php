<?php

use App\Connect\Connect;

class BannedManager
{
    public static function addBannedUser(string $mail, string $username) {
        $insert = Connect::getPDO()->prepare("INSERT INTO fpm03_banned ( username,mail, `date-de-ban`) value ( '$username','$mail', NOW())");

        if ($insert->execute()) {
            $alert = [];
            $alert[] = '<div class="alert-succes">Vous avez banni '. ucfirst($username) .'!</div>';
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
            }
        }
    }

    public static function getMailBanned(string $mail, string $username) {
        $get = Connect::getPDO()->prepare("SELECT * FROM fpm03_banned WHERE mail = '$mail'");
        if ($get->execute()) {
            $datas = $get->fetchAll();
            foreach ($datas as $data) {
                if ($data['mail'] === $mail) {
                    $alert = [];
                    $alert[] = '<div class="alert-error">L\'utilisateur '. ucfirst($username) .' est déjà banni !</div>';
                    if (count($alert) > 0) {
                        $_SESSION['alert'] = $alert;
                        header('LOCATION: ?c=espace-admin');
                    }
                }
            }
        }
    }

    public static function getAllBannedUser() {
        $get = Connect::getPDO()->prepare("SELECT * FROM fpm03_banned");

        if ($get->execute()) {
            $datas = $get->fetchAll();
            ?>
            <div class="bannedList">
                <h3>Liste des utilisateurs bannis</h3>
                <?php
            foreach ($datas as $data) {

                ?>
                <table>
                    <tbody>
                    <tr>
                        <th>Nom</th>
                        <th>Adresse e-mail</th>
                        <th>Date de bannissement</th>
                    </tr>
                    <tr>   <td><?=$data['username']?></td>
                        <td><?=$data['mail']?></td>
                        <td><?= date('d-m-y', strtotime($data['date-de-ban'])) ?></td>
                    </tbody>
                </table>
                <form action="?c=espace-moderation" method="post" style="display: inline">
                    <input type="text" name="username" value="<?=$data['username']?>" style="display: none">
                    <input type="text" name="mail" value="<?=$data['mail']?>" style="display: none">
                    <input type="submit" name="deleteBanned" id="debanned" value="🔓" alt="Débannir l'utilisateur" title="Débannir l'utilisateur">
                </form>


<?php

            }
            ?>
            </div>
<?php
        }
    }

    public static function debanned(string $mail, string $username) {
        $delete = Connect::getPDO()->prepare("DELETE  FROM fpm03_banned WHERE mail = '$mail'");

        if ($delete->execute()) {
            $alert = [];
            $alert[] = '<div class="alert-succes">Vous avez debanni '. ucfirst($username) .'</div>';
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
            }
        }
    }
}