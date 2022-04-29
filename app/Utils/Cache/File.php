<?php
namespace App\Utils\Cache;

use App\Utils\Utils;

class File {
    /**
     * Responsável por obter uma informação do cache
     */
    public static function getCache($hash, $expiration, $function){
        //Execução da função
        $content = $function();

        //Grava o retorno no cache
        self::storageCache($hash, $content);

        return $content;
    }
    /**
     * Responsável por guardar informações no cache
     */
    private static function storageCache($hash, $content){
        //Serealiza o retorno
        $serialize = serialize($content);
        
        //Caminho do arquivo
        $cacheFile = self::getFilePath($hash);
    }
    /**
     * Retorna o caminho do arquivo de cache
     */
    private static function getFilePath($hash){
        //Diretório de cache
        $dir = getenv('CACHE_DIR');
        Utils::pre($dir);
    }
    
}