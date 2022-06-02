<?php

namespace App\Model\Entity;

use App\Utils\Utils;
use WilliamCosta\DatabaseManager\Database;

class Banner
{

    public $id;
    public $title;
    public $link;
    public $link_target;
    public $active;
    public $banner_desktop;
    public $banner_mobile;

    /**
     * Retorna Depoimentos
     * @return PDOStatement
     */
    public static function getBanners($where = null, $order = null, $limit = null, $filds = "*")
    {
        return (new Database('banners'))->select($where, $order, $limit, $filds);
    }

    /**
     * Cadastra a instancia atual no banco
     */
    public function register()
    {
        $this->id = (new Database('banners'))->insert([
            'title' => $this->title,
            'link' => $this->link,
            'link_target' => $this->link_target,
            'active' => $this->active,
            'banner_desktop' => $this->banner_desktop,
            'banner_mobile' => $this->banner_mobile
        ]);
        return true;
    }

    /**
     * Atualiza a instancia atual no banco
     */
    public function update()
    {

        return (new Database('banners'))->update('id = ' . $this->id, [
            'title' => $this->title,
            'link' => $this->link,
            'link_target' => $this->link_target,
            'active' => $this->active,
            'banner_desktop' => $this->banner_desktop,
            'banner_mobile' => $this->banner_mobile
        ]);
        return true;
    }

    /**
     * Deleta a instancia atual no banco
     */
    public function delete()
    {

        return (new Database('banners'))->delete('id = ' . $this->id);
        return true;
    }

    /**
     * Busca por ID
     */
    public static function getBannerById($id)
    {
        return self::getBanners('id = ' . $id)->fetchObject(self::class);
    }
}
