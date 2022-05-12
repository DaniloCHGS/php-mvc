<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AccessAreaAddColumns extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('access_area');
        $table->addColumn('label', 'string', ['limit' => 20, 'after'=>'admin'])
            ->addColumn('link', 'string', ['limit' => 20, 'after'=>'label'])
            ->addColumn('icon', 'string', ['limit' => 20, 'after'=>'link'])
            ->addColumn('order', 'string', ['limit' => 20, 'after'=>'icon'])
            ->save();
    }
}
