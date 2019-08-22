<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    const TYPE_TPE_1 = 1;
    const TYPE_TPE_2 = 2;
    const TYPE_TPE_3 = 3;

    /**
     * Get solution's types
     
     * @return array
     */
    public static function getTypes()
    {
        return [
            'type_1' => Solution::TYPE_TPE_1,
            'type_2' => Solution::TYPE_TPE_2,
            'type_3' => Solution::TYPE_TPE_3,
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
        $solution->image    = $data['image'];
        $solution->title    = $data['title'];
        $solution->type    = $data['type'];
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
        $this->title    = $data['title'];
        $this->type = $data['type'];
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
}
