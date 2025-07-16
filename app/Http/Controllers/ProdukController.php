<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Supplier;
use App\Models\LogPerubahanStok;
use App\Models\NotifikasiStok;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::with('supplier')->get();
        return view('produk.index', compact('produks'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        return view('produk.create', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required|string',
            'id_supplier' => 'required|exists:suppliers,id',
            'nomor_barcode' => 'required|unique:produk',
            'nama_produk' => 'required|string',
            'harga_jual' => 'required|numeric',
            'harga_beli' => 'required|numeric',
            'stok' => 'required|integer',
            'status' => 'required|in:aktif,nonaktif',
            'batas_stok_minimal' => 'required|integer',
            'foto' => 'nullable|image|max:2048',
        ]);

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('foto_produk', $filename);
            $data['foto'] = $filename;
        }

        Produk::create($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $suppliers = Supplier::all();
        return view('produk.edit', compact('produk', 'suppliers'));
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $request->validate([
            'kategori' => 'required|string',
            'id_supplier' => 'required|exists:suppliers,id',
            'nomor_barcode' => 'required|unique:produk,nomor_barcode,' . $produk->id_produk . ',id_produk',
            'nama_produk' => 'required|string',
            'harga_jual' => 'required|numeric',
            'harga_beli' => 'required|numeric',
            'stok' => 'required|integer',
            'status' => 'required|in:aktif,nonaktif',
            'batas_stok_minimal' => 'required|integer',
            'foto' => 'nullable|image|max:2048',
        ]);

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('foto_produk', $filename);
            $data['foto'] = $filename;
        }

        // Cek perubahan stok
        if ($produk->Stok != $request->Stok) {
            $log = LogPerubahanStok::create([
                'id_produk' => $produk->id_produk,
                'stok_sebelumnya' => $produk->Stok,
                'stok_sesudah' => $request->Stok,
                'alasan_perubahan' => 'Update produk',
            ]);

            if ($request->Stok < $request->batas_stok_minimal) {
                NotifikasiStok::create([
                    'id_perubahan_stok' => $log->id,
                    'judul' => 'Stok Menipis',
                    'pesan' => 'Stok produk ' . $produk->Nama_produk . ' menipis hingga ' . $request->Stok . ' unit.',
                ]);
            }
        }

        $produk->update($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

   public function destroy($id)
{
    $produk = Produk::findOrFail($id);

    // Hapus foto dari storage jika ada
    if ($produk->foto && Storage::disk('public')->exists('foto_produk/' . $produk->foto)) {
        Storage::disk('public')->delete('foto_produk/' . $produk->foto);
    }

    // Hapus produk dari database
    $produk->delete();

    return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
}
}
