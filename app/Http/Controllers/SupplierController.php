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

        return response()->json($suppliers);
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
