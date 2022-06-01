<?php

namespace App\Services;
use App\Utils\Utils;

class OpenWeatherMap
{
    /**
     * URL padrão da API
     */
    const BASE_URL = 'https://api.openweathermap.org';
    /**
     * Chave de acesso
     */
    private $api_key;

    public function __construct($api_key)
    {
        $this->api_key = $api_key;
    }
    /**
     * Consulta o clima da cidade atual do Brasil
     */
    public function consultCurrentWeather($city, $uf)
    {
        return $this->get('/data/2.5/weather', [
            'q' => $city.', BR-'.$uf.', BRA'
        ]);
    }
    /**
     * Executa a consulta get na API
     */
    private function get($resource, $params = []){
        $params['units'] = 'metric';
        $params['lang'] = 'pt_br';
        $params['appid'] = $this->api_key;

        $endPoint = self::BASE_URL.$resource.'?'.http_build_query($params);

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $endPoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'GET'
        ]);
        
        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response, true);
    }
}
