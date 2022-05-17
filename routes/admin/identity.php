<?php

use App\Http\Response;
use \App\Controller\Admin;
use App\Utils\Utils;

//Tela da identidade do site
$router->get('/admin/identidade-site', [
    'middlewares' => [
        'required-admin-login',
        'time-login',
        'module-auth'
    ],
    function ($request) {
        return new Response(200, Admin\Identity::getIdentity($request));
    }
]);

//Editar identidade
$router->post('/admin/identidade-site', [
    'middlewares' => [
        'required-admin-login',
        'time-login',
        'module-auth'
    ],
    function ($request) {
        return new Response(200, Admin\Identity::updateIdentity($request));
    }
]);
