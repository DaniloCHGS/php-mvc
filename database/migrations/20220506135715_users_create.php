<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class UsersCreate extends AbstractMigration
{
    public function change(): void
    {
        $users = $this->table('users');
        $users->addColumn('username', 'string',     ['limit' => 20, 'null' => false])
              ->addColumn('password', 'string',     ['limit' => 255, 'null' => false])
              ->addColumn('email', 'string',        ['limit' => 255, 'null' => false])
              ->addColumn('permission', 'string',   ['limit' => 5,  'null' => false ,'comment' => "1:insert, 2:update, 3:delete | 1-2-3"])
              ->addColumn('access_area', 'string',  ['limit' => 10, 'null' => false])
              ->addColumn('admin', 'smallinteger',  ['null' => false])
              ->addColumn('created', 'datetime')
              ->addColumn('updated', 'datetime',    ['null' => true])
              ->addIndex(['username', 'email'],     ['unique' => true])
              ->create();
    }
}
