<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateBanner extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('banners');
        $table->addColumn('title', 'string', ['limit'=>255])
                ->create();
    }
}
