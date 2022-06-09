<?php

namespace App\Utils\FilesManager;

use App\Model\Entity\Files;
use App\Utils\Utils;
use Cocur\Slugify\Slugify;

class UpFile extends BrowserFile
{
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
     * Indicativo se o upload foi realizado.
     * @var string
     */
    public $uploaded = false;

    /**
     * Indicativo de qual erro impediu o upload. 0 indica que não houve erros.
     * @var boolean
     */
    public $error_code = 0;

    /**
     * Quantidade de vez em que a função set_name() foi executada.
     * @var integer
     */
    public static $amount = 0;

    /**
     * Função construtora da classe.
     * @param array $file
     * @param string $path
     * @param string|array $allowed_extensions
     * @param bolean $default_path
     */
    function __construct($file, $path, $file_name = "", $allowed_extensions = [], $default_path = true)
    {
        //Definindo o comportamento na construção da classe
        $this->default_path = $default_path;
        $this->allowed_extensions = $allowed_extensions;

        //Definindo o caminho onde o arquivo será salvo.
        $this->path = $this->default_path ? UPLOAD_PATH . $path : $path;
        
        $this->new_name = "";

        if (isset($file)) {
            if($this->allowed_extensions != []){
                if($allowed_extensions == "img"){
                    $this->allowed_extensions = ["png", "jpg", "jpeg", "webp"];
                }
                else if($allowed_extensions == "doc"){
                    $this->allowed_extensions = ["pdf", "doc", "docx"];
                }
            }

            //Construindo a classe File
            parent::__construct($file);
            $this->set_new_name($file_name);
        }
    }

    /**
     * Função resposável por gerar o novo nome do arquivo usado no upload.
     * @return void
     */
    public function set_new_name($file_name)
    {
        if($file_name == ""){
            $data = date("Y-m-d H:i:s");
            $data = explode(" ", $data);
    
            $hora = explode(":", $data[1]);
            $data = explode("-", $data[0]);
    
            $this->new_name = implode("", $data)
                . implode("", $hora)
                . "-"
                . self::$amount;
    
            self::$amount++;
        }else if($file_name == "same_name"){
            $last_dot = strripos($this->name, ".");
            $name = substr($this->name, 0, $last_dot); 

            $this->new_name = (new Slugify())->slugify($name);
        }else{
            $this->new_name = (new Slugify())->slugify($file_name) . "." . $this->ext;
        }

        $db_file = Files::getFileByName($this->new_name . "%");
        
        if(!empty($db_file)){
            $db_name = explode(".", $db_file->file)[0];

            if($this->new_name == $db_name){
                $this->new_name = uniqid($this->new_name . "-", true);
            }
        }

        $this->new_name = (new Slugify())->slugify($this->new_name) . "." . $this->ext;
    }

    /**
     * Função responsável por fazer o upload do arquivo.
     * @return boolean
     */
    function upload()
    {
        if(Utils::path_exist($this->path)){
            if($this->check_extension()){
                $this->uploaded = move_uploaded_file($this->tmp_name, $this->path . $this->new_name);
            }else{
                $this->error_code = 2;    
            }
        }
        else{
            $this->error_code = 1;
        }
    }

    /**
     * Função responsável por checar se a extensenção do arquivo é permitida.
     * @return boolean
     */
    function check_extension(){
        if($this->allowed_extensions != []){
            if(gettype($this->allowed_extensions) == "array"){
                foreach($this->allowed_extensions as $ext){
                    if(strtolower($this->ext) == strtolower($ext)){
                        return true;
                    }
                }
    
                return false;
            }else{
                return false;
            }
        }else{
            return true;
        }
    }
}