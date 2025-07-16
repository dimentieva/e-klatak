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
        Schema::create('produk', function (Blueprint $table) {
            $table->id('id_produk');
            $table->string('kategori');
            $table->unsignedBigInteger('id_supplier');
            $table->string('nomor_barcode')->unique();
            $table->string('nama_produk');
            $table->decimal('harga_jual', 12, 2);
            $table->decimal('harga_beli', 12, 2);
            $table->integer('stok');
            $table->enum('status', ['aktif', 'nonaktif']);
            $table->integer('batas_stok_minimal');
            $table->string('foto')->nullable();
            $table->timestamps();

            $table->foreign('id_supplier')
                ->references('id')
                ->on('suppliers')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
