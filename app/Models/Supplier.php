<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    // Nama tabel (opsional, Laravel otomatis pakai 'suppliers')
    protected $table = 'suppliers';

    // Kolom yang boleh diisi (mass assignment)
    protected $fillable = [
        'nama_supp',
        'kontak',
        'alamat',
    ];
}

