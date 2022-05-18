<?php
namespace App\Services;

use App\Services\AlertTelegram;
use App\Utils\Utils;

class UpTime {
    /**
     * Verifica se o site está o ar
     */
    public static function isConnected(){
        try {
            $url = 'https://higiservicos.com.br/a';
            $curl = curl_init($url);
            curl_setopt_array($curl, [
                CURLOPT_HEADER => true,
                CURLOPT_NOBODY => true,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 10 //10 segundos
            ]);

            //Executa
            curl_exec($curl);
            //Código de status da requisição
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            //Fecha conexão
            curl_close($curl);

            if($httpCode != 200){
                throw new \Exception("ATENÇÃO! O endereço: $url retornou o status $httpCode ", $httpCode);
            }

        } catch(\Exception $e){
            echo $e->getMessage()."\n";
            AlertTelegram::sendMessage( $e->getCode().": ".$e->getMessage() );
        }
    }
}