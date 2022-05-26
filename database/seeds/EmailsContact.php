<?php


use Phinx\Seed\AbstractSeed;

class EmailsContact extends AbstractSeed
{
    public function run()
    {
        $data = [
            'emails' => 'exemple@mail.com'
        ];
        $user = $this->table('emails_contact');
        $user->insert($data)->saveData();
    }
}
