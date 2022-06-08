<?php

namespace App\Utils\FilesManager;

use App\Utils\Utils;

class UpImage extends UpFile{
    /**
     * Realiza o upload de uma imagem, desde que o arquivo passe 
     * em todas as verificações. As verificações possíveis são:
     * |Resolução da imagem -> a imagem deve ter uma largura e 
     * altura especificas. Ex: 1280x720.|
     * |Extenção do arquivo -> a imagem deve ser do formato 
     * exigido. Ex: png, jpg ou webp.|
     * 
     * @var array $file
     * @var string $path
     * @var string $file_name - Aleátorio: "" | Igual: "same_name" | Livre: "nome_especifico"
     * @var array $resolution - [width, heigth]
     * @var array|string $allowed_extensions - Padrão: "img" | ["png", "jpeg"]
     * @var bool $default_path
     */
    function __construct($file, $path, $file_name= "", $resolution = [0, 0], $allowed_extensions = [], $default_path = true){
        $this->allowed_width = $resolution[0]; 
        $this->allowed_height = $resolution[1];

        //Construindo a classe UpFile
        parent::__construct(
            $file, 
            $path, 
            $file_name, 
            $allowed_extensions != [] ? $allowed_extensions : "img",
            $default_path
        );

        list($this->width, $this->height) = getimagesize($this->tmp_name);

        $can_upload = true;

        if(($this->allowed_width > 0) && ($this->width != $this->allowed_width)){
            $can_upload = false;
        }
        if(($this->allowed_height > 0) && ($this->height != $this->allowed_height)){
            $can_upload = false;
        }

        if($can_upload){
            parent::upload();
        }else{
            $this->error_code = 3;
        }
    }
}