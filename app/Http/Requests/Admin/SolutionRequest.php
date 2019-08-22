<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SolutionRequest extends FormRequest
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
        if (!isset($this->all()['id'])) {
            return [
                'image'         => 'required|mimes:jpeg,jpg,bmp,png|max:1024',
                'title'           => 'required|max:255',
            ];
        } else {
            return [
                'image'         => 'mimes:jpeg,jpg,bmp,png|max:1024',
                'title'           => 'required|max:255',
            ];
        }
    }
}