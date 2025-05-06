<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Http\Requests\PegawaiRequest;
use App\Models\Pegawai;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PegawaiController extends Controller
{
    public function GetAllPegawai(Request $request)
    {
        $pegawai =  $this->GetQuery()->paginate(20);
        return response()->json($pegawai);
    }
    public function GetPegawaibyFilter(Request $request)
    {
        $query = $this->GetQuery();
        if ($request->has('name') && $request->name != '') {
            $query->where('pegawai.nama', 'like', '%' . $request->name . '%');
        }
        if ($request->has('unit_kerja_id') && $request->unit_kerja_id != '') {
            $query->where('unit_kerja.id', $request->unit_kerja_id);
        }
        if ($request->has('kota_id') && $request->unit_kerja_id != '') {
            $query->where('kota.id', $request->unit_kerja_id);
        }
        $pegawai = $query->orderBy('pegawai.nama', 'asc')->paginate(20);
        return response()->json($pegawai);
    }
    public function DeletePegawai($NIP)
    {
        $pegawai = Pegawai::findOrFail($NIP);
        $pegawai->delete();
        return response()->json(['message' => 'Pegawai deleted successfully']);
    }
    public function UpdatePegawai(PegawaiRequest $request,$NIP)
    {
        $pegawai = Pegawai::where('NIP', $NIP)->first();
        $pegawai->update($request->validated());
        return response()->json($pegawai, 200);
    }
    public function CreatePegawai(PegawaiRequest $request)
    {
        $validated = $request->validated();
        if ($request->hasFile('Foto')) {
            $imageName = time() . '.' . $request->file('Foto')->extension();
            $request->file('Foto')->storeAs('public/fotos', $imageName);
            $validated['Foto'] = $imageName;
        }
        $pegawai = Pegawai::create($validated);
        return response()->json($pegawai, 201);
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
