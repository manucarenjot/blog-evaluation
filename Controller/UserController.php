<?php
class UserController extends AbstactController
{

    public function index()
    {
        $this->render('user/profil');
    }

    public function inscriptionConnect()
    {
        $this->render('user/connect&inscription');
    }

}