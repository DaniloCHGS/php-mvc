<?php

namespace App\Controller\Admin;

use App\Utils\View;
use App\Utils\Utils;

class Home extends Page
{
    /**
     * Retorna a Home do Painel
     */
    public static function getHome($request){
        //Conteudo da Home
        $content = View::render('admin/modules/home/index');

        //Retorna página completa
        return parent::getPanel('Painel Administrativo | Home', $content, 'home');
    }
}
