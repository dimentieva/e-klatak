<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('search');

        $query = Supplier::query()
            ->when($keyword, function ($q) use ($keyword) {
                $q->where('nama_supp', 'like', "%{$keyword}%")
                  ->orWhere('kontak', 'like', "%{$keyword}%")
                  ->orWhere('alamat', 'like', "%{$keyword}%");
            })
            ->orderBy('id', 'asc');

        // AJAX Request
        if ($request->ajax()) {
            return response()->json($query->get());
        }

        $suppliers = $query->paginate(5)->withQueryString();
        return view('supplier.supindex', compact('suppliers'));
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
        $supplier->delete();

        return redirect()->route('supplier.index')->with('success', 'Data supplier berhasil dihapus');
    }
}
