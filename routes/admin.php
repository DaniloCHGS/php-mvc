<?php

use App\Http\Response;
use \App\Controller\Admin;

$router->get('/admin', [
    function () {
        return new Response(200, 'Admin');
    }
]);
$router->get('/admin/login', [
    function ($request) {
        return new Response(200, Admin\Login::getLogin($request));
    }
]);