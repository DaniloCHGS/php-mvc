<?php

namespace App\Http\Middleware;

use App\Utils\Utils;
use App\Model\Entity\AccessArea as EntityAccessArea;

class ModuleAuth
{
    /**
     * Executa o middleware
     */
    public function handle($request, $next)
    {
        $uri = $this->getUri($request);
        $module = EntityAccessArea::getAccessAreaByURI($uri);
        $userLevel = $_SESSION['admin']['user']['admin'];
        
        if($userLevel >= $module->admin){
            return $next($request);
        }

        throw new \Exception("Você não tem acesso a este módulo", 403);
    }
    private function getUri($request){

        //URI
        $uri = $request->getUri();

        //Dividindo a uri
        $uri_parts = explode('/', $uri);

        //URI limpa
        $uri_str = $uri_parts[3];

        //Ajusta uri para formato do banco
        $alter_uri_str = preg_replace('/-/', '_', $uri_str);

        return $alter_uri_str;
    }

    
}
