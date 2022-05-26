<?php

namespace App\Controller\Admin;

use App\Utils\View;
use App\Model\Entity\User;
use App\Session\Admin\Login as SessionAdminLogin;
use App\Utils\Utils;
use App\Services\Mail;

class Forgot extends Page
{
    /**
     * Retorna tela de login
     */
    public static function getForgot($request, $erroMessage = null)
    {
        //Status
        $status = !is_null($erroMessage) ? Alert::getError($erroMessage) : '';

        //Conteudo da página de login
        $content = View::render('admin/forgot', [
            'status' => $status
        ]);

        return parent::getPage('Boss | Recuperar senha', $content);
    }
    /**
     * Define o login do usuário
     */
    public static function setForgot($request)
    {
        //Post vars
        $postVars   = $request->getPostVars();
        $email      = filter_var($postVars['email'], FILTER_SANITIZE_STRING) ?? '';

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
            return self::getForgot($request, 'Recaptcha não validado');
        }

        //Validação de email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return self::getForgot($request, 'Email inválido');
        }

        //Busca do usuário
        $user = User::getUserByEmail($email);

        //Validação de busca
        if (!$user instanceof User) {
            return self::getForgot($request, 'Email inválido');
        }

        $mail = new Mail;
        $mail->camps = [
            'email' => $email
        ];
        $mail->subject = 'Recuperação de senha';
        $mail->recipients = ['danilo@taticaweb.com.br'];
        $mail->from_name = 'Danilo';
        $mail->from_email = 'danilo@taticaweb.com.br';
        $responseMail = $mail->send();
        Utils::pre($responseMail);
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
