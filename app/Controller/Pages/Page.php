<?php

namespace App\Controller\Pages;

use \App\Utils\View;

class Page
{
    /**
     * Método responsável pela home page
     * return string
     */
    public static function getPage($title = "Tática", $content)
    {
        return View::render("pages/page", ["title" => $title, "content" => $content]);
    }

    /**
     * Renderiza o layout de paginação
     */
    public static function getPagination($request, $pagination)
    {
        //Pagina
        $pages = $pagination->getPages();
        
        //Verifica quantidade de páginas
        if (count($pages) <= 1) {return "";}

        //links
        $links = "";

        //URL atual (Sem GETS)
        $url = $request->getRouter()->getCurrentUrl();

        //GET
        $queryParams = $request->getQueryParams();

        //Renderiza os links
        foreach ($pages as $page) {
            //Altera página
            $queryParams['page'] = $page['page'];
            
            //Link
            $link = $url . "?" . http_build_query($queryParams);
            
            //View
            $links .= View::render("pages/pagination/link", [
                "page" => $page['page'],
                "link" => $link,
                "active"=> $page['current'] ? 'active' : ''
            ]);
        }
        //Renderiza box
        return View::render("pages/pagination/box", [
            "links" => $links
        ]);
    }
}
