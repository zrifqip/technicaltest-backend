<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class WilayahController extends Controller
{
    function GetAllKota($idProvinsi)
    {
        $kota = DB::table('kota')->where('id_provinsi', $idProvinsi)->get();
        return Response()->json($kota);
    }
    function GetAllProvinsi(){
        $provinsi = DB::table('provinsi')->get();
        return Response()->json($provinsi);
    }
}
