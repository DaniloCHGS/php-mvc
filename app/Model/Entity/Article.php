<?php

namespace App\Model\Entity;

use App\Utils\Utils;
use WilliamCosta\DatabaseManager\Database;

class Article
{

    public $id;
    /**
     * Autor do artigo
     */
    public $author;
    /**
     * Data de cadastro
     */
    public $date;
    /**
     * ID da categoria
     */
    public $category_id;
    /**
     * Titulo do artigo
     */
    public $title_article;
    /**
     * Subtitulo
     */
    public $subtitle;
    /**
     * Slug de acesso ao artigo
     */
    public $slug;
    /**
     * Noticia
     */
    public $text;
    /**
     * Imagem de thumbnail
     */
    public $thumbnail;

    /**
     * Retorna articles
     * @return PDOStatement
     */
    public static function getArticles($where = null, $order = null, $limit = null, $filds = "*")
    {
        return (new Database('articles'))->select($where, $order, $limit, $filds);
    }

    /**
     * Cadastra a instancia atual no banco
     */
    public function register()
    {
        $this->data = date("Y-m-d H:i:s");

        $this->id = (new Database('articles'))->insert([
            'author' => $this->author,
            'date' => $this->date,
            'category_id' => $this->category_id,
            'title_article' => $this->title_article,
            'subtitle' => $this->subtitle,
            'slug' => $this->slug,
            'text' => $this->text,
            'thumbnail' => $this->thumbnail
        ]);
        return true;
    }

    /**
     * Atualiza a instancia atual no banco
     */
    public function update()
    {

        return (new Database('articles'))->update('id = ' . $this->id, [
            'author' => $this->author,
            'date' => $this->date,
            'category_id' => $this->category_id,
            'title_article' => $this->title_article,
            'subtitle' => $this->subtitle,
            'slug' => $this->slug,
            'text' => $this->text,
            'thumbnail' => $this->thumbnail
        ]);
        return true;
    }

    /**
     * Deleta a instancia atual no banco
     */
    public function delete()
    {

        return (new Database('articles'))->delete('id = ' . $this->id);
        return true;
    }

    /**
     * Busca por ID
     */
    public static function getArticleById($id)
    {
        return self::getArticles('id = ' . $id)->fetchObject(self::class);
    }
}
