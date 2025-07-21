<?php

namespace App\Providers;
use App\View\Composers\StokMenipisComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Produk;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
         View::composer('*', function ($view) {
        if (auth()->check() && auth()->user()->role === 'admin') {
            $produkMenipis = Produk::whereColumn('stok', '<=', 'batas_stok_minimal')->get();
            $view->with('produkMenipis', $produkMenipis);
        }
    });
    }
}
