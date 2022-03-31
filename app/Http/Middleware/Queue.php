<?php

namespace App\Http\Middleware;

class Queue
{

    /**
     * Fila de middlewares a serem executados
     */
    private $middlewares = [];

    /**
     * Funcção de execução de controlador
     * @var Closure
     */
    private $controller;

    /**
     * Argumentos da função do controlador
     */
    private $controllerArgs = [];

    /**
     * Responsável por construir a clase de fila de middlewares
     */
    public function __construct($middlewares, $controller, $controllerArgs)
    {
        $this->middlewares = $middlewares;
        $this->controller = $controller;
        $this->controllerArgs = $controllerArgs;
    }
}
