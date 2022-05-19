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