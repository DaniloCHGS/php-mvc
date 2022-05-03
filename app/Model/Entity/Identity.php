<?php
namespace App\Model\Entity;

use App\Utils\Utils;
use WilliamCosta\DatabaseManager\Database;

class Identity
{

    //Título do site
    public $title_site;
    //Descrição do site
    public $description;
    //Logo primária
    public $logo_primary;
    //Logo secundária
    public $logo_secondary;
    //Logo footer
    public $logo_footer;

    /**
     * Retorna os dados da Identidade do site
     * @return PDOStatement
     */
    public static function getIdentity($where = null, $order = null, $limit = null, $filds = "*")
    {
        return (new Database('identity'))->select($where, $order, $limit, $filds);
    }

    /**
     * Cadastra a instancia atual no banco
     */
    public function register()
    {
        $this->id = (new Database('identity'))->insert([
            'title_site' => $this->title_site,
            'description' => $this->description,
            'logo_primary' => $this->logo_primary,
            'logo_secondary' => $this->logo_secondary,
            'logo_footer' => $this->logo_footer
        ]);
        return true;
    }

    /**
     * Atualiza a instancia atual no banco
     */
    public function update()
    {
        return (new Database('identity'))->update('id = ' . $this->id, [
            'title_site' => $this->title_site,
            'description' => $this->description,
            'logo_primary' => $this->logo_primary,
            'logo_secondary' => $this->logo_secondary,
            'logo_footer' => $this->logo_footer
        ]);
        return true;
    }

    public static function getIdentityById($id){
        return self::getIdentity('id = ' . $id)->fetchObject(self::class);
    }
}
