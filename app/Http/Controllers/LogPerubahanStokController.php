<?php

namespace App\Http\Controllers;

use App\Models\LogPerubahanStok;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogPerubahanStokController extends Controller
{
    public function index(Request $request)
    {
        $query = LogPerubahanStok::with('produk');

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

        // Gunakan paginate agar bisa menampilkan pagination di view
        $logs = $query->orderByDesc('created_at')->paginate(15)->withQueryString();

        $produkList = Produk::all();

        // Kirim nilai filter ke view untuk form input
        $filter = [
            'tanggal' => $request->tanggal,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
        ];

        return view('produk.kelola_stok', compact('logs', 'produkList', 'filter'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produk,id_produk',
            'jenis' => 'required|in:tambah,kurang',
            'jumlah_perubahan' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
        ]);

        $produk = Produk::findOrFail($request->produk_id);
        $stoklama = $produk->stok;
        $jumlah = $request->jumlah_perubahan;

        // Hitung stok baru
        if ($request->jenis === 'tambah') {
            $stokbaru = $stoklama + $jumlah;
        } else {
            if ($stoklama < $jumlah) {
                return back()->with('error', 'Stok tidak mencukupi untuk dikurangi.');
            }
            $stokbaru = $stoklama - $jumlah;
        }

        // Simpan ke produk
        $produk->stok = $stokbaru;
        $produk->save();

        // Simpan ke log
        LogPerubahanStok::create([
            'id_produk' => $produk->id_produk,
            'jenis' => $request->jenis,
            'stok_awal' => $stoklama,
            'stok_akhir' => $stokbaru,
            'jumlah_perubahan' => $jumlah,
            'keterangan' => $request->keterangan,
            'created_by' => Auth::user()->role === 'kasir' ? 'kasir' : 'admin',
        ]);

        return redirect()->route('produk.kelola_stok')->with('success', 'Perubahan stok berhasil disimpan.');
    }
}
