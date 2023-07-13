<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cabang_id');
            $table->string('bukti_dp')->nullable();
            $table->tinyInteger('status_dp')->nullable();
            $table->integer('bayar_dp')->nullable();
            $table->integer('total_harga')->nullable();
            $table->integer('bayar_offline')->nullable();
            $table->integer('kembalian')->nullable();
            $table->tinyInteger('status_lunas')->nullable();
            $table->tinyInteger('status_proses')->nullable();
            $table->foreignId('user_id');
            $table->foreignId('karyawan_id');
            $table->foreignId('jadwal_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
