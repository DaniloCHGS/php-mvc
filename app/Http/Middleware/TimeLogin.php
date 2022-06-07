<?php

namespace App\Http\Middleware;

use App\Session\Admin\Login as SessionAdminLogin;
use App\Controller\Admin\Login;
use App\Utils\Utils;

class TimeLogin
{

    /**
     * Executa o middleware
     */
    public function handle($request, $next)
    {
        if (SessionAdminLogin::timeEndSession()) {
            //Destroy sessão de login
            SessionAdminLogin::logout();

            //Redireciona
            $request->getRouter()->redirect('/admin/time-out');
        };
        return $next($request);
    }
}
