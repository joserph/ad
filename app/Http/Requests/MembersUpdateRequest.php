<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MembersUpdateRequest extends FormRequest
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
            'seccional.exists' => 'La seccional es inválida.',
            'municipio.exists' => 'El municipio es inválido.',
            'parroquia.exists' => 'La parroquia es inválida.',
            'cedula.required' => 'La cédula es obligatoria.',
            'cedula.numeric' => 'La cédula debe ser un número.',
            'cedula.unique' => 'La cédula ya ha sido registrada.',
            'nombre.required' => 'El nombre es obligatorio.',
            'apellido.required' => 'Los apellidos son obligatorios.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.numeric' => 'El teléfono debe ser un número.',
            'correo.required' => 'El correo es obligatorio.',
            'correo.email' => 'El correo debe ser una dirección de correo válida.',
            'correo.unique' => 'El correo ya ha sido registrado.',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'fecha_nacimiento.date_format' => 'La fecha de nacimiento no cumple con el formato requerido.',
            'alcance.required' => 'El alcance es obligatorio.',
            'tipo_cargo.required' => 'El tipo de cargo es obligatorio.',
            'cargo.required' => 'El cargo es obligatorio.',
            'genero.required' => 'El género es obligatorio.',
            'genero.in' => 'El género seleccionado no es válido.',
            // 'esUsuario.required' => 'Es necesario especificar si es usuario.',
            // 'esUsuario.in' => 'La selección de si es usuario no es válida.',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        // dd($this->id);
        return [
            'seccional' => 'nullable|exists:geograficos,estado',
            'municipio' => 'nullable|exists:geograficos,municipio',
            'parroquia' => 'nullable|exists:geograficos,parroquia',
            'cedula' => 'required|unique:members,cedula,' . $this->id,
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'required|nullable|numeric',
            'correo' => 'required|email|unique:members,correo,' . $this->id,
            'fecha_nacimiento' => 'required|date_format:Y/m/d',
            'profesion' => 'nullable|string|max:255',
            'red_social' => 'nullable|string|max:255',
            'usuario_red' => 'nullable|string|max:255',
            'genero' => 'required|in:hombre,mujer',
            'alcance' => 'required|string|max:255',
            'tipo_cargo' => 'nullable|string|max:255',
            'cargo' => 'nullable|string|max:255',
            'buro' => 'nullable|string|max:255',
            'cargo_pub' => 'nullable|string|max:255',
            // 'esUsuario' => 'required|in:si,no',
        ];
    }
}
