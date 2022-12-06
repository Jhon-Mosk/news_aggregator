<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsSourceRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'link' => 'required|url|active_url',
        ];
    }

    public function attributes()
    {
        return [
            'link' => 'Источник',
        ];
    }

    public function messages()
    {
        return [
            'link.required' => 'А источник?'
        ];
    }
}
