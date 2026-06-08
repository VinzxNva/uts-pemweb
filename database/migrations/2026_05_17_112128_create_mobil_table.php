<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('mobil', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mobil');
            $table->string('merek');
            $table->string('plat_nomor')->unique();
            $table->integer('harga_per_hari');
            $table->string('status')->default('tersedia');
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('mobil');
    }
};