<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        return view('siswa.index');
    }

    public function create()
    {
        return view('siswa.create');
    }

    public function store(Request $request)
    {
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan!');
    }

    public function show($id)
    {
        return view('siswa.show');
    }

    public function edit($id)
    {
        return view('siswa.edit');
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui!');
    }

    public function destroy($id)
    {
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus!');
    }
}
