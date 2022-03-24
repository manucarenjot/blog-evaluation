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

    public function getPost(): bool {
        return isset($_POST['send']);
    }
    public function getDelete(): bool {
        return isset($_POST['delete']);
    }
}