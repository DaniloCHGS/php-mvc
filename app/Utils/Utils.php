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
            return "Moderador";
        } else if ($type == 2) {
            return "Administrador";
        } else {
            return "Programador";
        }
    }
    
    /**
     * Verifica se uma pasta existe, caso não exista ela é criada.
     * @var string $path -- Diretório desejado 
     * @return bool -- True se a pasta existir ou for criada com sucesso, False caso não existe e não seja criada.
     */
    public static function path_exist($path){
        if(!file_exists($path)){
            if(!mkdir($path)){
                return false;
            }
        }

        return true;
    }
}