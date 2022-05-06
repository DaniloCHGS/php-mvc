<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AccessAreaCreate extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('access_area');
        $table->addColumn('access', 'string', ['limit' => 20])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime',    ['null' => true])
            ->addIndex(['access'], ['unique' => true])
            ->create();
    }
}
