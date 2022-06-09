<?php

namespace App\Model\Entity;

use App\Utils\Utils;
use App\Utils\FilesManager;
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
        return self::getFiles("file LIKE '$name'")->fetchObject(self::class);
    }

    public static function getFileName($id){
        $file = self::getFileById($id);
        
        return empty($file->web_file) ? $file->file : $file->web_file;
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

    /**
     * Função responsável por realizar o upload do arquivo para que
     * possa ser realizado o registro no banco. 
     */    
    public function setFile($file, $extensions = [], $file_name = "same_name"){
        $file = new FilesManager\UpFile($file, "", $file_name, $extensions);
        $file->upload();

        if($file->uploaded){
            $this->file = $file->new_name;
            $this->web_file = "";
        }

        return $file->error_code;
    }

    /**
     * Função responsável por realizar o upload da imagem para que
     * possa ser realizado o registro no banco. 
     */
    public function setImage($file, $extensions = "img", $file_name = "same_name", $resolution = [0, 0]){
        $image = new FilesManager\UpImage($file, "", $file_name, $resolution, $extensions);

        if($image->uploaded){
            $toWebp = new FilesManager\ToWebp();
            $web_file = $toWebp->convert($image->path . $image->new_name);
            
            if($web_file != ""){
                $this->file = $image->new_name;
                $this->web_file = $web_file;
            }else{
                $this->file = $file->new_name;
                $this->web_file = "";
            }
        }

        return $image->error_code;
    }
}