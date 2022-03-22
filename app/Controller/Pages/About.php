<?php
namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Organization;

class About extends Page {
    /**
     * Método responsável pela sobre page
     * return string
     */
    public static function getAbout(){

        $organization = new Organization();
        $content = View::render(
            "pages/about",
            ["name"=>$organization->name]
        );
        return self::getPage('Sobre', $content);
    }
}