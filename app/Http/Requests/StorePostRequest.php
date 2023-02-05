<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:10'],
            'image' => 'mimes:jpg,bmp,png'
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Post must have a title!',
            'description.required' => 'Post must have description!',
            // 'author_id.exists' => 'Author id not found!'
        ];
    }
}
