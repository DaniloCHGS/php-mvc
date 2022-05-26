<?php

use App\Http\Response;
use \App\Controller\Admin;
use App\Utils\Utils;

//Busca de dados
$router->get('/admin/contato', [
    'middlewares' => [
        'required-admin-login',
        'time-login',
        'module-auth'
    ],
    function ($request) {
        return new Response(200, Admin\Contact::index($request));
    }
]);
$router->post('/admin/contato', [
    'middlewares' => [
        'required-admin-login',
        'time-login',
        'module-auth'
    ],
    function ($request) {
        return new Response(200, Admin\Contact::updateEmails($request));
    }
]);