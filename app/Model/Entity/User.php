<?php

namespace App\Model\Entity;

use WilliamCosta\DatabaseManager\Database;

class User
{
    /**
     * Id usuário
     */
    public $id;
    /**
     * Email usuário
     */
    public $email;
    /**
     * Senha usuário
     */
    public $password;
    /**
     * Retornar usuário base de email
     * @param string $email
     * @return User
     */
    /**
     * Permissão de usuário para inserir, editar e excluir
     * 1:Inserir, 2:Editar, 3:Excluir
     * 1-2-3
     */
    public $permission;
    /**
     * Quais módulos o usuário pode acessar
     * 1-2-3-4-5
     */
    public $access_area;
    /**
     * Se o usuário é administrador, moderador ou desenvolvedor
     */
    public static function getUserByEmail($email)
    {
        return (new Database('users'))->select('email = "' . $email . '"')->fetchObject(self::class);
    }
    /**
     * Retorna listagem de usuários
     */
    public static function getUsers($where = null, $order = null, $limit = null, $filds = "*")
    {
        return (new Database('users'))->select($where, $order, $limit, $filds);
    }
    /**
     * Cadastra a instancia atual no banco
     */
    public function register()
    {
        $this->id = (new Database('users'))->insert([
            'email' => $this->email,
            'password' => $this->password,
            'username' => $this->username,
            'permission' => $this->permission,
            'access_area' => $this->access_area,
            'admin' => $this->admin
        ]);
        return true;
    }
    /**
     * Atualiza a instancia atual no banco
     */
    public function update()
    {
        return (new Database('users'))->update('id = ' . $this->id, [
            'email'     => $this->email,
            'password'  => $this->password,
            'username' => $this->username,
            'permission' => $this->permission,
            'access_area' => $this->access_area,
            'admin' => $this->admin
        ]);
        return true;
    }
    /**
     * Deleta a instancia atual no banco
     */
    public function delete()
    {
        return (new Database('users'))->delete('id = ' . $this->id);
        return true;
    }
    /**
     * Busca por ID
     */
    public static function getUserById($id)
    {
        return self::getUsers('id = ' . $id)->fetchObject(self::class);
    }
}
