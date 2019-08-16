<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LanguageRequest extends FormRequest
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
        $id = $this->request->get('id');

        return [
            'locale' => [
                    'alpha_dash',
                    'regex:/(^([a-zA-Z0-9_\-]+)$)/u',
                    $id ? '' : 'required',
                    Rule::unique('translator_languages', 'locale')->ignore($id)
                ],
            'name' => [
                'required',
                    Rule::unique('translator_languages', 'name')->ignore($id)
            ],
        ];
    }
}
