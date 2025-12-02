@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="mb-3">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-bold">Daftar User</h1>
        <a href="{{ route('user.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Tambah User</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white shadow rounded">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. HP</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($users as $u)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $u->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $u->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $u->no_hp ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $u->role ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <a href="{{ route('user.edit', $u->id) }}" class="text-blue-600 mr-2">Edit</a>
                            <form action="{{ route('user.destroy', $u->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus user ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @extends('layouts.app')

                @section('title','Kelola User')

                @section('content')
                <div class="container">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="mb-0">Kelola User</h4>
                        <a href="{{ route('user.create') }}" class="btn btn-primary">Tambah User</a>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="row g-3">
                        @foreach($users as $u)
                            <div class="col-md-4">
                                <div class="card shadow-sm">
                                    <div class="card-body d-flex justify-content-between align-items-start gap-3">
                                        <div>
                                            <h5 class="card-title mb-1">{{ $u->name }}</h5>
                                            <p class="mb-1 text-muted">{{ $u->email }}</p>
                                            <p class="mb-0 small">No HP: {{ $u->no_hp ?? '-' }}</p>
                                            <p class="mb-0 small">Role: <strong>{{ $u->role }}</strong></p>
                                        </div>
                                        <div class="text-end">
                                            <a href="{{ route('user.edit',$u->id) }}" class="btn btn-sm btn-outline-warning mb-2">Edit</a>
                                            <form action="{{ route('user.destroy',$u->id) }}" method="POST" onsubmit="return confirm('Hapus user?')">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-3">
                        {{ $users->links() }}
                    </div>
                </div>
                @endsection
