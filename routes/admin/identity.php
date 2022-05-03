<?php

use App\Http\Response;
use \App\Controller\Admin;

//Lista tela da identidade do site
$router->get('/admin/identidade-site', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request) {
        return new Response(200, Admin\Identity::getIdentity($request));
    }
]);

//Tela de cadastro
$router->get('/admin/identidade-site/new', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request) {
        return new Response(200, Admin\Identity::getNewTestimonies($request));
    }
]);

//Cadastro
$router->post('/admin/identidade-site/new', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request) {
        return new Response(200, Admin\Identity::setNewTestimonies($request));
    }
]);

//Tela de editar
$router->get('/admin/identidade-site/{id}/edit', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request, $id) {
        return new Response(200, Admin\Identity::getEditTestimonies($request, $id));
    }
]);

//Editar
$router->post('/admin/identidade-site/{id}/edit', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request, $id) {
        return new Response(200, Admin\Identity::setEditTestimonies($request, $id));
    }
]);

//Tela de excluir
$router->get('/admin/identidade-site/{id}/delete', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request, $id) {
        return new Response(200, Admin\Identity::getDeleteTestimonies($request, $id));
    }
]);

//Excluir
$router->post('/admin/identidade-site/{id}/delete', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request, $id) {
        return new Response(200, Admin\Identity::setDeleteTestimonies($request, $id));
    }
]);
