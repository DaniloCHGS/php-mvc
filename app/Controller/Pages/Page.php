<?php
namespace App\Controller\Pages;

use \App\Utils\View;

class Page {
    /**
     * Método responsável pela home page
     * return string
     */
    public static function getPage($content, $title = "Tática"){
        return View::render("pages/page", ["title"=>$title, "content"=>$content]);
    }
}