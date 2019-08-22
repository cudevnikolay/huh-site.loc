<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ContactInfoRequest extends FormRequest
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
            'phone' => 'required|max:255',
            'email' => 'required|max:255',
            'address_french' => 'required|max:255',
            'address_germany' => 'required|max:255',
            'worked_time' => 'required|max:255',
        ];
    }
}