<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
            'title' => 'required|min:5|max:20',
            'category_id' => "required|exists:App\Models\Category,id",
            'text' => 'required|min:5',
            'image' => 'mimes:png,jpeg,webp|max:10000',
            'isPrivate' => 'sometimes|in:1'
        ];
    }

    public function messages()
    {
        return [
            'title.min' => ':attribute коротковат. Минимум 5 символов.'
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Заголовок',
            'category_id' => 'Категория',
            'text' => 'Текст',
            'image' => 'Изображение',
            'isPrivate' => 'Приватность',
        ];
    }
}
