<?php
namespace App\Utils;

use App\Model\Entity\Historic as EntityHistoric;
use App\Model\Entity\User as EntityUser;

class Historic {

    public $user_id;
    public $action;

    /**
     * Responsável em trazer o histórico do sistema
     */
    public static function getHistoric(){
        $content = View::render('admin/modules/home/box', [
            'itens' => self::getItensHistoric()
        ]);
        return $content;
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
    /**
     * Rendereiza os itens do histórico
     */
    private function getItensHistoric(){
        $itens = "";

        $userLevel = $_SESSION['admin']['user']['admin'];
        $userId = $_SESSION['admin']['user']['id'];

        $results = $userLevel == 1 ? EntityHistoric::getHistoricById($userId) : EntityHistoric::getHistoric(null, 'id DESC');

        //Renderiza o item
        while ($historic = $results->fetchObject(EntityHistoric::class)) {
            $user = EntityUser::getUserById($historic->user_id);
            $itens .= View::render(
                "admin/modules/home/itens",
                [
                    "user" => $user->username,
                    "action" => $historic->action,
                    "date" => date('d/m/Y H:i:s', strtotime($historic->created)),
                ]
            );
        }
        return $itens;
    }
}