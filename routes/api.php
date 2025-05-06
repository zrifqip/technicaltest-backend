<?php

use App\enums\TokenAbility;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\JabatanController;
use App\Http\Controllers\API\PegawaiController;
use App\Http\Controllers\API\UnitkerjaController;
use App\Http\Controllers\API\WilayahController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function(){
    Route::post('login', 'loginAdmin');
    Route::post('loginGuest', 'loginGuest');
});
Route::middleware('auth:sanctum')->group(function(){
    Route::prefix('pegawai')->group(function(){
        Route::controller(PegawaiController::class)->group(function(){
            Route::get( '/', 'GetAllPegawai');
            Route::get('/filter/','GetPegawaibyFilter');
        });
        Route::controller(UnitKerjaController::class)->group(function(){
            Route::get('/unitkerja', 'GetAllUnitKerja');
        });
        Route::controller(JabatanController::class)->group(function(){
           Route::get('/jabatan', 'GetAllJabatan');
           Route::post('/jabatan', 'PostJabatan');
        });
        Route::controller(WilayahController::class)->group(function(){
            Route::get('/provinsi', 'GetAllProvinsi');
            Route::get('/kota', 'GetAllKota');
        });
    });
    Route::middleware('ability:' . TokenAbility::ACCESS_ADMIN->value)->group(function(){
        Route::prefix('pegawai')->group(function(){
            Route::controller(PegawaiController::class)->group(function(){
                Route::post('/', 'CreatePegawai');
                Route::put('/{NIP}', 'UpdatePegawai');
                Route::delete('/{NIP}', 'DeletePegawai');
            });
        });
    });
});
