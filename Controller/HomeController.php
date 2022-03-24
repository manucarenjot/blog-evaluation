<?php
class HomeController extends AbstactController

{

    public function index()
    {
        $this->render('public/home');
    }
}