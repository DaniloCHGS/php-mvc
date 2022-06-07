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
$router->post('/admin/blog/new', [
    'middlewares' => [
        'required-admin-login',
        'time-login',
        'module-auth'
    ],
    function ($request) {
        return new Response(200, Admin\Blog::setNewArticle($request));
    }
]);

//Tela de editar
$router->get('/admin/blog/{id}/edit', [
    'middlewares' => [
        'required-admin-login',
        'time-login',
        'module-auth'
    ],
    function ($request, $id) {
        return new Response(200, Admin\Blog::getEditArticle($request, $id));
    }
]);

//Editar
$router->post('/admin/blog/{id}/edit', [
    'middlewares' => [
        'required-admin-login',
        'time-login',
        'module-auth'
    ],
    function ($request, $id) {
        return new Response(200, Admin\Blog::setEditArticle($request, $id));
    }
]);

//Tela de excluir
$router->get('/admin/blog/{id}/delete', [
    'middlewares' => [
        'required-admin-login',
        'time-login',
        'module-auth'
    ],
    function ($request, $id) {
        return new Response(200, Admin\Blog::getDeleteArticle($request, $id));
    }
]);

//Excluir
$router->post('/admin/blog/{id}/delete', [
    'middlewares' => [
        'required-admin-login',
        'time-login',
        'module-auth'
    ],
    function ($request, $id) {
        return new Response(200, Admin\Blog::setDeleteBlog($request, $id));
    }
]);
