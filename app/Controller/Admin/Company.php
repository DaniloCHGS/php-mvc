<?php

namespace App\Controller\Admin;

use App\Utils\View;
use App\Utils\Utils;
use App\Model\Entity\Company as EntityCompany;

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
                return Alert::getSuccess('Dados da empresa criado com sucesso');
                break;
            case 'updated':
                return Alert::getSuccess('Dados da empresa atualizado com sucesso');
                break;
        }
    }

    /**
     * Retorna os dados da Identidade do site
     */
    public static function index($request)
    {
        $company = EntityCompany::getAddressById(1);

        //Conteudo da Identidade do site
        $content = View::render('admin/modules/company/index', [
            'title' => 'Dados da Empresa',
            'MODULE_URL' => URL.'/admin/dados-empresa',
            'status' => self::getStatus($request),
            'address' => $company->address ?? '',
            'cep' => $company->cep ?? '',
            'state' => $company->state ?? '',
            'phone_one' => '',
            'phone_two' => '',
            'whatsapp' => '',
            'api_wpp' => '',
            'email' => '',
            'facebook' => '',
            'instagram' => '',
            'linkedin' => '',
            'youtube' => '',
        ]);

        //Retorna página completa
        return parent::getPanel('Boss | Dados da empresa', $content, 'company');
    }

    /**
     * Atualiza
     */
    public static function updateAddressCompany($request)
    {
        $postVars = $request->getPostVars();
        
        $companyAddress = EntityCompany::getAddressById(1);
        
        if($companyAddress instanceof EntityCompany){
            $companyAddress->address = $postVars['address'] ?? $companyAddress->address;
            $companyAddress->cep = $postVars['cep'] ?? $companyAddress->cep;
            $companyAddress->state = $postVars['state'] ?? $companyAddress->state;
            $companyAddress->updateAddress();
        }

        $request->getRouter()->redirect('/admin/dados-empresa?status=updated');
    }
}
