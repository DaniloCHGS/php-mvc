<?php

use App\Http\Response;
use \App\Controller\Admin;

//Lista os depoimentos
$router->get('/admin/banners', [
    'middlewares' => [
        'required-admin-login',
        'time-login',
        'module-auth'
    ],
    function ($request) {
        return new Response(200, Admin\Banners::index($request));
    }
]);

//Tela de cadastro
$router->get('/admin/banner/new', [
    'middlewares' => [
        'required-admin-login',
        'time-login',
        'module-auth'
    ],
    function ($request) {
        return new Response(200, Admin\Banners::getNewBanner($request));
    }
]);

//Cadastro
$router->post('/admin/banner/new', [
    'middlewares' => [
        'required-admin-login',
        'time-login',
        'module-auth'
    ],
    function ($request) {
        return new Response(200, Admin\Banners::setNewBanner($request));
    }
]);

//Tela de editar
$router->get('/admin/banners/{id}/edit', [
    'middlewares' => [
        'required-admin-login',
        'time-login',
        'module-auth'
    ],
    function ($request, $id) {
        return new Response(200, Admin\Banners::getEditBanner($request, $id));
    }
]);

//Editar
$router->post('/admin/banners/{id}/edit', [
    'middlewares' => [
        'required-admin-login',
        'time-login',
        'module-auth'
    ],
    function ($request, $id) {
        return new Response(200, Admin\Banners::setEditBanner($request, $id));
    }
]);

//Tela de excluir
$router->get('/admin/banners/{id}/delete', [
    'middlewares' => [
        'required-admin-login',
        'time-login',
        'module-auth'
    ],
    function ($request, $id) {
        return new Response(200, Admin\Banners::getDeleteBanner($request, $id));
    }
]);

//Excluir
$router->post('/admin/banners/{id}/delete', [
    'middlewares' => [
        'required-admin-login',
        'time-login',
        'module-auth'
    ],
    function ($request, $id) {
        return new Response(200, Admin\Banners::setDeleteBanner($request, $id));
    }
]);
