<?php
namespace App\Utils\FilesManager;

use App\Utils\Utils;

class BrowserFile
{
    /**
     * Extensão do arquivo sem o ".".
     * @var string
     */
    public $ext;

    /**
     * Equivalente a chave ["name"] dos arquivos.
     * @var string
     */
    public $name;

    /**
     * Equivalente a chave ["type"] dos arquivos.
     * @var string
     */
    public $type;

    /**
     * Equivalente a chave ["tmp_name"] dos arquivos.
     * @var string
     */
    public $tmp_name;

    /**
     * Equivalente a chave ["error"] dos arquivos.
     * @var string
     */
    public $error;

    /**
     * Equivalente a chave ["size"] dos arquivos.
     * @var string
     */
    public $size;

    /**
     * Função construtora da classe.
     */
    function __construct($file)
    {
            //Carregando arquivo na classe
            $this->name = $file["name"];
            $this->type = $file["type"];
            $this->tmp_name = $file["tmp_name"];
            $this->error = $file["error"];
            $this->size = $file["size"];

            $this->get_extension();
    }

    /**
     * Função resposável por extrair a extensão do arquivo.
     * @return void
     */
    function get_extension()
    {
        $this->ext = explode(".", $this->name)[count(explode(".", $this->name)) - 1];
    }
}
