<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class IdentityCreate extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $table = $this->table('identity');
        $table->addColumn('title-site', 'string',   ['limit' => 30, 'null' => false])
            ->addColumn('description', 'string',    ['limit' => 255, 'null' => false])
            ->addColumn('logo-primary', 'string',   ['limit' => 20])
            ->addColumn('logo-secondary', 'string', ['limit' => 20])
            ->addColumn('logo-footer', 'string',    ['limit' => 20])
            ->addColumn('created', 'datetime',      ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated', 'datetime',      ['null' => true, 'default' => 'CURRENT_TIMESTAMP'])
            ->create();
    }
}
