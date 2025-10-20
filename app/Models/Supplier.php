<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'suppliers';

    protected $fillable = [
        'nama_supp',
        'kontak',
        'alamat',
    ];

    // Relasi: Supplier punya banyak produk
    public function produk()
    {
        return $this->hasMany(Produk::class, 'id_supplier', 'id');
    }

    // Relasi: Supplier punya banyak detail transaksi lewat produk
    public function detailTransaksi()
    {
        return $this->hasManyThrough(
            DetailTransaksi::class,
            Produk::class,
            'id_supplier', 
            'id_produk',   
            'id',          
            'id_produk'    
        );
    }
}
