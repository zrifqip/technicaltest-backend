<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PegawaiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules() : array
    {
        return [
            'NIP' => 'required|string|unique:pegawai,NIP',
            'Nama' => 'required|string',
            'Foto' => 'required|string',
            'Alamat' => 'required|string',
            'Tanggal_Lahir' => 'required|date',
            'Jenis_Kelamin' => 'required|string',
            'No_Handphone' => 'required|string',
            'NPWP' => 'required|string',
            'Agama' => 'required|string',
            'Golongan' => 'required|string',
            'kota_lahir_id' => 'required|exists:kota,id',
            'jabatan_id' => 'required|exists:jabatan,id',
        ];
    }
}
