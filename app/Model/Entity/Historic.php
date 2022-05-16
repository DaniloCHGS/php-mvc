<?php

namespace App\Model\Entity;

use App\Utils\Utils;
use WilliamCosta\DatabaseManager\Database;

class Historic
{
    public $id;
    public $user_id;
    public $action;
    public $created;

    /**
     * Retorna Depoimentos
     * @return PDOStatement
     */
    public static function getHistoric($where = null, $order = null, $limit = null, $filds = "*")
    {
        return (new Database('historic'))->select($where, $order, $limit, $filds);
    }

    /**
     * Cadastra a instancia atual no banco
     */
    public function register()
    {
        $this->id = (new Database('historic'))->insert([
            'user_id' => $this->user_id,
            'action' => $this->action,
            'created' => date('Y-m-d H:i:s')
        ]);
        return true;
    }
    public static function getHistoricById($id){
        return self::getHistoric('id = ' . $id)->fetchObject(self::class);
    }
}
