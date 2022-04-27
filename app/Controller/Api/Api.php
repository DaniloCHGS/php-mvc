<?php

namespace App\Controller\Api;

class Api {
    /**
     * Retorna os detalhes da API
     */
    public static function getDetails($request){
        return [
            'name'      =>  'API - Painel',
            'version'   =>  'v1.0.0',
            'author'    =>  'Tática'
        ];
    }

    /**
     * Retorna paginação
     */
    protected static function getPagination($request, $pagination){
        //Query Params
        $queryParams = $request->getQueryParams();

        //Página
        $page = $pagination->getPages();

        return [
            'currentPage' => isset($queryParams['page']) ? (int)$queryParams['page'] : 1,
            'quantityPages' => !empty($page) ? count($page) : 1
        ];
    }
}