<?php

namespace App\Http;

use App\Utils\Utils;

class Request
{

    /**
     * Instancia Router
     */
    private $router;
    /**
     * Método Http da requisição
     */
    private $httpMethod;

    /**
     * URI da página (rota)
     */
    private $uri;

    /**
     * Parâmetros URL (GET)
     */
    private $queryParams = [];

    /**
     * Variavéis recebidas da requisição (POST)
     */
    private $postVars = [];

    /**
     * Cabeçalho da requisição
     */
    private $headers = [];

    public function __construct($router)
    {
        $this->router = $router;
        $this->queryParams  = $_GET ?? [];
        $this->postVars     = $_POST ?? [];
        $this->headers      = getallheaders();
        $this->httpMethod   = $_SERVER['REQUEST_METHOD'] ?? [];
        $this->setUri();
    }

    /**
     * Define a URI
     */
    private function setUri(){
        //URI completa (com GETS)
        $this->uri = $_SERVER['REQUEST_URI'] ?? [];

        //Remover GETS
        $xUri = explode("?", $this->uri);
        $this->uri = $xUri[0];
    }
    /**
     * Retornar o Router
     */
    public function getRouter()
    {
        return $this->router;
    }
    public function getHttpMethod()
    {
        return $this->httpMethod;
    }
    public function getUri()
    {
        return $this->uri;
    }
    public function getHeaders()
    {
        return $this->headers;
    }
    public function getPostVars()
    {
        return $this->postVars;
    }
    public function getQueryParams()
    {
        return $this->queryParams;
    }
}
