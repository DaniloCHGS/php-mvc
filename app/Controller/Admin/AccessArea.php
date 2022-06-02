<?php

namespace App\Controller\Admin;

use App\Utils\View;
use App\Utils\Utils;
use App\Model\Entity\AccessArea as EntityAccess;
use \WilliamCosta\DatabaseManager\Pagination;
use App\Utils\Historic;

class AccessArea extends Page
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
        $content = View::render('admin/modules/access/index', [
            'title' => 'Área de Acesso',
            'itens' => self::getAccessItens($request, $pagination),
            'pagination' => parent::getPagination($request, $pagination),
            'status' => self::getStatus($request)
        ]);

        //Retorna página completa
        return parent::getPanel('Boss - Área de Acesso', $content, 'access_area');
    }

    /**
     * Retorna formulário de cadastro
     */
    public static function getNewAccessArea($request)
    {
        //Conteudo do formulário
        $content = View::render('admin/modules/access/form', [
            'title' => 'Cadastro de Área de Acesso',
            'access' => '',
            'status' => '',
            'uri' => '',
            'admin' => ''
        ]);

        //Retorna página completa
        return parent::getPanel('Boss - Área de Acesso', $content, 'access_area');
    }

    /**
     * Cadastra access
     */
    public static function setNewAccessArea($request)
    {
        //Dados
        $postVars   = $request->getPostVars();

        $access = new EntityAccess;
        $access->access = $postVars['access'];
        $access->uri = $postVars['uri'];
        $access->admin = $postVars['admin'];
        $access->register();

        $historic = new Historic;
        $historic->user_id = $_SESSION['admin']['user']['id'];
        $historic->action = "Inseriu uma nova Área de Acesso: " . $access->access;
        $historic->createHistoric();

        $request->getRouter()->redirect('/admin/area-de-acesso/' . $access->id . '/edit?status=created');
    }

    /**
     * Form para editar access
     */
    public static function getEditAccessArea($request, $id)
    {
        $access = EntityAccess::getAccessAreaById($id);

        if (!$access instanceof EntityAccess) {
            $request->getRouter()->redirect('/admin/area-de-acesso');
        }

        //Conteudo do formulário
        $content = View::render('admin/modules/access/form', [
            'title' => 'Editar Acesso',
            'status' => self::getStatus($request),
            'access' => $access->access,
            'uri' => $access->uri,
            'admin' => $access->admin
        ]);

        //Retorna página completa
        return parent::getPanel('Boss - Área de Acesso', $content, 'access_area');
    }

    /**
     * Editar access
     */
    public static function setEditAccessArea($request, $id)
    {
        $access = EntityAccess::getAccessAreaById($id);

        if (!$access instanceof EntityAccess) {
            $request->getRouter()->redirect('/admin/area-de-acesso');
        }

        $postVars   = $request->getPostVars();

        $access->access = $postVars['access'] ?? $access->access;
        $access->uri = $postVars['uri'] ?? $access->uri;
        $access->admin = $postVars['admin'] ?? $access->admin;

        $access->update();

        $historic = new Historic;
        $historic->user_id = $_SESSION['admin']['user']['id'];
        $historic->action = "Atualizou uma Área de Acesso: " . $access->access;
        $historic->createHistoric();

        $request->getRouter()->redirect('/admin/area-de-acesso/' . $access->id . '/edit?status=updated');
    }

    /**
     * Tela de deletar um access 
     */
    public static function getDeleteAccessArea($request, $id)
    {
        $access = EntityAccess::getAccessAreaById($id);

        if (!$access instanceof EntityAccess) {
            $request->getRouter()->redirect('/admin/area-de-acesso');
        }

        //Conteudo do formulário
        $content = View::render('admin/modules/access/delete', [
            'title' => 'Excluir access',
            'access' => $access->access
        ]);

        //Retorna página completa
        return parent::getPanel('Boss - Área de Acesso', $content, 'access_area');
    }

    /**
     * Deletar access
     */
    public static function setDeleteAccessArea($request, $id)
    {
        $access = EntityAccess::getAccessAreaById($id);

        if (!$access instanceof EntityAccess) {
            $request->getRouter()->redirect('/admin/area-de-acesso');
        }

        $access->delete();

        $historic = new Historic;
        $historic->user_id = $_SESSION['admin']['user']['id'];
        $historic->action = "Excluiu uma Área de Acesso: " . $access->access;
        $historic->createHistoric();

        $request->getRouter()->redirect('/admin/area-de-acesso?status=deleted');
    }

    /**
     * Renderiza os itens de access na página
     */
    private function getAccessItens($request, &$pagination)
    {
        $itens = "";

        //Quantidade total de registros
        $total = EntityAccess::getAccess(null, null, null, "COUNT(*) as qtd")->fetchObject()->qtd;

        //Pagina atual
        $queryParams = $request->getQueryParams();
        $paginaAtual = $queryParams['page'] ?? 1;

        //Instancia
        $pagination = new Pagination($total, $paginaAtual, 3);

        //Resultados da página
        $results = EntityAccess::getAccess(null, 'id DESC', $pagination->getLimit());

        //Renderiza o item
        while ($access_area = $results->fetchObject(EntityAccess::class)) {
            $itens .= View::render(
                "admin/modules/access/itens",
                [
                    "id" => $access_area->id,
                    "access" => $access_area->access,
                    "uri" => $access_area->uri,
                    "admin" => Utils::typeUser($access_area->admin)
                ]
            );
        }
        return $itens;
    }
}
