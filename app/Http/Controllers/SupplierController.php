<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    // Tampilkan semua data supplier
    public function index()
    {
        $suppliers = Supplier::orderBy('id', 'asc')->get(); 
        return view('supplier.supindex', compact('suppliers'));
    }

    // Tampilkan form tambah supplier
    public function create()
    {
        return view('supplier.supcreate');
    }

    // Simpan data supplier baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_supp' => 'required',
            'kontak' => 'nullable',
            'alamat' => 'nullable',
        ]);

        Supplier::create($request->all());

        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil ditambahkan.');
    }

    // Tampilkan form edit supplier
    public function edit(Supplier $supplier)
    {
        return view('supplier.supedit', compact('supplier'));
    }

    // Update data supplier
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'nama_supp' => 'required',
            'kontak' => 'nullable',
            'alamat' => 'nullable',
        ]);

        $supplier->update($request->all());

        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil diperbarui.');
    }

    // Hapus data supplier
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil dihapus.');
    }
}
