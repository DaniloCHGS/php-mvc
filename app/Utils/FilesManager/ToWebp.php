<?php

namespace App\Utils\FilesManager;

use App\Utils\FilesManager\File;
use App\Utils\Utils;

class ToWebp{
    private $save_path;
    
    function __construct($save_path = ""){
        $save_path = $save_path == "" ? UPLOAD_PATH : $save_path;
        
        $this->set_save_path($save_path);
    }

    public function set_save_path($save_path){
        $this->save_path = $save_path;
    }
    
    public function convert($image_path){
        if(Utils::path_exist($this->save_path)){
            $fromimage = new File($image_path);
            
            switch($fromimage->ext){
                case "png":
                    $image = imagecreatefrompng($fromimage->get_all_path());
                    break;
                case "jpg" || "jpeg":
                    $image = imagecreatefromjpeg($fromimage->get_all_path());
                    break;
                default:
                    $image = "";
                    break;
            }
    
            if($image != ""){
                imagewebp($image, $this->save_path . $fromimage->get_all_name("webp"));
                imagedestroy($image);
                
                if($this->save_path == UPLOAD_PATH){
                    return $fromimage->get_all_name("webp");
                }else{
                    return $this->save_path . $fromimage->get_all_name("webp");
                }
            }
        }

        return "";
    }
}