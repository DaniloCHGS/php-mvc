<?php

namespace App\Http\Middleware;

use App\Utils\Utils;
use App\Model\Entity\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTAuth
{
    /**
     * Executa o middleware
     */
    public function handle($request, $next)
    {
        //Valida o acesso via JWT
        $this->Auth($request);

        return $next($request);
    }
    /**
     * Responsável por válidar o acesso por JWT
     */
    private function Auth($request)
    {
        //Verifica usuario recebido
        if ($user = $this->getJWTAuthUser($request)) {
            $request->user = $user;
            return true;
        }
        throw new \Exception("Acesso negado", 403);
    }
    /**
     * Retorna instancia de usuarios autenticado
     */
    private function getJWTAuthUser($request)
    {
        //Headers
        $headers = $request->getHeaders();

        //Token puro JWT
        $jwt = isset($headers['Authorization']) ? str_replace('Bearer ', '', $headers['Authorization']) : '';

        try {
            $decode = (array)JWT::decode($jwt, new Key(getenv('JWT_KEY'), 'HS256'));
        } catch(\Exception $e) {
            throw new \Exception("Token inválido", 403);
        }

        $email = $decode['email'] ?? '';

        $user = User::getUserByEmail($email);

        return $user instanceof User ? $user : false;
    }
}
