<?php

namespace App\Model\Entity;

use App\Utils\Utils;
use WilliamCosta\DatabaseManager\Database;

class Contact
{

    //Id do registro
    public $id;
    //Emails
    public $emails;

    /**
     * Busca de dados
     * @return PDOStatement
     */
    public static function getEmails($where = null, $order = null, $limit = null, $filds = "*")
    {
        return (new Database('emails_contact'))->select($where, $order, $limit, $filds);
    }

    /**
     * Atualização de dados
     */
    public function update()
    {
        return (new Database('emails_contact'))->update('id = ' . $this->id, [
            'emails' => $this->emails
        ]);

        return true;
    }

    /**
     * Busca por id
     */
    public static function getEmailsById($id)
    {
        return self::getEmails('id = ' . $id)->fetchObject(self::class);
    }
}
