<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    protected $primaryKey = 'id_produk';
    public $timestamps = true; // aktifkan jika pakai created_at & updated_at

    protected $fillable = [
        'id_categories',
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

    /**
     * Relasi ke supplier (many to one)
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier', 'id');
    }

    /**
     * Relasi ke kategori (many to one)
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'id_categories', 'id');
    }

    /**
     * Relasi ke notifikasi stok (one to one)
     */
    public function notifikasiStok()
    {
        return $this->hasOne(NotifikasiStok::class, 'id_produk', 'id_produk');
    }

    /**
     * Relasi ke log perubahan stok (one to many)
     */
    public function logPerubahanStok()
    {
        return $this->hasMany(LogPerubahanStok::class, 'id_produk', 'id_produk');
    }
}
