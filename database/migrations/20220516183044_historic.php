<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Historic extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('historic');
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ])
            ->addColumn('user_id', 'integer', [
                'null' => false
            ])
            ->addColumn('acess_id', 'integer',  [
                'null' => false
            ])
            ->addColumn('action', 'string',    [
                'limit' => 255,
                'null' => false
            ])
            ->create();
    }
}
