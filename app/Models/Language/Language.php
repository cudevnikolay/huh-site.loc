<?php

namespace App\Models\Language;

use App\Models\PolicyLink;
use App\ValueObjects\Admin\Translations\{
    LanguageValueObject, TranslationValueObject
};
use Illuminate\Database\Eloquent\Model;


/**
 * Class Language
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language\Language firstOrNew(array $attrs)
 * @property int $id
 * @property string $locale
 * @property string $name
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int $enabled
 * @property-read string $language_code
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Language\Translation[] $translations
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language\Language active()
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Language\Language onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Language\Language withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Language\Language withoutTrashed()
 * @mixin \Eloquent
 * @property-read \App\Models\PolicyLink $policyLink
 */
class Language extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;

    const STATUS_ENABLED = 1;
    const STATUS_DRAFT = 0;
    const DEFAULT_LOCALE = 'en';

    /**
     *  Table name in the database.
     * @var string
     */
    protected $table = 'translator_languages';

    /**
     *  List of variables that cannot be mass assigned
     * @var array
     */
    protected $fillable = ['locale', 'name'];

    /**
     *  Each language may have several translations.
     */
    public function translations()
    {
        return $this->hasMany(Translation::class, 'locale', 'locale');
    }

    /**
     *  Returns the name of this language in the current selected language.
     *
     * @return string
     */
    public function getLanguageCodeAttribute()
    {
        return "languages.{$this->locale}";
    }

    public function scopeActive($query)
    {
        return $query->where('enabled', '=', self::STATUS_ENABLED);
    }

    /**
     * Create new language
     *
     * @param LanguageValueObject $languageObj
     * @return Language
     */
    public static function createOrUpdateLanguage(LanguageValueObject $languageObj): self
    {
        $languageObj->enabled = $languageObj->locale === self::DEFAULT_LOCALE ? self::STATUS_ENABLED : $languageObj->enabled;

        $language = self::firstOrNew(['name' => $languageObj->name]);
        $language->setAttribute('enabled', $languageObj->enabled);
        $language->setAttribute('locale', $languageObj->locale);
        $language->save();

        return $language;
    }

    /**
     * Edit existing language
     *
     * @param LanguageValueObject $languageObj
     */
    public function edit(LanguageValueObject $languageObj)
    {
        $this->name = $languageObj->name;
        $this->enabled = $this->isDefault() ? self::STATUS_ENABLED : $languageObj->enabled;
    }

    /**
     * Update translation of language
     *
     * @param TranslationValueObject $translationValueObject
     */
    public function updateTranslation(TranslationValueObject $translationValueObject)
    {
        $translation = $this->getTranslationById($translationValueObject->id);
        $translation->edit($translationValueObject);
        $this->translations()->save($translation);
    }

    /**
     * Delete translation of language
     *
     * @param TranslationValueObject $translationValueObject
     * @throws \Exception
     */
    public function deleteTranslation(TranslationValueObject $translationValueObject)
    {
        $translation = $this->getTranslationById($translationValueObject->id);
        $translation->delete();
    }

    /**
     * Create translation of language
     *
     * @param TranslationValueObject $translationValueObject
     */
    public function createOrUpdateTranslation(TranslationValueObject $translationValueObject)
    {
        $translation = $this->translations()->firstOrNew(
            [
                'group' => $translationValueObject->group,
                'item' => $translationValueObject->item
            ]);
        $translation->setAttribute('text', $translationValueObject->text);
        $translation->save();
    }

    /**
     * Get language translation by id
     *
     * @param $id
     * @return Translation|null
     */
    public function getTranslationById($id): ?Translation
    {
        foreach ($this->translations as $translation) {
            if ($translation->id === $id) {
                return $translation;
            }
        }
        return null;
    }

    public function isDefault()
    {
        return $this->locale === self::DEFAULT_LOCALE;
    }

    public function policyLink()
    {
        return $this->belongsTo(PolicyLink::class, 'locale', 'locale');
    }
}
