<?php

namespace App\Http\Controllers;

use App\Models\LogPerubahanStok;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogPerubahanStokController extends Controller
{
    public function index(Request $request, $produk_id)
    {
        $produk = Produk::findOrFail($produk_id); // penting!

        $query = LogPerubahanStok::with('produk')->where('id_produk', $produk_id); // filter log hanya untuk produk ini

        // Filter berdasarkan tanggal, bulan, dan tahun jika tersedia
        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }

        if ($request->filled('bulan')) {
            $query->whereMonth('created_at', $request->bulan);
        }

        if ($request->filled('tahun')) {
            $query->whereYear('created_at', $request->tahun);
        }

        // Ambil log perubahan stok, urutkan dari terbaru, dan paginasi
        $logs = $query->orderByDesc('created_at')->paginate(15)->withQueryString();

        // Ambil semua produk untuk ditampilkan (jika dibutuhkan)
        $produkList = Produk::all();

        // Simpan nilai filter untuk ditampilkan kembali di form
        $filter = [
            'tanggal' => $request->tanggal,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
        ];

        return view('produk.kelola_stok', compact('logs', 'produkList', 'filter', 'produk')); // Add 'produk' here
    }

    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produk,id_produk',
            'jenis' => 'required|in:tambah,kurang',
            'jumlah_perubahan' => 'required|integer|min:1',
            'keterangan' => 'required|string',
        ]);

        // Ambil data produk berdasarkan ID
        $produk = Produk::where('id_produk', $request->produk_id)->firstOrFail();
        $stokLama = $produk->stok;
        $jumlah = $request->jumlah_perubahan;

        // Hitung stok baru berdasarkan jenis perubahan
        if ($request->jenis === 'tambah') {
            $stokBaru = $stokLama + $jumlah;
        } else {
            if ($stokLama < $jumlah) {
                return back()->with('error', 'Stok tidak mencukupi untuk dikurangi.')->withInput();
            }
            $stokBaru = $stokLama - $jumlah;
        }

        // Update stok produk
        $produk->stok = $stokBaru;
        $produk->save();

        // Simpan log perubahan stok
        LogPerubahanStok::create([
            'id_produk' => $produk->id_produk,
            'jenis' => $request->jenis,
            'stok_awal' => $stokLama,
            'stok_akhir' => $stokBaru,
            'jumlah_perubahan' => $jumlah,
            'keterangan' => $request->keterangan,
            'created_by' => Auth::user()->role ?? 'admin',
            'kasir' // fallback admin jika tidak ada
        ]);

        return redirect()->route('produk.kelola_stok', $produk->id_produk)->with('success', 'Perubahan stok berhasil disimpan.');
    }
}
