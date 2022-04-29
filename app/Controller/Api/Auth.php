<?php

namespace App\Controller\Api;

use App\Utils\Utils;
use App\Model\Entity\User as EntityUser;
use Firebase\JWT\JWT;

class Auth extends Api
{

    /**
     * Responsável por gerar um Token JWT
     */
    public static function generateToken($request)
    {

        $postVars = $request->getPostVars();

        if (!isset($postVars['email']) or !isset($postVars['password'])) {
            throw new \Exception("Campos de email e senha são obrigatorios", 400);
        }

        $user = EntityUser::getUserByEmail($postVars['email']);

        if(!$user instanceof EntityUser){
            throw new \Exception("Usuário não encontrado", 400);
        }

        if(!password_verify($postVars['password'], $user->password)){
            throw new \Exception("Usuário ou senha inválidos", 400);
        }

        //Payload
        $payload = [
            'email' => $user->email,
        ];
        
        return [
            'token' => JWT::encode($payload, getenv('JWT_KEY'),'HS256')
        ];
    }
}