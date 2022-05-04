<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CompanyAddressCreate extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('address');
        $table->addColumn('address', 'string',   ['limit' => 255, 'null' => true])
            ->addColumn('cep', 'string', ['limit' => 10, 'null' => true])
            ->addColumn('state', 'string', ['limit' => 20, 'null' => true])
            ->addColumn('created', 'datetime',      ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated', 'datetime',      ['null' => true, 'default' => 'CURRENT_TIMESTAMP'])
            ->create();
    }
}
