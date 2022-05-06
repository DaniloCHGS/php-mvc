<?php

namespace App\Controller\Admin;

use App\Utils\View;
use App\Utils\Utils;
use App\Model\Entity\User as EntityUser;
use \WilliamCosta\DatabaseManager\Pagination;

class Users extends Page
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
                return Alert::getSuccess('Usuário criado com sucesso');
                break;
            case 'updated':
                return Alert::getSuccess('Usuário atualizado com sucesso');
                break;
            case 'deleted':
                return Alert::getSuccess('Usuário excluido com sucesso');
                break;
            case 'duplicated':
                return Alert::getError('Email sendo utilizado');
                break;
        }
    }

    /**
     * Retorna os Usuários do Painel
     */
    public static function getUsers($request)
    {
        //Conteudo de Usuários
        $content = View::render('admin/modules/users/index', [
            'itens' => self::getUserItens($request, $pagination),
            'pagination' => parent::getPagination($request, $pagination),
            'status' => self::getStatus($request)
        ]);

        //Retorna página completa
        return parent::getPanel('Painel Administrativo | Usuários', $content, 'users');
    }

    /**
     * Retorna formulário de cadastro
     */
    public static function getNewUser($request)
    {
        //Conteudo do formulário
        $content = View::render('admin/modules/users/form', [
            'title' => 'Cadastro de Usuário',
            'status' => self::getStatus($request),
            'email' => '',
            'username' => ''
        ]);

        //Retorna página completa
        return parent::getPanel('Painel Administrativo | Usuários', $content, 'users');
    }

    /**
     * Cadastra depoimento
     */
    public static function setNewUser($request)
    {
        //Dados
        $postVars   = $request->getPostVars();

        $email      = $postVars['email'] ?? '';
        $password   = $postVars['password'] ?? '';

        $hasUser = EntityUser::getUserByEmail($email);

        if ($hasUser instanceof EntityUser) {
            $request->getRouter()->redirect('/admin/usuarios/new?status=duplicated');
        }

        $user = new EntityUser;
        $user->email    = $email;
        $user->password = password_hash($password, PASSWORD_DEFAULT);
        $user->permission = $postVars['permission'];
        $user->access_area = $postVars['access_area'];
        $user->admin = $postVars['admin'];
        $user->register();

        $request->getRouter()->redirect('/admin/usuarios/' . $user->id . '/edit?status=created');
    }

    /**
     * Form para editar depoimento
     */
    public static function getEditUsers($request, $id)
    {
        $user = EntityUser::getUserById($id);

        if (!$user instanceof EntityUser) {
            $request->getRouter()->redirect('/admin/usuarios');
        }

        //Conteudo do formulário
        $content = View::render('admin/modules/users/form', [
            'title' => 'Editar Usuário',
            'email' => $user->email,
            'status' => self::getStatus($request)
        ]);

        //Retorna página completa
        return parent::getPanel('Painel Administrativo | Usuários', $content, 'users');
    }

    /**
     * Editar depoimento
     */
    public static function setEditUsers($request, $id)
    {
        $user = EntityUser::getUserById($id);

        if (!$user instanceof EntityUser) {
            $request->getRouter()->redirect('/admin/usuarios');
        }

        $postVars = $request->getPostVars();

        $email = $postVars['email'] ?? '';
        $password = $postVars['password'] ?? '';

        $hasUser = EntityUser::getUserByEmail($email);

        if ($hasUser instanceof EntityUser) {
            $request->getRouter()->redirect('/admin/usuarios/' . $user->id . '/edit?status=duplicated');
        }

        $user->email = $email;
        $user->password = $password ? password_hash($password, PASSWORD_DEFAULT) : $user->password;

        $user->update();

        $request->getRouter()->redirect('/admin/usuarios/' . $user->id . '/edit?status=updated');
    }

    /**
     * Tela de deletar um depoimento 
     */
    public static function getDeleteUsers($request, $id)
    {
        $user = EntityUser::getUserById($id);

        if (!$user instanceof EntityUser) {
            $request->getRouter()->redirect('/admin/usuarios');
        }

        //Conteudo do formulário
        $content = View::render('admin/modules/users/delete', [
            'title' => 'Excluir Depoimento',
            'email' => $user->email
        ]);

        //Retorna página completa
        return parent::getPanel('Painel Administrativo | Usuários', $content, 'testimonies');
    }

    /**
     * Deletar depoimento
     */
    public static function setDeleteUsers($request, $id)
    {
        $user = EntityUser::getUserById($id);

        if (!$user instanceof EntityUser) {
            $request->getRouter()->redirect('/admin/usuarios');
        }

        $user->delete();

        $request->getRouter()->redirect('/admin/usuarios?status=deleted');
    }

    /**
     * Renderiza os itens de depoimento na página
     */
    private function getUserItens($request, &$pagination)
    {
        $itens = "";

        //Quantidade total de registros
        $total = EntityUser::getUsers(null, 'id', null, "COUNT(*) as qtd")->fetchObject()->qtd;

        //Pagina atual
        $queryParams = $request->getQueryParams();
        $paginaAtual = $queryParams['page'] ?? 1;

        //Instancia
        $pagination = new Pagination($total, $paginaAtual, 3);

        //Resultados da página
        $results = EntityUser::getUsers(null, 'id DESC', $pagination->getLimit());

        //Renderiza o item
        while ($user = $results->fetchObject(EntityUser::class)) {
            $itens .= View::render(
                "admin/modules/users/itens",
                [
                    "id" => $user->id,
                    "email" => $user->email,
                    "permission" => $user->permission,
                    "access_area" => $user->access_area,
                    "admin" => self::typeUser($user->admin),
                    "username" => $user->username
                ]
            );
        }
        return $itens;
    }
    /**
     * Responsável por identificar o tipo de usuário
     */
    private static function typeUser($type)
    {
        if ($type == 1) {
            return "Administrador";
        } else if ($type == 2) {
            return "Moderador";
        } else {
            return "Programador";
        }
    }
}
