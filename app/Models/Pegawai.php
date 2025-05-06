<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'pegawai';
    protected $fillable = [
        'NIP',
        'Foto',
        'Nama',
        'jabatan',
        'Alamat',
        'Tanggal_lahir',
        'Jenis_Kelamin',
        'Agama',
        'No_Handphone',
        'NPWP',
        'jabatan_id',
        'kota_lahir_id'
    ];

}
