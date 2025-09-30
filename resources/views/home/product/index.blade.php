@extends ('layouts.frontend.master')

@section('productActive')
    active
@endsection

@section('content')
    <div class="container my-5">

        <!-- Banner -->
        <div class="text-center mb-5">
            <div class="p-4 rounded shadow-sm bg-light">
                <div class="ratio ratio-21x9 banner-wrapper">
                    <img src="{{ asset('assets/img/banner 1.png') }}" alt="Acme Product Banner" class="rounded-3 banner-img">
                </div>
            </div>
        </div>





        <!-- Search & Filter -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
            <!-- Search -->
            <div class="input-group w-100 w-md-50 mb-3 mb-md-0">
                <input type="text" class="form-control" placeholder="Cari produk...">
                <button class="btn btn-pink">Search</button>
            </div>

            <!-- Sort -->
            <div class="dropdown px-3">
                <button class="btn btn-light border dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    Urutkan
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Terbaru</a></li>
                    <li><a class="dropdown-item" href="#">Terlaris</a></li>
                    <li><a class="dropdown-item" href="#">Harga Rendah - Tinggi</a></li>
                    <li><a class="dropdown-item" href="#">Harga Tinggi - Rendah</a></li>
                    <li><a class="dropdown-item" href="#">Rating</a></li>
                </ul>
            </div>
        </div> 

        <!-- Filter Category -->
        <div class="d-flex justify-content-center mb-4 flex-wrap">
    <a href="{{ route('home.product.index') }}" 
       class="btn filter-btn mx-2 mb-2 {{ request('filter') == '' ? 'active' : '' }}">All</a>

    <a href="{{ route('home.product.index', ['filter' => 'terbaru']) }}" 
       class="btn filter-btn mx-2 mb-2 {{ request('filter') == 'terbaru' ? 'active' : '' }}">Terbaru</a>

    <a href="{{ route('home.product.index', ['filter' => 'terlaris']) }}" 
       class="btn filter-btn mx-2 mb-2 {{ request('filter') == 'terlaris' ? 'active' : '' }}">Terlaris</a>

    <a href="{{ route('home.product.index', ['filter' => 'diskon']) }}" 
       class="btn filter-btn mx-2 mb-2 {{ request('filter') == 'diskon' ? 'active' : '' }}">Diskon</a>

    <a href="{{ route('home.product.index', ['filter' => 'harga_desc']) }}" 
       class="btn filter-btn mx-2 mb-2 {{ request('filter') == 'harga_desc' ? 'active' : '' }}">Harga: Tinggi - Rendah</a>

    <a href="{{ route('home.product.index', ['filter' => 'harga_asc']) }}" 
       class="btn filter-btn mx-2 mb-2 {{ request('filter') == 'harga_asc' ? 'active' : '' }}">Harga: Rendah - Tinggi</a>

    <a href="{{ route('home.product.index', ['filter' => 'az']) }}" 
       class="btn filter-btn mx-2 mb-2 {{ request('filter') == 'az' ? 'active' : '' }}">A-Z</a>
</div>


        <!-- Produk & Sidebar -->
        <section id="products" class="py-5">
            <div class="container">
                <div class="row g-4">

                    <!-- Sidebar kiri -->
                    <div class="col-md-3">
                        @include('home.product.sidebar')
                    </div>

                    <!-- Produk kanan -->
                    <div class="col-md-9">
                        <div class="row g-4">
                            @forelse($products as $product)
                                <div class="col-md-4 col-sm-6">
                                    <div class="card h-100 product-card position-relative">

                                        {{-- Badge Diskon --}}
                                        @php
              $discount = $product->discount > 1 ? $product->discount / 100 : $product->discount;  
            @endphp
                                        @if ($product->discount > 0)
                                            <span class="badge bg-danger position-absolute top-0 end-5 m-2 shadow">
                                                -{{ $discount * 100 }}% OFF
                                            </span>
                                        @endif


                                        {{-- Gambar Produk --}}
                                        @if ($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}"
                                                class="card-img-top">
                                        @else
                                            <img src="{{ asset('assets/img/no-image.png') }}" alt="No Image"
                                                class="card-img-top">
                                        @endif

                                        {{-- Body Produk --}}
                                        <div class="card-body">
                                            <h6 class="card-title fw-bold">{{ $product->title }}</h6>

                                            {{-- Harga Produk --}}
@if ($product->discount > 0)
    <p class="fw-bold mb-2" style="color:#e85a70;">
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
    $count  = $product->testimonialsCount();
@endphp

@if ($count > 0)
    <p class="mb-2 small">
        {{-- Bintang rating --}}
        @for($i = 1; $i <= 5; $i++)
            @if($i <= round($rating))
                {{-- Bintang penuh pink --}}
                <span style="color:#ff69b4; font-size:1rem;">★</span>
            @else
                {{-- Bintang kosong abu-abu dengan outline pink --}}
                <span style="color:#ffffff; -webkit-text-stroke: 0.8px #ff69b4; font-size:1rem;">★</span>
            @endif
        @endfor

        {{-- Angka rating & jumlah testimonial --}}
        <span class="text-muted ms-1">({{ $rating }} / {{ number_format($count) }})</span>
    </p>
@else
    <p class="mb-2 small">
        {{-- Bintang kosong --}}
        @for($i = 1; $i <= 5; $i++)
            <span style="color:#ffffff; -webkit-text-stroke: 0.8px #ff69b4; font-size:1rem;">★</span>
        @endfor
        <span class="text-muted ms-1">({{ $rating }} / {{ number_format($count) }})</span>
    </p>
@endif





                                            <!-- Tombol Detail Produk-->
                                            <a href="{{ route('home.product.show', $product->id) }}"
                                                class="btn btn-pink rounded-pill px-4 py-2 w-100">
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

                </div>
            </div>
        </section>


        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-5">
            <nav>
                <ul class="pagination" style="">
                    <li class="page-item disabled"><a class="page-link">&laquo;</a></li>
                    <li class="page-item active"><a class="page-link" href="#" style="background-color: #f47183;">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                </ul>
            </nav>
        </div>
    </div>

    <style>
        /* Button pink */
        .btn-pink {
            background-color: #f47183;
            color: #fff;
            border: none;
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-pink:hover {
            background-color: #e35a6f;
        }

        /* Banner panjang ke samping */
        .banner-wrapper {
            max-width: 1200px;
            /* biar ga full width banget */
            margin: 0 auto;
            /* center */
        }

        .banner-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* isi penuh area, lebih modern */
            border-radius: 20px;
        }

        /* Filter button */
        .filter-btn {
            border: 1px solid #ddd;
            border-radius: 20px;
            padding: 6px 18px;
            font-size: 14px;
            background: #fff;
            transition: all 0.3s ease;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background-color: #f47183;
            color: #fff;
            border-color: #f47183;
        }

        /* Card produk */
        .product-card {
            border-radius: 16px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .product-card img {
            object-fit: cover;
            height: 230px;
        }
    </style>
@endsection
