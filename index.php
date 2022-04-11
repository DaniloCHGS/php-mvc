<?php
require __DIR__ .'/includes/app.php';

use \App\Http\Router;

//Inicica o Router
$router = new Router(URL);

//Rotas de páginas do site
include __DIR__ . '/routes/pages.php';

//Rotas de páginas do painel administrativo
include __DIR__ . '/routes/admin.php';


$router->run()->sendResponse();
