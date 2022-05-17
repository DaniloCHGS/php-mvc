<?php

namespace App\Session\Admin;

class Login
{

    /**
     * Inicia Sessão
     */
    private static function init()
    {
        //Verifica se a sessão não está ativa
        if (session_start() != PHP_SESSION_ACTIVE) {
            session_start();
        }
    }
    /**
     * Cria um usário
     */
    public static function login($user)
    {
        //Inicia sessão
        self::init();
        $time_init = time();
        //1H
        $time_end = $time_init + ((60) * 60);

        $_SESSION['admin']['user'] = [
            'id' => $user->id,
            'email' => $user->email,
            'admin' => $user->admin,
            'access_area' => $user->access_area,
            'name' => $user->username,
            'time_init' => $time_init,
            'time_end' => $time_end
        ];
        //success
        return true;
    }
    /**
     * Verifica se o usário está logado
     */
    public static function isLogged()
    {
        self::init();

        return isset($_SESSION['admin']['user']['id']);
    }
    /**
     * Loggout
     */
    public static function logout()
    {
        self::init();

        //Destroy usuário
        unset($_SESSION['admin']['user']);

        return true;
    }
    /**
     * Verifica se o tempo de utilização ainda é válido
     */
    public static function timeEndSession(){
        if(time() >= $_SESSION['admin']['user']['time_end']){
            return true;
        }
    }
}
