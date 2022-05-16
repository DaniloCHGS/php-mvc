<?php
namespace App\Utils;

use App\Model\Entity\Historic as EntityHistoric;

class Historic {

    public $user_id;
    public $action;

    /**
     * Responsável em trazer o histórico do sistema
     */
    public static function getHistoric(){

        $userLevel = $_SESSION['admin']['user']['admin'];
        $userId = $_SESSION['admin']['user']['id'];

        $results = $userLevel == 1 ? EntityHistoric::getHistoricById($userId) : EntityHistoric::getHistoric();

        while ($objHistoric = $results->fetchObject(EntityHistoric::class)){
            $historic[] = $objHistoric;
        }

        return $historic;
    }
    /**
     * Insere no banco o histórico atual
     */
    public function createHistoric(){
        $historic = new EntityHistoric;

        $historic->user_id = $this->user_id;
        $historic->action = $this->action;
        $historic->register();
    }
}