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
        $email      = filter_var($postVars['email'], FILTER_SANITIZE_STRING) ?? '';
        $password   = filter_var($postVars['password'], FILTER_SANITIZE_STRING) ?? '';

        //Validação de email
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return self::getLogin($request, 'Email ou senha inválido');
        }

        //Busca do usuário
        $user = User::getUserByEmail($email);
        
        //Validação de busca
        if(!$user instanceof User || !password_verify($password, $user->password)){
            return self::getLogin($request, 'Email ou senha inválido');
        }
    }
}
