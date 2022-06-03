<?php
namespace App\Utils;

class View {

    /**
     * Variaveis padrões da View
     */
    private static $vars = [];
    /**
     * Define dados padrões iniciais da classe
     */
    public static function init($vars = []){
        self::$vars = $vars;
    }
    /**
     * Método responsável por retornar conteudo de uma view
     * @param string $view
     * return string
    */
    private static function getContentView($view){
        $file = __DIR__."/../../resources/view/".$view.".html";
        return file_exists($file) ? file_get_contents($file) : "";
    }

    /**
     * Método responsável por retornar conteudo renderizado de uma view
     * @param string $view
     * @param array $vars (string/numbers)
     * return string
    */
    public static function render($view, $vars = []){
        $contentView = self::getContentView($view);

        //Merge de variaveis da view
        $vars = array_merge(self::$vars, $vars);

        $keys = array_keys($vars);
        $keys = array_map(function($item){ return "{{".$item."}}"; }, $keys);

        return str_replace($keys, array_values($vars), $contentView);
    }
}