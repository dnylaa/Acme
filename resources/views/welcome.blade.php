<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Acme - Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

  @vite([])

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

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="#"><span>🌸 Acme</span></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="./index.html">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="./shop.html">Shop</a></li>
        <li class="nav-item"><a class="nav-link" href="./about.html">About</a></li>
        <li class="nav-item"><a class="nav-link" href="./contact.html">Contact</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>


      </ul>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<section class="hero-section">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-7 hero-text mt-2">
        <h1>Temukanlah Tren Kecantikan<br>Terbaru Musim Ini</h1>
        <p class="text-muted mt-3" style="font-size: 1.2rem;">Kami percaya bahwa kecantikan dan kesehatan akan maksimal jika didukung oleh sains.</p>
        <button class="btn btn-pink mt-4 px-4 py-3" style="color: white; font-weight: bold;">MULAI SEKARANG</button>
        <p class="text-muted mt-5">Dipercaya oleh lebih dari 10+ perusahaan ternama</p>
        <div class="brand-logos mt-2">
          <img src="{{asset('assets/img/Dove.png')}}" alt="Dove">
          <img src="{{asset('assets/img/Nivea.png')}}" alt="Nivea">
          <img src="{{asset('assets/img/Vaseline.png')}}" alt="Vaseline">
        </div>
      </div>
      <div class="col-md-4">
        <img src="{{asset('assets/img/Untitled design (3).png')}}" class="img-fluid rounded" alt="Model Kecantikan">
      </div>
    </div>
  </div>
</section>

<!-- Ingredients Section -->
<section style="
  background-image: url(' {{asset('assets/img/Flower Bg.jpg')}} ');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  padding: 100px 0;
">
  <div class="container">
    <h2 class="text-center mb-4 text-white">Bahan Aktif Unggulan</h2>
    <p class="text-center mb-5 text-white">Setiap formula dari D'YOU dibuat dengan bahan aktif yang didukung riset klinis dan hasil nyata.</p>
    <div class="row g-4 justify-content-center">
      <div class="col-md-4">
        <div class="p-4 bg-white rounded shadow-sm h-100">
          <h5>✨ Niacinamide</h5>
          <p class="text-muted">Mencerahkan warna kulit, meratakan tekstur, dan mengecilkan pori.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="p-4 bg-white rounded shadow-sm h-100">
          <h5>🧬 Peptides Complex</h5>
          <p class="text-muted">Meningkatkan produksi kolagen dan menjaga elastisitas kulit.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="p-4 bg-white rounded shadow-sm h-100">
          <h5>🌟 AHA / BHA</h5>
          <p class="text-muted">Mengangkat sel kulit mati dan memperbaiki permukaan kulit tanpa iritasi.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Stats Section -->
<section style="background-color: #f891a9; color: white; padding: 90px 0;">
  <div class="container text-center">
    <h3 class="fw-bold mb-2">Didukung Ilmu Pengetahuan, Dibuktikan oleh Hasil</h3>
    <p class="mb-5">Kesehatan dari dalam, kilau alami dari luar.</p>
    <div class="row justify-content-center">
      <div class="col-6 col-md-4">
        <h2 class="fw-bold">30</h2>
        <p>Produk</p>
      </div>
      <div class="col-6 col-md-4 border-start border-end mb-4">
        <h2 class="fw-bold">300+</h2>
        <p>Pelanggan</p>
      </div>
      <div class="col-6 col-md-4 ">
        <h2 class="fw-bold">18</h2>
        <p>Formula Unggul</p>
      </div>
    </div>
  </div>
</section>

<!-- Call to Action Section -->
<section style="padding: 80px 0;">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6 mb-5">
        <h3 class="fw-bold">Standar Baru Kecantikan, Sesuai Versimu</h3>
        <p class="text-muted mt-3">Kami percaya bahwa produk kecantikan seharusnya memperkuat siapa dirimu — bukan menyembunyikannya.</p>
        <a href="#" class="btn btn-pink mt-4 px-4 py-2" style="color: white; font-weight: bold;">MULAI SEKARANG</a>
      </div>
      <div class="col-md-6 text-center">
        <img src="{{asset('assets/img/Exfoliating Glow Serum.jpg')}}" class="img-fluid" alt="Serum" style="max-height: 300px;">
      </div>
    </div>
  </div>
</section>

<!-- Testimonials Section -->
<section style="background-color: #e8bcf0; padding: 80px 0;">
  <div class="container text-center">
    <h3 class="fw-bold mb-5">Apa Kata Mereka Tentang D'YOU?</h3>

    <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">

      <div class="carousel-inner px-5">

        <!-- Slide 1 -->
        <div class="carousel-item active">
          <div class="row justify-content-center">
            <!-- Card 1 -->
            <div class="col-md-5 mx-2 mb-4">
              <div class="bg-white p-4 shadow rounded">
                <h5 class="fw-bold">Kulitku Jadi Glowing Banget!</h5>
                <p class="text-muted">"Serius deh, sejak pakai D’YOU aku jadi makin pede walau nggak pakai makeup. Kulitku lebih cerah, tekstur halus, dan banyak yang notice perubahan ini. Love it!"</p>
                <p class="fw-semibold mb-0">Martha S.</p>
                <small class="text-muted">Jakarta</small>
              </div>
            </div>
            <!-- Card 2 -->
            <div class="col-md-5 mx-2">
              <div class="bg-white p-4 shadow rounded">
                <h5 class="fw-bold">Beneran Ngebantu Jerawatku</h5>
                <p class="text-muted">"Awalnya skeptis, tapi ternyata cocok banget! Kulitku nggak cuma lebih bersih, tapi juga keliatan sehat. Jerawat minggat, aku makin happy!"</p>
                <p class="fw-semibold mb-0">Alley H.</p>
                <small class="text-muted">Bandung</small>
              </div>
            </div>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item">
          <div class="row justify-content-center">
            <!-- Card 3 -->
            <div class="col-md-5 mx-2 mb-4">
              <div class="bg-white p-4 shadow rounded">
                <h5 class="fw-bold">Nggak Nyangka Bakal Cocok</h5>
                <p class="text-muted">"Gue cowok, tapi penasaran sama skincare ini. Ternyata hasilnya nyata. Kulit gue jadi nggak kusam, lebih lembap, dan bebas jerawat. Gokil sih!"</p>
                <p class="fw-semibold mb-0">Rizky A.</p>
                <small class="text-muted">Surabaya</small>
              </div>
            </div>
            <!-- Card 4 -->
            <div class="col-md-5 mx-2">
              <div class="bg-white p-4 shadow rounded">
                <h5 class="fw-bold">Produk Favoritku!</h5>
                <p class="text-muted">"Dari semua skincare yang pernah aku coba, ini yang paling ngaruh! Teksturnya ringan, hasilnya nyata. Sekarang aku selalu repurchase!"</p>
                <p class="fw-semibold mb-0">Nadya P.</p>
                <small class="text-muted">Yogyakarta</small>
              </div>
            </div>
          </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item">
          <div class="row justify-content-center">
            <!-- Card 5 -->
            <div class="col-md-5 mx-2 mb-4">
              <div class="bg-white p-4 shadow rounded">
                <h5 class="fw-bold">Simple Tapi Powerful!</h5>
                <p class="text-muted">"Aku suka banget karena produknya nggak ribet, tapi hasilnya cepet kelihatan. Baru dua minggu pakai, udah keliatan glowingnya. Fix jatuh cinta!"</p>
                <p class="fw-semibold mb-0">Citra L.</p>
                <small class="text-muted">Malang</small>
              </div>
            </div>
            <!-- Card 6 -->
            <div class="col-md-5 mx-2">
              <div class="bg-white p-4 shadow rounded">
                <h5 class="fw-bold">Udah Kayak Skincare Premium</h5>
                <p class="text-muted">"Seriusan, dari packaging sampai tekstur, semuanya berasa mewah. Tapi harganya masih masuk akal. Thank you D’YOU, kalian keren!"</p>
                <p class="fw-semibold mb-0">Dewi K.</p>
                <small class="text-muted">Tangerang</small>
              </div>
            </div>
          </div>
        </div>

      </div>

      <!-- Carousel Controls -->
      <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>

      <!-- Carousel Indicators -->
      <div class="mt-4">
        <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="0" class="active rounded-circle mx-1"
          style="width: 10px; height: 10px; background-color: #000; border: none;"></button>
        <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="1" class="rounded-circle mx-1"
          style="width: 10px; height: 10px; background-color: #000; border: none;"></button>
        <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="2" class="rounded-circle mx-1"
          style="width: 10px; height: 10px; background-color: #000; border: none;"></button>
      </div>
    
  </div>
</section>


<!-- Footer -->
<footer class="py-5 mt-5 bg-light">
  <div class="container">
    <div class="row text-center text-md-start align-items-start">
      <div class="col-lg-6 mb-4">
        <h5 class="fw-bold mb-3">🌸 Acme</h5>
        <p class="text-muted">
          Acme hadir sebagai brand skincare berbasis sains yang mengutamakan transparansi, efektivitas, dan keamanan. Kami percaya bahwa perawatan kulit bukan tentang menyembunyikan kekurangan, tapi merawat dengan cerdas, memberi nutrisi, dan menghargai keunikan setiap kulit. 
        </p>
      </div>
      <div class="col-lg-2 mb-4">
        <h6 class="fw-bold mb-3">Tautan Cepat</h6>
        <ul class="list-unstyled">
          <li><a href="#" class="text-decoration-none text-muted">Home</a></li>
          <li><a href="#" class="text-decoration-none text-muted">Shop</a></li>
          <li><a href="#" class="text-decoration-none text-muted">About</a></li>
          <li><a href="#" class="text-decoration-none text-muted">Contact</a></li>
        </ul>
      </div>
      <div class="col-lg-2 mb-4">
        <h6 class="fw-bold mb-3">Info Lainnya</h6>
        <ul class="list-unstyled">
          <li><a href="#" class="text-decoration-none text-muted">Cara Kerja</a></li>
          <li><a href="#" class="text-decoration-none text-muted">Hasil Klinis</a></li>
          <li><a href="#" class="text-decoration-none text-muted">Kebijakan Privasi</a></li>
        </ul>
      </div>
      <div class="col-lg-2 mb-4">
        <h6 class="fw-bold mb-3">Bantuan</h6>
        <ul class="list-unstyled">
          <li><a href="#" class="text-decoration-none text-muted">FAQ</a></li>
          <li><a href="#" class="text-decoration-none text-muted">Syarat Penggunaan</a></li>
          <li><a href="#" class="text-decoration-none text-muted">Diskon</a></li>
        </ul>
      </div>
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

    
</body>
</html>
