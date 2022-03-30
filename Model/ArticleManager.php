<?php

use App\Connect\Connect;

class ArticleManager
{
    public static function addArticle(string $author, string $title, string $content)
    {
        $insert = Connect::getPDO()->prepare("INSERT INTO fpm03_articles (author, title, content, date) 
                                                    VALUES (:author, :title, :content, NOW()) ");

        $insert->bindValue(':author', $author);
        $insert->bindValue(':title', $title);
        $insert->bindValue(':content', $content);

        if ($insert->execute()) {
            $alert = [];
            $alert[] = '<div class="alert-succes">Vous avez ajouté un article!</div>';
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('LOCATION: ?c=home');
            }
        } else {
            $alert = [];
            $alert[] = '<div class="alert-error">L\'ajout de l\'article a échoué!</div>';
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('LOCATION: ?c=home');
            }
        }
    }

    public static function getNameArticle()
    {
        $select = Connect::getPDO()->prepare("SELECT * FROM fpm03_articles ");

        if ($select->execute()) {
            ?>
            <h1>Articles</h1>
            <?php
            $datas = $select->fetchAll();
            foreach ($datas as $data) {
                ?>
                <a href="?c=home&article=<?= $data['id'] ?>"><h3 class="titleArticle"><?= $data['title'] ?></h3></a>
                <?php
            }
        }
    }


    public static function getArticle($id)
    {
        $select = Connect::getPDO()->prepare("SELECT * FROM fpm03_articles WHERE id = $id");

        if ($select->execute()) {
            ?>
            <div class="articles">
            <?php
            $datas = $select->fetchAll();

            foreach ($datas as $data) {
                ?>
                <div class="article">
                <h5 class="author" style="display: inline">De: <?= $data['author'] ?></h5>
                <h3 class="titleArticle" style="display: inline"><?= $data['title'] ?></h3>
                <h6 class="dateArticle" style="display: inline">Publié
                    le: <?= date('d-m-y à H:m', strtotime($data['date'])) ?></h6>
                <?php
                if ($data['author'] === $_SESSION['user']['username'] or isset($_SESSION['modo']) or isset($_SESSION['admin'])) {
                    ?>
                    <form action="?c=home&article=<?= $data['id'] ?>" method="post" style="display: inline">
                        <input type="number" name="idArticle" value="<?= $data['id'] ?>" style="display: none">
                        <input type="submit" name="deleteArticle" value="❌" style="display: inline; border: none"
                               title="Supprimer l'article" ">
                    </form>
                    <?php
                }
                ?>
                <p class="contentArticle"><?= $data['content'] ?></p>

                <h4>Commentaires 🔻</h4>
                <form action="?c=home" method="post">
                    <input type="number" name="id" value="<?= $data['id'] ?>" style="display: none">
                    <input type="text" name="comment" placeholder="Ajouter un commentaire" style="display: inline">
                    <input type="submit" name="sendComment" value="▶" style="border: none"
                           title="Envoyer le commentaire"">
                </form>


                <?php


                $idArticle = $data['id'];
                $select = Connect::getPDO()->prepare("SELECT * FROM fpm03_comment WHERE article_fk = '$idArticle'");

                if ($select->execute()) {
                    $datas = $select->fetchAll();
                    foreach ($datas as $data) {
                        ?>
                        <div class="commentArticle">
                            <h5 class="authorComment" style="display: inline"><?= $data['username'] ?>
                                le <?= date('d-m-y à H:m', strtotime($data['date'])) ?></h5>
                            <?php
                            if ($data['username'] === $_SESSION['user']['username'] or isset($_SESSION['modo']) or isset($_SESSION['admin'])) {
                                ?>
                                <form action="?c=home&article=<?= $idArticle ?>" method="post" style="display: inline">
                                    <input type="number" name="idArticle" value="<?= $idArticle ?>"
                                           style="display: none">
                                    <input type="number" name="idComment" value="<?= $data['id'] ?>"
                                           style="display: none">
                                    <input type="submit" name="deleteComment" value="❌"
                                           style="display: inline; border: none" title="Supprimer le commentaire">
                                </form>
                                <?php
                            }
                            ?>
                            <p class="commentArticle"><?= $data['content'] ?></p>
                        </div>
                        </div>
                        <?php
                    }
                    ?>
                    </div>
                    <?php
                }
            }
            ?>

            <?php
        }
    }

    public static function addComment(string $username, string $content, int $id)
    {
        $insert = Connect::getPDO()->prepare('INSERT INTO fpm03_comment (username, content, article_fk) 
                                                    VALUES (:username, :content, :article_fk)');

        $insert->bindValue(':username', $username);
        $insert->bindValue(':content', $content);
        $insert->bindValue(':article_fk', $id, PDO::PARAM_INT);

        if ($insert->execute()) {
            $alert = [];
            $alert[] = '<div class="alert-succes">Vous avez ajouté un commentaire!</div>';
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
            }
        } else {
            $alert = [];
            $alert[] = '<div class="alert-error">L\'ajout du commentaire a échoué!</div>';
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
            }
        }
    }

    public static function deleteArticle($id)
    {
        $delete = Connect::getPDO()->prepare("DELETE FROM fpm03_articles WHERE id = '$id'");

        if ($delete->execute()) {
            $alert = [];
            $alert[] = '<div class="alert-succes">Vous avez supprimé l\'article!</div>';
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('LOCATION: ?c=home');
            }
        } else {
            $alert = [];
            $alert[] = '<div class="alert-error">Une erreur c\'est produite!</div>';
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('LOCATION: ?c=home');
            }
        }
    }

        public static function deleteComment(int $id, int $idArticle)
    {
        $delete = Connect::getPDO()->prepare("DELETE FROM fpm03_comment WHERE id = '$id'");

        if ($delete->execute()) {
            $alert = [];
            $alert[] = '<div class="alert-succes">Vous avez supprimé le commentaire!</div>';
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('LOCATION: ?c=home&article=' . $idArticle);
            }
        } else {
            $alert = [];
            $alert[] = '<div class="alert-error">Une erreur c\'est produite!</div>';
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('LOCATION: ?c=home&article=' . $idArticle);
            }
        }

    }
}