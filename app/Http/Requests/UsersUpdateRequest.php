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
        
        $user = $this->route()->parameters('user');
        //dd($user['user']);
        if($user)
        {
            return [
                'name'      => 'required',
                'email'     => 'required|email|unique:users,email,' . $user['user'],
                'password'  => 'same:password_confirmation',
            ];
        }
    }
}
