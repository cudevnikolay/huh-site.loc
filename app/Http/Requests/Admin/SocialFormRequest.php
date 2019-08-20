<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SocialFormRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            '*.link' => 'url|nullable',
        ];
        
        return $rules;
    }
    
    public function messages()
    {
        return [
            '*.link.url' => 'The url format is invalid',
        ];
    }
}