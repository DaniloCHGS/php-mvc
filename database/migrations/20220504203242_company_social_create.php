<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CompanySocialCreate extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('social');
        $table->addColumn('facebook', 'string',    ['limit' => 255, 'null' => true])
            ->addColumn('instagram', 'string',    ['limit' => 255, 'null' => true])
            ->addColumn('youtube', 'string',    ['limit' => 255, 'null' => true])
            ->addColumn('linkedin', 'string',    ['limit' => 255, 'null' => true])
            ->addColumn('created', 'datetime',  ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated', 'datetime',  ['null' => true, 'default' => 'CURRENT_TIMESTAMP'])
            ->create();
    }
}
