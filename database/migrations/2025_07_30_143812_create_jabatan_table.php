<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('jabatan', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('Nama_Jabatan');
            $table->string('Eselon');
            $table->foreignId('id_unit_kerja')->references('id')->on('unit_kerja');
            $table->foreignId('id_kota_kerja')->references('id')->on('kota');
        });
    }

    public function down()
    {
        Schema::dropIfExists('jabatan');
    }
};
