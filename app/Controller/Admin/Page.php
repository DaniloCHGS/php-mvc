<?php

namespace App\Controller\Admin;

use App\Utils\View;
use App\Utils\UpFile;
use App\Model\Entity\AccessArea as EntityAccessArea;
use App\Utils\Utils;

class Page
{
    /**
     * Módulos do painel
     */
    // Site de ícones https://boxicons.com/
    private static $modules = [
        'home' => [
            'label' => 'Home',
            'link' => URL . '/admin',
            'icon' => 'bx-home-circle'
        ],
        'testimonies' => [
            'label' => 'Depoimentos',
            'link' => URL . '/admin/depoimentos',
            'icon' => 'bx-message-rounded-dots'
        ],
        'company' => [
            'label' => 'Dados da Empresa',
            'link' => URL . '/admin/dados-empresa',
            'icon' => 'bx-buildings'
        ],
        'identity' => [
            'label' => 'Identidade do Site',
            'link' => URL . '/admin/identidade-site',
            'icon' => 'bx-palette'
        ],
        'access_area' => [
            'label' => 'Área de Acesso',
            'link' => URL . '/admin/area-de-acesso',
            'icon' => 'bx-cog'
        ],
        'users' => [
            'label' => 'Usuários',
            'link' => URL . '/admin/usuarios',
            'icon' => 'bx-user'
        ],
    ];
    /**
     * Retorna o conteudo (view) da estrutura principal do painel
     */
    public static function getPage($title, $content)
    {
        return View::render("admin/page", [
            'title'     => $title,
            'content'   => $content
        ]);
    }
    /**
     * Renderiza o menu
     */
    private static function getMenu($currentModule)
    {
        $entityModules = self::getModules();

        //Links do menu
        $links = "";

        foreach (self::$modules as $hash => $module) {
            $links .= View::render('admin/menu/link', [
                'label' => $module['label'],
                'link'  => $module['link'],
                'icon'  => $module['icon'],
                'current'  => $hash == $currentModule ? 'active' : ''
            ]);
        }

        //Retorna renderização do menu
        return View::render("admin/menu/box", [
            'links' => $links
        ]);
    }
    /**
     * Busca todos módulos cadastrados no banco
     */
    private static function getModules()
    {
        $entityModules = [];

        $results = EntityAccessArea::getAccess();

        while ($entityModule = $results->fetchObject(EntityAccessArea::class)) {
            $entityModules[] = $entityModule;
        }
        return $entityModules;
    }
    /**
     * Retorna a estrutura do painel com conteudo dinamico
     */
    public static function getPanel($title, $content, $currentModule)
    {
        //Renderiza a view do painel
        $contentPanel = View::render('admin/panel', [
            'menu' => self::getMenu($currentModule),
            'content' => $content
        ]);
        //Retorna a página renderizada
        return self::getPage($title, $contentPanel);
    }
    /**
     * Renderiza o layout de paginação
     */
    public static function getPagination($request, $pagination)
    {
        //Pagina
        $pages = $pagination->getPages();

        //Verifica quantidade de páginas
        if (count($pages) <= 1) {
            return "";
        }

        //links
        $links = "";

        //URL atual (Sem GETS)
        $url = $request->getRouter()->getCurrentUrl();

        //GET
        $queryParams = $request->getQueryParams();

        //Renderiza os links
        foreach ($pages as $page) {
            //Altera página
            $queryParams['page'] = $page['page'];

            //Link
            $link = $url . "?" . http_build_query($queryParams);

            //View
            $links .= View::render("admin/pagination/link", [
                "page" => $page['page'],
                "link" => $link,
                "active" => $page['current'] ? 'active' : ''
            ]);
        }
        //Renderiza box
        return View::render("admin/pagination/box", [
            "links" => $links
        ]);
    }
    public static function uploadFile($file, $path, $config = [])
    {
        if ($file['error'] != 4 and !empty($path)) {
            $fileUploaded = new UpFile($file, $path, $config);
            return $fileUploaded;
        }
        return false;
    }
}
