<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'author_id'   => 'required|exists:authors,id',
            'year'        => 'nullable|integer|min:1000|max:' . date('Y'),
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price'       => 'nullable|numeric|min:0',
        ];
    }
}
