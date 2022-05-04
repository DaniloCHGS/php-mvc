<?php


use Phinx\Seed\AbstractSeed;

class SocialSeed extends AbstractSeed
{
    public function run()
    {
        $data = [
            'facebook' => 'https://',
            'instagram' => 'https://',
            'linkedin' => 'https://',
            'youtube' => 'https://',
        ];
        $user = $this->table('social');
        $user->insert($data)->saveData();
    }
}
