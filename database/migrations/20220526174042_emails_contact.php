<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class EmailsContact extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('emails_contact');
        $table->addColumn('emails', 'text', ['null'=> true])->create();
    }
}
