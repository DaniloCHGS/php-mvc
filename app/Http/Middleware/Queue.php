<?php

namespace App\Http\Middleware;

class Queue
{

    /**
     * Mapeamento de middlewares
     */
    private static $map = [];

    /**
     * Mapeamento de middlewares que serão carregados em todas rotas
     */
    private static $default = [];
    /**
     * Fila de middlewares a serem executados
     */
    private $middlewares = [];

    /**
     * Função de execução de controlador
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
        $this->middlewares      = array_merge(self::$default, $middlewares);
        $this->controller       = $controller;
        $this->controllerArgs   = $controllerArgs;
    }
    /**
     * Define mapeamento de middlewares
     */
    public static function setMap($map)
    {
        self::$map = $map;
    }
    /**
     * 
     */
    public static function setDefault($default)
    {
        self::$default = $default;
    }
    /**
     * Executa o próximo nível da fila de middlewares
     */
    public function next($request)
    {
        //Valida instancia de controller
        if (!is_callable($this->controller)) {
            throw new \Exception("Tipo esperado 'callable'. Mas veio  '...\Middleware\Closure'");
        }
        //Verifica se a fila esta vazia
        if (empty($this->middlewares)) return call_user_func_array($this->controller, $this->controllerArgs);

        //Middleware
        $middleware = array_shift($this->middlewares);

        //verifica o mapeamento
        if (!isset(self::$map[$middleware])) {
            throw new \Exception("Problemas ao processar o middleware da requisição", 500);
        }

        //Next
        $queue = $this;
        $next = function ($request) use ($queue) {
            return $queue->next($request);
        };
        
        return (new self::$map[$middleware])->handle($request, $next);
    }
}
