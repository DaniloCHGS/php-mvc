<?php

namespace App\Controller\Admin;

use App\Utils\View;
use App\Utils\UpFile;
use App\Model\Entity\AccessArea as EntityAccessArea;
use App\Utils\Utils;
use App\Utils\Historic;

class Page
{
    /**
     * Módulos do painel
     */
    // Site de ícones https://boxicons.com/
    private static $modules = [
        'testimonies' => [
            'label' => 'Depoimentos',
            'link' => URL . '/admin/depoimentos',
            'icon' => 'bx-message-rounded-dots',
            'id' => 6,
            'admin' => 1
        ],
        'company' => [
            'label' => 'Dados da Empresa',
            'link' => URL . '/admin/dados-empresa',
            'icon' => 'bx-buildings',
            'id' => 1,
            'admin' => 1
        ],
        'identity' => [
            'label' => 'Identidade do Site',
            'link' => URL . '/admin/identidade-site',
            'icon' => 'bx-palette',
            'id' => 2,
            'admin' => 1
        ],
        'access_area' => [
            'label' => 'Área de Acesso',
            'link' => URL . '/admin/area-de-acesso',
            'icon' => 'bx-cog',
            'id' => 3,
            'admin' => 3
        ],
        'users' => [
            'label' => 'Usuários',
            'link' => URL . '/admin/usuarios',
            'icon' => 'bx-user',
            'id' => 4,
            'admin' => 2
        ],
    ];
    /**
     * Retorna o conteudo (view) da estrutura principal do painel
     */
    public static function getPage($title, $content, $script = null)
    {
        return View::render("admin/page", [
            'title'     => $title,
            'content'   => $content,
            'script' => $script
        ]);
    }
    /**
     * Renderiza o menu
     */
    private static function getMenu($currentModule)
    {
        //Links do menu
        $links = "";

        // $entityModules = self::getModules();
        $userLevel = $_SESSION['admin']['user']['admin'];
        $user_access_area = $_SESSION['admin']['user']['access_area'];

        foreach (self::$modules as $hash => $module) {

            if ($userLevel == 1 and $module['admin'] == 1) {

                $modulesUser = explode('-', $user_access_area);
                $hasModule = in_array($module['id'], $modulesUser);

                if ($hasModule == 1) {
                    $links .= View::render('admin/menu/link', [
                        'label' => $module['label'],
                        'link'  => $module['link'],
                        'icon'  => $module['icon'],
                        'current'  => $hash == $currentModule ? 'active' : ''
                    ]);
                }
            } else if($userLevel >= $module['admin']){
                $links .= View::render('admin/menu/link', [
                    'label' => $module['label'],
                    'link'  => $module['link'],
                    'icon'  => $module['icon'],
                    'current'  => $hash == $currentModule ? 'active' : ''
                ]);
            }
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
    public static function getPanel($title, $content, $currentModule, $script = null)
    {
        //Renderiza a view do painel
        $contentPanel = View::render('admin/panel', [
            'menu' => self::getMenu($currentModule),
            'content' => $content
        ]);
        //Retorna a página renderizada
        return self::getPage($title, $contentPanel, $script);
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
