<?php

namespace App\Controller\Admin;
use App\Utils\View;

class Login extends Page {
    /**
     * Retorna tela de login
     */
    public static function getLogin(){
        /**
         * Conteudo da página de login
         */
        $content = View::render('admin/login', []);

        return parent::getPage('Painel Administrativo | Login', $content);
    }
}