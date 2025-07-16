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
        Schema::create('notifikasi_stok', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_perubahan_stok'); // relasi ke log_perubahan_stok
            $table->string('judul');
            $table->text('pesan');
            $table->timestamps();

            // FK ke log_perubahan_stok
            $table->foreign('id_perubahan_stok')->references('id')->on('log_perubahan_stok')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifikasi_stok');
    }
};
