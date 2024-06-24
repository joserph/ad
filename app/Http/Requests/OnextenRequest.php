<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OnextenRequest extends FormRequest
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
            'responsable'   => 'required',
            'telefono'      => 'required|nullable|numeric',
            'seccional'     => 'required|nullable|exists:geograficos,estado',
            'municipio'     => 'required|nullable|exists:geograficos,municipio',
            'parroquia'     => 'required|nullable|exists:geograficos,parroquia',
            'sector'        => 'required',
        ];
    }
}
