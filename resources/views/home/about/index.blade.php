@extends('layouts.frontend.master')

@section('aboutActive')
    active
@endsection

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Beauty Trends</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #fff;
    }

    .hero-section {
      padding: 80px 0;
    }

    .hero-text h1 {
       font-family: 'Playfair Display', serif;
       font-weight: 700;
       font-size: 3rem;
       line-height: 1.2;
    }

    .brand-logos img {
      height: 80px;
      margin-right: 50px;
    }

    .btn-pink {
      background-color: #f47183;
      border: none;
    }

    .btn-pink:hover {
      background-color: #e35a6f;
    }

    .navbar-brand span {
      color: #f47183;
      font-weight: bold;
    }

    .navbar-nav .nav-link {
      margin: 0 25px;
    }

  </style>
</head>
<body>

  <!-- Tentang Kami -->
<section style="padding: 80px 0;">
  <div class="container">
    <div class="row align-items-center">
      
      <!-- Teks -->
      <div class="col-md-6"> 
        <h2 class="fw-bold mb-4 animate__animated animate__fadeInUp animate__delays-1">Tentang Acme</h2>
        <hr style="background-color: #000000">
        <p class="text-muted animate__animated animate__fadeInUp animate__delays-3" style="font-size: 1.1rem; ">
          Acme adalah brand skincare yang berdedikasi untuk menghadirkan kecantikan alami melalui kombinasi bahan-bahan alami dan teknologi sains terkini. Kami percaya bahwa kulit yang sehat berawal dari perawatan yang lembut dan berkualitas tinggi.
        </p>
        <p class="text-muted animate__animated animate__fadeInUp animate__delays-4" style="font-size: 1.1rem;">
          Setiap produk kami dirancang untuk merawat dan memperbaiki tanpa mengorbankan kesehatan kulitmu. Dengan bahan seperti <strong>matcha, horsetail, dan cacao</strong>, kami menciptakan solusi yang efektif dan tetap ramah kulit.
        </p>
        <a href="{{ route('home.product.index') }}" class="btn btn-pink mt-4 px-4 py-2 animate__animated animate__fadeInUp animate__delays-5" style="color: white;">Lihat Produk</a>
      </div>

      <!-- Gambar -->
      <div class="col-md-6 text-center">
        <img src="{{ asset('assets/img/2.jpg') }}" alt="Tentang Acme" class="img-fluid rounded animate__animated animate__fadeInUp animate__delays-6 my-5" style="max-height: 400px;">
      </div>
    </div>
  </div>
</section>
 
</body>
</html>

@endsection