<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UsersUpdateRequest extends FormRequest
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

    public function messages()
    {
        return [
            'correo.required' => 'El correo es obligatorio.',
            'correo.email' => 'Ingrese una dirección de correo válida.',
            'correo.unique' => 'El correo ingresado ya se encuentra registrado.',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'correo' => [
                'required',
                'email',
                Rule::unique('members', 'correo')->ignore($this->user()->id),
                Rule::unique('users', 'email')->ignore($this->route('users')->id),
            ],
        ];
    }
}
