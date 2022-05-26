<?php

namespace App\Controller\Admin;

use App\Utils\View;
use App\Utils\Utils;
use App\Model\Entity\Company as EntityCompany;

class Contact extends Page
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
        //Conteudo da Identidade do site
        $content = View::render('admin/modules/contact/index', [
            'title' => 'Contato',
            'MODULE_URL' => URL.'/admin/contato',
            'status' => self::getStatus($request)
        ]);

        //Retorna página completa
        return parent::getPanel('Boss | Contato', $content, 'contact');
    }

    /**
     * Atualiza
     */
    public static function updateAddressCompany($request)
    {
        $postVars = $request->getPostVars();
        
        $company = EntityCompany::getAddressById(1);
        
        if($company instanceof EntityCompany){
            $company->address = $postVars['address'] ?? $company->address;
            $company->cep = $postVars['cep'] ?? $company->cep;
            $company->state = $postVars['state'] ?? $company->state;
            $company->updateAddress();
        }

        $request->getRouter()->redirect('/admin/dados-empresa?status=updated');
    }

    /**
     * Atualiza
     */
    public static function updateContactCompany($request)
    {
        $postVars = $request->getPostVars();
        
        $company = EntityCompany::getContactById(1);
        
        if($company instanceof EntityCompany){
            $company->email = $postVars['email'] ?? $company->email;
            $company->phone_one = $postVars['phone_one'] ?? $company->phone_one;
            $company->phone_two = $postVars['phone_two'] ?? $company->phone_two;
            $company->whatsapp = $postVars['whatsapp'] ?? $company->whatsapp;
            $company->api_wpp = $postVars['api_wpp'] ?? $company->api_wpp;
            $company->updateContact();
        }

        $request->getRouter()->redirect('/admin/dados-empresa?status=updated');
    }

    /**
     * Atualiza
     */
    public static function updateSocialCompany($request)
    {
        $postVars = $request->getPostVars();
        
        $company = EntityCompany::getSocialById(1);
        
        if($company instanceof EntityCompany){
            $company->facebook = $postVars['facebook'] ?? $company->facebook;
            $company->youtube = $postVars['youtube'] ?? $company->youtube;
            $company->instagram = $postVars['instagram'] ?? $company->instagram;
            $company->linkedin = $postVars['linkedin'] ?? $company->linkedin;
            $company->updateSocial();
        }

        $request->getRouter()->redirect('/admin/dados-empresa?status=updated');
    }
}
