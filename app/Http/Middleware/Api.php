<?php

namespace App\Http\Middleware;

class Api
{
    /**
     * Executa o middleware
     */
    public function handle($request, $next)
    {
        //Altera o ContentType para JSON
        $request->getRouter()->setContentType('application/json');

        return $next($request);
    }
}
