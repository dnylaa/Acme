<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lupa Password - Acme</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Segoe+UI&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background-color: #fff0f5;
            font-family: 'Segoe UI', sans-serif;
        }

        .forgot-card {
            max-width: 500px;
            border-radius: 20px;
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
        <div class="forgot-card w-100">
            <h3 class="text-center fw-bold mb-4">🔑 Lupa Password</h3>
            <p class="text-center text-muted mb-4">Masukkan email kamu, kami akan mengirim link reset password.</p>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                        class="form-control @error('email') is-invalid @enderror" required autofocus>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-pink w-100">Kirim Link Reset Password</button>

                <div class="text-center mt-3">
                    <small><a href="{{ route('login') }}" style="color: #f47183;">&larr; Kembali ke login</a></small>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
