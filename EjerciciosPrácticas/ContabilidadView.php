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

        $appUrl_base = $this->ini['app_url_base'];

        $template = $this->template_render("Contabilidad.phtml",['app.url_base'=>$appUrl_base]);

        return $template;
    }

}