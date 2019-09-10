<?php

namespace App\Services;

use App\Models\Language\Language;

class LanguageService
{
    /**
     * Get locales array for select
     *
     * @return array
     */
    public function getAllLocalsForSelect(): array
    {
        $locales = Language::get();
        $resultLocals = [];
        foreach ($locales as $locale) {
            $resultLocals[$locale->locale] = ucfirst($locale->name);
        }

        return $resultLocals;
    }
}