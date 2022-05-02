<?php

namespace App\Http\Middleware;

use App\Utils\Utils;
use App\Utils\Cache\File as CacheFile;

class Cache
{
    /**
     * Executa o middleware
     */
    public function handle($request, $next)
    {
        //Verifica se a request atual é cacheavel
        if (!$this->isCacheable($request)) return $next($request);

        $hash = $this->getHash($request);
        
        return CacheFile::getCache($hash, getenv('CACHE_TIME'), function() use($request,$next) {
            return $next($request);
        });
    }

    /**
     * Responsável por retornar a has do cache
     * @param Request request
     */
    private function getHash($request){
        //URI da rota
        $uri = $request->getRouter()->getUri();

        $queryParams = $request->getQueryParams();
        $uri.= !empty($queryParams) ? '?'.http_build_query($queryParams) : '';

        //Remove as / e retorna a hash
        return rtrim('route-'.preg_replace('/[^0-9a-zA-z]/', '-', ltrim($uri, '/')), '-');
    }

    /**
     * Responsável por verificar e a request atual é cacheavel
     */
    private function isCacheable($request)
    {
        //Valida o tempo de cache
        if (getenv('CACHE_TIME') <= 0) {
            return false;
        }

        //Valida o metódo da requisição
        if($request->getHttpMethod() != 'GET'){
            return false;
        }

        //Valida o header de cache
        $headers = $request->getHeaders();
        
        //Se esta validação permenecer o clientem tem controle do cache
        if(isset($headers['Cache-Control']) and $headers['Cache-Control'] == 'no-cache'){
            return false;
        }

        return true;
    }
}
