<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class IdentityCreate extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('identity');
        $table->addColumn('title_site', 'string',   ['limit' => 30, 'null' => false])
        ->addColumn('description', 'text')
        ->addColumn('logo_primary', 'string',   ['limit' => 20, 'null'=>true])
        ->addColumn('logo_secondary', 'string', ['limit' => 20, 'null'=>true])
        ->addColumn('logo_footer', 'string',    ['limit' => 20, 'null'=>true])
        ->addColumn('created', 'datetime',      ['default' => 'CURRENT_TIMESTAMP'])
        ->addColumn('updated', 'datetime',      ['null' => true, 'default' => 'CURRENT_TIMESTAMP'])
            ->create();
    }
    public function down(): void
    {
        $this->table('identity')->drop()->save();
    }
}
