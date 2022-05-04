<?php

use App\Http\Response;
use \App\Controller\Admin;
use App\Utils\Utils;

//Busca de dados
$router->get('/admin/dados-empresa', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request) {
        return new Response(200, Admin\Company::index($request));
    }
]);

//Atualização de endereço
$router->post('/admin/dados-empresa/address', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request) {
        return new Response(200, Admin\Company::updateAddressCompany($request));
    }
]);

//Atualização de contato
$router->post('/admin/dados-empresa/contact', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request) {
        return new Response(200, Admin\Company::updateContactCompany($request));
    }
]);