<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Depoimentos as DepoimentosModel;
use App\Utils\Utils;

class Depoimentos extends Page
{
    /**
     * Método responsável pela sobre page
     * return string
     */
    public static function getDepoimentos()
    {

        $content = View::render(
            "pages/depoimentos",
            ["itens" => self::getDepoimentosItens()]
        );
        return self::getPage('Sobre', $content);
    }
    /**
     * Renderiza os itens de depoimento na página
     */
    private function getDepoimentosItens()
    {
        $itens = "";

        //Resultados da página
        $results = DepoimentosModel::getDepoimento(null, 'id DESC');

        //Renderiza o item
        while ($obDepoimentos = $results->fetchObject(DepoimentosModel::class)) {
            $itens .= View::render(
                "pages/depoimento/item",
                [
                    "autor" => $obDepoimentos->autor,
                    "depoimento" => $obDepoimentos->depoimento,
                    "data" => date("d/m/Y H:i:s", strtotime($obDepoimentos->data))
                ]
            );
        }
        return $itens;
    }

    /**
     * @param Request
     */
    public function insert($request)
    {
        $postVars = $request->getPostVars();

        $depoimento = new DepoimentosModel;

        $depoimento->autor = $postVars['autor'];
        $depoimento->depoimento = $postVars['depoimento'];
        $depoimento->register();
        return self::getDepoimentos();
    }
}