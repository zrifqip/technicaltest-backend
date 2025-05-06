<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    public $timestamps = false;

    protected $table = 'jabatan';
    protected $fillable = [
        'Nama_Jabatan',
        'Eselon',
        'ID_Unit_Kerja',
        'ID_Kota'
    ];
}
