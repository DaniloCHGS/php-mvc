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
    public static function getUserByEmail($email)
    {
        return (new Database('users'))->select('email = "' . $email . '"')->fetchObject(self::class);
    }
    /**
     * Retorna listagem de usuários
     */
    public static function getUsers($where = null, $order = null, $limit = null, $filds = "*"){
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
