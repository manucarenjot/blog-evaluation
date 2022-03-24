<?php
class ArticleController extends AbstactController
{


        public function index()
    {
        $this->render('articles/article');
    }

    public function addArticle()
    {
        $this->render('articles/addArticle');
    }
}