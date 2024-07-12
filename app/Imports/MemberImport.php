<?php

namespace App\Imports;

use App\Models\Members;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class MemberImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Members([
            'cedula'            => $row['cedula'],
            'nombre'            => $row['nombre'],
            'apellido'          => $row['apellido'],
            'telefono'          => $row['telefono'],
            'correo'            => $row['correo'],
            'fecha_nacimiento'  => $row['fecha_nacimiento'],
            'profesion'         => $row['profesion'],
            'red_social'        => $row['red_social'],
            'usuario_red'       => $row['usuario_red'],
            'genero'            => $row['genero'],
            'alcance'           => $row['alcance'],
            'seccional'         => $row['seccional'],
            'municipio'         => $row['municipio'],
            'parroquia'         => $row['parroquia'],
            'tipo_cargo'        => $row['tipo_cargo'],
            'cargo'             => $row['cargo'],
            'buro'              => $row['buro'],
            'direccion'         => $row['direccion_domicilio'],
        ]);
    }

    public function rules(): array
    {
        return [
            'seccional' => 'nullable|exists:geograficos,estado',
            'municipio' => 'nullable|exists:geograficos,municipio',
            'parroquia' => 'nullable|exists:geograficos,parroquia',
            'cedula' => 'required|unique:members,cedula',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'required|nullable|numeric',
            'correo' => 'required|email|unique:members,correo',
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
            'direccion' => 'nullable|string|max:255',
        ];
    }
    public function customValidationMessages()
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
        ];
    }
}
