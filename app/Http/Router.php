<?php

namespace App\Http;

use App\Utils\Utils;
use Closure;
use Exception;
use ReflectionFunction;

class Router
{
    /**
     * URL raiz
     */
    private $url = "";
    /**
     * Prefixo das rotas
     */
    private $prefix = "";
    /**
     * Indice das rotas
     * return array
     */
    private $routes = [];

    /**
     * Instancia de Request
     */
    private $request;

    public function __construct($url)
    {
        $this->request = new Request($this);
        $this->url = $url;
        $this->setPrefix();
    }
    /**
     * Define prefixo das rotas
     */
    private function setPrefix()
    {
        //Informações da URL
        $parseUrl = parse_url($this->url);
        //Define o prefixo
        $this->prefix = $parseUrl['path'] ?? "";
    }
    /**
     * Adiciona uma rota a Classe
     */
    private function addRoute($method, $route, $params = [])
    {
        //Validação de parâmetros
        foreach ($params as $key => $value) {
            if ($value instanceof Closure) {
                $params['controller'] = $value;
                unset($params[$key]);
                continue;
            }
        }

        //Variaveis da rota
        $params['variables'] = [];

        //Padrão de variavéis das rotas
        $patternVariables = '/{(.*?)}/';

        if (preg_match_all($patternVariables, $route, $matches)) {
            $route = preg_replace($patternVariables, '(.*?)', $route);
            $params['variables'] = $matches[1];
        }

        //Padrão de validação da URL
        $patternRoute = "/^" . str_replace('/', '\/', $route) . "$/";

        //Adiciona a rota dentro da Classe
        $this->routes[$patternRoute][$method] = $params;
    }
    /**
     * Define uma rota GET
     */
    public function get($route, $params = [])
    {
        return $this->addRoute('GET', $route, $params);
    }
    /**
     * Define uma rota POST
     */
    public function post($route, $params = [])
    {
        return $this->addRoute('POST', $route, $params);
    }
    /**
     * Define uma rota PUT
     */
    public function put($route, $params = [])
    {
        return $this->addRoute('PUT', $route, $params);
    }
    /**
     * Define uma rota DELETE
     */
    public function delete($route, $params = [])
    {
        return $this->addRoute('DELETE', $route, $params);
    }
    /**
     * Retornar a URI desconsiderando o prefixo
     */
    private function getUri()
    {
        //URI da Request
        $uri = $this->request->getUri();

        //Fatia a URI com prefixo
        $xUri = strlen($this->prefix) ? explode($this->prefix, $uri) : [$uri];

        //Retorna a URI sem prefixo
        return end($xUri);
    }
    /**
     * Retorna os dados da rota atual
     * return array
     */
    private function getRoute()
    {
        //URI
        $uri = $this->getUri();

        //Metodo
        $httpMethod = $this->request->getHttpMethod();

        //Valida as rotas
        foreach ($this->routes as $patternRoute => $methods) {
            //Varifica se a URI bate o padrão
            if (preg_match($patternRoute, $uri, $matches)) {
                //Verifica metodo
                if (isset($methods[$httpMethod])) {
                    //Remove a primeira posição
                    unset($matches[0]);

                    //Chaves
                    $keys = $methods[$httpMethod]['variables'];

                    //Variaveis processadas
                    $methods[$httpMethod]['variables'] = array_combine($keys, $matches);
                    $methods[$httpMethod]['variables']['request'] = $this->request;

                    //Retorna parametros da rota
                    return $methods[$httpMethod];
                }
                throw new Exception("Método não é permitido", 405);
            }
        }
        throw new Exception("URL não encontrada", 404);
    }
    /**
     * Responsavel por executar a rota atual
     * return Response
     */
    public function run()
    {
        try {
            //Obtem rota atual
            $route = $this->getRoute();
            
            //Verifica o controlador
            if (!isset($route['controller'])) {
                throw new Exception("A URL não pode ser processada", 500);
            }
            $args = [];

            $reflection = new ReflectionFunction($route['controller']);
            foreach ($reflection->getParameters() as $parameter) {
                $name = $parameter->getName();
                $args[$name] = $route['variables'][$name] ?? "";
            }
            return call_user_func_array($route['controller'], $args);
        } catch (Exception $e) {
            return new Response($e->getCode(), $e->getMessage());
        }
    }
    /**
     * Retorna URL atual
     */
    public function getCurrentUrl(){
        return $this->url.$this->getUri();
    }
}
