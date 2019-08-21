<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class QuotesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    
    /**
     * @return array
     *
     * Rules for a validation Request
     */
    public function rules()
    {
        return [
            'title'         => 'required|max:255',
            'text'          => 'required',
            'author'        => 'required|max:255',
        ];
    }
}