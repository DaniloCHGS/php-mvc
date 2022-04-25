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

//Tela de cadastro
$router->get('/admin/depoimentos/new', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request) {
        return new Response(200, Admin\Testimony::getNewTestimonies($request));
    }
]);

//Cadastro
$router->post('/admin/depoimentos/new', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request) {
        return new Response(200, Admin\Testimony::setNewTestimonies($request));
    }
]);

//Te de editar
$router->get('/admin/depoimentos/{id}/edit', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request, $id) {
        return new Response(200, Admin\Testimony::getEditTestimonies($request, $id));
    }
]);

//Editar
$router->post('/admin/depoimentos/{id}/edit', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request, $id) {
        return new Response(200, Admin\Testimony::setEditTestimonies($request, $id));
    }
]);
