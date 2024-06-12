<?php

namespace src\controllers;

use src\core\View;

class SiteController
{
    private View $view;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function index(): void
    {
        $this->view->render('index.php');
    }

    // 404 page
    public function notFound(): void
    {
        $this->view->renderNotFound();
    }
}