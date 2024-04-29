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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->foreignId('id_konsumen');
            $table->foreignId('id_layanan');
            $table->foreignId('id_pembayaran');
            $table->string('status')->default('baru');
            $table->string('status_pembayaran');
            $table->integer('jumlah');
            $table->string('total_harga');
            $table->integer('uang_bayar'); 
            $table->integer('uang_kembalian'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
