<?php
namespace App\Controller\Pages;

use \App\Utils\View;

class Page {
    /**
     * Método responsável pela home page
     * return string
     */
    public static function getPage($title = "Tática", $content){
        return View::render("pages/page", ["title"=>$title, "content"=>$content]);
    }
}