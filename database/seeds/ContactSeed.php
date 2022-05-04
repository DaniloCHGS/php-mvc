<?php


use Phinx\Seed\AbstractSeed;

class ContactSeed extends AbstractSeed
{
    public function run()
    {
        $data = [
            'phone_one' => '00000-0000',
            'phone_two' => '00000-0000',
            'whatsapp' => '00000-0000',
            'api_wpp' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere ipsa ut deserunt porro sunt, distinctio id sint necessitatibus ea nesciunt odio, quasi impedit inventore nobis explicabo corrupti rerum omnis sit!',
            'email' => 'exemple@mail.com.br',
        ];
        $user = $this->table('contact');
        $user->insert($data)->saveData();
    }
}
