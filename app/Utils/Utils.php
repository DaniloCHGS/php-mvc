<?php
namespace App\Utils;

class Utils {
    public static function pre($content){
        echo "<pre>";
        print_r($content);
        echo "</pre>";
        exit;
    }
    /**
     * Especifíca o tipo de usuário
     */
    public static function typeUser($type)
    {
        if ($type == 1) {
            return "Administrador";
        } else if ($type == 2) {
            return "Moderador";
        } else {
            return "Programador";
        }
    }
}