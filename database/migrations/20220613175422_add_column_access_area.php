<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddColumnAccessArea extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('access_area');
        $table->addColumn('label', 'string', ['limit' => 100, 'null' => true])
            ->addColumn('link', 'string', ['limit' => 200, 'null' => true])
            ->addColumn('icon', 'string', ['limit' => 200, 'null' => true])
            ->update();
    }
}
