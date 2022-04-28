<?php

namespace App\Controller\Api;

use App\Model\Entity\User as EntityUser;
use App\Utils\Utils;
use \WilliamCosta\DatabaseManager\Pagination;

class User extends Api
{
    /**
     * Retorna os depoimentos
     */
    public static function getUsers($request)
    {
        return [
            'usuarios' => self::getUsersItens($request, $pagination),
            'paginacao' => parent::getPagination($request, $pagination)
        ];
    }

    /**
     * Retorna um depoimento
     */
    public static function getUser($request, $id)
    {
        if (!is_numeric($id)) {
            throw new \Exception("O id '" . $id . "' não é válido", 400);
        }

        $user = EntityUser::getUserById($id);

        if (!$user instanceof EntityUser) {
            throw new \Exception("Depoimento '" . $id . "' não encontrado", 404);
        }
        //Retorna os detalhes do usuario
        return [
            "id"    => (int) $user->id,
            "email"  => $user->email,
        ];
    }

    /**
     * Cadastra novo depoimento
     */
    public static function setNewUser($request)
    {
        $postVars   = $request->getPostVars();

        //Valida os campos obrigatorios
        if (!isset($postVars['autor']) or !isset($postVars['depoimento'])) {
            throw new \Exception("Os campos nome e mensagem são obrigatorios", 400);
        }

        $user = new EntityUser;
        $user->autor = $postVars['autor'];
        $user->depoimento = $postVars['depoimento'];
        $user->register();

        return [
            'success' => true
        ];
    }

    /**
     * Editar depoimento
     */
    public static function setEditUser($request, $id)
    {
        $postVars   = $request->getPostVars();

        //Valida os campos obrigatorios
        if (!isset($postVars['email'])) {
            throw new \Exception("O campo email é obrigatorio", 400);
        }

        $user = EntityUser::getUserById($id);

        if (!$user instanceof EntityUser) {
            throw new \Exception("Usuário de id '" . $id . "' não encontrado", 404);
        }

        $user->email = $postVars['email'] ?? $user->email;
        $user->update();

        return [
            'id' => $user->id,
            'email' => $user->email,
        ];
    }

    /**
     * Exclui depoimento
     */
    public static function setDeleteUser($request, $id)
    {

        $user = EntityUser::getUserById($id);

        if (!$user instanceof EntityUser) {
            throw new \Exception("Usuário de id '" . $id . "' não encontrado", 404);
        }
        $user->delete();

        return [
            'success' => true
        ];
    }

    /**
     * Renderiza os itens de depoimento na página
     */
    private function getUsersItens($request, &$pagination)
    {
        $itens = [];

        //Quantidade total de registros
        $total = EntityUser::getUsers(null, null, null, "COUNT(*) as qtd")->fetchObject()->qtd;

        //Pagina atual
        $queryParams = $request->getQueryParams();
        $paginaAtual = $queryParams['page'] ?? 1;

        //Instancia
        $pagination = new Pagination($total, $paginaAtual, $total);

        //Resultados da página
        $results = EntityUser::getUsers(null, 'id DESC', $pagination->getLimit());

        //Renderiza o item
        while ($obUser = $results->fetchObject(EntityUser::class)) {
            $itens[] = [
                "id"    => (int) $obUser->id,
                "email" => $obUser->email,
            ];
        };
        return $itens;
    }
}
