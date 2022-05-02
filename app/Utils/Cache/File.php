<?php

namespace App\Utils\Cache;

use App\Utils\Utils;
use Phinx\Util\Util;

class File
{
    /**
     * Responsável por obter uma informação do cache
     */
    public static function getCache($hash, $expiration, $function)
    {
        //Verifica conteudo gravado
        if ($content = self::getContentCach($hash, $expiration)) {
            return $content;
        }
        //Execução da função
        $content = $function();

        //Grava o retorno no cache
        self::storageCache($hash, $content);

        return $content;
    }
    /**
     * Responsável por guardar informações no cache
     */
    private static function storageCache($hash, $content)
    {
        //Serealiza o retorno
        $serialize = serialize($content);

        //Caminho do arquivo
        $cacheFile = self::getFilePath($hash);

        //Grava as informações no arquivo
        return file_put_contents($cacheFile, $serialize);
    }
    /**
     * Retorna o caminho do arquivo de cache
     */
    private static function getFilePath($hash)
    {
        //Diretório de cache
        $dir = getenv('CACHE_DIR');
        //Verifica existencia do diretório
        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }
        //Retornar caminho até o caminho
        return $dir . '/' . $hash;
    }
    /**
     * Responsável por retornar conteúdo gravado no cache
     */
    private static function getContentCach($hash, $expiration)
    {
        //Obtem caminho do arquivo
        $cacheFile = self::getFilePath($hash);

        //Verifica existencia do arquivo
        if (!file_exists($cacheFile)) {
            return false;
        }

        //Valida a expiração do cache
        $createTime = filectime($cacheFile);
        $difTime = time() - $createTime;

        if ($difTime > $expiration) {
            return false;
        }

        $serialize = file_get_contents($cacheFile);

        //Retorna o dado real
        return unserialize($serialize);
    }
}
