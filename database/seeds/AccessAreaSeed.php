<?php


use Phinx\Seed\AbstractSeed;

class AccessAreaSeed extends AbstractSeed
{
    public function run()
    {
        $data = [
            ['access' => 'Dados da Empresa', 'created' => date('Y-m-d H:i:s')],
            ['access' => 'Identidade do Site', 'created' => date('Y-m-d H:i:s')],
            ['access' => 'Área de Acesso', 'created' => date('Y-m-d H:i:s')],
            ['access' => 'Usuários', 'created' => date('Y-m-d H:i:s')],
        ];
        $access = $this->table('access_area');
        $access->insert($data)->saveData();
    }
}
