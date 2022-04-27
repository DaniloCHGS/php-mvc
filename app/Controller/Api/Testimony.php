<?php

namespace App\Controller\Api;

use App\Model\Entity\Depoimentos as EntityTestimony;
use App\Utils\Utils;
use \WilliamCosta\DatabaseManager\Pagination;

class Testimony extends Api
{
    /**
     * Retorna os depoimentos
     */
    public static function getTestimonies($request)
    {
        return [
            'depoimentos' => self::getTestimoniesItens($request, $pagination),
            'paginacao' => parent::getPagination($request, $pagination)
        ];
    }

    /**
     * Retorna um depoimento
     */
    public static function getTestimony($request, $id)
    {
        $testimony = EntityTestimony::getTestimonyById($id);

        if (!$testimony instanceof EntityTestimony) {
            throw new \Exception("Depoimento " . $id . " não encontrado", 404);
        }
    }

    /**
     * Renderiza os itens de depoimento na página
     */
    private function getTestimoniesItens($request, &$pagination)
    {
        $itens = [];

        //Quantidade total de registros
        $total = EntityTestimony::getTestimonies(null, null, null, "COUNT(*) as qtd")->fetchObject()->qtd;

        //Pagina atual
        $queryParams = $request->getQueryParams();
        $paginaAtual = $queryParams['page'] ?? 1;

        //Instancia
        $pagination = new Pagination($total, $paginaAtual, 1);

        //Resultados da página
        $results = EntityTestimony::getTestimonies(null, 'id DESC', $pagination->getLimit());

        //Renderiza o item
        while ($obDepoimentos = $results->fetchObject(EntityTestimony::class)) {
            $itens[] = [
                "id"            => (int) $obDepoimentos->id,
                "autor"         => $obDepoimentos->autor,
                "depoimento"    => $obDepoimentos->depoimento,
                "data"          => $obDepoimentos->data
            ];
        };
        return $itens;
    }
}
