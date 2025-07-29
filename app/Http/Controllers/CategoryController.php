<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Tampilkan halaman kategori
    public function index(Request $request)
    {
        $searchQuery = $request->query('search', '');

        if ($searchQuery) {
            $categories = Category::where('name', 'like', "%{$searchQuery}%")
                ->orderBy('created_at', 'asc')
                ->paginate(10);
        } else {
            $categories = Category::orderBy('created_at', 'asc')->paginate(10);
        }

        return view('categories.index', compact('categories'));
    }

    // Endpoint untuk AJAX search
    public function search(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:255',
        ]);

        $searchQuery = $request->query('search', '');

        $categories = Category::where('name', 'like', "%{$searchQuery}%")
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($categories);
    }

    // Tampilkan form tambah kategori
    public function create()
    {
        return view('categories.create');
    }

    // Simpan kategori baru
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create($validatedData);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    // Tampilkan form edit kategori
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    // Simpan perubahan kategori
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->update($validatedData);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    // Hapus kategori
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
