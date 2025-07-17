<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class LogPerubahanStok extends Model
{
    use HasFactory;

    protected $table = 'log_perubahan_stok';

    protected $fillable = [
        'id_produk',
        'jenis',
        'jumlah_perubahan',
        'stok_awal',
        'stok_akhir',
        'keterangan',
        'created_by',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }
}
