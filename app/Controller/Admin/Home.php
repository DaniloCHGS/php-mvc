<?php

namespace App\Controller\Admin;

use App\Utils\Historic;
use App\Utils\View;
use App\Utils\Utils;
use App\Services\OpenWeatherMap;

class Home extends Page
{
    /**
     * Mensagem de status
     */
    private static function getStatus($request)
    {
        $queryParams = $request->getQueryParams();

        if (!isset($queryParams['status'])) return '';

        switch ($queryParams['status']) {
            case 'denied':
                return Alert::getError('Acesso negado');
                break;
        }
    }
    /**
     * Retorna a Home do Painel
     */
    public static function getHome($request){

        $currentWeather = self::getWeather();

        //Conteudo da Home
        $content = View::render('admin/modules/home/index', [
            'status' => self::getStatus($request),
            'historic' => Historic::getHistoric(),
            'user' => $_SESSION['admin']['user']['name'],
            'city' => 'Rio de Janeiro',
            'temp' => (int) $currentWeather['main']['temp'],
            'climate' => $currentWeather['weather'][0]['description'],
            'date' => date('d/m/Y', time()),
            'clock' => date('H:i:s', time()),
            'day' => date('H', time()) <= 18 ? 'sun' : 'moon'
        ]);

        //Retorna página completa
        return parent::getPanel('Boss - Home', $content, 'home');
    }
    /**
     * Retorna 404
     */
    public static function get404($request){
        //Conteudo da Home
        $content = View::render('admin/modules/home/404');

        //Retorna página completa
        return parent::getPanel('Boss - 404', $content, '');
    }
    /**
     * Retorna 500
     */
    public static function get500($request){
        //Conteudo da Home
        $content = View::render('admin/modules/home/500');

        //Retorna página completa
        return parent::getPanel('Boss - 500', $content, '');
    }

    private function getWeather(){
        $openWeatherMap = new OpenWeatherMap(getenv('OPENWEATHERMAP_KEY'));
        return $openWeatherMap->consultCurrentWeather("Rio de Janeiro", "RJ");
    }
}
