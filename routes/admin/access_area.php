<?php

use App\Http\Response;
use \App\Controller\Admin;
use App\Utils\Utils;

//Tela da identidade do site
$router->get('/admin/area-de-acesso', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request) {
        return new Response(200, Admin\AccessArea::index($request));
    }
]);

//Cadastro tela
$router->get('/admin/area-de-acesso/new', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request) {
        return new Response(200, Admin\AccessArea::getNewAccessArea($request));
    }
]);

//Cadastro
$router->post('/admin/area-de-acesso/new', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request) {
        return new Response(200, Admin\AccessArea::setNewAccessArea($request));
    }
]);

//Editar tela
$router->get('/admin/area-de-acesso/{id}/edit', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request, $id) {
        return new Response(200, Admin\AccessArea::getEditAccessArea($request, $id));
    }
]);

//Editar
$router->post('/admin/area-de-acesso/{id}/edit', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request, $id) {
        return new Response(200, Admin\AccessArea::setEditAccessArea($request, $id));
    }
]);

//Deletar tela
$router->get('/admin/area-de-acesso/{id}/delete', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request, $id) {
        return new Response(200, Admin\AccessArea::getDeleteAccessArea($request, $id));
    }
]);

//Deletar
$router->post('/admin/area-de-acesso/{id}/delete', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request, $id) {
        return new Response(200, Admin\AccessArea::setDeleteAccessArea($request, $id));
    }
]);
