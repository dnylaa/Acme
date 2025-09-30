<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register - Acme</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Segoe+UI&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background-color: #fff0f5;
            font-family: 'Segoe UI', sans-serif;
        }

        .register-card {
            max-width: 700px;
            border-radius: 20px;
            overflow: hidden;
            background: white;
            padding: 40px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-pink {
            background-color: #f47183;
            border: none;
            color: white;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .btn-pink:hover {
            background-color: #e35a6f;
        }

        input:focus,
        select:focus {
            border-color: #f47183;
            box-shadow: 0 0 0 0.2rem rgba(244, 113, 131, 0.25);
        }
    </style>
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="register-card w-100">
            <h3 class="text-center fw-bold mb-4">🌸 Acme Register</h3>
            <p class="text-center text-muted mb-4">Daftar untuk membuat akun baru</p>

            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
    @csrf
    <div class="row g-3">
        <!-- Kolom Kiri -->
        <div class="col-md-6">
            <div class="mb-3">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}"
                    class="form-control @error('name') is-invalid @enderror" required autofocus>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Alamat Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                    class="form-control @error('email') is-invalid @enderror" required>
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password" name="password"
                    class="form-control @error('password') is-invalid @enderror" required>
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation"
                    class="form-control" required>
            </div>
        </div>

        <!-- Kolom Kanan -->
        <div class="col-md-6">
            <div class="mb-3">
                <label for="gender" class="form-label">Jenis Kelamin</label>
                <select id="gender" name="gender"
                    class="form-select @error('gender') is-invalid @enderror" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    <option value="Lainnya" {{ old('gender') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
                @error('gender')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Nomor Telepon</label>
                <input id="phone" type="text" name="phone" value="{{ old('phone') }}"
                    class="form-control @error('phone') is-invalid @enderror" required>
                @error('phone')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="instagram" class="form-label">Username Instagram (Opsional)</label>
                <input id="instagram" type="text" name="instagram"
                    class="form-control @error('instagram') is-invalid @enderror">
                @error('instagram')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Unggah Foto Profil (Opsional)</label>
                <input id="image" type="file" name="image"
                    class="form-control @error('image') is-invalid @enderror">
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-pink w-100">Daftar</button>

    <div class="text-center mt-3">
        <small class="fw-bold">Sudah punya akun? <a href="{{ route('login') }}" style="color: #f47183;">Login</a></small>
    </div>
    <div class="text-center mt-2">
        <small><a href="/" style="color: #f47183;">&larr; Kembali ke halaman utama</a></small>
    </div>
</form>

        </div>
    </div>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
