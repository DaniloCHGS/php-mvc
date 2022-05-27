<?php

namespace App\Controller\Admin;

use App\Utils\View;
use App\Utils\Utils;
use App\Model\Entity\Banner as EntityBanner;
use \WilliamCosta\DatabaseManager\Pagination;

class Banners extends Page
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
                return Alert::getSuccess('Banner criado com sucesso');
                break;
            case 'updated':
                return Alert::getSuccess('Banner atualizado com sucesso');
                break;
            case 'deleted':
                return Alert::getSuccess('Banner excluido com sucesso');
                break;
        }
    }

    /**
     * Retorna os Depoimentos do Painel
     */
    public static function index($request)
    {
        //Conteudo de Depoimentos
        $content = View::render('admin/modules/banners/index', [
            'itens' => self::getBannerItens($request, $pagination),
            'pagination' => parent::getPagination($request, $pagination),
            'status' => self::getStatus($request)
        ]);

        //Retorna página completa
        return parent::getPanel('Boss | Banners', $content, 'banners');
    }

    /**
     * Retorna formulário de cadastro
     */
    public static function getNewBanner($request)
    {

        //Conteudo do formulário
        $content = View::render('admin/modules/banners/form', [
            'title' => 'Cadastro de Banner',
            'autor' => '',
            'depoimento' => '',
            'status' => ''
        ]);

        //Retorna página completa
        return parent::getPanel('Boss | Banners', $content, 'banners');
    }

    /**
     * Cadastra depoimento
     */
    public static function setNewBanner($request)
    {
        //Dados
        $postVars = $request->getPostVars();
        $fileVars = $request->getFileVars();
        
        $banner = new EntityBanner;
        $banner->title = $postVars['title'];
        $banner->link = $postVars['link'];
        $banner->link_target = !isset($postVars['link_target']) ? 0 : 1;
        $banner->active = !isset($postVars['active']) ? 0 : 1;

        $banner_desktop = parent::uploadFile($fileVars['banner_desktop'], 'banner/');
        $banner_mobile  = parent::uploadFile($fileVars['banner_mobile'],  'banner/mobile/');
        
        $banner->banner_desktop = $banner_desktop->new_name;
        $banner->banner_mobile = $banner_mobile->new_name;
        $banner->register();

        $request->getRouter()->redirect('/admin/banners/' . $banner->id . '/edit?status=created');
    }

    /**
     * Form para editar depoimento
     */
    public static function getEditBanner($request, $id)
    {
        $banner = EntityBanner::getBannerById($id);

        if (!$banner instanceof EntityBanner) {
            $request->getRouter()->redirect('/admin/banners');
        }

        //Conteudo do formulário
        $content = View::render('admin/modules/banners/form', [
            'title' => 'Editar Depoimento',
            'status' => self::getStatus($request),
            'title' => $banner->title,
            'link' => $banner->link,
            'banner_desktop' => $banner->banner_desktop,
            'banner_mobile' => $banner->banner_mobile,
            'active' => $banner->active,
            'link_target' => $banner->link_target
        ]);

        //Retorna página completa
        return parent::getPanel('Boss | Banners', $content, 'banners');
    }

    /**
     * Editar depoimento
     */
    public static function setEditBanner($request, $id)
    {
        $banner = EntityBanner::getBannerById($id);

        if (!$banner instanceof EntityBanner) {
            $request->getRouter()->redirect('/admin/banners');
        }

        $postVars = $request->getPostVars();
        $fileVars = $request->getFileVars();

        $banner->title = $postVars['title'] ?? $banner->title;
        $banner->link = $postVars['link'] ?? $banner->link;
        $banner->link_target = !isset($postVars['link_target']) ? 0 : 1;
        $banner->active = !isset($postVars['active']) ? 0 : 1;

        if($fileVars['banner_desktop']['error'] != 4){
            $banner_desktop = parent::uploadFile($fileVars['banner_desktop'], 'banner/');
            $banner->banner_desktop = $banner_desktop->new_name;
        }

        if($fileVars['banner_mobile']['error'] != 4){
            $banner_mobile  = parent::uploadFile($fileVars['banner_mobile'],  'banner/mobile/');
            $banner->banner_mobile = $banner_mobile->new_name;
        }
        $banner->update();

        $request->getRouter()->redirect('/admin/banners/' . $banner->id . '/edit?status=updated');
    }

    /**
     * Tela de deletar um depoimento 
     */
    public static function getDeleteBanner($request, $id)
    {
        $banner = EntityBanner::getBannerById($id);

        if (!$banner instanceof EntityBanner) {
            $request->getRouter()->redirect('/admin/banners');
        }

        //Conteudo do formulário
        $content = View::render('admin/modules/banners/delete', [
            'title' => $banner->title,
            'banner_desktop' => $banner->banner_desktop
        ]);

        //Retorna página completa
        return parent::getPanel('Boss | Banners', $content, 'banners');
    }

    /**
     * Deletar depoimento
     */
    public static function setDeleteBanner($request, $id)
    {
        $banner = EntityBanner::getBannerById($id);

        if (!$banner instanceof EntityBanner) {
            $request->getRouter()->redirect('/admin/banners');
        }

        $banner->delete();

        $request->getRouter()->redirect('/admin/banners?status=deleted');
    }

    /**
     * Renderiza os itens de depoimento na página
     */
    private function getBannerItens($request, &$pagination)
    {
        $itens = "";

        //Quantidade total de registros
        $total = EntityBanner::getBanners(null, null, null, "COUNT(*) as qtd")->fetchObject()->qtd;

        //Pagina atual
        $queryParams = $request->getQueryParams();
        $paginaAtual = $queryParams['page'] ?? 1;

        //Instancia
        $pagination = new Pagination($total, $paginaAtual, 3);

        //Resultados da página
        $results = EntityBanner::getBanners(null, 'id DESC', $pagination->getLimit());

        //Renderiza o item
        while ($obBanner = $results->fetchObject(EntityBanner::class)) {
            $itens .= View::render(
                "admin/modules/banners/itens",
                [
                    'banner_desktop' => $obBanner->banner_desktop,
                    'title' => $obBanner->title,
                    'active' => $obBanner->active == 1 ? 'Ativo' : 'Desativado',
                    'id' => $obBanner->id
                ]
            );
        }
        return $itens;
    }
}
