<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Utils\View;
use WilliamCosta\DotEnv\Environment;
use WilliamCosta\DatabaseManager\Database;
use App\Http\Middleware\Queue as MiddlewareQueue;

//Carrega variaveis de ambiente
Environment::load(__DIR__ . "/../");

//Define as configs do BD
Database::config(
    getenv('DB_HOST'),
    getenv('DB_NAME'),
    getenv('DB_USER'),
    getenv('DB_PASS'),
    getenv('DB_PORT')
);

//Define constante de URL
define("URL", getenv('URL'));
define("URL_CONTENT", getenv('URL_CONTENT'));
define("ADMIN_ASSETS", getenv('ADMIN_ASSETS'));

//Define valores padrões das variaveis
View::init(['URL' => URL, 'URL_CONTENT' => URL_CONTENT, 'ADMIN_ASSETS'=> ADMIN_ASSETS]);

//Define o mapeamento de middlewares
MiddlewareQueue::setMap([
    'maintenance' =>            \App\Http\Middleware\Maintenance::class,
    'api' =>                    \App\Http\Middleware\Api::class,
    'jwt-auth' =>               \App\Http\Middleware\JWTAuth::class,
    'cache' =>                  \App\Http\Middleware\Cache::class,
    'required-admin-logout' =>  \App\Http\Middleware\RequireredAdminLogout::class,
    'required-admin-login' =>   \App\Http\Middleware\RequireredAdminLogin::class,
    'user-basic-auth' =>        \App\Http\Middleware\UserBasicAuth::class,
    'time-login' =>             \App\Http\Middleware\TimeLogin::class,
    'module-auth' =>            \App\Http\Middleware\ModuleAuth::class
]);
//Define o mapeamento de middlewares padrões em todas as rotas
MiddlewareQueue::setDefault([
    'maintenance'
]);
