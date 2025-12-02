@extends('layouts.app')

@section('title','Tambah Produk')

@section('content')
<div class="container">
    <div class="card p-3 shadow-sm">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Tambah Produk Baru</h4>
            <a href="{{ route('produk.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $err) <li>{{ $err }}</li> @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data" id="formProduk">
            @csrf
            <div class="row">
                <div class="col-md-5">
                    <div class="mb-3">
                        <label class="form-label">Preview Gambar</label>
                        <div class="border rounded p-2 text-center" style="min-height:220px;">
                            <img id="previewImg" src="{{ asset('images/default.png') }}" alt="preview" style="max-width:100%; max-height:200px; object-fit:contain;">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gambar Produk</label>
                        <input type="file" id="gambar" name="gambar" class="form-control" accept="image/*" required onchange="previewFile(this)">
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="mb-3">
                        <label class="form-label">Nama Produk</label>
                        <input type="text" name="nama_produk" class="form-control form-control-lg" value="{{ old('nama_produk') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <input type="text" name="kategori" class="form-control" value="{{ old('kategori') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Harga (Rp)</label>
                        <input type="number" id="txtHarga" name="harga" class="form-control form-control-lg" value="{{ old('harga', 0) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Diskon (%)</label>
                        <div class="d-flex gap-2 align-items-center">
                            <input type="range" id="sldDiskon" min="0" max="100" step="1" value="{{ old('diskon', 0) }}" class="form-range flex-grow-1">
                            <input type="number" id="txtDiskon" name="diskon" class="form-control" style="width:90px;" min="0" max="100" value="{{ old('diskon', 0) }}">
                        </div>
                        <div class="mt-2 d-flex justify-content-between">
                            <small class="text-muted">Potongan: Rp <span id="lblNominalDiskon">0</span></small>
                            <small class="text-muted">Harga Akhir: Rp <span id="lblHargaAkhir">0</span></small>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button class="btn btn-warning btn-lg">Simpan Produk</button>
                        <a href="{{ route('produk.index') }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function previewFile(input) {
    const file = input.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('previewImg').src = e.target.result;
    }
    reader.readAsDataURL(file);
}

function updateDiskon() {
    let harga = parseFloat(document.getElementById('txtHarga').value) || 0;
    let diskon = parseFloat(document.getElementById('sldDiskon').value) || 0;
    document.getElementById('txtDiskon').value = diskon;
    let nominal = Math.round((harga * diskon) / 100);
    let akhir = harga - nominal;
    document.getElementById('lblNominalDiskon').textContent = nominal.toLocaleString('id-ID');
    document.getElementById('lblHargaAkhir').textContent = akhir.toLocaleString('id-ID');
}

document.getElementById('txtHarga').addEventListener('input', updateDiskon);
document.getElementById('sldDiskon').addEventListener('input', updateDiskon);
document.getElementById('txtDiskon').addEventListener('input', function(){ document.getElementById('sldDiskon').value = this.value; updateDiskon(); });
setTimeout(updateDiskon, 50);
</script>
@endsection


