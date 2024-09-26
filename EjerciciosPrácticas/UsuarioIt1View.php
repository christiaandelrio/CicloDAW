<?php

namespace Dondis\views;

use Dondisfraz\Base\views\BaseView;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class UsuarioIt1View extends BaseView
{
    public function __construct()
    {
        parent::__construct();
        $loader = new FilesystemLoader('/var/www/html/templates/');
    }

    public function indexHtml()
    {
        $nombre= 'Patricia';
        $contenido = '<p>Lorem ipsum dolor sit amet, consectetur
                         çadipiscing elit. Phasellus elementum.
                      </p>';

        $template = $this->render("usuarioIt1/UsuarioIt1.phtml",['nombre'=>$nombre,'contenido'=>$contenido]);
        return $template;
    }

}