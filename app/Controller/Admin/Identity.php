<?php

namespace App\Controller\Admin;

use App\Utils\View;
use App\Utils\Utils;
use App\Model\Entity\Identity as EntityIdentity;
use App\Utils\UpFile;
use Phinx\Util\Util;

class Identity extends Page
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
    public static function getIdentity($request)
    {
        $identity = EntityIdentity::getIdentityById(1);

        //Conteudo da Identidade do site
        $content = View::render('admin/modules/identity/index', [
            'title' => 'Identidade do site',
            'MODULE_URL' => 'identidade-site',
            'status' => self::getStatus($request),
            'title_site' => $identity->title_site ?? '',
            'description' => $identity->description ?? '',
            'logo_primary' => $identity->logo_primary ?? '',
            'logo_secondary' => $identity->logo_secondary ?? '',
            'logo_footer' => $identity->logo_footer ?? ''
        ]);

        //Retorna página completa
        return parent::getPanel('Boss | Identidade do site', $content, 'identity');
    }

    /**
     * Atualiza
     */
    public static function updateIdentity($request)
    {
        $postVars = $request->getPostVars();
        $fileVars = $request->getFileVars();

        $logoPrimary = parent::uploadFile($fileVars['logo_primary'], 'logo/');
        $logoSecondary = parent::uploadFile($fileVars['logo_secondary'], 'logo/');
        $logoFooter = parent::uploadFile($fileVars['logo_footer'], 'logo/');

        $identity = EntityIdentity::getIdentityById(1);

        if ($identity instanceof EntityIdentity) {

            $identity->id = 1;
            $identity->title_site = $postVars['title_site'];
            $identity->description = $postVars['description'];

            $identity->logo_primary = $logoPrimary->new_name ?? $identity->logo_primary;
            $identity->logo_secondary = $logoSecondary->new_name ?? $identity->logo_secondary;
            $identity->logo_footer = $logoFooter->new_name ?? $identity->logo_footer;
            $identity->update();

            $request->getRouter()->redirect('/admin/identidade-site?status=updated');
        }

        $identity->title_site = $postVars['title_site'];
        $identity->description = $postVars['description'];
        $identity->logo_primary = $postVars['logo_primary'];
        $identity->logo_secondary = $postVars['logo_secondary'];
        $identity->logo_footer = $postVars['logo-footer'];

        $identity->logo_primary = $logoPrimary->new_name;
        $identity->logo_secondary = $logoSecondary->new_name;
        $identity->logo_footer = $logoFooter->new_name;
        $identity->register();

        $request->getRouter()->redirect('/admin/identidade-site?status=created');
    }
    /**
     * Executa upload da logo
     */
    private static function uploadLogo($file)
    {
        if ($file['error'] != 4) {
            $logo = new UpFile($file, 'logo/');
            return $logo;
        }
        return false;
    }
}
