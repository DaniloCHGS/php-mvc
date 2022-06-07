<?php

use App\Http\Response;
use \App\Controller\Admin;
use App\Utils\Utils;

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

//Categorias

//Tela de cadastro
$router->get('/admin/categoria/new', [
    'middlewares' => [
        'required-admin-login',
        'time-login',
        'module-auth'
    ],
    function ($request) {
        return new Response(200, Admin\Blog::getNewCategory($request));
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
        return new Response(200, Admin\Blog::setNewCategory($request));
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
        return new Response(200, Admin\Blog::getEditCategory($request, $id));
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
        return new Response(200, Admin\Blog::setEditCategory($request, $id));
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
        return new Response(200, Admin\Blog::getDeleteCategory($request, $id));
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
        return new Response(200, Admin\Blog::setDeleteCategory($request, $id));
    }
]);