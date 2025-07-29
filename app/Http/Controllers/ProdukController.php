<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\LogPerubahanStok;
use App\Models\NotifikasiStok;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $query = Produk::with(['supplier', 'category']);

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nama_produk', 'like', '%' . $search . '%')
                  ->orWhere('nomor_barcode', 'like', '%' . $search . '%')
                  ->orWhereHas('category', function ($q1) use ($search) {
                      $q1->where('name', 'like', '%' . $search . '%');
                  })
                  ->orWhereHas('supplier', function ($q2) use ($search) {
                      $q2->where('nama_supp', 'like', '%' . $search . '%');
                  });
            });
        }

        $produks = $query->orderBy('id_produk', 'asc')->paginate(10);
        return view('produk.index', compact('produks'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $categories = Category::all();
        return view('produk.create', compact('suppliers', 'categories'));
    }

    public function show($id)
    {
        $produk = Produk::with(['supplier', 'category'])->findOrFail($id);
        return view('produk.show', compact('produk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_categories' => 'required|exists:categories,id',
            'id_supplier' => 'required|exists:suppliers,id',
            'nomor_barcode' => 'nullable|unique:produk,nomor_barcode',
            'nama_produk' => 'required|string',
            'harga_jual' => 'required|numeric',
            'harga_beli' => 'required|numeric',
            'stok' => 'required|integer',
            'status' => 'required|in:dijual,tidak dijual',
            'batas_stok_minimal' => 'required|integer',
            'foto' => 'nullable|image|max:2048',
        ]);

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('foto_produk', $filename, 'public');
            $data['foto'] = $filename;
        }

        Produk::create($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $suppliers = Supplier::all();
        $categories = Category::all();
        return view('produk.edit', compact('produk', 'suppliers', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $request->validate([
            'id_categories' => 'required|exists:categories,id',
            'id_supplier' => 'required|exists:suppliers,id',
            'nomor_barcode' => 'nullable|unique:produk,nomor_barcode,' . $produk->id_produk . ',id_produk',
            'nama_produk' => 'required|string',
            'harga_jual' => 'required|numeric',
            'harga_beli' => 'required|numeric',
            'stok' => 'required|integer',
            'status' => 'required|in:dijual,tidak dijual',
            'batas_stok_minimal' => 'required|integer',
            'foto' => 'nullable|image|max:2048',
        ]);

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('foto_produk', $filename, 'public');
            $data['foto'] = $filename;
        }

        // Cek perubahan stok
        if ($produk->Stok != $request->Stok) {
            $log = LogPerubahanStok::create([
                'id_produk' => $produk->id_produk,
                'stok_awal' => $produk->Stok,
                'stok_akhir' => $request->Stok,
                'alasan_perubahan' => 'Update produk',
            ]);

            if ($request->Stok < $request->batas_stok_minimal) {
                NotifikasiStok::create([
                    'id_perubahan_stok' => $log->id,
                    'judul' => 'stok menipis',
                    'pesan' => 'stok produk ' . $produk->Nama_produk . ' menipis hingga ' . $request->Stok . ' unit.',
                ]);
            }
        }

        $produk->update($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function tambahStok($id)
    {
        $produk = Produk::findOrFail($id);
        return view('produk.kelola_stok', compact('produk'));
    }

    public function updateStok(Request $request, $id)
    {
        $request->validate([
            'stok_baru' => 'required|integer|min:1',
            'alasan' => 'required|string',
        ]);

        $produk = Produk::findOrFail($id);
        $stok_lama = $produk->Stok;
        $stok_baru = $stok_lama + $request->stok_baru;

        $produk->update(['Stok' => $stok_baru]);

        $log = LogPerubahanStok::create([
            'id_produk' => $produk->id_produk,
            'stok_awal' => $stok_lama,
            'stok_akhir' => $stok_baru,
            'alasan_perubahan' => $request->alasan,
        ]);

        if ($stok_baru < $produk->batas_stok_minimal) {
            NotifikasiStok::create([
                'id_perubahan_stok' => $log->id,
                'judul' => 'Stok Masih Rendah',
                'pesan' => 'Stok produk ' . $produk->Nama_produk . ' masih rendah walaupun sudah ditambah.',
            ]);
        }

        return redirect()->route('produk.index')->with('success', 'Stok produk berhasil ditambahkan.');
    }

    public function simpanStok(Request $request, $id)
    {
        $request->validate([
            'jumlah_stok' => 'required|integer|min:1',
        ]);

        $produk = Produk::findOrFail($id);
        $produk->stok += $request->jumlah_stok;
        $produk->save();

        return redirect()->route('produk.index')->with('success', 'Stok berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        if ($produk->foto && Storage::disk('public')->exists('foto_produk/' . $produk->foto)) {
            Storage::disk('public')->delete('foto_produk/' . $produk->foto);
        }
        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }
    public function search(Request $request)
{
    $keyword = $request->search;

    $produk = Produk::with(['category', 'supplier'])
        ->where('nama_produk', 'like', "%{$keyword}%")
        ->orWhere('nomor_barcode', 'like', "%{$keyword}%")
        ->orWhereHas('category', function ($query) use ($keyword) {
            $query->where('name', 'like', "%{$keyword}%");
        })
        ->orWhereHas('supplier', function ($query) use ($keyword) {
            $query->where('nama_supp', 'like', "%{$keyword}%");
        })
        ->get();

    return response()->json($produk);
}

}
