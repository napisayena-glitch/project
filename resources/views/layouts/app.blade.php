<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Toko Sepatu'))</title>

    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* COMMON */
        body { transition: background .3s, color .3s; }
        .card { transition: transform .25s, box-shadow .25s; border-radius:12px; }
        .card:hover { transform: translateY(-6px); box-shadow: 0 10px 30px rgba(0,0,0,0.08); }
        .produk-img { width:100%; height:220px; object-fit:cover; border-top-left-radius:12px; border-top-right-radius:12px; }

        /* THEME: minimal (default) */
        :root { --bg-color: #f8f9fa; --card-bg: #ffffff; --primary: #0d6efd; --muted: #6c757d; }
       

        body { background: var(--bg-color); color: inherit; }
        .card { background: var(--card-bg); }
        .price { color: var(--primary); font-weight:700; }
        .muted { color: var(--muted); }
        .theme-switcher .btn { margin-right:6px; }
    </style>

    @stack('styles')
</head>
<body data-theme="minimal">

<nav class="navbar navbar-expand-lg sticky-top" style="background:linear-gradient(90deg, rgba(255,255,255,0.9), rgba(255,255,255,0.6));">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">Mandiri</a>

        <div class="d-flex align-items-center">
            @unless(Request::routeIs('dashboard'))
            <div class="me-3 theme-switcher d-none d-md-block">
                <button class="btn btn-sm btn-outline-secondary" data-theme="minimal">Minimal</button>
               
            </div>
            @endunless

            @auth
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('produk.create') }}" class="btn btn-primary btn-sm me-2">Tambah Produk</a>
                    <a href="{{ route('user.index') }}" class="btn btn-warning btn-sm me-2">Kelola User</a>
                @endif
                <span class="me-3">{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-sm me-2">Login</a>
                <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Register</a>
            @endauth
        </div>
    </div>
</nav>

<div class="container py-5">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @yield('content')
</div>

<!-- Delete confirmation modal (reused) -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form method="POST" id="deleteForm">
        @csrf
        @method('DELETE')
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Konfirmasi Hapus</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">Apakah Anda yakin ingin menghapus item ini?</div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-danger">Hapus</button>
          </div>
        </div>
    </form>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Theme switcher
    document.querySelectorAll('.theme-switcher [data-theme]').forEach(btn=>{
        btn.addEventListener('click', ()=> {
            const t = btn.getAttribute('data-theme');
            document.body.setAttribute('data-theme', t === 'minimal' ? 'minimal' : t);
        });
    });

    // Delete modal: set form action dynamically
    function confirmDelete(url){
        const form = document.getElementById('deleteForm');
        form.action = url;
        const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
        modal.show();
    }

    // Prevent back button setelah login
    @auth
    if (window.history.forward(1) != null) {
        window.history.forward(1);
    }
    
    window.onload = function() {
        window.history.forward(1);
    };
    
    window.addEventListener('popstate', function(e) {
        window.history.pushState(null, null, window.location.href);
    });
    @endauth
</script>

@stack('scripts')
</body>
</html>
