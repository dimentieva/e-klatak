<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    protected $primaryKey = 'id_produk';

    protected $fillable = [
        'kategori',
        'id_supplier',
        'nomor_barcode',
        'nama_produk',
        'harga_jual',
        'harga_beli',
        'stok',
        'status',
        'batas_stok_minimal',
        'foto',
    ];

    // Relasi ke supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier');
    }

    public function notifikasiStok()
    {
        return $this->hasOne(NotifikasiStok::class, 'id_produk');
    }
    public function logPerubahanStok()
    {
        return $this->hasMany(LogPerubahanStok::class, 'id_produk', 'id_produk');
    }
}
