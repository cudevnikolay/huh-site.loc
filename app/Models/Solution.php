<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    const TYPE_GLOBAL = 1;
    const TYPE_INDUSTRIES = 2;
    const TYPE_LANGUAGES = 3;

    /**
     * Get solution's types
     
     * @return array
     */
    public static function getTypes()
    {
        return [
            'global' => Solution::TYPE_GLOBAL,
            'industries' => Solution::TYPE_INDUSTRIES,
            'languages' => Solution::TYPE_LANGUAGES,
        ];
    }

    /**
     * Get solution's types by ids
     
     * @return array
     */
    public static function getTypesById()
    {
        return array_flip(self::getTypes());
    }

    /**
     * @param $data
     * @return Solution
     *
     * Creating a new field in the table
     */
    static public function createSolution($data)
    {
        $solution = new Solution();
        $solution->locale   = $data['locale'];
        $solution->image    = $data['image'];
        $solution->title    = $data['title'];
        $solution->text     = $data['text'];
        $solution->type     = $data['type'];
        $solution->enabled  = isset($data['enabled']) ? 1 : 0;

        return $solution;
    }
    
    /**
     * @param $data
     *
     * Update values in a field
     */
    public function editSolution($data)
    {
        $this->image    = is_null($data['image']) ? $data['image'] : $this->image;
        $this->locale    = $data['locale'];
        $this->title    = $data['title'];
        $this->text     = $data['text'];
        $this->type     = $data['type'];
        $this->enabled  = $data['enabled'];
    }
    
    /**
     * @param $query
     * @return mixed
     */
    public function scopeEnabled($query)
    {
        return $query->where('enabled', 1);
    }
    
    /**
     * Get by list type
     *
     * @param $query
     * @param $type
     *
     * @return mixed
     */
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Get by list locale
     *
     * @param $query
     * @param $locale
     *
     * @return mixed
     */
    public function scopeByLocale($query, $locale)
    {
        return $query->where('locale', $locale);
    }
}
