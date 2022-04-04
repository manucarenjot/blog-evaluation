<?php

abstract class AbstactController
{
    abstract public function index();

    public function render($page)
    {
        ob_start();
        require __DIR__ . '/../View/' . $page . '.html.php';
    }


    public function notSessionActivate()
    {
        if (!isset($_SESSION['admin'])) {
            header('LOCATION: ?c=connect&a=login');
        }
    }

    public function getPost(): bool
    {
        return isset($_POST['send']);
    }

    public function getPostComment(): bool
    {
        return isset($_POST['sendComment']);
    }

    public function getDelete(): bool
    {
        return isset($_POST['delete']);
    }

    public function getDeleteBanned(): bool
    {
        return isset($_POST['deleteBanned']);
    }

    public function deleteArticle(): bool
    {
        return isset($_POST['deleteArticle']);
    }
    public function deleteComment(): bool
    {
        return isset($_POST['deleteComment']);
    }

    public function getBanned(): bool
    {
        return isset($_POST['banned']);
    }

    public function getModo(): bool
    {
        return isset($_POST['addModo']);
    }

    public function validateMail() {
        $comb = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array();
        $combLen = strlen($comb) - 1;
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $combLen);
            $pass[] = $comb[$n];
        }
        $pass = implode($pass);
        $_SESSION['codeValidate'] = $pass;
        $destinataire = $_SESSION['user']['mail'];
        $sujet = "Activer votre compte" ;
        $entete = "From: blog@world-of-sapologie.com" ;
        $message = 'Ceci est un mail automatique, Merci de ne pas y répondre.
---------------
Bienvenue sur notre Site,
Pour activer votre compte, veuillez cliquer sur le lien ci dessous
ou copier/coller dans votre navigateur internet.
http://localhost/?c=validation&'.$pass.'&'.$_SESSION['user']['username'];
        mail($destinataire, $sujet, $message, $entete);
    }
}