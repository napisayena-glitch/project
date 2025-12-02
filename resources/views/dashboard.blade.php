@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <!-- Shopee-style Hero -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="p-4 rounded" style="background: linear-gradient(90deg,#ff5722,#ff8a65); color: white;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="mb-1">Selamat Datang di Toko Sepatu</h2>
                        <p class="mb-0">Promo menarik setiap hari — temukan produk favoritmu!</p>
                    </div>
                    <div style="min-width:260px;">
                        <form method="GET" action="{{ route('produk.index') }}">
                            <div class="input-group">
                                <input type="text" name="q" class="form-control" placeholder="Cari produk, merk, atau kategori...">
                                <button class="btn btn-dark" type="submit">Cari</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Category shortcuts (small) -->
    <div class="row mb-3">
        <div class="col-12">
            <div class="d-flex gap-2 flex-wrap">
                <a class="btn btn-light border" href="#">Sepatu</a>
                <a class="btn btn-light border" href="#">Pakaian</a>
                <a class="btn btn-light border" href="#">Elektronik</a>
                <a class="btn btn-light border" href="#">Aksesoris</a>
                <a class="btn btn-light border" href="#">Promo</a>
            </div>
        </div>
    </div>

    <!-- Featured discounts -->
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center mb-2">
            <h5 class="mb-0">Flash Sale / Diskon Spesial</h5>
            <a href="{{ route('produk.diskon') }}" class="text-decoration-none">Lihat Semua</a>
        </div>

        <div class="col-12">
            <div class="row">
                @forelse($produkDiscounted as $p)
                    <div class="col-6 col-md-3 mb-3">
                        <div class="card h-100 shadow-sm p-2">
                            <div class="position-relative">
                                <img src="{{ asset('images/'.$p->gambar) }}" class="img-fluid" style="height:160px; width:100%; object-fit:cover; border-radius:8px;" alt="{{ $p->nama_produk }}">
                                @if($p->diskon > 0)
                                    <span class="badge bg-danger position-absolute" style="top:8px; left:8px;">-{{ (int)$p->diskon }}%</span>
                                @endif
                            </div>
                            <div class="mt-2">
                                <div class="small text-muted">{{ $p->kategori }}</div>
                                <div class="fw-bold">{{ Str::limit($p->nama_produk, 38) }}</div>
                                <div class="d-flex align-items-baseline gap-2">
                                    <div class="text-muted" style="text-decoration:line-through; font-size:13px;">Rp {{ number_format($p->harga,0,',','.') }}</div>
                                    <div class="text-danger fw-bold">Rp {{ number_format($p->harga - round(($p->harga * $p->diskon) / 100),0,',','.') }}</div>
                                </div>
                                <div class="mt-2 d-flex gap-2">
                                    <a href="{{ route('produk.show', $p->id) }}" class="btn btn-sm btn-outline-primary flex-fill">Detail</a>
                                    @if(Auth::user()->role === 'admin')
                                        <a href="{{ route('produk.edit', $p->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">Belum ada produk diskon.</div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- New arrivals / product grid -->
    <div class="row">
        <div class="col-12 d-flex justify-content-between align-items-center mb-2">
            <h5 class="mb-0">Produk Terbaru</h5>
            <a href="{{ route('produk.index') }}" class="text-decoration-none">Lihat Semua</a>
        </div>

        <div class="col-12">
            <div class="row">
                @forelse($produkTerbaru as $p)
                    <div class="col-6 col-md-3 mb-3">
                        <div class="card h-100 shadow-sm p-2">
                            <img src="{{ asset('images/'.$p->gambar) }}" class="img-fluid" style="height:160px; width:100%; object-fit:cover; border-radius:8px;" alt="{{ $p->nama_produk }}">
                            <div class="mt-2">
                                <div class="small text-muted">{{ $p->kategori }}</div>
                                <div class="fw-bold">{{ Str::limit($p->nama_produk, 38) }}</div>
                                <div class="text-primary fw-bold">Rp {{ number_format($p->harga,0,',','.') }}</div>
                                <a href="{{ route('produk.show', $p->id) }}" class="btn btn-sm btn-outline-primary mt-2 w-100">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">Belum ada produk.</div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

