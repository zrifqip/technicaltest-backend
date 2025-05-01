<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->string('NIP')->unique()->primary();
            $table->string('Nama');
            $table->string('Alamat');
            $table->timestamp('Tanggal_Lahir');
            $table->string('Jenis_Kelamin');
            $table->string('No_Handphone');
            $table->string('NPWP');
            $table->string('Golongan_Darah');
            $table->string('Agama');
            $table->foreignId('id_kota_lahir')->references('id')->on('kota');
            $table->foreignId('jabatan_id')->references('id')->on('jabatan');
            $table->foreignId('unit_kerja_id')->references('id')->on('unit_kerja');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pegawai');
    }
};
