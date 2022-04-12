<?php
namespace App\Http\Middleware;
use App\Session\Admin\Login as SessionAdminLogin;

class RequireredAdminLogin {

    /**
     * Executa o middleware
     */
    public function handle($request, $next){
        //Verifica se o usuário está logado
        if(!SessionAdminLogin::isLogged()){
            $request->getRouter()->redirect('/admin/login');
        }

        return $next($request);
    }

}