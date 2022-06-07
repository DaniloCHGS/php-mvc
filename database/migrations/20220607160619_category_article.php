<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CategoryArticle extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('category_articles');
        $table->addColumn('title', 'string', ['limit'=> 100, 'null' => false])
            ->addColumn('slug', 'string',   ['limit' => 130, 'null' => false])
            ->create();
    }
}
