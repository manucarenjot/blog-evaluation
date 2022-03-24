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