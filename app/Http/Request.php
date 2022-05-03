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

    private $fileVars = [];

    /**
     * Cabeçalho da requisição
     */
    private $headers = [];

    public function __construct($router)
    {
        $this->router = $router;
        $this->queryParams  = $_GET ?? [];
        $this->headers      = getallheaders();
        $this->httpMethod   = $_SERVER['REQUEST_METHOD'] ?? [];
        $this->setUri();
        $this->setPostVars();
        $this->setFileVars();
    }

    /**
     * Define variaveis do post
     */
    private function setPostVars(){
        if($this->httpMethod == 'GET') return false;

        $this->postVars = $_POST ?? [];

        $inputRaw = file_get_contents('php://input');
        $this->postVars = (strlen($inputRaw) && empty($_POST)) ? json_decode($inputRaw, true) : $this->postVars;
    }

    private function setFileVars(){
        if($this->httpMethod == 'GET') return false;

        $this->fileVars = $_FILES ?? [];

        $inputRaw = file_get_contents('php://input');
        $this->fileVars = (strlen($inputRaw) && empty($_FILES)) ? json_decode($inputRaw, true) : $this->fileVars;
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
    public function getFileVars()
    {
        return $this->fileVars;
    }
}
