<?php


use Phinx\Seed\AbstractSeed;

class AddressSeed extends AbstractSeed
{
    public function run()
    {
        $data = [
            'address' => 'Exemple Address',
            'cep' => '00000-000',
            'state' => 'Rio de Janeiro',
        ];
        $user = $this->table('address');
        $user->insert($data)->saveData();
    }
}
