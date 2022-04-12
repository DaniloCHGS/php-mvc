<?php
namespace App\Http\Middleware;
use App\Session\Admin\Login as SessionAdminLogin;

class RequireredAdminLogout {

    /**
     * Executa o middleware
     */
    public function handle($request, $next){
        //Verifica se o usuário está logado
        if(SessionAdminLogin::isLogged()){
            $request->getRouter()->redirect('/admin');
        }

        return $next($request);
    }

}