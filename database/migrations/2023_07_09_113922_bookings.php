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
            $table->foreignId('booking_service_id');
            $table->string('bukti_dp');
            $table->tinyInteger('status_dp');
            $table->integer('bayar_dp');
            $table->integer('total_harga');
            $table->integer('bayar_offline');
            $table->integer('kembalian');
            $table->tinyInteger('status_lunas');
            $table->foreignId('user_id');
            $table->foreignId('karyawan_id');
            $table->foreignId('jadwal_id');
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
