<?php

use Phinx\Seed\AbstractSeed;

class AccessAreaSeed extends AbstractSeed
{
    public function run()
    {
        $data = [
            ['access' => 'Dados da Empresa', 'uri'=> 'dados-empresa', 'admin' => '1', 'created' => date('Y-m-d H:i:s')],
            ['access' => 'Identidade do Site', 'uri'=> 'identidade-site', 'admin' => '1', 'created' => date('Y-m-d H:i:s')],
            ['access' => 'Área de Acesso', 'uri'=> 'area-de-acesso', 'admin' => '3', 'created' => date('Y-m-d H:i:s')],
            ['access' => 'Usuários', 'uri'=> 'usuarios', 'admin' => '2', 'created' => date('Y-m-d H:i:s')],
        ];
        $access = $this->table('access_area');
        $access->insert($data)->saveData();
    }
}
