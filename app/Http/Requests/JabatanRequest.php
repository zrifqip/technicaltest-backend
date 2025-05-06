<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JabatanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'Nama_Jabatan' => 'required|string',
            'Golongan' => 'required|string',
            'id_unit_kerja' => 'required|exists:unit_kerja,id',
            'id_kota' => 'required|exists:kota,id',
        ];
    }
}
