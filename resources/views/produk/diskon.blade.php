@extends('layouts.app')

@section('title','Produk Diskon')

@section('content')
<!-- Back Button -->
<div class="mb-3">
    <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="mb-0">🎉 Produk Diskon Spesial</h3>

    <form class="d-flex" method="GET" action="{{ route('produk.diskon') }}">
        <input type="text" name="q" class="form-control form-control-sm me-2" placeholder="Cari produk..." value="{{ request('q') }}">
        <button class="btn btn-sm btn-outline-secondary">Cari</button>
    </form>
</div>

<div class="row mb-3">
    <div class="col-12">
        @forelse($produk as $p)
            <div class="col-md-4 mb-4">
                <div class="card h-100 position-relative">
                    <img src="{{ asset('images/'.$p->gambar) }}" class="produk-img" alt="gambar">
                    
                    <!-- Badge Diskon -->
                    @if($p->diskon > 0)
                        <div class="position-absolute top-0 end-0 m-2">
                            <span class="badge bg-danger" style="font-size: 14px;">
                                -{{ $p->diskon }}%
                            </span>
                        </div>
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{ $p->nama_produk }}</h5>
                        <p class="text-muted mb-1">{{ $p->kategori }}</p>
                        
                        <!-- Harga Section -->
                        <div class="mb-2">
                            @if($p->diskon > 0)
                                <p class="mb-0">
                                    <span class="text-muted" style="text-decoration: line-through;">
                                        Rp {{ number_format($p->harga,0,',','.') }}
                                    </span>
                                </p>
                                <p class="price mb-0" style="color: #dc3545; font-weight: bold;">
                                    Rp {{ number_format($p->harga - round(($p->harga * $p->diskon) / 100), 0, ',', '.') }}
                                </p>
                                <small class="text-success">
                                    Hemat Rp {{ number_format(round(($p->harga * $p->diskon) / 100), 0, ',', '.') }}
                                </small>
                            @else
                                <p class="price mb-0">Rp {{ number_format($p->harga,0,',','.') }}</p>
                            @endif
                        </div>

                        <p class="small text-truncate">{{ $p->deskripsi ?? '-' }}</p>

                        <div class="d-flex justify-content-between mt-3">
                            <a href="{{ route('produk.show', $p->id) }}" class="btn btn-outline-primary btn-sm">Detail</a>
                            
                            <!-- Tombol Edit dan Hapus hanya untuk Admin -->
                            @if(Auth::user()->role === 'admin')
                                <div>
                                    <a href="{{ route('produk.edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <button onclick="confirmDelete('{{ route('produk.destroy', $p->id) }}')" class="btn btn-danger btn-sm">Hapus</button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">Belum ada produk dengan diskon.</div>
            </div>
        @endforelse
    </div>
</div>

<div class="d-flex justify-content-center">
    {{ $produk->links() }}
</div>
@endsection
