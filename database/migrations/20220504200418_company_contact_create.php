<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CompanyContactCreate extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('contact');
        $table->addColumn('email', 'string',    ['limit' => 255, 'null' => true])
            ->addColumn('phone_one', 'string',  ['limit' => 255, 'null' => true])
            ->addColumn('phone_two', 'string',  ['limit' => 255, 'null' => true])
            ->addColumn('whatsapp', 'string',   ['limit' => 255, 'null' => true])
            ->addColumn('api_wpp', 'text',      ['null' => true])
            ->addColumn('created', 'datetime',  ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated', 'datetime',  ['null' => true, 'default' => 'CURRENT_TIMESTAMP'])
            ->create();
    }
    public function down(): void
    {
        $this->table('contact')->drop()->save();
    }
}
