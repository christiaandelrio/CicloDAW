<?php

namespace Dondis\views;

use Dondisfraz\Base\views\BaseView;

class ContabilidadView extends BaseView
{
    public function __construct()
    {
        parent::__construct();
        $this->setViewPath("contabilidad");
        $this->log->setFileLogName("contabilidad.log");
    }


    public function indexHtml()
    {

        $template = $this->template_render("Contabilidad.phtml");

        return $template;
    }

}