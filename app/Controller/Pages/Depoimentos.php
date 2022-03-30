<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Depoimentos as DepoimentosModel;
use App\Utils\Utils;
use \WilliamCosta\DatabaseManager\Pagination;

class Depoimentos extends Page
{
    /**
     * Método responsável pela sobre page
     * return string
     */
    public static function getDepoimentos($request)
    {
        $content = View::render(
            "pages/depoimentos",
            ["itens" => self::getDepoimentosItens($request, $pagination)]
        );
        return self::getPage('Sobre', $content);
    }
    /**
     * Renderiza os itens de depoimento na página
     */
    private function getDepoimentosItens($request, &$pagination)
    {
        $itens = "";

        //Quantidade total de registros
        $total = DepoimentosModel::getDepoimento(null, null,null,"COUNT(*) as qtd")->fetchObject()->qtd;

        //Pagina atual
       $queryParams = $request->getQueryParams();
       $paginaAtual = $queryParams['page'] ?? 1;

       //Instancia
       $pagination = new Pagination($total, $paginaAtual,3);

        //Resultados da página
        $results = DepoimentosModel::getDepoimento(null, 'id DESC', $pagination->getLimit());

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
        return self::getDepoimentos($request);
    }
}