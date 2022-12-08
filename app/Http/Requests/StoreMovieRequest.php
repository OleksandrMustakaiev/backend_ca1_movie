<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMovieRequest extends FormRequest
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
            'title' => ['required'],
            'year' => ['required'],
            'category' => ['required'],
            'description' => ['required'],
            'rating' => ['required'],
            'image' => ['required'],
            'production_company_id' => ['required'],
            'directors' => ['required', 'exists:directors,id']
        ];
    }
}
