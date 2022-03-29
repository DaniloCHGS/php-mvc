<?php

namespace App\Model\Entity;

use App\Utils\Utils;
use WilliamCosta\DatabaseManager\Database;

class Depoimentos
{

    public $id;
    public $autor;
    public $depoimento;
    public $data;

    /**
     * Cadastra a instancia atual no banco
     */
    public function register()
    {
        $this->data = date("Y-m-d H:i:s");

        $this->id = (new Database('depoimentos'))->insert([
            'autor' => $this->autor,
            'depoimento' => $this->depoimento,
            'data' => $this->data
        ]);
        return true;
    }
}
