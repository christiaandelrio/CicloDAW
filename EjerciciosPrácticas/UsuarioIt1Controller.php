<?php

namespace Dondis\controllers;

use Dondis\views\UsuarioIt1View;
use Dondisfraz\Base\controller\BaseController;

class UsuarioIt1Controller extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->log->setFileLogName("UsuarioIt1.log");
    }

    public function indexAction()
    {

        $this->listAction();

    }

    public function chrisAction()
    {
        $this->listAction();
    }

    public function listAction()
    {
        $view = new UsuarioIt1View();
        echo $view->indexHtml();
    }
}
