<?php

use App\Http\Response;
use \App\Controller\Admin;
use App\Utils\Utils;

//Lista
$router->get('/admin/usuarios', [
    'middlewares' => [
        'required-admin-login',
        'time-login',
        'module-auth'
    ],
    function ($request) {
        return new Response(200, Admin\Users::getUsers($request));
    }
]);

//Tela de cadastro
$router->get('/admin/usuarios/new', [
    'middlewares' => [
        'required-admin-login',
        'time-login',
        'module-auth'
    ],
    function ($request) {
        return new Response(200, Admin\Users::getNewUser($request));
    }
]);

//Cadastro
$router->post('/admin/usuarios/new', [
    'middlewares' => [
        'required-admin-login',
        'time-login',
        'module-auth'
    ],
    function ($request) {
        return new Response(200, Admin\Users::setNewUser($request));
    }
]);

//Tela de editar
$router->get('/admin/usuarios/{id}/edit', [
    'middlewares' => [
        'required-admin-login',
        'time-login',
        'module-auth'
    ],
    function ($request, $id) {
        return new Response(200, Admin\Users::getEditUsers($request, $id));
    }
]);

//Editar
$router->post('/admin/usuarios/{id}/edit', [
    'middlewares' => [
        'required-admin-login',
        'time-login',
        'module-auth'
    ],
    function ($request, $id) {
        return new Response(200, Admin\Users::setEditUsers($request, $id));
    }
]);

//Tela de excluir
$router->get('/admin/usuarios/{id}/delete', [
    'middlewares' => [
        'required-admin-login',
        'time-login',
        'module-auth'
    ],
    function ($request, $id) {
        return new Response(200, Admin\Users::getDeleteUsers($request, $id));
    }
]);

//Excluir
$router->post('/admin/usuarios/{id}/delete', [
    'middlewares' => [
        'required-admin-login',
        'time-login',
        'module-auth'
    ],
    function ($request, $id) {
        return new Response(200, Admin\Users::setDeleteUsers($request, $id));
    }
]);
