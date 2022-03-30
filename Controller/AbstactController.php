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


}