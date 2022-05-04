<?php

namespace App\Controller\Admin;

use App\Utils\View;
use App\Utils\Utils;
use App\Utils\UpFile;

class Company extends Page
{
    /**
     * Mensagem de status
     */
    private static function getStatus($request)
    {
        $queryParams = $request->getQueryParams();

        if (!isset($queryParams['status'])) return '';

        switch ($queryParams['status']) {
            case 'created':
                return Alert::getSuccess('Identidade do site criada com sucesso');
                break;
            case 'updated':
                return Alert::getSuccess('Identidade do site atualizada com sucesso');
                break;
        }
    }

    /**
     * Retorna os dados da Identidade do site
     */
    public static function index($request)
    {
        //Conteudo da Identidade do site
        $content = View::render('admin/modules/company/index', [
            'title' => 'Dados da Empresa',
            'MODULE_URL' => URL.'/dados-empresa',
            'status' => self::getStatus($request),
            'address' => '',
            'cep' => '',
            'state' => ''
        ]);

        //Retorna página completa
        return parent::getPanel('Boss | Dados da empresa', $content, 'company');
    }

    /**
     * Atualiza
     */
    public static function updateIdentity($request)
    {
        $postVars = $request->getPostVars();
        $fileVars = $request->getFileVars();

        $request->getRouter()->redirect('/admin/dados-empresa?status=created');
    }
}
