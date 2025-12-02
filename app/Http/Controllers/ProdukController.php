<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::orderBy('id','desc')->paginate(9);
        return view('produk.index', compact('produk'));
    }

    public function create()
    {
        return view('produk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk'=>'required|string|max:255',
            'kategori'=>'required|string|max:100',
            'harga'=>'required|integer',
            'diskon'=>'nullable|numeric|min:0|max:100',
            'gambar'=>'required|image|max:2048'
        ]);

        $fileName = time().'-'.$request->gambar->getClientOriginalName();
        $request->gambar->move(public_path('images'), $fileName);

        Produk::create([
            'nama_produk'=>$request->nama_produk,
            'kategori'=>$request->kategori,
            'harga'=>$request->harga,
            'diskon'=>$request->diskon ?? 0,
            'gambar'=>$fileName
        ]);

        return redirect()->route('produk.index')->with('success','Produk berhasil ditambahkan.');
    }

    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        return view('produk.show', compact('produk'));
    }

    public function diskon()
    {
        $produk = Produk::where('diskon', '>', 0)->orderBy('diskon', 'desc')->paginate(9);
        return view('produk.diskon', compact('produk'));
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $request->validate([
            'nama_produk'=>'required|string|max:255',
            'kategori'=>'required|string|max:100',
            'harga'=>'required|integer',
            'diskon'=>'nullable|numeric|min:0|max:100',
            'gambar'=>'nullable|image|max:2048'
        ]);

        $fileName = $produk->gambar;
        if ($request->hasFile('gambar')) {
            $fileName = time().'-'.$request->gambar->getClientOriginalName();
            $request->gambar->move(public_path('images'), $fileName);
        }

        $produk->update([
            'nama_produk'=>$request->nama_produk,
            'kategori'=>$request->kategori,
            'harga'=>$request->harga,
            'diskon'=>$request->diskon ?? 0,
            'gambar'=>$fileName
        ]);

        return redirect()->route('produk.index')->with('success','Produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        // optional: unlink image file if exists
        // if(file_exists(public_path('images/'.$produk->gambar))) unlink(public_path('images/'.$produk->gambar));
        $produk->delete();
        return redirect()->route('produk.index')->with('success','Produk berhasil dihapus.');
    }
}
