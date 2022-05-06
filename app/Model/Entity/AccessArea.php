<?php

namespace App\Model\Entity;

use App\Utils\Utils;
use WilliamCosta\DatabaseManager\Database;

class AccessArea
{

    public $id;
    public $access;

    /**
     * Retorna Depoimentos
     * @return PDOStatement
     */
    public static function getAccess($where = null, $order = null, $limit = null, $filds = "*")
    {
        return (new Database('access_area'))->select($where, $order, $limit, $filds);
    }

    /**
     * Cadastra a instancia atual no banco
     */
    public function register()
    {
        $this->id = (new Database('access_area'))->insert([
            'access' => $this->access
        ]);
        return true;
    }

    /**
     * Atualiza a instancia atual no banco
     */
    public function update()
    {

        return (new Database('access_area'))->update('id = ' . $this->id, [
            'access' => $this->access,
        ]);
        return true;
    }

    /**
     * Deleta a instancia atual no banco
     */
    public function delete()
    {

        return (new Database('access_area'))->delete('id = ' . $this->id);
        return true;
    }

    /**
     * Busca por ID
     */
    public static function getAccessAreaById($id)
    {
        return self::getAccess('id = ' . $id)->fetchObject(self::class);
    }
}
