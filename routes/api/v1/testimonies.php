<?php

use App\Http\Response;
use \App\Controller\Api;

//Todos depoimentos
$router->get('/api/v1/depoimentos', [
    'middlewares' => [
        'api',
        'cache'
    ],
    function ($request) {
        return new Response(200, Api\Testimony::getTestimonies($request), 'application/json');
    }
]);
//Todos um depoimento
$router->get('/api/v1/depoimento/{id}', [
    'middlewares' => [
        'api'
    ],
    function ($request, $id) {
        return new Response(200, Api\Testimony::getTestimony($request, $id), 'application/json');
    }
]);
//Cadastro de depoimento
$router->post('/api/v1/depoimento', [
    'middlewares' => [
        'api',
        'user-basic-auth'
    ],
    function ($request) {
        return new Response(201, Api\Testimony::setNewTestimony($request), 'application/json');
    }
]);
//Edição de depoimento
$router->put('/api/v1/depoimento/{id}', [
    'middlewares' => [
        'api',
        'user-basic-auth'
    ],
    function ($request, $id) {
        return new Response(200, Api\Testimony::setEditTestimony($request, $id), 'application/json');
    }
]);
//Exclui de depoimento
$router->delete('/api/v1/depoimento/{id}', [
    'middlewares' => [
        'api',
        'user-basic-auth'
    ],
    function ($request, $id) {
        return new Response(200, Api\Testimony::setDeleteTestimony($request, $id), 'application/json');
    }
]);