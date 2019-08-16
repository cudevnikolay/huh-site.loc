<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use App\Models\Language\{
    Translation,
    Language
};

class TranslationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->dataLanguages() as $locale => $lang_data) {
            $language = Language::where('locale', '=', $locale)->first();

            if (!$language) {
                $language = new Language;
                $language->setAttribute('locale', $locale);
                $language->setAttribute('name', $lang_data['name']);
                $language->setAttribute('enabled', 1);
                $language->save();
            }

            $translations = [];
            foreach ($this->dataTranslations()[$locale] as $groupName => $group) {
                foreach ($group as $key => $text) {
                    $translation = Translation::where('item', '=', $key)
                        ->where('group', '=', $groupName)
                        ->where('locale', '=', $locale)
                        ->first();

                    if (!$translation) {
                        $translation = new Translation;
                        $translation->setAttribute('group', $groupName);
                        $translation->setAttribute('item', $key);
                        $translation->setAttribute('text', $text);
                        $translation->setAttribute('locale', $locale);
                        $translation->save();
                    }
                }
            }
        }

        Artisan::call('translator:flush');
        Artisan::call('config:cache');
    }

    private function dataLanguages()
    {
        return [
            'en' => [
                'name' => 'English',
                'locale' => 'en',
            ],
            'fr' => [
                'name' => 'French',
                'locale' => 'fr',
            ],
        ];
    }

    private function dataTranslations()
    {
        $pathToLang = realpath(__DIR__ . '/../../resources/lang');

        return [
            'en' => [
                'meta' => include $pathToLang . '/en/meta.php',
                'menu' => include $pathToLang . '/en/menu.php',
                'home' => include $pathToLang . '/en/home.php',
                'contact' => include $pathToLang . '/en/contact.php',
                'platform' => include $pathToLang . '/en/platform.php',
                'team' => include $pathToLang . '/en/team.php',
                'solution' => include $pathToLang . '/en/solution.php',
                'ia_solution' => include $pathToLang . '/en/ia_solution.php',
                'training' => include $pathToLang . '/en/training.php',
                'footer' => include $pathToLang . '/en/footer.php',
            ],
            'fr' => [
                'meta' => include $pathToLang . '/fr/meta.php',
                'menu' => include $pathToLang . '/fr/menu.php',
                'home' => include $pathToLang . '/fr/home.php',
                'contact' => include $pathToLang . '/fr/contact.php',
                'platform' => include $pathToLang . '/fr/platform.php',
                'team' => include $pathToLang . '/fr/team.php',
                'solution' => include $pathToLang . '/fr/solution.php',
                'ia_solution' => include $pathToLang . '/fr/ia_solution.php',
                'training' => include $pathToLang . '/fr/training.php',
                'footer' => include $pathToLang . '/fr/footer.php',
            ],
        ];
    }
}