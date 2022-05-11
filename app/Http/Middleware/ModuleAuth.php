<?php

namespace App\Http\Middleware;

use App\Utils\Utils;

class ModuleAuth
{
    /**
     * Executa o middleware
     */
    public function handle($request, $next)
    {
        
        return $next($request);
    }

    
}
