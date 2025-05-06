<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UnitkerjaController extends Controller
{
    public function GetAllUnitKerja(){
        $unitKerja = DB::table('unit_kerja')
            ->select(DB::raw("CONCAT(instansi, ' ', kategori) as instansi"))
            ->get();
        return response()->json($unitKerja);
    }
}
