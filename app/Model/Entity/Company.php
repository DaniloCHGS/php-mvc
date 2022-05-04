<?php
namespace App\Model\Entity;

use App\Utils\Utils;
use WilliamCosta\DatabaseManager\Database;

class Company
{

    //Id do registro
    public $id;
    //Endereço
    public $address;
    //CEP
    public $cep;
    //Estado
    public $state;

    /**
     * Busca de dados
     * @return PDOStatement
     */
    public static function getAddress($where = null, $order = null, $limit = null, $filds = "*")
    {
        return (new Database('address'))->select($where, $order, $limit, $filds);
    }

    /**
     * Busca de dados
     * @return PDOStatement
     */
    public static function getContact($where = null, $order = null, $limit = null, $filds = "*")
    {
        return (new Database('contact'))->select($where, $order, $limit, $filds);
    }

    /**
     * Cadastro de dados
     */
    public function registerAddress()
    {
        $this->id = (new Database('address'))->insert([
            'address' => $this->address,
            'cep' => $this->cep,
            'state' => $this->state
        ]);
        return true;
    }

    /**
     * Atualização de dados
     */
    public function updateAddress()
    {
        return (new Database('address'))->update('id = ' . $this->id, [
            'address' => $this->address,
            'cep' => $this->cep,
            'state' => $this->state
        ]);
        return true;
    }

    /**
     * Busca por id
     */
    public static function getAddressById($id){
        return self::getAddress('id = ' . $id)->fetchObject(self::class);
    }
    /**
     * Busca por id
     */
    public static function getContactById($id){
        return self::getContact('id = ' . $id)->fetchObject(self::class);
    }
}
