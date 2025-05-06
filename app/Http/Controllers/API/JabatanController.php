<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\JabatanRequest;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JabatanController extends Controller
{
    public function GetAllJabatan (JabatanRequest $request)
    {
        return $this->GetQuery($request->unit_kerja_id, $request->kota_id);
    }
    public function PostJabatan(JabatanRequest $request)
    {
        $jabatan = Jabatan::create($request->all());
        return response()->json($jabatan, 201);
    }
    private function GetQuery($unit_kerja_id, $kota_id){
        return DB::table('Jabatan')
            ->where('id_unit_kerja', '=', $unit_kerja_id, )
            ->where('id_kota_kerja', '=', $kota_id)
            ->get();
    }
}
