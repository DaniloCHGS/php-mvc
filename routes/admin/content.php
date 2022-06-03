<?php

use App\Http\Response;
use \App\Controller\Admin;
use App\Utils\Utils;

//Tela da identidade do site
$router->get('/admin/conteudo', [
    'middlewares' => [
        'required-admin-login',
        'time-login',
        'module-auth'
    ],
    function ($request) {
        return new Response(200, Admin\Content::index($request));
    }
]);