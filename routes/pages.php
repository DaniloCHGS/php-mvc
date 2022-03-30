<?php

use App\Http\Response;
use \App\Controller\Pages;
use App\Utils\Utils;

$router->get('/', [
    function () {
        return new Response(200, Pages\Home::getHome());
    }
]);
$router->get('/sobre', [
    function () {
        return new Response(200, Pages\About::getAbout());
    }
]);
$router->get('/depoimentos', [
    function ($request) {
        return new Response(200, Pages\Depoimentos::getDepoimentos($request));
    }
]);
$router->post('/depoimentos', [
    function ($request) {
        return new Response(200, Pages\Depoimentos::insert($request));
    }
]);
