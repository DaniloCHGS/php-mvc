<?php

namespace App\Controller\Admin;

use App\Utils\View;
use App\Model\Entity\User;

class Login extends Page
{
    /**
     * Retorna tela de login
     */
    public static function getLogin($request, $erroMessage = null)
    {
        //Status
        $status = !is_null($erroMessage) ? View::render('admin/login/status', [
            'mensagem' => $erroMessage
        ]) : '';

        //Conteudo da página de login
        $content = View::render('admin/login', [
            'status' => $status
        ]);

        return parent::getPage('Painel Administrativo | Login', $content);
    }
    /**
     * Define o login do usuário
     */
    public static function setLogin($request)
    {
        //Post vars
        $postVars   = $request->getPostVars();
        $email      = $postVars['email'] ?? '';
        $password   = $postVars['password'] ?? '';

        //Busca do usuário
        $user = User::getUserByEmail($email);
        
        //Validação
        if(!$user instanceof User){
            return self::getLogin($request, 'Email ou senha iválido');
        }
    }
}
