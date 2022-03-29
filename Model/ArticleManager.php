<?php

use App\Connect\Connect;

class ArticleManager
{
    public static function addArticle(string $author, string $title, string $content)
    {
        $insert = Connect::getPDO()->prepare("INSERT INTO fpm03_articles (author, title, content, date) 
                                                    VALUES ('$author','$title', '$content', NOW()) ");

        if ($insert->execute()) {
            $alert = [];
            $alert[] = '<div class="alert-succes">Vous avez ajouté un article!</div>';
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
            }
        } else {
            $alert = [];
            $alert[] = '<div class="alert-error">L\'ajout de l\'article a échoué!</div>';
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
            }
        }
    }

    public static function getArticle()
    {
        $select = Connect::getPDO()->prepare("SELECT * FROM fpm03_articles");

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
                <form action="?c=home" method="post" style="display: inline">
                    <input type="submit" name="delete" value="🗑️" style="display: inline">
                </form>
                <p class="contentArticle"><?= $data['content'] ?></p>


                <form action="?c=home" method="post">
                    <input type="number" name="id" value="<?= $data['id'] ?>" style="display: none">
                    <input type="text" name="comment" placeholder="Ajouter un commentaire" style="display: inline">
                    <input type="submit" name="sendComment" value="▶">
                </form>
                <a href="?c=home&comment=<?= $data['id'] ?>">Voir les commentaire 🔻</a>

                <?php

                if (isset($_GET['comment'])) {
                    $idArticle = $data['id'];
                $select = Connect::getPDO()->prepare("SELECT * FROM fpm03_comment WHERE article_fk = '$idArticle'");

                if ($select->execute()) {
                    $datas = $select->fetchAll();
                    foreach ($datas as $data) {
                        ?>
                        <div class="commentArticle">
                            <h5 class="authorComment"><?= $data['username'] ?>
                                le <?= date('d-m-y à H:m', strtotime($data['date'])) ?></h5>
                            <p class="commentArticle"><?= $data['content'] ?></p>
                        </div>
                        </div>
                        <?php
                    }
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
        $insert = Connect::getPDO()->prepare("INSERT INTO fpm03_comment (username, content, article_fk) 
                                                    VALUES ('$username', '$content', '$id')");

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



}