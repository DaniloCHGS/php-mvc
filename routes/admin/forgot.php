<?php

use App\Http\Response;
use \App\Controller\Admin;

//Login
$router->get('/admin/recuperar-senha', [
    'middlewares'=> [
        'required-admin-logout'
    ],
    function ($request) {
        return new Response(200, Admin\Forgot::getForgot($request));
    }
]);
$router->post('/admin/recuperar-senha', [
    'middlewares'=> [
        'required-admin-logout'
    ],
    function ($request) {
        return new Response(200, Admin\Forgot::setForgot($request));
    }
]);
//Logout
$router->get('/admin/logout', [
    'middlewares'=> [
        'required-admin-login'
    ],
    function ($request) {
        return new Response(200, Admin\Login::setLogout($request));
    }
]);