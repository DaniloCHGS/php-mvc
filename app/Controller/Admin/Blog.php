<?php

namespace App\Controller\Admin;

use App\Utils\View;
use App\Utils\Utils;
use App\Model\Entity\Article as EntityArticle;
use \WilliamCosta\DatabaseManager\Pagination;

class Blog extends Page
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
                return Alert::getSuccess('Artigo criado com sucesso');
                break;
            case 'updated':
                return Alert::getSuccess('Artigo atualizado com sucesso');
                break;
            case 'deleted':
                return Alert::getSuccess('Artigo excluido com sucesso');
                break;
        }
    }

    /**
     * Retorna os Depoimentos do Painel
     */
    public static function index($request)
    {
        //Conteudo de Depoimentos
        $content = View::render('admin/modules/blog/index', [
            'itens' => self::getTestimoniesItens($request, $pagination),
            'pagination' => parent::getPagination($request, $pagination),
            'status' => self::getStatus($request)
        ]);

        //Retorna página completa
        return parent::getPanel('Boss - Blog', $content, 'blog');
    }

    /**
     * Retorna formulário de cadastro
     */
    public static function getNewArticle($request)
    {

        //Conteudo do formulário
        $content = View::render('admin/modules/blog/form', [
            'title' => 'Cadastro de Artigo',
            'autor' => '',
            'depoimento' => '',
            'status' => ''
        ]);

        //Retorna página completa
        return parent::getPanel('Boss - Blog', $content, 'blog');
    }

    /**
     * Cadastra depoimento
     */
    public static function setNewArticle($request)
    {
        //Dados
        $postVars   = $request->getPostVars();

        $depoimento = new EntityArticle;
        $depoimento->autor = $postVars['autor'];
        $depoimento->depoimento = $postVars['depoimento'];
        $depoimento->register();

        $request->getRouter()->redirect('/admin/blog/' . $depoimento->id . '/edit?status=created');
    }

    /**
     * Form para editar depoimento
     */
    public static function getEditTestimonies($request, $id)
    {
        $depoimento = EntityArticle::getTestimonyById($id);

        if (!$depoimento instanceof EntityArticle) {
            $request->getRouter()->redirect('/admin/depoimentos');
        }

        //Conteudo do formulário
        $content = View::render('admin/modules/testimonies/form', [
            'title' => 'Editar Depoimento',
            'autor' => $depoimento->autor,
            'depoimento' => $depoimento->depoimento,
            'status' => self::getStatus($request)
        ]);

        //Retorna página completa
        return parent::getPanel('Boss - Depoimentos', $content, 'testimonies');
    }

    /**
     * Editar depoimento
     */
    public static function setEditTestimonies($request, $id)
    {
        $depoimento = EntityArticle::getTestimonyById($id);

        if (!$depoimento instanceof EntityArticle) {
            $request->getRouter()->redirect('/admin/depoimentos');
        }

        $postVars   = $request->getPostVars();

        $depoimento->autor = $postVars['autor'] ?? $depoimento->autor;
        $depoimento->depoimento = $postVars['depoimento'] ?? $depoimento->depoimento;

        $depoimento->update();

        $request->getRouter()->redirect('/admin/depoimentos/' . $depoimento->id . '/edit?status=updated');
    }

    /**
     * Tela de deletar um depoimento 
     */
    public static function getDeleteTestimonies($request, $id)
    {
        $depoimento = EntityArticle::getTestimonyById($id);

        if (!$depoimento instanceof EntityArticle) {
            $request->getRouter()->redirect('/admin/depoimentos');
        }

        //Conteudo do formulário
        $content = View::render('admin/modules/testimonies/delete', [
            'title' => 'Excluir Depoimento',
            'autor' => $depoimento->autor,
            'depoimento' => $depoimento->depoimento,
        ]);

        //Retorna página completa
        return parent::getPanel('Boss - Depoimentos', $content, 'testimonies');
    }

    /**
     * Deletar depoimento
     */
    public static function setDeleteTestimonies($request, $id)
    {
        $depoimento = EntityArticle::getTestimonyById($id);

        if (!$depoimento instanceof EntityArticle) {
            $request->getRouter()->redirect('/admin/depoimentos');
        }

        $depoimento->delete();

        $request->getRouter()->redirect('/admin/depoimentos?status=deleted');
    }

    /**
     * Renderiza os itens de depoimento na página
     */
    private function getTestimoniesItens($request, &$pagination)
    {
        $itens = "";

        //Quantidade total de registros
        $total = EntityArticle::getTestimonies(null, null, null, "COUNT(*) as qtd")->fetchObject()->qtd;

        //Pagina atual
        $queryParams = $request->getQueryParams();
        $paginaAtual = $queryParams['page'] ?? 1;

        //Instancia
        $pagination = new Pagination($total, $paginaAtual, 3);

        //Resultados da página
        $results = EntityArticle::getTestimonies(null, 'id DESC', $pagination->getLimit());

        //Renderiza o item
        while ($obDepoimentos = $results->fetchObject(EntityArticle::class)) {
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
