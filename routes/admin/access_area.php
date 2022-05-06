<?php

use App\Http\Response;
use \App\Controller\Admin;
use App\Utils\Utils;

//Tela da identidade do site
$router->get('/admin/area-de-acesso', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request) {
        return new Response(200, Admin\AccessArea::index($request));
    }
]);

//Editar identidade
$router->post('/admin/identidade-site', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request) {
        return new Response(200, Admin\Identity::updateIdentity($request));
    }
]);
