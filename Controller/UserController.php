<?php
class UserController extends AbstactController
{

    public function index()
    {
        $this->render('user/profil');
    }
    public function register()
    {
        $this->render('user/register');
        if ($this->getPost()) {
            $username = trim(strip_tags($_POST['username']));
            $mail = trim(strip_tags(($_POST['mail'])));
            $password = trim(strip_tags($_POST['password']));
            $passwordRepeat = trim(strip_tags($_POST['password-repeat']));
            $alert = [];

            if (empty($username)) {
                $alert[] = 'Un des champs est vide';
            }
            if (empty($mail)) {
                $alert[] = 'Un des champs est vide';
            }
            if (empty($password)) {
                $alert[] = 'Un des champs est vide';
            }
            if (empty($passwordRepeat)) {
                $alert[] = 'Un des champs est vide';
            }
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('LOCATION: ?c=user&a=register');
            }
        }

    }

    public function login()
    {
        $this->render('user/login');
    }

    public function logout()
    {
        $this->render('user/logout');
    }

}