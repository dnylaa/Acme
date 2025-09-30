@extends('layouts.frontend.master')

@section('homeActive')
    active
@endsection

@section('content')

    <!-- Hero Section -->
    <section class="vh-100 d-flex align-items-center "
        style="position:relative; overflow:hidden; background: linear-gradient(135deg, #ffe3ec 0%, #fff0f5 100%);">

        <!-- Decorative Bubbles & Sparkles -->
        <div style="position:absolute; top:0; left:0; width:100%; height:100%; pointer-events:none; overflow:hidden;">
            <!-- Bubbles -->
            <div class="bubble"
                style="width:70px; height:70px; background:rgba(255,77,148,0.15); border-radius:50%; position:absolute; top:15%; left:15%; animation: floatBubble 11s infinite ease-in-out;">
            </div>
            <div class="bubble"
                style="width:50px; height:50px; background:rgba(186,85,211,0.12); border-radius:50%; position:absolute; top:60%; left:75%; animation: floatBubble 13s infinite ease-in-out;">
            </div>
            <div class="bubble"
                style="width:60px; height:60px; background:rgba(255,105,180,0.14); border-radius:50%; position:absolute; top:40%; left:50%; animation: floatBubble 15s infinite ease-in-out;">
            </div>
            <!-- Sparkles -->
            <div class="sparkle"
                style="width:5px; height:5px; background:white; border-radius:50%; position:absolute; top:25%; left:30%; opacity:0.8; box-shadow:0 0 12px white; animation: twinkle 2s infinite alternate;">
            </div>
            <div class="sparkle"
                style="width:4px; height:4px; background:white; border-radius:50%; position:absolute; top:55%; left:70%; opacity:0.7; box-shadow:0 0 10px white; animation: twinkle 2.5s infinite alternate;">
            </div>
            <div class="sparkle"
                style="width:6px; height:6px; background:white; border-radius:50%; position:absolute; top:45%; left:50%; opacity:0.9; box-shadow:0 0 14px white; animation: twinkle 3s infinite alternate;">
            </div>
        </div>

        <div class="container">
            <div class="row align-items-center">

                <!-- Left Text -->
                <div class="col-md-6 text-center text-md-start">
                    <h1 class="display-2 fw-bold hero-text" style="color:#ff4d94; line-height:1.2;">Cerah & Sehat Bersama
                        Acme</h1>
                    <p class="mt-4 fs-5 text-muted hero-text">Rasakan kombinasi bahan alami & teknologi canggih untuk kulit
                        yang selalu bersinar.</p>
                    <a href="{{ route('home.product.index') }}" class="btn btn-gradient-pink-purple mt-4">Lihat Produk</a>
                </div>

                <!-- Right Image -->
                <div class="col-md-6 text-center" style="position:relative;">
                    <div class="image-wrapper"
                        style="display:inline-block; animation: floatImage 4s ease-in-out infinite alternate;">
                        <img src="{{ asset('assets/img/model 3.jpg') }}" alt="Acme Model" class="img-fluid"
                            style="max-height:420px; border-radius:30px; box-shadow:0 25px 80px rgba(255,77,148,0.45);">
                        <!-- Glow Halo -->
                        <div
                            style="position:absolute; top:-40px; left:-40px; width:100%; height:100%; border-radius:50%; box-shadow:0 0 140px rgba(186,85,211,0.3); pointer-events:none;">
                        </div>
                        <!-- Reflection -->
                        <div
                            style="position:absolute; bottom:-10px; left:10%; width:80%; height:25px; background:rgba(255,255,255,0.15); border-radius:50%; filter: blur(25px); transform:rotateX(180deg); pointer-events:none;">
                        </div>
                        <!-- Halo Blur -->
                        <div
                            style="position:absolute; top:-50px; left:-50px; width:120%; height:120%; border-radius:50%; background:rgba(255,77,148,0.05); filter: blur(50px); pointer-events:none;">
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </section>

    <!-- Apa itu Acme -->
    <section class="py-5"
        style="background: linear-gradient(135deg, #fce4ec 0%, #f3e5f5 100%); position:relative; overflow:hidden;">
        <div class="container">
            <div class="row align-items-center">

                <!-- Left Image -->
                <div class="col-md-5 mb-4 mb-md-0 text-center position-relative">
                    <div
                        style="display:inline-block; position:relative; animation: floatImage 6s ease-in-out infinite alternate;">
                        <img src="{{ asset('assets/img/1.jpg') }}" class="img-fluid rounded-4 shadow-lg" alt="Tentang Acme"
                            style="max-height: 320px; border-radius:20px; position:relative; z-index:2;">
                        <!-- Soft Glow -->
                        <div
                            style="position:absolute; top:50%; left:50%; transform:translate(-50%,-50%); width:110%; height:110%; background:radial-gradient(circle, rgba(186,85,211,0.15) 0%, rgba(255,192,203,0.1) 70%, transparent 100%); filter:blur(40px); border-radius:20px; z-index:1;">
                        </div>
                    </div>
                </div>

                <!-- Right Text -->
                <div class="col-md-7 fadeInUp">
                    <h2 class="fw-bold mb-3" style="position:relative; display:inline-block;">
                        Apa Itu Acme?
                        <span
                            style="display:block; height:4px; width:50px; background:linear-gradient(90deg, #ff4d94, #b19cd9); margin-top:8px; border-radius:2px;"></span>
                    </h2>
                    <p class="text-muted fs-5 lh-lg">
                        Acme adalah brand skincare yang menggabungkan <strong>bahan alami premium</strong> dengan
                        <strong>teknologi terkini</strong> untuk memberikan hasil yang nyata dan aman.
                        Bukan sekadar tren, kami memahami bahwa setiap kulit punya kebutuhan unik.
                        Dari perawatan harian hingga solusi khusus, setiap produk kami dirancang untuk <em>memberikan
                            nutrisi, perlindungan, dan hasil yang tahan lama</em>.
                    </p>
                    <a href="{{ route('home.about.index') }}"
                        class="btn btn-gradient-pink-purple mt-3 px-4 py-2 rounded-pill">Pelajari Lebih Lanjut</a>
                </div>

            </div>
        </div>

    </section>


    <!-- Kenapa Harus Pakai Acme -->
    <section class="py-5 why-acme-section text-white">
        <div class="container">
            <h2 class="text-center fw-bold mb-5 section-title">Kenapa Harus Pilih Acme?</h2>
            <div class="row text-center">

                <!-- Card 1 -->
                <div class="col-md-4 mb-4">
                    <div class="why-card h-100">
                        <img src="{{ asset('assets/img/Download_premium_png_of_PNG_Young_female_scientist_working_in_lab__collage_element__transparent_background_by_audi_about_lab_technician__chemistry_laboratory_hand_drawn__chemistry_lab_illustration__sc.png') }}"
                            alt="Diformulasikan oleh Ahli" class="feature-icon mb-3">
                        <h5 class="fw-bold">Diformulasikan oleh Ahli</h5>
                        <p>Kami bekerja sama dengan apoteker & dermatologist berpengalaman untuk menciptakan produk yang
                            aman, efektif, dan terpercaya.</p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-md-4 mb-4">
                    <div class="why-card h-100">
                        <img src="{{ asset('assets/img/download (26).jpg') }}" alt="100% Vegan & Cruelty-Free"
                            class="feature-icon mb-3">
                        <h5 class="fw-bold">Bahan Premium & Aman</h5>
                        <p>Hanya menggunakan bahan alami dan teknologi terkini yang telah melalui uji klinis, bebas dari
                            bahan berbahaya.</p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-md-4 mb-4">
                    <div class="why-card h-100">
                        <img src="{{ asset('assets/img/Young pretty girl.jpg') }}" alt="Aman untuk Semua Jenis Kulit"
                            class="feature-icon mb-3">
                        <h5 class="fw-bold">Cocok untuk Semua Jenis Kulit</h5>
                        <p>Teruji cocok untuk kulit sensitif sekalipun, memberikan hasil maksimal tanpa iritasi.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <section class="py-5">
        <div class="container"> {{-- Tambahkan container untuk mengatur lebar keseluruhan --}}
            <h3 class="mb-4 fw-bold text-center">Artikel Terbaru</h3>
            <hr class="my-1">
            <br>
            <div class="row justify-content-center"> {{-- Tambahkan justify-content-center agar konten dalam row berada di tengah --}}
                <div class="col-lg-9"> {{-- Ini kolom utama, sudah cukup bagus --}}
                    <div class="row">
                        @forelse ($articles as $key => $val)
                            @if ($key == 0 && !empty($articles) && count($articles) > 0)
                                @continue
                            @endif
                            <div class="col-md-4 my-3 ">
                                <div class="card shadow-sm border-0 h-100 mb-3">
                                    @if ($val->image)
                                        <div class="ratio ratio-16x9">
                                            <img class="card-img-top" src="{{ asset('storage/' . $val->image) }}"
                                                alt="Gambar Artikel: {{ $val->title }}">
                                        </div>
                                    @else
                                        <div class="card-img-top d-flex align-items-center justify-content-center text-white-50 ratio ratio-16x9"
                                            style="background: linear-gradient(rgba(177,156,217,0.6), rgba(255,77,148,0.6)), url('file://wsl.localhost/Ubuntu-22.04/home/dania/my_project/acme/public/assets/img/Hero%20Skincare%20Bg.jpg') center/cover no-repeat;">
                                            Acme Image
                                        </div>
                                    @endif
                                    <div class="card-body small d-flex flex-column">
                                        <h5 class="card-title"><small>{{ $val->title }}</small></h5>
                                        <p class="card-text flex-grow-1">
                                            <small>{{ Str::limit(strip_tags($val->meta_desc), 120) }}</small>
                                        </p>
                                        <a href="{{ route('home.articles.show', $val->slug) }}"
                                            class="btn btn-sm btn-primary mt-1 rounded-pill">Baca Artikel</a>
                                    </div>
                                    <div class="card-footer text-center">
                                        <small class="text-muted">Diperbaharui:
                                            {{ $val->updated_at->format('d M Y') }}</small>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-info text-center" role="alert">
                                    Belum ada artikel yang tersedia.
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>

        </div>
    </section>

    {{-- Stats Section --}}
    @php
        use App\Models\Product;
        use App\Models\User;
        use App\Models\OrderItem;
        $productCount = Product::count();
        $customerCount = User::count();
        $soldCount = OrderItem::sum('quantity');
    @endphp
    <section class="stats-section" id="statsSection">
        <div class="container text-center">
            <h3 class="fw-bold mb-2">Dirancang dengan Cermat, Dipercaya Banyak Orang</h3>
            <p class="mb-5">Kesehatan dari dalam, kilau alami dari luar.</p>
            <div class="row justify-content-center">
                <div class="col-6 col-md-4">
                    <h2 class="fw-bold display-5"><span class="count-up" data-target="{{ $productCount }}">0</span>+
                    </h2>
                    <p>Produk</p>
                </div>
                <div class="col-6 col-md-4 stats-divider">
                    <h2 class="fw-bold display-5"><span class="count-up" data-target="{{ $customerCount }}">0</span>+
                    </h2>
                    <p>Pelanggan</p>
                </div>
                <div class="col-6 col-md-4">
                    <h2 class="fw-bold display-5"><span class="count-up" data-target="{{ $soldCount }}">0</span>+
                    </h2>
                    <p>Terjual</p>
                </div>
            </div>
        </div>
    </section>


    <!-- Produk Unggulan -->
    <section id="products" class="py-5">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold section-title">Produk Unggulan</h2>
            <div class="row">
                @forelse($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card product-card h-100">
                            @php
                                $discount = $product->discount > 1 ? $product->discount / 100 : $product->discount;
                            @endphp
                            @if ($product->discount > 0)
                                <span class="badge bg-danger position-absolute top-0 end-5 m-2 shadow">
                                    -{{ $discount * 100 }}% OFF
                                </span>
                            @endif
                            @if ($product->image)
                                <div class="product-img-wrapper">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}">
                                </div>
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->title }}</h5>
                                <p class="text-muted">{{ Str::limit($product->meta_desc, 80) }}</p>
                                @if ($product->discount > 0)
                                    <p class="fw-bold" style="color: #e85a70;">
                                        Rp{{ number_format($product->price - ($product->price * $product->discount) / 100, 0, ',', '.') }}
                                        <del class="text-muted small ms-2">
                                            Rp{{ number_format($product->price, 0, ',', '.') }}
                                        </del>
                                    </p>
                                @else
                                    <p class="fw-bold mb-2" style="color:#e85a70;">
                                        Rp{{ number_format($product->price, 0, ',', '.') }}
                                    </p>
                                @endif

                                @php
                                    $rating = number_format($product->averageRating() ?? 0, 1);
                                    $count = $product->testimonialsCount();
                                @endphp

                                @if ($count > 0)
                                    <p class="mb-2 small">
                                        {{-- Bintang rating --}}
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= round($rating))
                                                {{-- Bintang penuh pink --}}
                                                <span style="color:#ff69b4; font-size:1rem;">★</span>
                                            @else
                                                {{-- Bintang kosong abu-abu dengan outline pink --}}
                                                <span
                                                    style="color:#ffffff; -webkit-text-stroke: 0.8px #ff69b4; font-size:1rem;">★</span>
                                            @endif
                                        @endfor

                                        {{-- Angka rating & jumlah testimonial --}}
                                        <span class="text-muted ms-1">({{ $rating }} /
                                            {{ number_format($count) }})</span>
                                    </p>
                                @else
                                    <p class="mb-2 small">
                                        {{-- Bintang kosong --}}
                                        @for ($i = 1; $i <= 5; $i++)
                                            <span
                                                style="color:#ffffff; -webkit-text-stroke: 0.8px #ff69b4; font-size:1rem;">★</span>
                                        @endfor
                                        <span class="text-muted ms-1">({{ $rating }} /
                                            {{ number_format($count) }})</span>
                                    </p>
                                @endif
                                <a href="{{ route('home.product.show', $product->id) }}"
                                    class="btn btn-dark rounded-pill px-4 py-2 mt-2">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted text-center">Belum ada produk yang tersedia.</p>
                @endforelse
            </div>
        </div>
    </section>


    <!-- Testimonials Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-4">Testimoni Pelanggan</h2>
            <div class="row">
                @forelse($testimonials as $t)
                    <div class="col-md-4 mb-3">
                        <div class="card shadow-sm h-100">
                            <div class="card-body text-center">
                                <p class="card-text">"{{ $t->message }}"</p>
                            </div>
                            <div class="card-footer text-center text-muted">
                                <strong>{{ $t->name }}</strong><br>

                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">Belum ada testimoni.</p>
                @endforelse
            </div>
        </div>
    </section>


@endsection
{{-- Script Count-Up dengan Intersection Observer --}}
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const counters = document.querySelectorAll(".count-up");
        const statsSection = document.querySelector("#statsSection");

        let counted = false; // flag biar cuma jalan sekali

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !counted) {
                    counters.forEach(counter => {
                        const target = +counter.getAttribute("data-target");
                        let count = 0;
                        const step = target / 100;
                        const interval = setInterval(() => {
                            count += step;
                            if (count >= target) {
                                counter.textContent = target.toLocaleString();
                                clearInterval(interval);
                            } else {
                                counter.textContent = Math.ceil(count)
                                    .toLocaleString();
                            }
                        }, 20);
                    });
                    counted = true; // biar nggak jalan lagi saat scroll ke atas
                }
            });
        }, {
            threshold: 0.5
        }); // 50% section terlihat

        observer.observe(statsSection);
    });
</script>
