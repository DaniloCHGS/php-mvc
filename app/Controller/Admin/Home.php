<?php

namespace App\Controller\Admin;

use App\Utils\Historic;
use App\Utils\View;
use App\Utils\Utils;

class Home extends Page
{
    /**
     * Mensagem de status
     */
    private static function getStatus($request)
    {
        $queryParams = $request->getQueryParams();

        if (!isset($queryParams['status'])) return '';

        switch ($queryParams['status']) {
            case 'denied':
                return Alert::getError('Acesso negado');
                break;
        }
    }
    /**
     * Retorna a Home do Painel
     */
    public static function getHome($request){
        
        //Conteudo da Home
        $content = View::render('admin/modules/home/index', [
            'status' => self::getStatus($request),
            'historic' => Historic::getHistoric(),
            'user' => $_SESSION['admin']['user']['name']
        ]);

        //Retorna página completa
        return parent::getPanel('Painel Administrativo | Home', $content, 'home');
    }
    /**
     * Retorna 404
     */
    public static function get404($request){
        //Conteudo da Home
        $content = View::render('admin/modules/home/404');

        //Retorna página completa
        return parent::getPanel('Painel Administrativo | 404', $content, '');
    }
    /**
     * Retorna 500
     */
    public static function get500($request){
        //Conteudo da Home
        $content = View::render('admin/modules/home/500');

        //Retorna página completa
        return parent::getPanel('Painel Administrativo | 500', $content, '');
    }
}
