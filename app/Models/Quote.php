<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    /**
     * @param $data
     * @return Quote
     *
     * Creating a new field in the table
     */
    static public function createQuote($data)
    {
        $quote = new Quote();
        $quote->title = $data['title'];
        $quote->text = $data['text'];
        $quote->author = $data['author'];
        $quote->enabled = isset($data['enabled']) ? 1 : 0;
        $quote->locale = $data['locale'];
        
        return $quote;
    }
    
    /**
     * @param $data
     *
     * Update values in a field
     */
    public function editQuote($data)
    {
        $this->title = $data['title'];
        $this->text = $data['text'];
        $this->author = $data['author'];
        $this->enabled  = $data['enabled'];
        $this->locale = $data['locale'];
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
