<?php

namespace App\Http;

class Response
{

    /**
     * Código do status HTTP
     * return integer
     */
    private $httpCode = 200;
    /**
     * Cabeçalhos da requisição
     * return array
     */
    private $headers = [];
    /**
     * Tipo de conteudo que está sendo retornado
     * return string
     */
    private $contentType = "text/html";
    /**
     * Conteudo da Resposta
     * return mixed
     */
    private $content;
    /**
     * Método responsável por iniciar a classe e definir valores
     */
    public function __construct($httpCode, $content, $contentType = "text/html")
    {
        $this->httpCode = $httpCode;
        $this->content = $content;
        $this->setContentType($contentType);
    }
    /**
     * Método responsável por alterar o content type da Response
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
        $this->addHeaders('Content-Type', $contentType);
    }
    /**
     * Método responsável por adicionar um cabeçalho
     */
    public function addHeaders($key, $value)
    {
        $this->headers[$key] = $value;
    }
    /**
     * Envia os headers para o navegador
     */
    private function sendHeades()
    {
        http_response_code($this->httpCode);

        foreach ($this->headers as $key => $value) {
            header($key . ': ' . $value);
        }
    }
    /**
     * Método responsável por enviar a resposta para o usuário
     */
    public function sendResponse()
    {
        $this->sendHeades();

        switch ($this->contentType) {
            case "text/html":
                echo $this->content;
                exit;
            case "application/json":
                echo json_encode($this->content, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                exit;
        }
    }
}
