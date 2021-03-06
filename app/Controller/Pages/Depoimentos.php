<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Depoimentos as DepoimentosModel;
use \WilliamCosta\DatabaseManager\Pagination;

class Depoimentos extends Page
{
    /**
     * Renderiza os itens de depoimento na página
     */
    private function getTestimoniessItens($request, &$pagination)
    {
        $itens = "";

        //Quantidade total de registros
        $total = DepoimentosModel::getTestimonies(null, null, null, "COUNT(*) as qtd")->fetchObject()->qtd;

        //Pagina atual
        $queryParams = $request->getQueryParams();
        $paginaAtual = $queryParams['page'] ?? 1;

        //Instancia
        $pagination = new Pagination($total, $paginaAtual, 3);

        //Resultados da página
        $results = DepoimentosModel::getTestimonies(null, 'id DESC', $pagination->getLimit());

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
     * Método responsável pela sobre page
     * return string
     */
    public static function getTestimoniess($request)
    {
        $content = View::render(
            "pages/depoimentos",[
            "itens" => self::getTestimoniessItens($request, $pagination),
            "pagination" => parent::getPagination($request, $pagination)
        ]);
        return self::getPage('Sobre', $content);
    }

    /**
     * @param Request $request
     */
    public function insert($request)
    {
        $postVars = $request->getPostVars();

        $depoimento = new DepoimentosModel;

        $depoimento->autor = $postVars['autor'];
        $depoimento->depoimento = $postVars['depoimento'];
        $depoimento->register();
        return self::getTestimoniess($request);
    }
}
