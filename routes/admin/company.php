<?php

use App\Http\Response;
use \App\Controller\Admin;
use App\Utils\Utils;

//Tela da identidade do site
$router->get('/admin/dados-empresa', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request) {
        return new Response(200, Admin\Company::index($request));
    }
]);