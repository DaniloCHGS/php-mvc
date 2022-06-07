<?php

namespace App\Controller\Admin;

use App\Utils\View;
use App\Utils\Utils;
use App\Model\Entity\Article as EntityArticle;
use App\Model\Entity\CategoryArticle as EntityCategory;
use \WilliamCosta\DatabaseManager\Pagination;

class CategoryArticle extends Page
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
                return Alert::getSuccess('Categoria criada com sucesso');
                break;
            case 'updated':
                return Alert::getSuccess('Categoria atualizada com sucesso');
                break;
            case 'deleted':
                return Alert::getSuccess('Categoria excluida com sucesso');
                break;
        }
    }

    /**
     * Retorna os Depoimentos do Painel
     */
    public static function index($request)
    {
        //Conteudo de Depoimentos
        $content = View::render('admin/modules/blog/index', [
            'itens' => self::getArticleItens($request, $pagination),
            'categories' => self::getCategoryItens($request, $pagination),
            'pagination' => parent::getPagination($request, $pagination),
            'status' => self::getStatus($request)
        ]);

        //Retorna página completa
        return parent::getPanel('Boss - Blog', $content, 'blog');
    }

    /**
     * Retorna formulário de cadastro
     */
    public static function getNewCategory($request)
    {

        //Conteudo do formulário
        $content = View::render('admin/modules/blog/category/form', [
            'title_module' => 'Cadastro de Categoria',
            'status' => '',
            'title' => '',
            'slug' => '',
        ]);

        //Retorna página completa
        return parent::getPanel('Boss - Categoria', $content, 'blog');
    }

    /**
     * Cadastra depoimento
     */
    public static function setNewCategory($request)
    {
        //Dados
        $postVars   = $request->getPostVars();

        $category = new EntityCategory;

        $category->title = $postVars['title'];
        $category->slug = $postVars['slug'];

        $category->register();

        $request->getRouter()->redirect('/admin/blog/' . $category->id . '/edit?status=created');
    }

    /**
     * Form para editar depoimento
     */
    public static function getEditCategory($request, $id)
    {
        $category = EntityCategory::getCategoryById($id);

        if (!$category instanceof EntityCategory) {
            $request->getRouter()->redirect('/admin/blog');
        }

        //Conteudo do formulário
        $content = View::render('admin/modules/blog/category/form', [
            'title_module' => 'Editar Categoria',
            'status' => self::getStatus($request),
            'title' => $category->title,
            'slug' => $category->slug,
        ]);

        //Retorna página completa
        return parent::getPanel('Boss - Categoria', $content, 'blog');
    }

    /**
     * Editar depoimento
     */
    public static function setEditCategory($request, $id)
    {
        $category = EntityCategory::getCategoryById($id);

        if (!$category instanceof EntityCategory) {
            $request->getRouter()->redirect('/admin/blog');
        }

        $postVars   = $request->getPostVars();

        $category->title = $postVars['title'] ?? $category->title;
        $category->slug = $postVars['slug'] ?? $category->slug;

        $category->update();

        $request->getRouter()->redirect('/admin/blog/' . $category->id . '/edit?status=updated');
    }

    /**
     * Tela de deletar um depoimento 
     */
    public static function getDeleteCategory($request, $id)
    {
        $category = EntityCategory::getCategoryById($id);

        if (!$category instanceof EntityCategory) {
            $request->getRouter()->redirect('/admin/blog');
        }

        //Conteudo do formulário
        $content = View::render('admin/modules/blog/category/delete', [
            'title_module' => 'Excluir artigo',
            'title' => $category->title,
            'slug' => $category->slug,
        ]);

        //Retorna página completa
        return parent::getPanel('Boss - Categoria', $content, 'blog');
    }

    /**
     * Deletar depoimento
     */
    public static function setDeleteCategory($request, $id)
    {
        $category = EntityCategory::getCategoryById($id);

        if (!$category instanceof EntityCategory) {
            $request->getRouter()->redirect('/admin/blog');
        }

        $category->delete();

        $request->getRouter()->redirect('/admin/blog?status=deleted');
    }

    /**
     * Renderiza os itens de depoimento na página
     */
    private function getArticleItens($request, &$pagination)
    {
        $itens = "";

        //Quantidade total de registros
        $total = EntityArticle::getArticles(null, null, null, "COUNT(*) as qtd")->fetchObject()->qtd;

        //Pagina atual
        $queryParams = $request->getQueryParams();
        $paginaAtual = $queryParams['page'] ?? 1;

        //Instancia
        $pagination = new Pagination($total, $paginaAtual, 3);

        //Resultados da página
        $results = EntityArticle::getArticles(null, 'id DESC', $pagination->getLimit());

        //Renderiza o item
        while ($article = $results->fetchObject(EntityArticle::class)) {
            $itens .= View::render(
                "admin/modules/blog/category/itens",
                [
                    'id' => $article->id,
                    'data' => date('d/m/Y', strtotime($article->date)),
                    'title_article' => $article->title_article,
                    'slug' => $article->slug,
                    'thumbnail' => $article->thumbnail
                ]
            );
        }
        return $itens;
    }
    /**
     * Renderiza os itens de depoimento na página
     */
    public static function getCategoryItens($request, &$pagination)
    {
        $itens = "";

        //Quantidade total de registros
        $total = EntityCategory::getCategories(null, null, null, "COUNT(*) as qtd")->fetchObject()->qtd;

        //Pagina atual
        $queryParams = $request->getQueryParams();
        $paginaAtual = $queryParams['page'] ?? 1;

        //Instancia
        $pagination = new Pagination($total, $paginaAtual, 3);

        //Resultados da página
        $results = EntityCategory::getCategories(null, 'id DESC', $pagination->getLimit());

        //Renderiza o item
        while ($article = $results->fetchObject(EntityCategory::class)) {
            $itens .= View::render(
                "admin/modules/blog/category/itens",
                [
                    'id' => $article->id,
                    'title' => $article->title,
                    'slug' => $article->slug,
                ]
            );
        }
        return $itens;
    }
}
