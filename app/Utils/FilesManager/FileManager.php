<?php
namespace App\Utils\FilesManager;

use App\Model\Entity\Files as EntityFiles;
use App\Utils\FilesManager as Files;
use App\Utils\Utils;

class FileManager {

    private $file;
    private $web_file;

    /**
     * Responsável por trazer todos os arquivos do banco.
     */
    public static function getAllFiles(){
        return EntityFiles::getFiles();
    }

    /**
     * Insere no banco um arquivo
     */
    public function createFile(){
        $file = new EntityFiles;

        $file->file = $this->file;
        $file->web_file = $this->web_file;
        
        $file->register();

        return $file->id;
    }

    public function setFile($file, $extensions = [], $file_name = "same_name"){
        $file = new Files\UpFile($file, "", $file_name, $extensions);
        $file->upload();

        if($file->uploaded){
            $this->file = $file->new_name;
            $this->web_file = "";
        }

        return $file->error_code;
    }

    public function setImage($file, $extensions = "img", $file_name = "same_name"){
        $image = new Files\UpImage($file, "", $file_name, $extensions);

        if($image->uploaded){
            $toWebp = new Files\ToWebp();
            $web_file = $toWebp->convert($image->path . $image->new_name);
            
            if($web_file != ""){
                $this->file = $image->new_name;
                $this->web_file = $web_file;
            }else{
                $this->file = $file->new_name;
                $this->web_file = "";
            }
        }

        return $image->error_code;
    }
}