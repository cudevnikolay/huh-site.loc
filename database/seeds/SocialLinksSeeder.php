<?php

use App\Models\SocialLink;
use Illuminate\Database\Seeder;

class SocialLinksSeeder extends Seeder
{
    private $links = [
        'facebook' => 'https://www.facebook.com/Huh-School-571281273020801/',
        'twitter' => 'https://twitter.com/HuhSchool',
        'linkedin' => '',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->links as $alias => $link) {
            $socialLink = SocialLink::where('alias', '=', $alias)->first();
        
            if (!$socialLink) {
                $socialLink = new SocialLink;
                $socialLink->setAttribute('alias', $alias);
                $socialLink->setAttribute('link', $link);
                $socialLink->save();
            }
        }
    }
}
