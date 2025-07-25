<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  protected $table = 'categories';

    protected $fillable = ['name'];

    public function produk()
    {
        return $this->hasMany(Produk::class, 'id_categories');
    }
}
