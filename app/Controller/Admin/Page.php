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
     * Retorna a estrutura do painel com conteudo dinamico
     */
    public static function getPanel($title, $content, $currentModule)
    {
        //Retorna a página renderizada
        return self::getPage($title,$content);
    }
}
