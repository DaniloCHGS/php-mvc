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
        if (!is_numeric($id)) {
            throw new \Exception("O id '" . $id . "' não é válido", 400);
        }

        $testimony = EntityTestimony::getTestimonyById($id);

        if (!$testimony instanceof EntityTestimony) {
            throw new \Exception("Depoimento '" . $id . "' não encontrado", 404);
        }
        //Retorna os detalhes do depoimento
        return [
            "id"            => (int) $testimony->id,
            "autor"         => $testimony->autor,
            "depoimento"    => $testimony->depoimento,
            "data"          => $testimony->data
        ];
    }

    /**
     * Cadastra novo depoimento
     */
    public static function setNewTestimony($request)
    {
        $postVars   = $request->getPostVars();

        //Valida os campos obrigatorios
        if (!isset($postVars['autor']) or !isset($postVars['depoimento'])) {
            throw new \Exception("Os campos nome e mensagem são obrigatorios", 400);
        }

        $testimony = new EntityTestimony;
        $testimony->autor = $postVars['autor'];
        $testimony->depoimento = $postVars['depoimento'];
        $testimony->register();

        return [
            'success' => true
        ];
    }

    /**
     * Editar depoimento
     */
    public static function setEditTestimony($request, $id)
    {
        $postVars   = $request->getPostVars();

        //Valida os campos obrigatorios
        if (!isset($postVars['autor']) or !isset($postVars['depoimento'])) {
            throw new \Exception("Os campos nome e mensagem são obrigatorios", 400);
        }

        $testimony = EntityTestimony::getTestimonyById($id);

        if (!$testimony instanceof EntityTestimony) {
            throw new \Exception("Depoimento '" . $id . "' não encontrado", 404);
        }

        $testimony->autor = $postVars['autor'] ?? $testimony->autor;
        $testimony->depoimento = $postVars['depoimento'] ?? $testimony->depoimento;
        $testimony->update();

        return [
            'id' => $testimony->id,
            'autor' => $testimony->autor,
            'depoimento' => $testimony->depoimento,
        ];
    }

    /**
     * Exclui depoimento
     */
    public static function setDeleteTestimony($request, $id)
    {

        $testimony = EntityTestimony::getTestimonyById($id);

        if (!$testimony instanceof EntityTestimony) {
            throw new \Exception("Depoimento '" . $id . "' não encontrado", 404);
        }
        $testimony->delete();

        return [
            'success' => true
        ];
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
        $pagination = new Pagination($total, $paginaAtual, $total);

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
