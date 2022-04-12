<?php

use App\Http\Response;
use \App\Controller\Admin;

//Lista os depoimentos
$router->get('/admin/depoimentos', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request) {
        return new Response(200, Admin\Testimony::getTestimonies($request));
    }
]);
