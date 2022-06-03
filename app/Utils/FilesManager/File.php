<?php

namespace App\Utils\FilesManager;

class File{
    public $name;
    public $ext;
    public $path;

    function __construct($path)
    {
        $all_name = substr(strrchr($path, "/"), -(strlen(strrchr($path, "/")) - 1));
        $all_name = explode(".", $all_name);
        $this->name = $all_name[0];
        $this->ext = strtolower($all_name[1]);
        $this->path = substr($path, 0, strripos($path, "/")) . "/";
    }

    public function get_all_name($extension = ""){
        return $this->name . "." . ($extension == "" ? $this->ext : $extension);
    }

    public function get_all_path(){
        return $this->path . $this->get_all_name();
    }
}