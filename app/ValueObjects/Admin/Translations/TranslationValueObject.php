<?php

namespace App\ValueObjects\Admin\Translations;

class TranslationValueObject
{
    public $id;
    public $text;
    public $group;
    public $item;

    /**
     * TranslationValueObject constructor.
     * @param $id
     * @param $text
     * @param $group
     */
    public function __construct($translation)
    {
        $this->id = $translation['id'];
        $this->text = $translation['text'];
        $this->group = $translation['group'];
        $this->item = $translation['item'];
    }
}