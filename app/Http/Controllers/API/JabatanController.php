<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

class UnitkerjaController extends Controller
{
    public function GetALlInstansi(Request $request)
    {
        $pegawai =  $this->GetQuery()->paginate(20);
        return response()->json($pegawai);
    }
    private function GetQuery(){
        return DB::table('pegawai')
            ->join('kota as kota_lahir','pegawai.kota_lahir_id', '=', 'kota_lahir.id')
            ->join('jabatan', 'pegawai.jabatan_id', '=', 'jabatan.id')
            ->join('unit_kerja', 'jabatan.id_unit_kerja', '=', 'unit_kerja.id')
            ->join('kota as kota_kerja','jabatan.id_kota_kerja', '=', 'kota_kerja.id')
            ->select(
                'pegawai.NIP',
                'pegawai.Nama',
                'kota_lahir.Nama as Tempat Lahir',
                'pegawai.Alamat',
                'pegawai.Tanggal_Lahir as Tgl Lahir',
                'pegawai.Jenis_Kelamin as Jenis Kelamin',
                'pegawai.Golongan as Gol',
                'jabatan.Eselon',
                'jabatan.Nama_Jabatan as Jabatan',
                'kota_kerja.Nama as Tempat Tugas',
                'pegawai.Agama',
                'unit_kerja.Instansi as Unit Kerja',
                'pegawai.No_Handphone as No. HP',
                'pegawai.NPWP as NPWP',
            )->orderBy('unit_kerja.Instansi');
    }
}
