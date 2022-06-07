<?php

use App\Http\Response;
use \App\Controller\Admin;

//Lista os depoimentos
$router->get('/admin/blog', [
    'middlewares' => [
        'required-admin-login',
        'time-login',
        'module-auth'
    ],
    function ($request) {
        return new Response(200, Admin\Blog::index($request));
    }
]);

//Tela de cadastro
$router->get('/admin/blog/new', [
    'middlewares' => [
        'required-admin-login',
        'time-login',
        'module-auth'
    ],
    function ($request) {
        return new Response(200, Admin\Blog::getNewArticle($request));
    }
]);

//Cadastro
$router->post('/admin/depoimentos/new', [
    'middlewares' => [
        'required-admin-login',
        'time-login',
        'module-auth'
    ],
    function ($request) {
        return new Response(200, Admin\Testimony::setNewTestimonies($request));
    }
]);

//Tela de editar
$router->get('/admin/depoimentos/{id}/edit', [
    'middlewares' => [
        'required-admin-login',
        'time-login',
        'module-auth'
    ],
    function ($request, $id) {
        return new Response(200, Admin\Testimony::getEditTestimonies($request, $id));
    }
]);

//Editar
$router->post('/admin/depoimentos/{id}/edit', [
    'middlewares' => [
        'required-admin-login',
        'time-login',
        'module-auth'
    ],
    function ($request, $id) {
        return new Response(200, Admin\Testimony::setEditTestimonies($request, $id));
    }
]);

//Tela de excluir
$router->get('/admin/depoimentos/{id}/delete', [
    'middlewares' => [
        'required-admin-login',
        'time-login',
        'module-auth'
    ],
    function ($request, $id) {
        return new Response(200, Admin\Testimony::getDeleteTestimonies($request, $id));
    }
]);

//Excluir
$router->post('/admin/depoimentos/{id}/delete', [
    'middlewares' => [
        'required-admin-login',
        'time-login',
        'module-auth'
    ],
    function ($request, $id) {
        return new Response(200, Admin\Testimony::setDeleteTestimonies($request, $id));
    }
]);
