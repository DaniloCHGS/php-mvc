<?php

use App\Http\Response;
use \App\Controller\Admin;
use App\Utils\Utils;

//Lista
$router->get('/admin/perfil', [
    'middlewares' => [
        'required-admin-login',
        'time-login',
        'module-auth'
    ],
    function ($request) {
        return new Response(200, Admin\Profile::index($request));
    }
]);

//Lista
$router->post('/admin/perfil', [
    'middlewares' => [
        'required-admin-login',
        'time-login',
        'module-auth'
    ],
    function ($request) {
        return new Response(200, Admin\Profile::setEditUsers($request));
    }
]);