<?php

namespace App\Models\Language;

use App\ValueObjects\Admin\Translations\TranslationValueObject;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Language\Translation
 *
 * @property int $id
 * @property string $locale
 * @property string $namespace
 * @property string $group
 * @property string $item
 * @property string $text
 * @property int $unstable
 * @property int $locked
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read mixed $code
 * @property-read \App\Models\Language\Language $language
 * @mixin \Eloquent
 */
class Translation extends Model
{
    /**
     *  Table name in the database.
     *  @var string
     */
    protected $table = 'translator_translations';

    /**
     *  List of variables that can be mass assigned
     *  @var array
     */
    protected $fillable = ['locale', 'namespace', 'group', 'item', 'text', 'unstable'];

    /**
     *  Each translation belongs to a language.
     */
    public function language()
    {
        return $this->belongsTo(Language::class, 'locale', 'locale');
    }

    /**
     *  Returns the full translation code for an entry: namespace.group.item
     *  @return string
     */
    public function getCodeAttribute()
    {
        return $this->namespace === '*' ? "{$this->group}.{$this->item}" : "{$this->namespace}::{$this->group}.{$this->item}";
    }

    /**
     *  Flag this entry as Reviewed
     *  @return void
     */
    public function flagAsReviewed()
    {
        $this->unstable = 0;
    }

    /**
     *  Set the translation to the locked state
     *  @return void
     */
    public function lock()
    {
        $this->locked = 1;
    }

    /**
     *  Check if the translation is locked
     *  @return boolean
     */
    public function isLocked()
    {
        return (boolean) $this->locked;
    }

    public function isSiteGroup()
    {
        return in_array($this->group, ['meta', 'menu', 'home', 'contact', 'platform', 'team', 'solution', 'ia_solution', 'training', 'footer']);
    }

    /**
     * Edit existing translation
     *
     * @param TranslationValueObject $translationObj
     */
    public function edit(TranslationValueObject $translationObj)
    {
        $this->group = $translationObj->group;
        $this->text = $translationObj->text;
    }

    /**
     * Create new translation
     *
     * @param TranslationValueObject $translationObj
     * @return Translation
     */
    public static function createTranslation(TranslationValueObject $translationObj): self
    {
        $translation = new self();
        $translation->group = $translationObj->group;
        $translation->text = $translationObj->text;
        $translation->item = $translationObj->item;

        return $translation;
    }
}
