<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reset Password - Acme</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Segoe+UI&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background-color: #fff0f5;
            font-family: 'Segoe UI', sans-serif;
        }

        .reset-card {
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

        input:focus {
            border-color: #f47183;
            box-shadow: 0 0 0 0.2rem rgba(244, 113, 131, 0.25);
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="reset-card w-100">
            <h3 class="text-center fw-bold mb-4">🌸 Reset Password</h3>
            <p class="text-center text-muted mb-4">Masukkan email dan password baru Anda</p>

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', $request->email) }}" required autofocus>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password Baru</label>
                    <input type="password" name="password" id="password"
                        class="form-control @error('password') is-invalid @enderror" required>
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="form-control" required>
                </div>

                <button type="submit" class="btn btn-pink w-100">Reset Password</button>

                <div class="text-center mt-3">
                    <small><a href="{{ route('login') }}" style="color: #f47183;">Kembali ke Login</a></small>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
