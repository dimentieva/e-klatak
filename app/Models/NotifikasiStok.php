<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotifikasiStok extends Model
{
    use HasFactory;

    protected $table = 'notifikasi_stok';

    protected $fillable = [
        'id_perubahan_stok',
        'judul',
        'pesan',
    ];

    /**
     * Relasi ke log_perubahan_stok
     */
    public function perubahanStok()
    {
        return $this->belongsTo(LogPerubahanStok::class, 'id_perubahan_stok');
    }
}
