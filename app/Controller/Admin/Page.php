<?php

namespace App\Controller\Admin;

use App\Utils\View;

class Page
{
    /**
     * Módulos do painel
     */
    private static $modules = [
        'home' => [
            'label' => 'Home',
            'link' => URL . '/admin',
            'icon' => 'bx-home-circle'
        ],
        'testimonies' => [
            'label' => 'Depoimentos',
            'link' => URL . '/depoimentos',
            'icon' => 'bx-message-rounded-dots'
        ],
        'users' => [
            'label' => 'Usuários',
            'link' => URL . '/usuarios',
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
}
