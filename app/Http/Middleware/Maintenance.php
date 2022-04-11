<?php

namespace App\Http\Middleware;

class Maintenance {
    /**
     * Executa o middleware
     */
    public function handle($request, $next){
        if(getenv('MAINTENANCE') == 'true'){
            throw new \Exception("Site em manutenção", 200);
        }
        return $next($request);
    }
}