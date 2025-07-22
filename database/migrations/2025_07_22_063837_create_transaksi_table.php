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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->timestamp('waktu_transaksi');
            $table->string('nomor_nota')->unique();
            $table->string('metode_bayar');
            $table->decimal('total_harga', 12, 2);
            $table->decimal('jumlah_pembayaran', 12, 2);
            $table->decimal('kembalian', 12, 2);
            $table->decimal('pajak', 12, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
