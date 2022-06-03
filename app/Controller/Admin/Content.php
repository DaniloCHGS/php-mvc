<?php

namespace App\Controller\Admin;

use App\Utils\View;
use App\Utils\Utils;
use App\Model\Entity\AccessArea as EntityAccess;
use App\Model\Entity\Files as EntityFiles;
use \WilliamCosta\DatabaseManager\Pagination;
use App\Utils\Historic;

class Content extends Page
{
    /**
     * Mensagem de status
     */
    private static function getStatus($request)
    {
        $queryParams = $request->getQueryParams();

        if (!isset($queryParams['status'])) return '';

        switch ($queryParams['status']) {
            case 'created':
                return Alert::getSuccess('Área de Acesso criada com sucesso');
                break;
            case 'updated':
                return Alert::getSuccess('Área de Acesso atualizada com sucesso');
                break;
            case 'deleted':
                return Alert::getSuccess('Área de Acesso excluida com sucesso');
                break;
        }
    }

    /**
     * Retorna os accesss do Painel
     */
    public static function index($request)
    {
        //Conteudo de accesss
        $content = View::render('admin/modules/content/index', [
            'title' => 'Conteúdo',
            'itens' => self::getFilesItens($request, $pagination),
            'pagination' => parent::getPagination($request, $pagination),
            'status' => self::getStatus($request)
        ]);

        //Retorna página completa
        return parent::getPanel('Boss - Conteúdo', $content, 'content');
    }

    /**
     * Renderiza os itens de access na página
     */
    private function getFilesItens($request, &$pagination)
    {
        $itens = "";

        //Quantidade total de registros
        $total = EntityFiles::getFiles(null, null, null, "COUNT(*) as qtd")->fetchObject()->qtd;

        //Pagina atual
        $queryParams = $request->getQueryParams();
        $paginaAtual = $queryParams['page'] ?? 1;

        //Instancia
        $pagination = new Pagination($total, $paginaAtual, 3);

        //Resultados da página
        $results = EntityFiles::getFiles(null, 'id DESC', $pagination->getLimit());

        //Renderiza o item
        while ($files = $results->fetchObject(EntityFiles::class)) {
            $itens .= View::render(
                "admin/modules/content/itens",
                [
                    "id" => $files->id,
                    "file" => $files->file,
                    "web_file" => $files->web_file,
                ]
            );
        }
        return $itens;
    }
}