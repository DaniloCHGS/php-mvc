<?php

namespace App\Session\Admin;

class Login {

    /**
     * Inicia Sessão
     */
    private static function init(){
        //Verifica se a sessão não está ativa
        if(session_start() != PHP_SESSION_ACTIVE){
            session_start();
        }
    }
    /**
     * Cria um usário
     */
    public static function login($user){
        //Inicia sessão
        self::init();
        $_SESSION['admin']['user'] = [
            'id' => $user->id,
            'email'=> $user->email
        ];
        //success
        return true;
    }
}