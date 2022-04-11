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
}
