<?php

namespace App\Controller\Admin;

use App\Utils\View;
use App\Utils\Utils;
use App\Model\Entity\Depoimentos as DepoimentosModel;
use \WilliamCosta\DatabaseManager\Pagination;

class Testimony extends Page
{
    /**
     * Retorna os Depoimentos do Painel
     */
    public static function getTestimonies($request)
    {
        //Conteudo de Depoimentos
        $content = View::render('admin/modules/testimonies/index', [
            'itens' => self::getTestimoniesItens($request, $pagination),
            'pagination' => parent::getPagination($request, $pagination)
        ]);

        //Retorna página completa
        return parent::getPanel('Painel Administrativo | Depoimentos', $content, 'testimonies');
    }
    /**
     * Retorna formulário de cadastro
     */
    public static function getNewTestimonies($request)
    {

        //Conteudo do formulário
        $content = View::render('admin/modules/testimonies/form', [
            'title' => 'Cadastro de Depoimento',
            'autor' => '',
            'depoimento' => ''
        ]);

        //Retorna página completa
        return parent::getPanel('Painel Administrativo | Depoimentos', $content, 'testimonies');
    }
    /**
     * Cadastra depoimento
     */
    public static function setNewTestimonies($request)
    {
        //Dados
        $postVars   = $request->getPostVars();

        $depoimento = new DepoimentosModel;
        $depoimento->autor = $postVars['autor'];
        $depoimento->depoimento = $postVars['depoimento'];
        $depoimento->register();

        $request->getRouter()->redirect('/admin/depoimentos?status=created');
    }
    /**
     * Form para editar depoimento
     */
    public static function getEditTestimonies($request, $id)
    {
        $depoimento = DepoimentosModel::getDepoimentoById($id);

        if (!$depoimento instanceof DepoimentosModel) {
            $request->getRouter()->redirect('/admin/depoimentos');
        }

        //Conteudo do formulário
        $content = View::render('admin/modules/testimonies/form', [
            'title' => 'Editar Depoimento',
            'autor' => $depoimento->autor,
            'depoimento' => $depoimento->depoimento
        ]);

        //Retorna página completa
        return parent::getPanel('Painel Administrativo | Depoimentos', $content, 'testimonies');
    }
    /**
     * Editar depoimento
     */
    public static function setEditTestimonies($request, $id)
    {
        $depoimento = DepoimentosModel::getDepoimentoById($id);

        if (!$depoimento instanceof DepoimentosModel) {
            $request->getRouter()->redirect('/admin/depoimentos');
        }

        $postVars   = $request->getPostVars();

        $depoimento->autor = $postVars['autor'] ?? $depoimento->autor;
        $depoimento->depoimento = $postVars['depoimento'] ?? $depoimento->depoimento;

        $depoimento->update();

        $request->getRouter()->redirect('/admin/depoimentos?status=updated');

        //Retorna página completa
        return parent::getPanel('Painel Administrativo | Depoimentos', $content, 'testimonies');
    }
    /**
     * Renderiza os itens de depoimento na página
     */
    private function getTestimoniesItens($request, &$pagination)
    {
        $itens = "";

        //Quantidade total de registros
        $total = DepoimentosModel::getDepoimento(null, null, null, "COUNT(*) as qtd")->fetchObject()->qtd;

        //Pagina atual
        $queryParams = $request->getQueryParams();
        $paginaAtual = $queryParams['page'] ?? 1;

        //Instancia
        $pagination = new Pagination($total, $paginaAtual, 3);

        //Resultados da página
        $results = DepoimentosModel::getDepoimento(null, 'id DESC', $pagination->getLimit());

        //Renderiza o item
        while ($obDepoimentos = $results->fetchObject(DepoimentosModel::class)) {
            $itens .= View::render(
                "admin/modules/testimonies/itens",
                [
                    "autor" => $obDepoimentos->autor,
                    "depoimento" => $obDepoimentos->depoimento,
                    "data" => date("d/m/Y H:i:s", strtotime($obDepoimentos->data)),
                    "id" => $obDepoimentos->id,
                ]
            );
        }
        return $itens;
    }
}
