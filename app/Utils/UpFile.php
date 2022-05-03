<?php
namespace App\Utils;

use App\Utils\Utils;

class UpFile
{
    /**
     * Caminho padrão do boss para salvar arquivos.
     * @var string
     */
    const DEFAULT_PATH = "../../resources/content/";

    /**
     * Caminho da pasta para a qual será feito o upload do arquivo.
     * @var string
     */
    public $path;

    /**
     * Nome gerado aleatoriamente baseado na data e hora.
     * @var string
     */
    public $new_name;

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
     * Indicativo se o upload foi realizado.
     * @var string
     */
    public $uploaded = false;

    /**
     * Função construtora da classe.
     */
    function __construct($file, $path, $config = [])
    {
        if (!empty($file)) {
            //Definindo o comportamento na construção da classe
            $default_path = $config["default_path"] ?? false;
            $auto_upload = $config["auto_upload"] ?? true;

            //Carregando arquivo na classe
            $this->name = $file["name"];
            $this->type = $file["type"];
            $this->tmp_name = $file["tmp_name"];
            $this->error = $file["error"];
            $this->size = $file["size"];

            //Definindo o caminho onde o arquivo será salvo.
            $this->path = $default_path ? $path : self::DEFAULT_PATH . $path;

            $this->get_extension();
            $this->set_new_name();

            if ($auto_upload) {
                $this->upload();
            }
        } else {
            $this->new_name = "";
        }
    }

    /**
     * Função resposável por gerar o novo nome do arquivo usado no upload.
     * @return void
     */
    function set_new_name()
    {
        $data = date("Y-m-d H:i:s");
        $data = explode(" ", $data);

        $hora = explode(":", $data[1]);
        $data = explode("-", $data[0]);

        $this->new_name = implode("", $data)
            . implode("", $hora)
            . "."
            . $this->ext;
    }

    /**
     * Função resposável por extrair a extensão do arquivo.
     * @return void
     */
    function get_extension()
    {
        $this->ext = explode(".", $this->name)[count(explode(".", $this->name)) - 1];
    }

    /**
     * Retorna o caminho completo do novo arquivo.
     * @return string
     */
    function get_all_path()
    {
        return $this->path . $this->new_name;
    }

    /**
     * Função responsável por fazer o upload do arquivo.
     * @return boolean
     */
    function upload()
    {
        $this->uploaded = move_uploaded_file($this->tmp_name, $this->get_all_path());

        return $this->uploaded;
    }
}
