<?php

namespace App\Http;

class Request
{

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

    public function __construct()
    {
        $this->queryParams  = $_GET ?? [];
        $this->postVars     = $_POST ?? [];
        $this->headers      = getallheaders();
        $this->httpMethod   = $_SERVER['REQUEST_METHOD'] ?? [];
        $this->uri          = $_SERVER['REQUEST_URI'] ?? [];
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
