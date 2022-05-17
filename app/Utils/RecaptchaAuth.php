<?php

namespace App\Utils;

class RecaptchaAuth
{
    /**
     * Token que vem do formulário do cliente
     */
    public $token_cliente;
    /**
     * Status da requisição da API
     */
    public $status;
    /**
     * Chave secreta do lado do servidor
     */
    public $secret;

    public function request()
    {
        $curl = curl_init();

        //Definições da requisição com curl
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://www.google.com/recaptcha/api/siteverify',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => [
                'secret' => $this->secret,
                'response' => $token_cliente ?? ''
            ]
        ]);

        //Executa execução
        $response = curl_exec($curl);

        //Fecha conexão curl
        curl_close($curl);

        $responseArray = json_decode($response, true);

        //Sucesso
        $this->status = $responseArray['success'] ?? false;
    }
}
