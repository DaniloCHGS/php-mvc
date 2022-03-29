<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Utils\View;
use WilliamCosta\DotEnv\Environment;
use WilliamCosta\DatabaseManager\Database;

//Carrega variaveis de ambiente
Environment::load(__DIR__."/../");

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

//Define valores padrões das variaveis
View::init(['URL' => URL]);