<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $searchQuery = $request->query('search', '');

        if ($searchQuery) {
            $suppliers = Supplier::where('nama_supp', 'like', "%{$searchQuery}%")
                ->orWhere('kontak', 'like', "%{$searchQuery}%")
                ->orWhere('alamat', 'like', "%{$searchQuery}%")
                ->paginate(10);
        } else {
            $suppliers = Supplier::paginate(10);
        }

        return view('supplier.supindex', compact('suppliers'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:255',
        ]);

        $searchQuery = $request->query('search', '');

        $suppliers = Supplier::where('nama_supp', 'like', "%{$searchQuery}%")
            ->orWhere('kontak', 'like', "%{$searchQuery}%")
            ->orWhere('alamat', 'like', "%{$searchQuery}%")
            ->get();

        // 🔥 Tambahkan URL edit & delete agar bisa dipakai di JS
        $result = $suppliers->map(function ($supplier) {
            return [
                'id' => $supplier->id,
                'nama_supp' => $supplier->nama_supp,
                'kontak' => $supplier->kontak,
                'alamat' => $supplier->alamat,
                'edit_url' => route('supplier.edit', $supplier->id),
                'delete_url' => route('supplier.destroy', $supplier->id),
            ];
        });

        return response()->json($result);
    }

    public function create()
    {
        return view('supplier.supcreate');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_supp' => 'required|string|max:255',
            'kontak' => 'nullable|string|max:100',
            'alamat' => 'nullable|string',
        ]);

        Supplier::create($request->all());
        return redirect()->route('supplier.index')->with('success', 'Data supplier berhasil ditambahkan');
    }

    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('supplier.supedit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_supp' => 'required|string|max:255',
            'kontak' => 'nullable|string|max:100',
            'alamat' => 'nullable|string',
        ]);

        $supplier = Supplier::findOrFail($id);
        $supplier->update($request->all());

        return redirect()->route('supplier.index')->with('success', 'Data supplier berhasil diperbarui');
    }

    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);

        // Cek apakah ada produk supplier ini yang dipakai di detail_transaksi
        $produkDipakai = \DB::table('detail_transaksi')
            ->whereIn('id_produk', function ($query) use ($id) {
                $query->select('id_produk')
                    ->from('produk')
                    ->where('id_supplier', $id);
            })
            ->exists();

        if ($produkDipakai) {
            return redirect()->route('supplier.index')
                ->with('error', 'Supplier ini tidak dapat dihapus karena masih digunakan pada halaman kelola produk.');
        }

        // Kalau sampai sini, berarti aman. Produknya bisa dihapus otomatis karena ON DELETE CASCADE di produk
        $supplier->delete();

        return redirect()->route('supplier.index')->with('success', 'Data supplier berhasil dihapus.');
    }
}
