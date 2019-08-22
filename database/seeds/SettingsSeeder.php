<?php

use Illuminate\Database\Seeder;
use App\Services\SettingsService;

class SettingsSeeder extends Seeder
{
    private $settings = [
        'phone' => '+61 3 8376 6284',
        'email' => 'support@bestlooker.pro',
        'address_french' => '36 rue de Cléry 75002 Paris',
        'address_germany' => '33 avenue Pierre Brossolette 94000 Créteil',
        'worked_time' => 'Monday-Friday: 9am to 5pm; Saturday, Sunday — clossed',
    ];
    
    /**
     * Run the database seeds.
     *
     * @param SettingsService $service
     *
     * @return void
     */
    public function run(SettingsService $service)
    {
        foreach ($this->settings as $key => $value) {
            if (!$service->getSetting($key)) {
                $service->setSetting($key, $value);
            }
        }
    }
}
