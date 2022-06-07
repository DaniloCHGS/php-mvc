<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class ArticleTable extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('articles');
        $table->addColumn('date', 'string', ['limit'=> 10, 'null' => false])
            ->addColumn('title_article', 'string', ['limit'=> 100, 'null' => false])
            ->addColumn('category_id', 'integer',    ['null' => false])
            ->addColumn('subtitle', 'string',    ['limit' => 255, 'null' => true])
            ->addColumn('author', 'string',   ['limit' => 100, 'null' => true])
            ->addColumn('slug', 'string',   ['limit' => 130, 'null' => false])
            ->addColumn('text', 'text',   ['null' => false])
            ->addColumn('thumbnail', 'string',   ['limit' => 255, 'null' => false])
            ->create();
    }
}
