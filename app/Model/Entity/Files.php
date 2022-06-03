<?php

namespace App\Model\Entity;

use App\Utils\Utils;
use WilliamCosta\DatabaseManager\Database;

class Files
{
    public $id;
    public $file;
    public $web_file;
    public $created;

    const TABLE = 'files';

    /**
     * Retorna Depoimentos
     * @return PDOStatement
     */
    public static function getFiles($where = null, $order = null, $limit = null, $filds = "*")
    {
        return (new Database(self::TABLE))->select($where, $order, $limit, $filds);
    }

    public static function getFileById($id){
        return self::getFiles('id = ' . intval($id))->fetchObject(self::class);
    }

    public static function getFileByName($name){
        return self::getFiles("file LIKE '%$name%'")->fetchObject(self::class);
    }

    /**
     * Cadastra a instancia atual no banco
     */
    public function register()
    {
        $this->id = (new Database(self::TABLE))->insert([
            'file' => $this->file,
            'web_file' => $this->web_file,
            'created' => date('Y-m-d H:i:s')
        ]);
        return true;
    }

    /**
     * Atualiza a instancia atual no banco
     */
    public function update()
    {
        return (new Database(self::TABLE))->update('id = ' . $this->id, [
            'file' => $this->file,
            'web_file' => $this->web_file
        ]);
        return true;
    }

    /**
     * Deleta a instancia atual no banco
     */
    public function delete()
    {
        return (new Database(self::TABLE))->delete('id = ' . $this->id);
        return true;
    }
}