<?php

namespace App\Controller\Admin;

use App\Utils\View;
use App\Model\Entity\User;
use App\Session\Admin\Login as SessionAdminLogin;
use App\Utils\Utils;

class Login extends Page
{
    /**
     * Retorna tela de login
     */
    public static function setTimeout($request, $erroMessage = null)
    {
        //Status
        $status = !is_null($erroMessage) ? Alert::getError($erroMessage) : '';

        //Conteudo da página de login
        $content = View::render('admin/time-out', [
            'status' => $status
        ]);

        return parent::getPage('Boss - Time out', $content);
    }
    /**
     * Retorna tela de login
     */
    public static function getLogin($request, $erroMessage = null)
    {
        //Status
        $status = !is_null($erroMessage) ? Alert::getError($erroMessage) : '';

        //Conteudo da página de login
        $content = View::render('admin/login', [
            'status' => $status
        ]);

        return parent::getPage('Boss - Login', $content);
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

        //Auth do recaptcha
        $token = $postVars['g-recaptcha-response'];

        $curl = curl_init();

        //Definições da requisição com curl
        curl_setopt_array($curl, [
            CURLOPT_URL=> 'https://www.google.com/recaptcha/api/siteverify',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => [
                'secret' => '6LfEYvgfAAAAACG-h_ag7gSGcs6wT4m2ShAElF-o',
                'response' => $token ?? ''
            ]
        ]);

        //Executa execução
        $response = curl_exec($curl);

        //Fecha conexão curl
        curl_close($curl);

        $responseArray = json_decode($response, true);

        //Sucesso
        $success = $responseArray['success'] ?? false;

        if($success != 1){
            return self::getLogin($request, 'Recaptcha não validado');
        }

        //Validação de email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return self::getLogin($request, 'Email ou senha inválido');
        }

        //Busca do usuário
        $user = User::getUserByEmail($email);

        if($user->blocked == 1){
            return self::getLogin($request, 'Usuário boqueado');
        }

        //Validação de busca de email
        if (!$user instanceof User) {
            return self::getLogin($request, 'Email ou senha inválido');
        }

        //Validação de senha
        if(!password_verify($password, $user->password)){

            if($user->quantity_blocked == 3){
                $user->blocked = 1;
                $user->update();

                return self::getLogin($request, 'Usuário boqueado');
            }

            if($user->quantity_blocked < 3){
                $user->quantity_blocked = $user->quantity_blocked + 1;
                $user->update();
            }

            return self::getLogin($request, 'Email ou senha inválido');
        }

        //Cria sessão de login
        SessionAdminLogin::login($user);

        //Redireciona
        $request->getRouter()->redirect('/admin');
    }
    /**
     * Desloga o usuário
     */
    public static function setLogout($request, $status = null)
    {
        //Destroy sessão de login
        SessionAdminLogin::logout();

        //Redireciona
        $request->getRouter()->redirect('/admin/login'.$status);
    }
}
