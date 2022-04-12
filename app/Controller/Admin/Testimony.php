<?php

namespace App\Controller\Admin;

use App\Utils\View;
use App\Utils\Utils;
use App\Model\Entity\Depoimentos as DepoimentosModel;

class Testimony extends Page
{
    /**
     * Retorna os Depoimentos do Painel
     */
    public static function getTestimonies($request)
    {
        //Conteudo de Depoimentos
        $content = View::render('admin/modules/testimonies/index');

        //Retorna página completa
        return parent::getPanel('Painel Administrativo | Depoimentos', $content, 'testimonies');
    }
}
