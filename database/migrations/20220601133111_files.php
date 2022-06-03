<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Files extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('files');
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ])
        ->addColumn('file', 'string', [
            'null' => false
        ])
        ->addColumn('web_file', 'string',  [
            'null' => true
        ])
        ->create();
    }
}
