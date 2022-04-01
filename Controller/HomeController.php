<?php
class HomeController extends AbstactController

{

    public function index()
    {
        $this->render('public/home');

        if ($this->deleteComment()) {
            $id = $_POST['idComment'];
            $idArticle = $_POST['idArticle'];
            ArticleManager::deleteComment($id, $idArticle);
        }
        if ($this->deleteArticle()) {
            $id = $_POST['idArticle'];
            ArticleManager::deleteArticle($id);
        }
        ArticleManager::getNameArticle();

        if ($this->getPostComment()) {
            $username = $_SESSION['user']['username'];
            $comment = strip_tags($_POST['comment']);
            $id = $_POST['id'];



            $alert = [];
            if (empty($username)) {
                $alert[] = '<div class="alert-error">Un des champs est vide</div>';
            }
            if (empty($comment)) {
                $alert[] = '<div class="alert-error">Un des champs est vide</div>';
            }
            if (empty($id)) {
                $alert[] = '<div class="alert-error">Un des champs est vide</div>';
            }


            if (strlen($username) <= 2 || strlen($username) >= 255) {
                $alert[] = '<div class="alert-error">Vous devez être connecté pour écrire un commentaire !</div>';
            }

            if (strlen($comment) <= 1 || strlen($comment) >= 255) {
                $alert[] = '<div class="alert-error">Votre commentaire doit contenir entre 2 et 255 caractères !</div>';
            }

            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('LOCATION: ?c=home&article='.$id);
            }

            else {
                ArticleManager::addComment($username, $comment, $id);
                $alert[] = '<div class="alert-succes">Votre commentaire a été publié</div>';
                if (count($alert) > 0) {
                    $_SESSION['alert'] = $alert;
                    header('LOCATION: ?c=home&article='.$id);
                }
            }
        }
    }

    public function getRole() {
        $this->render('user/role');
        if (isset($_SESSION['user'])) {
            $alert = [];
            ModoManager::getModo();
            AdminManager::getAdmin();

            $alert[] = '<div class="alert-succes">Vous êtes connecté ! '.ucfirst($_SESSION['user']["username"]).'</div>';
            if(count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('LOCATION: ?c=home');
            }
        }
    }

    public function addArticle()
    {
        $this->render('articles/addArticle');
        if ($this->getPost()) {
            $title = strip_tags($_POST['title']);
            $contenu = strip_tags($_POST['content']);
            $author = strip_tags($_POST['author']);
            $alert = [];

            if (empty($title)) {
                $alert[] = '<div class="alert-error">Un des champs est vide</div>';
            }
            if (empty($contenu)) {
                $alert[] = '<div class="alert-error">Un des champs est vide</div>';
            }
            if (empty($author)) {
                $alert[] = '<div class="alert-error">Un des champs est vide</div>';
            }
            if (strlen($title) <= 5 || strlen($title) >= 255) {
                $alert[] = '<div class="alert-error">Le titre doit contenir entre 5 et 255 caractères !</div>';
            }
            if (strlen($contenu) <= 10) {
                $alert[] = '<div class="alert-error">Le contenu de l\'article doit contenir au minimum 10 caractères !</div>';
            }
            if (strlen($author) <= 2 || strlen($author) >= 255) {
                $alert[] = '<div class="alert-error">Vous devez être connecté pour écrire un article !</div>';
            }

            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('LOCATION: ?c=home&a=add-article');
            }

            else {
                ArticleManager::addArticle($author, $title, $contenu);

            }
        }
    }

    public function youBanned() {
        $this->render('public/bann');
    }
}