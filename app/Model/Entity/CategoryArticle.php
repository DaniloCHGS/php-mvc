<?php

namespace App\Model\Entity;

use App\Utils\Utils;
use WilliamCosta\DatabaseManager\Database;

class CategoryArticle
{

    public $id;
    /**
     * Titulo do artigo
     */
    public $title;
    /**
     * Slug de acesso ao artigo
     */
    public $slug;

    /**
     * Retorna articles
     * @return PDOStatement
     */
    public static function getCategories($where = null, $order = null, $limit = null, $filds = "*")
    {
        return (new Database('category_articles'))->select($where, $order, $limit, $filds);
    }

    /**
     * Cadastra a instancia atual no banco
     */
    public function register()
    {
        $this->id = (new Database('category_articles'))->insert([
            'title' => $this->title,
            'slug' => $this->slug,
        ]);
        return true;
    }

    /**
     * Atualiza a instancia atual no banco
     */
    public function update()
    {

        return (new Database('category_articles'))->update('id = ' . $this->id, [
            'title' => $this->title,
            'slug' => $this->slug,
        ]);
        return true;
    }

    /**
     * Deleta a instancia atual no banco
     */
    public function delete()
    {

        return (new Database('category_articles'))->delete('id = ' . $this->id);
        return true;
    }

    /**
     * Busca por ID
     */
    public static function getCategoryById($id)
    {
        return self::getCategories('id = ' . $id)->fetchObject(self::class);
    }
}
