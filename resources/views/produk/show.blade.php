@extends('layouts.app')

@section('title',$produk->nama_produk)

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card p-3">
            <img src="{{ asset('images/'.$produk->gambar) }}" class="w-100" style="height:420px;object-fit:cover;border-radius:10px;">
        </div>
    </div>

    <div class="col-md-6">
        <div class="card p-4">
            <h3>{{ $produk->nama_produk }}</h3>
            <p class="muted">{{ $produk->kategori }}</p>
            <h4 class="price">Rp {{ number_format($produk->harga,0,',','.') }}</h4>

            <hr>

            <div class="mt-4">
                <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-warning me-2">Edit</a>
                <button onclick="confirmDelete('{{ route('produk.destroy', $produk->id) }}')" class="btn btn-danger">Hapus</button>
                <a href="{{ route('produk.index') }}" class="btn btn-secondary ms-2">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
