<?php

use App\Http\Response;
use \App\Controller\Api;

//Todos usuarios
$router->get('/api/v1/usuarios', [
    'middlewares' => [
        'api',
        'jwt-auth'
    ],
    function ($request) {
        return new Response(200, Api\User::getUsers($request), 'application/json');
    }
]);
//Todos um usuario
$router->get('/api/v1/usuario/{id}', [
    'middlewares' => [
        'api',
        'jwt-auth'
    ],
    function ($request, $id) {
        return new Response(200, Api\User::getUser($request, $id), 'application/json');
    }
]);
//Usuário atual
$router->get('/api/v1/usuarios/me', [
    'middlewares' => [
        'api',
        'jwt-auth'
    ],
    function ($request) {
        return new Response(200, Api\User::getCurrentUser($request), 'application/json');
    }
]);
//Cadastro de usuario
$router->post('/api/v1/usuario', [
    'middlewares' => [
        'api',
        'jwt-auth'
    ],
    function ($request) {
        return new Response(201, Api\User::setNewUser($request), 'application/json');
    }
]);
//Edição de usuario
$router->put('/api/v1/usuario/{id}', [
    'middlewares' => [
        'api',
        'jwt-auth'
    ],
    function ($request, $id) {
        return new Response(200, Api\User::setEditUser($request, $id), 'application/json');
    }
]);
//Exclui de usuario
$router->delete('/api/v1/usuario/{id}', [
    'middlewares' => [
        'api',
        'jwt-auth'
    ],
    function ($request, $id) {
        return new Response(200, Api\User::setDeleteUser($request, $id), 'application/json');
    }
]);