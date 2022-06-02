<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Banners extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('banners');
        $table->addColumn('title', 'string', ['limit'=> 100, 'null' => true])
            ->addColumn('link', 'string',    ['limit' => 255, 'null' => true])
            ->addColumn('link_target', 'float',   ['default' => 0, 'null' => false])
            ->addColumn('active', 'float',   ['default' => 1, 'null' => false])
            ->addColumn('banner_desktop', 'string',   ['limit' => 255, 'null' => true])
            ->addColumn('banner_mobile', 'string',   ['limit' => 255, 'null' => true])
            ->create();
    }
}
