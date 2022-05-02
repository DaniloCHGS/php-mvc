<?php

use App\Http\Response;
use \App\Controller\Pages;

$router->get('/', [
    'middlewares' => [
        'cache'
    ],
    function () {
        return new Response(200, Pages\Home::getHome());
    }
]);
$router->get('/sobre', [
    'middlewares' => [
        'cache'
    ],
    function () {
        return new Response(200, Pages\About::getAbout());
    }
]);
$router->get('/depoimentos', [
    'middlewares' => [
        'cache'
    ],
    function ($request) {
        return new Response(200, Pages\Depoimentos::getTestimoniess($request));
    }
]);
$router->post('/depoimentos', [
    'middlewares' => [
        'cache'
    ],
    function ($request) {
        return new Response(200, Pages\Depoimentos::insert($request));
    }
]);
