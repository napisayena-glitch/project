@extends('layouts.app')

@section('title','Edit Produk')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card p-4">
            <h4>Edit Produk</h4>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $err) <li>{{ $err }}</li> @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data" id="formProduk">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama Produk</label>
                    <input type="text" name="nama_produk" class="form-control" value="{{ old('nama_produk', $produk->nama_produk) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <input type="text" name="kategori" class="form-control" value="{{ old('kategori', $produk->kategori) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">💰 Harga Produk</label>
                    <div class="input-group input-group-lg">
                        <span class="input-group-text">Rp</span>
                        <input type="number" id="txtHarga" name="harga" class="form-control" value="{{ old('harga', $produk->harga) }}" required placeholder="0">
                    </div>
                </div>

                <!-- Section Diskon Baru -->
                <div class="card border-warning bg-white mb-3" style="border-width: 2px;">
                    <div class="card-header bg-warning">
                        <h5 class="mb-0">🎉 Pengaturan Diskon Harga</h5>
                    </div>
                    <div class="card-body">
                        <!-- Slider Diskon -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label fw-bold mb-0">Persentase Diskon</label>
                                <span class="badge bg-danger" style="font-size: 14px;">
                                    <span id="lblDiskonPersen">0</span>%
                                </span>
                            </div>
                            <input type="range" id="sldDiskon" class="form-range" min="0" max="100" step="1" value="{{ old('diskon', $produk->diskon ?? 0) }}" style="height: 8px;">
                            <div class="d-flex justify-content-between mt-2" style="font-size: 12px; color: #666;">
                                <span>0%</span>
                                <span>50%</span>
                                <span>100%</span>
                            </div>
                        </div>

                        <!-- Atau Input Langsung -->
                        <div class="mb-4">
                            <label class="form-label">Atau Ketik Langsung</label>
                            <div class="input-group">
                                <input type="number" id="txtDiskon" name="diskon" class="form-control" min="0" max="100" step="1" value="{{ old('diskon', $produk->diskon ?? 0) }}" placeholder="0">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>

                        <!-- Ringkasan Diskon -->
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="p-3 rounded" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                                    <small class="d-block opacity-75">Potongan Harga</small>
                                    <h4 class="mb-0">Rp <span id="lblNominalDiskon">0</span></h4>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 rounded" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white;">
                                    <small class="d-block opacity-75">Harga Final</small>
                                    <h4 class="mb-0">Rp <span id="lblHargaAkhir">0</span></h4>
                                </div>
                            </div>
                        </div>

                        <!-- Info Hemat -->
                        <div class="alert alert-success mt-3 mb-0">
                            <small>
                                Anda menghemat <strong><span id="lblDiskonPersen2">0</span>%</strong> dari harga asli
                            </small>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gambar Produk</label>
                    @if($produk->gambar)
                        <div class="mb-2">
                            <img src="{{ asset('images/'.$produk->gambar) }}" alt="Current Image" style="max-width: 150px; border-radius: 8px;">
                        </div>
                    @endif
                    <input type="file" name="gambar" class="form-control" accept="image/*">
                    <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
                </div>

                <div class="d-flex gap-2">
                    <button class="btn btn-primary">Update Produk</button>
                    <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
function updateDiskon() {
    let harga = parseFloat(document.getElementById('txtHarga').value) || 0;
    let diskon = parseFloat(document.getElementById('sldDiskon').value) || 0;
    
    // Sync antara slider dan input
    document.getElementById('txtDiskon').value = diskon;
    document.getElementById('sldDiskon').value = diskon;
    
    // Hitung nominal diskon
    let nominalDiskon = Math.round((harga * diskon) / 100);
    let hargaAkhir = harga - nominalDiskon;
    
    // Update display
    document.getElementById('lblDiskonPersen').textContent = diskon.toFixed(0);
    document.getElementById('lblDiskonPersen2').textContent = diskon.toFixed(0);
    document.getElementById('lblNominalDiskon').textContent = nominalDiskon.toLocaleString('id-ID');
    document.getElementById('lblHargaAkhir').textContent = hargaAkhir.toLocaleString('id-ID');
}

// Event listeners
document.getElementById('txtHarga').addEventListener('change', updateDiskon);
document.getElementById('txtHarga').addEventListener('keyup', updateDiskon);
document.getElementById('sldDiskon').addEventListener('change', updateDiskon);
document.getElementById('sldDiskon').addEventListener('input', updateDiskon);
document.getElementById('txtDiskon').addEventListener('change', updateDiskon);
document.getElementById('txtDiskon').addEventListener('keyup', updateDiskon);

// Initial update
setTimeout(() => {
    updateDiskon();
}, 100);
</script>
@endsection
