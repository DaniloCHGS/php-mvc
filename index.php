<?php
require __DIR__ . '/vendor/autoload.php';

use \App\Http\Router;
use App\Utils\Utils;
use App\Utils\View;
use WilliamCosta\DotEnv\Environment;

Environment::load(__DIR__);

//Define constante de URL
define("URL", getenv('URL'));

//Define valores padrões das variaveis
View::init(['URL' => URL]);

//Inicica o Router
$router = new Router(URL);

include __DIR__ . '/routes/pages.php';


$router->run()->sendResponse();
