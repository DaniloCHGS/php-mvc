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
}
