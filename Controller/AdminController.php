<?php
class AdminController  extends AbstactController {

    public function index()
    {
        $this->render('admin/espace-admin');
    }

    public function addRole()
    {
        $this->render('admin/addRole');
    }
}