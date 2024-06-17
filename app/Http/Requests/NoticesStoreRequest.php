<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoticesStoreRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'link' => 'nullable|url',
            'content' => 'required|string',
            'main' => 'nullable',
            'category_id' => 'required',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'title.required' => 'El título es obligatorio.',
            'link.url' => 'El enlace debe ser una URL válida.',
            'content.required' => 'El contenido es obligatorio.',
            'category_id.required' => 'La categoría es obligatoria.',
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!$this->has('main') || $this->input('main') === null) {
                $this->merge(['main' => 0]);
            }
        });
    }


}
