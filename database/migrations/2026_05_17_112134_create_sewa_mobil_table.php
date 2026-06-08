<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('sewa_mobil', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('mobil_id')->constrained('mobil')->onDelete('cascade');
            $table->date('tanggal_sewa');
            $table->date('tanggal_kembali');
            $table->integer('total_harga');
            $table->string('status_pembayaran')->default('belum_bayar');
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('sewa_mobil');
    }
};