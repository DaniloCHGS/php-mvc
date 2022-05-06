<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class UserSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run()
    {
        $data = [
            'username'=> 'Danilo C.',
            'email' => 'danilo@taticaweb.com.br',
            'password' => password_hash('sucesso2022', PASSWORD_DEFAULT),
            'permission' => '1-2-3',
            'access_area' => '1-2-3-4-5',
            'admin' => '1',
            'created' => date('Y-m-d H:i:s')
        ];
        $user = $this->table('users');
        $user->insert($data)->saveData();
    }
}
