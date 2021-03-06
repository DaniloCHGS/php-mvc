<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AccessAreaCreate extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('access_area');
        $table->addColumn('access', 'string', ['limit' => 20])
            ->addColumn('uri', 'string', ['limit' => 20])
            ->addColumn('admin', 'smallinteger')
            ->addColumn('created', 'datetime',  ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated', 'datetime',  ['null' => true, 'default' => 'CURRENT_TIMESTAMP'])
            ->addIndex(['access'], ['unique' => true])
            ->create();
    }
    public function down(): void
    {
        $this->table('access_area')->drop()->save();
    }
}
