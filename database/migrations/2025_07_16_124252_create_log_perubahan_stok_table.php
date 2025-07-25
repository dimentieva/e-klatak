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
        Schema::create('log_perubahan_stok', function (Blueprint $table) {
            $table->id(); // id log
            $table->unsignedBigInteger('id_produk'); // relasi ke produk
            $table->enum('jenis', ['tambah', 'kurang']);
            $table->integer('jumlah_perubahan');
            $table->integer('stok_awal'); // stok_sebelum
            $table->integer('stok_akhir'); // stok_sesudah
            $table->text('keterangan')->nullable(); // tambahan
            $table->string('created_by')->nullable(); // siapa yang merubah (kasir/admin)
            $table->timestamps();

            // Foreign key ke produk
            $table->foreign('id_produk')->references('id_produk')->on('produk')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_perubahan_stok');
    }
};
