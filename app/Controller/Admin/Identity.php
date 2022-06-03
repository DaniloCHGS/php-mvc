<?php

namespace App\Controller\Admin;

use App\Utils\View;
use App\Model\Entity\Identity as EntityIdentity;
use App\Model\Entity\Files as EntityFiles;
use App\Utils\Utils;
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
            'logo_primary' => EntityFiles::getFileById($identity->logo_primary)->web_file ?? '',
            'logo_secondary' => EntityFiles::getFileById($identity->logo_secondary)->web_file ?? '',
            'logo_footer' => EntityFiles::getFileById($identity->logo_footer)->web_file  ?? ''
            // 'logo_primary' => $identity->logo_primary ?? '',
            // 'logo_secondary' => $identity->logo_secondary ?? '',
            // 'logo_footer' => $identity->logo_footer ?? ''
        ]);
        $script = View::render('admin/modules/identity/script');
        //Retorna página completa
        return parent::getPanel('Boss - Identidade do site', $content, 'identity', $script);
    }

    /**
     * Atualiza
     */
    public static function updateIdentity($request)
    {
        $postVars = $request->getPostVars();
        $fileVars = $request->getFileVars();

        $logoPrimary = parent::uploadFile($fileVars['logo_primary']);
        $logoSecondary = parent::uploadFile($fileVars['logo_secondary']);
        $logoFooter = parent::uploadFile($fileVars['logo_footer']);

        $identity = EntityIdentity::getIdentityById(1);

        if ($identity instanceof EntityIdentity) {

            $identity->id = 1;
            $identity->title_site = $postVars['title_site'];
            $identity->description = $postVars['description'];

            $identity->logo_primary = $logoPrimary ? $logoPrimary : $identity->logo_primary;
            $identity->logo_secondary = $logoSecondary ? $logoSecondary : $identity->logo_secondary;
            $identity->logo_footer = $logoFooter ? $logoFooter : $identity->logo_footer;
            $identity->update();

            $request->getRouter()->redirect('/admin/identidade-site?status=updated');
        }
    }
}
