<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawans = Karyawan::latest()->get();
        return view('karyawan.index', compact('karyawans'));
    }

    public function create()
    {
        return view('karyawan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:karyawans',
            'no_hp' => 'required',
            'alamat' => 'required',
            'tanggal_bergabung' => 'required|date',
        ]);

        Karyawan::create($request->all());

        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil ditambahkan.');
    }

    public function destroy(Karyawan $karyawan)
    {
        $karyawan->delete();
        return back()->with('success', 'Data karyawan berhasil dihapus.');
    }


    public function edit(Karyawan $karyawan)
    {
        return view('karyawan.edit', compact('karyawan'));
    }

    public function update(Request $request, Karyawan $karyawan)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:karyawans,email,' . $karyawan->id,
            'no_hp' => 'required',
            'alamat' => 'required',
            'tanggal_bergabung' => 'required|date',
        ]);

        $karyawan->update($request->all());

        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil diperbarui.');
    }
}
