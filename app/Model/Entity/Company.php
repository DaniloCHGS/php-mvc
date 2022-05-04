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
    //Email
    public $email;
    //Contato 1
    public $phone_one;
    //Contat 2;
    public $phone_two;
    //Whatsapp
    public $whatsapp;
    //Mensagem da API do whatsapp
    public $api_wpp;
    //Facebook
    public $facebook;
    //Youtube
    public $youtube;
    //Instagram
    public $instagram;
    //Linkedin
    public $linkedin;

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
     * Busca de dados
     * @return PDOStatement
     */
    public static function getSocial($where = null, $order = null, $limit = null, $filds = "*")
    {
        return (new Database('social'))->select($where, $order, $limit, $filds);
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
     * Atualização de dados
     */
    public function updateContact()
    {
        return (new Database('contact'))->update('id = ' . $this->id, [
            'phone_one' => $this->phone_one,
            'phone_two' => $this->phone_two,
            'whatsapp' => $this->whatsapp,
            'api_wpp' => $this->api_wpp,
            'email' => $this->email
        ]);
        return true;
    }
    /**
     * Atualização de dados
     */
    public function updateSocial()
    {
        return (new Database('social'))->update('id = ' . $this->id, [
            'facebook' => $this->facebook,
            'instagram' => $this->instagram,
            'linkedin' => $this->linkedin,
            'youtube' => $this->youtube
        ]);
        return true;
    }

    /**
     * Busca por id
     */
    public static function getAddressById($id)
    {
        return self::getAddress('id = ' . $id)->fetchObject(self::class);
    }
    /**
     * Busca por id
     */
    public static function getContactById($id)
    {
        return self::getContact('id = ' . $id)->fetchObject(self::class);
    }
    /**
     * Busca por id
     */
    public static function getSocialById($id)
    {
        return self::getSocial('id = ' . $id)->fetchObject(self::class);
    }
}
