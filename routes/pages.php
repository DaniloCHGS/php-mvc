<?php

use App\Http\Response;
use \App\Controller\Pages;

$router->get('/', [
    function(){
        return new Response(200, Pages\Home::getHome());
    }
]);
$router->get('/sobre', [
    function(){
        return new Response(200, Pages\About::getAbout());
    }
]);