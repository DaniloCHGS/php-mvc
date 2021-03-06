<?php

use App\Http\Response;
use \App\Controller\Admin;

$router->get('/admin', [
    'middlewares'=> [
        'required-admin-login',
        'time-login'
    ],
    function ($request) {
        return new Response(200, Admin\Home::getHome($request));
    }
]);
$router->get('/admin/404', [
    'middlewares'=> [
        'required-admin-login',
        'time-login'
    ],
    function ($request) {
        return new Response(200, Admin\Home::get404($request));
    }
]);
$router->get('/admin/500', [
    'middlewares'=> [
        'required-admin-login',
        'time-login'
    ],
    function ($request) {
        return new Response(200, Admin\Home::get500($request));
    }
]);