<?php

namespace App\Services;

use App\Models\Language\Translation;
use App\ValueObjects\Admin\Translations\LanguageValueObject;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Language\Language;
use App\Repositories\Language\LanguageRepository;
use App\Repositories\Language\TranslationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Waavi\Translation\UriLocalizer;

class TranslationService
{
    /**
     * @var LanguageRepository
     */
    private $languagesRepository;

    /**
     * @var TranslationRepository
     */
    private $translationsRepository;

    /**
     * @var UriLocalizer
     */
    private $uriLocalizer;

    /**
     * LanguageService constructor.
     * @param LanguageRepository $languageRepository
     * @param TranslationRepository $translationRepository
     * @param UriLocalizer $uriLocalizer
     */
    public function __construct(
        LanguageRepository $languageRepository,
        TranslationRepository $translationRepository,
        UriLocalizer $uriLocalizer
    ){
        $this->languagesRepository = $languageRepository;
        $this->translationsRepository = $translationRepository;
        $this->uriLocalizer = $uriLocalizer;
    }

    /**
     * Get data for data table
     *
     * @param $limit
     * @param $start
     * @param $order
     * @param $dir
     * @param $search
     * @param $draw
     * @return array
     */
    public function getLanguagesForDataTable($limit, $start, $order, $dir, $search, $draw)
    {
        $columns = [
            0 => 'id',
            1 =>'enabled',
            2 =>'name',
            3 => 'locale',
        ];

        $totalData = Language::count();

        $totalFiltered = $totalData;

        $limit = $limit == -1 ? $totalData : $limit;
        $order = $columns[$order];

        if(empty($search))
        {
            $languages = Language::offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
        } else {
            $languages =  Language::where('locale', 'LIKE', "%{$search}%")
                ->orWhere('name', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();

            $totalFiltered = Language::where('locale', 'LIKE', "%{$search}%")
                ->orWhere('name', 'LIKE', "%{$search}%")
                ->count();
        }

        $data = [];
        if(!empty($languages))
        {
            foreach ($languages as $i => $language)
            {
                $nestedData['index'] = $i+1;
                $nestedData['id'] = $language->id;
                $nestedData['enabled'] = $language->locale !== Language::DEFAULT_LOCALE ? $language->enabled: 'default';
                $nestedData['name'] = $language->name;
                $nestedData['locale'] = $language->locale;
                $nestedData['edit'] = route('language.edit', ['locale' => $language['locale']]);
                $nestedData['delete'] = $language->locale === Language::DEFAULT_LOCALE ? false : route('language.delete', ['locale' => $language['locale']]);
                $data[] = $nestedData;
            }
        }

        $result = [
            "draw"            => intval($draw),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        ];

        return $result;
    }

    /**
     * Get language by locale
     *
     * @param $locale
     * @return array
     */
    public function getLanguageByLocale($locale)
    {
        $language = $this->languagesRepository->findByLocaleWithTranslations($locale);

        /** @var Collection $translations */

        $language->translations = $this->convertTranslationsToGroup($language->translations);

        $default = $this->getDefaultTranslations();

        return compact('language', 'default');
    }

    /**
     * Get default language translations by groups
     *
     * @return Language|Collection|null
     */
    public function getDefaultTranslations()
    {
        $default = $this->getDefaultLanguage();

        /** @var Collection $defaultTranslations */
        $default = $this->convertTranslationsToGroup($default->translations);

        return $default;
    }

    /**
     * Get default language
     *
     * @return Language|null
     */
    public function getDefaultLanguage()
    {
        $language = $this->languagesRepository->findByLocaleWithTranslations(Language::DEFAULT_LOCALE);

        return $language;
    }

    /**
     * @param LanguageValueObject $languageObj
     * @return Language
     * @throws \Exception
     */
    public function update(LanguageValueObject $languageObj)
    {
        /** @var Language $language */
        $language = Language::findOrFail($languageObj->id);

        $language->edit($languageObj);
        $language->save();

        if (!empty($languageObj->translations)) {
            foreach ($languageObj->translations as $translationObj) {
                if ($translationObj->id) {
                    if (!empty($translationObj->text)) {
                        $language->updateTranslation($translationObj);
                    } else {
                        if ($language->isDefault()) {
                            throw new \DomainException('delete default language translation error');
                        }
                        $language->deleteTranslation($translationObj);
                    }
                } else {
                    $language->createOrUpdateTranslation($translationObj);
                }
            }
        }

        return $language;
    }

    /**
     * Store new language
     *
     * @param LanguageValueObject $languageObj
     * @return Language
     */
    public function store(LanguageValueObject $languageObj)
    {
        $language = Language::createOrUpdateLanguage($languageObj);

        if (!empty($languageObj->translations)) {
            foreach ($languageObj->translations as $translationObj) {
                $language->createOrUpdateTranslation($translationObj);
            }
        }

        return $language;
    }

    /**
     * Switch language status
     *
     * @param $id
     * @return mixed
     */
    public function switchLanguageStatus($id)
    {
        $language = Language::findOrFail($id);

        $language->enabled = $language->enabled === 1 ? 0 : 1;

        $language->save();

        return $language;
    }

    /**
     * @param $locale
     * @return mixed
     */
    public function deleteLanguage($locale)
    {
        if ($locale !== Language::DEFAULT_LOCALE) {
            $language = Language::where('locale', '=',$locale)->first();

            $language->translations()->delete();
            $language->forceDelete();

            return $language->name;
        } else {
            throw new \DomainException('Default language delete error');
        }
    }

    public function getLocalesForNotFound(Request $request)
    {
        $currentUrl    = $request->getUri();

        if ($request->hasSession() && $sessionLocale = $request->session()->get('waavi.translation.locale')) {
            $currentLocale = $request->session()->get('waavi.translation.locale');
        } else {
            $currentLocale = $this->uriLocalizer->getLocaleFromUrl($currentUrl, 0);
        }

        $currentLocale = $this->languagesRepository->findActiveByLocale($currentLocale);

        $selectableLanguages = $this->languagesRepository->allActiveExcept($currentLocale);

        $altLocalizedUrls    = [];

        foreach ($selectableLanguages as $lang) {
            $altLocalizedUrls[] = [
                'locale' => $lang->locale,
                'name'   => $lang->name,
                'url'    => $this->uriLocalizer->localize($currentUrl, $lang->locale, 0),
            ];
        }

        return compact('currentLocale', 'selectableLanguages', 'altLocalizedUrls');
    }

    /**
     * @param $translations
     * @return Collection
     */
    private function convertTranslationsToGroup($translations)
    {
        /** @var Collection $translations */
        $translations = $translations->filter(function (Translation $translation) {
            return $translation->isSiteGroup();
        });
        $translations = $translations->groupBy('group');
        foreach ($translations as $key => $group){
            $translations[$key] = $group->keyBy('item');
        }

        $translations = $translations->reverse();

        $result = [];
        // set meta at first position
        if (isset($translations['meta'])) {
            $result['meta'] = $translations['meta'];
            unset($translations['meta']);
        }
        foreach ($translations as $key => $group) {
            $result[$key] = $group;
        }

        return $result;
    }
}