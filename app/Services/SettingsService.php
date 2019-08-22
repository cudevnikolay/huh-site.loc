<?php

namespace App\Services;

class SettingsService
{
    /**
     * Get setting by name from db
     *
     * @param $name
     * @return mixed
     */
    public function getSetting($name)
    {
        return \Setting::get($name, 0);
    }
    
    /**
     * Get all settings
     *
     * @return array
     */
    public function getAllSetting()
    {
        return \Setting::all();
    }
    
    /**
     * Set value for setting by name from db
     *
     * @param $name
     * @param $value
     */
    public function setSetting($name, $value)
    {
        \Setting::set($name, $value);
        \Setting::save();
    }
}