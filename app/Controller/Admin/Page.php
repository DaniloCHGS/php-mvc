<?php

namespace App\Controller\Admin;

use App\Utils\View;

class Page
{
    /**
     * Retorna o conteudo (view) da estrutura principal do painel
     */
    public static function getPage($title, $content)
    {
        return View::render("admin/page", [
            'title'     => $title,
            'content'   => $content
        ]);
    }
    /**
     * Renderiza o menu
     */
    private static function getMenu($currentModule){
        //Retorna renderização do menu
        return View::render("admin/menu/box", []);
    }
    /**
     * Retorna a estrutura do painel com conteudo dinamico
     */
    public static function getPanel($title, $content, $currentModule)
    {
        //Renderiza a view do painel
        $contentPanel = View::render('admin/panel', [
            'menu'=> self::getMenu($currentModule),
            'content' => $content
        ]);
        //Retorna a página renderizada
        return self::getPage($title,$contentPanel);
    }
}
