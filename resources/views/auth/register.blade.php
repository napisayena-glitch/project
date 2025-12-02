<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .role-selector {
            display: flex;
            gap: 20px;
            margin: 20px 0;
            justify-content: center;
        }
        .role-card {
            flex: 1;
            max-width: 200px;
            padding: 20px;
            border: 2px solid #ddd;
            border-radius: 10px;
            cursor: pointer;
            text-align: center;
            transition: all 0.3s;
        }
        .role-card:hover {
            border-color: #007bff;
            background-color: #f0f8ff;
        }
        .role-card.selected {
            border-color: #007bff;
            background-color: #007bff;
            color: white;
        }
        .role-card input[type="radio"] {
            display: none;
        }
        .role-icon {
            font-size: 40px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body class="bg-light d-flex align-items-center" style="height: 100vh;">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4 shadow-lg">
                <h3 class="text-center mb-4">Register</h3>

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ url('/register') }}" method="POST">
                    @csrf

                    <!-- Pilih Role -->
                    <div class="mb-4">
                        <label class="form-label fw-bold mb-3">Daftar Sebagai:</label>
                        <div class="role-selector">
                            <label class="role-card" id="admin-card">
                                <input type="radio" name="role" value="admin" {{ old('role') == 'admin' ? 'checked' : '' }}>
                                <div class="role-icon">👨‍💼</div>
                                <div><strong>Admin</strong></div>
                            </label>
                            <label class="role-card" id="pelanggan-card">
                                <input type="radio" name="role" value="pelanggan" {{ old('role') == 'pelanggan' ? 'checked' : '' }}>
                                <div class="role-icon">👤</div>
                                <div><strong>Customer</strong></div>
                            </label>
                        </div>
                        @error('role')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan nama lengkap" required>
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan email" required>
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">No. HP</label>
                        <input type="text" name="no_hp" value="{{ old('no_hp') }}"
                               class="form-control @error('no_hp') is-invalid @enderror" placeholder="Contoh: 081234567890" required>
                        @error('no_hp')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password"
                               class="form-control @error('password') is-invalid @enderror" placeholder="Minimal 6 karakter" required>
                        @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation"
                               class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Ulangi password" required>
                        @error('password_confirmation')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <button class="btn btn-primary w-100 fw-bold">Register</button>
                </form>

                <p class="text-center mt-3">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-decoration-none fw-bold">Login</a>
                </p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Update visual selection saat role dipilih
    document.addEventListener('DOMContentLoaded', function() {
        const adminCard = document.getElementById('admin-card');
        const pelangganCard = document.getElementById('pelanggan-card');
        const adminRadio = document.querySelector('input[value="admin"]');
        const pelangganRadio = document.querySelector('input[value="pelanggan"]');

        function updateSelection() {
            if (adminRadio.checked) {
                adminCard.classList.add('selected');
                pelangganCard.classList.remove('selected');
            } else if (pelangganRadio.checked) {
                pelangganCard.classList.add('selected');
                adminCard.classList.remove('selected');
            }
        }

        adminRadio.addEventListener('change', updateSelection);
        pelangganRadio.addEventListener('change', updateSelection);

        // Update pada saat halaman dimuat
        updateSelection();
    });
</script>
</body>
</html>