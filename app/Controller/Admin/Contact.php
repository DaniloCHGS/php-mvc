<?php

namespace App\Controller\Admin;

use App\Utils\View;
use App\Utils\Utils;
use App\Model\Entity\Contact as EntityContact;

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
            case 'denied':
                return Alert::getError('Ação impossível');
                break;
            case 'updated':
                return Alert::getSuccess('Emails atualizados com sucesso');
                break;
        }
    }

    /**
     * Retorna os dados da Identidade do site
     */
    public static function index($request)
    {
        $emails_contact = self::getEmails(1);

        //Conteudo da Identidade do site
        $content = View::render('admin/modules/contact/index', [
            'title' => 'Contato',
            'MODULE_URL' => URL.'/admin/contato',
            'status' => self::getStatus($request),
            'emails_contact' => $emails_contact->emails,
            'emails_contact_id' => $emails_contact->id
        ]);

        //Retorna página completa
        return parent::getPanel('Boss | Contato', $content, 'contact');
    }

    /**
     * Atualiza
     */
    public static function updateEmails($request)
    {
        $postVars = $request->getPostVars();
        
        $id = $postVars['emails_id'] ?? '';

        if(empty($id)){
            $request->getRouter()->redirect('/admin/contato?status=denied');
        }

        $emails_contact = EntityContact::getEmailsById($id);
        
        if(!$emails_contact instanceof EntityContact){
            $request->getRouter()->redirect('/admin/contato?status=denied');
        }

        $emails_contact->emails = $postVars['emails_contact'];
        $emails_contact->update();

        $request->getRouter()->redirect('/admin/contato?status=updated');
    }

    /**
     * Busca os emails usados nos formulários
     */
    private function getEmails($id){
        return EntityContact::getEmailsById($id);
    }
}
