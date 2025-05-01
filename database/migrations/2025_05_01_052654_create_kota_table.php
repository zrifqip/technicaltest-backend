<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('kota', function (Blueprint $table) {
            $table->id();
            $table->string('Nama');
            $table->foreignId('id_provinsi')->references('id')->on('provinsi')->onDelete('cascade');;
        });
    }

    public function down()
    {
        Schema::dropIfExists('kota');
    }
};
