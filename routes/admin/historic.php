<?php

use App\Http\Response;
use \App\Controller\Admin;

$router->get('/admin/historico', [
    'middlewares' => [
        'required-admin-login',
        'time-login',
        'module-auth'
    ],
    function ($request) {
        return new Response(200, Admin\Historic::index($request));
    }
]);