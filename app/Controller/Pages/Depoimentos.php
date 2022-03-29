<?php
namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Depoimentos as DepoimentosModel;
use App\Utils\Utils;

class Depoimentos extends Page {
    /**
     * Método responsável pela sobre page
     * return string
     */
    public static function getDepoimentos(){

        $content = View::render(
            "pages/depoimentos",
            ["autor"=>"Danilo", "depoimento"=>"Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores rerum vel, reprehenderit necessitatibus in quae distinctio dolor nam temporibus itaque dolorem illo esse impedit odio, quibusdam alias consectetur! Eligendi, quam."]
        );
        return self::getPage('Sobre', $content);
    }

    /**
     * @param Request
     */
    public function insert($request){
        $postVars = $request->getPostVars();

        $depoimento = new DepoimentosModel;

        $depoimento->autor = $postVars['autor'];
        $depoimento->depoimento = $postVars['depoimento'];
        $depoimento->register();
        return self::getDepoimentos();
    }
}