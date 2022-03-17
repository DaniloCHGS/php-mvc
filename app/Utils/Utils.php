<?php
namespace App\Utils;

class Utils {
    public function pre($content){
        echo "<pre>";
        print_r($content);
        echo "</pre>";
        exit;
    }
}