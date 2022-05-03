<?php


use Phinx\Seed\AbstractSeed;

class IndeitySeed extends AbstractSeed
{
    public function run()
    {
        $data = [
            'title_site' => 'Exemple name',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt maxime id maiores in quidem optio nam itaque saepe. Est odit totam quidem! Recusandae fugit aliquam accusantium numquam assumenda cupiditate ipsa!',
            'logo_primary' => 'logo-primary.webp',
            'logo_secondary' => 'logo-secondary.webp',
            'logo_footer' => 'logo-footer.webp'
        ];
        $user = $this->table('identity');
        $user->insert($data)->saveData();
    }
}
