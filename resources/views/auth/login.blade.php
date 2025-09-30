<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Acme</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Segoe+UI&display=swap"
        rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background-color: #fff0f5;
            font-family: 'Segoe UI', sans-serif;
        }

        .login-card {
            max-width: 900px;
            border-radius: 20px;
            overflow: hidden;
        }

        .login-form {
            padding: 50px;
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

        .illustration {
            background-color: #ffe4ed;
            height: 100%;
            padding: 0;
        }

        .illustration img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 0;
        }


        @media (max-width: 767px) {
            .illustration {
                display: none;
            }
        }
    </style>
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row login-card bg-white w-100">

            <!-- Form Login (KIRI) -->
            <div class="col-md-6 login-form">
                <h3 class="text-center fw-bold mb-4">🌸 Acme Login</h3>
                <form action="{{ route('login') }}" method="POST" autocomplete="off" novalidate>
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email atau Username</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" placeholder="Masukkan email atau username" required
                            value="{{ old('email') }}">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Kata Sandi</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            id="password" name="password" placeholder="Masukkan kata sandi" required>
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-pink w-100 mt-3">Login</button>

                    <div class="text-center mt-4">
    <a href="/" class="back-icon d-inline-flex justify-content-center align-items-center"
       style="width:40px; height:40px; background:#ffe3ec; color:#ff69b4; border-radius:8px; font-size:1.5rem; text-decoration:none; align-items:center; justify-content:center;">
        <i class="fa-solid fa-less-than"></i>
    </a>
</div>




                    <div class="text-center mt-3">
    <a href="{{ route('password.request') }}" style="color: #f47183;">Lupa Password?</a>
</div>

                </form>

            </div>

            <!-- Gambar Kanan -->
            <div class="col-md-6 d-flex justify-content-center align-items-center illustration">
                <img src="{{ asset('assets/img/Gambar Login.jpg') }}" alt="Beauty Image" class="img-fluid rounded">
            </div>

        </div>
    </div>


    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    
</body>

</html>
