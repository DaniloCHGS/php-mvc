<?php
namespace App\Http\Middleware;
use App\Session\Admin\Login as SessionAdminLogin;
use App\Controller\Admin\Login;
use App\Utils\Utils;

class TimeLogin {

    /**
     * Executa o middleware
     */
    public function handle($request, $next){
        if(SessionAdminLogin::timeEndSession()){
            Login::setLogout($request, "?status=Tempo%20esgotado");
        };
        return $next($request);
    }

}