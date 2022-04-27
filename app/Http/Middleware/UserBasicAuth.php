<?php

namespace App\Http\Middleware;

use App\Utils\Utils;
use App\Model\Entity\User;

class UserBasicAuth
{
    /**
     * Executa o middleware
     */
    public function handle($request, $next)
    {
        //Valida o acesso via Basic Auth
        $this->basicAuth($request);

        return $next($request);
    }
    /**
     * Responsável por válidar o acesso por Basic Auth
     */
    private function basicAuth($request){
        //Verifica usuario recebido
        if($user = $this->getBasicAuthUser()){
            $request->user = $user;
            return true;
        }
        throw new \Exception("Usuário ou senha inválidos", 403);
    }
    /**
     * Retorna instancia de usuarios autenticado
     */
    private function getBasicAuthUser(){
       //Verificar se existe os dados de acesso
       if(!isset($_SERVER['PHP_AUTH_USER']) or !isset($_SERVER['PHP_AUTH_PW'])){
           return false;
       }
       $user = User::getUserByEmail($_SERVER['PHP_AUTH_USER']);
       
       if(!$user instanceof User){
           return false;
       }
       //Valida senha e retorna usuario
       return password_verify($_SERVER['PHP_AUTH_PW'], $user->password) ? $user : false;
    }
}
