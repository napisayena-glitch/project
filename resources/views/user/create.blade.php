@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="mb-3">
        <a href="{{ route('user.index') }}" class="btn btn-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <h1 class="text-xl font-bold mb-4">Tambah User</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 p-2 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('user.store') }}" method="POST" class="bg-white shadow rounded p-6">
        @csrf

        <div class="mb-4">
            <label class="font-semibold">Nama</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full px-3 py-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label class="font-semibold">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="w-full px-3 py-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label class="font-semibold">No. HP</label>
            <input type="text" name="no_hp" value="{{ old('no_hp') }}" class="w-full px-3 py-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label class="font-semibold">Role</label>
            <select name="role" class="w-full px-3 py-2 border rounded" required>
                <option value="admin">Admin</option>
                <option value="pelanggan" selected>Pelanggan</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="font-semibold">Password</label>
            <input type="password" name="password" class="w-full px-3 py-2 border rounded" required>
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection
