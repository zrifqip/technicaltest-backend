<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->string('NIP')->unique()->primary();
            $table->string('Foto')->nullable();
            $table->string('Nama');
            $table->string('Alamat');
            $table->timestamp('Tanggal_Lahir');
            $table->string('Jenis_Kelamin');
            $table->string('No_Handphone');
            $table->string('NPWP');
            $table->string('Agama');
            $table->foreignId('kota_lahir_id')->references('id')->on('kota');
            $table->foreignId('jabatan_id')->references('id')->on('jabatan');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pegawai');
    }
};
