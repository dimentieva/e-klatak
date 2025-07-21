<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\Produk;

class StokMenipisComposer
{
    public function compose(View $view)
    {
        $produkMenipis = Produk::whereColumn('stok', '<=', 'batas_stok_minimal')->get();
        $view->with('produkMenipis', $produkMenipis);
    }
}
