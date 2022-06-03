<?php

namespace App\Utils\FilesManager;

use App\Utils\Utils;

class UpImage extends UpFile{
    function __construct($file, $path, $file_name= "", $allowed_width = 0, $allowed_height = 0, $allowed_extensions = [], $default_path = true){
        $this->allowed_width = $allowed_width; 
        $this->allowed_height = $allowed_height;

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