<?php

use App\Http\Response;
use \App\Controller\Admin;


//Tela de cadastro
$router->get('/admin/categoria/new', [
    'middlewares' => [
        'required-admin-login',
        'time-login',
        'module-auth'
    ],
    function ($request) {
        return new Response(200, Admin\CategoryArticle::getNewCategory($request));
    }
]);

//Cadastro
$router->post('/admin/categoria/new', [
    'middlewares' => [
        'required-admin-login',
        'time-login',
        'module-auth'
    ],
    function ($request) {
        return new Response(200, Admin\CategoryArticle::setNewCategory($request));
    }
]);

//Tela de editar
$router->get('/admin/categoria/{id}/edit', [
    'middlewares' => [
        'required-admin-login',
        'time-login',
        'module-auth'
    ],
    function ($request, $id) {
        return new Response(200, Admin\CategoryArticle::getEditCategory($request, $id));
    }
]);

//Editar
$router->post('/admin/categoria/{id}/edit', [
    'middlewares' => [
        'required-admin-login',
        'time-login',
        'module-auth'
    ],
    function ($request, $id) {
        return new Response(200, Admin\CategoryArticle::setEditCategory($request, $id));
    }
]);

//Tela de excluir
$router->get('/admin/categoria/{id}/delete', [
    'middlewares' => [
        'required-admin-login',
        'time-login',
        'module-auth'
    ],
    function ($request, $id) {
        return new Response(200, Admin\CategoryArticle::getDeleteCategory($request, $id));
    }
]);

//Tela de excluir
$router->post('/admin/categoria/{id}/delete', [
    'middlewares' => [
        'required-admin-login',
        'time-login',
        'module-auth'
    ],
    function ($request, $id) {
        return new Response(200, Admin\CategoryArticle::setDeleteCategory($request, $id));
    }
]);