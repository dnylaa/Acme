@extends('layouts.frontend.master')

@section('title', $product->title . ' - Detail Produk')

@section('productActive')
    active
@endsection

@section('content')
    <section class="container-xl mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home.product.index') }}" class="text-decoration-none text-pink">Daftar Produk</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($product->title, 50) }}</li>
            </ol>
        </nav>
    </section>

    <section class="container-xl my-4">
        {{-- Alert sukses / error --}}
        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ Session::get('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row gx-4">
            {{-- Konten utama --}}
            <div class="col-lg-9 mb-3">
                <div class="card card-body shadow-sm border-0 p-4 mb-4">
                    <div class="row gx-5">
                        {{-- Gambar --}}
                        <div class="col-lg-4 text-center py-3">
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}"
                                    class="img-fluid rounded shadow-sm" style="max-height: 300px; object-fit: contain;">
                            @else
                                <div class="d-flex align-items-center justify-content-center bg-light text-muted rounded"
                                    style="height: 300px;">No Image</div>
                            @endif
                        </div>

                        {{-- Detail --}}
                        <div class="col-lg-8">
                            <h1 class="h3 fw-bold mb-2">{{ $product->title }}</h1>
                            <p class="text-muted small mb-3">SKU: {{ $product->sku ?? 'N/A' }} | Dilihat: XX</p>

                            @php
                                // Normalisasi discount (kalau ada yg nyimpen "5" artinya 5%, ubah jadi 0.05)
                                $discount = $product->discount > 1 ? $product->discount / 100 : $product->discount;

                                $discountAmount = $product->price * $discount;
                                $finalPrice = $product->price - $discountAmount;
                            @endphp


                            @if ($product->discount > 0)
                                <div class="d-flex align-items-center mb-1">
                                    <span class="badge bg-danger fs-6 me-2">{{ $discount * 100 }}% OFF</span>
                                    <s class="text-muted fs-6">Rp{{ number_format($product->price, 0, ',', '.') }}</s>
                                </div>
                            @endif
                            <h2 class="text-pink fw-bold display-5 mb-3">
                                Rp{{ number_format($finalPrice, 0, ',', '.') }}
                            </h2>

                            {{-- Deskripsi --}}
                            <div class="mb-3">
                                <p class="fw-semibold mb-1">Deskripsi Produk:</p>
                                <div class="text-break">
                                    {!! $product->description !!}
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <p class="fw-semibold mb-1">Stok:</p>
                                    <span
                                        class="badge {{ $product->stock > 0 ? 'bg-info' : 'bg-danger' }} fs-6">{{ $product->stock > 0 ? $product->stock . ' Tersedia' : 'Stok Habis' }}</span>
                                </div>
                                <div class="col-md-6">
                                    <p class="fw-semibold mb-1">Jenis Produk:</p>
                                    <span
                                        class="badge bg-warning fs-6">{{ $product->productType->name ?? 'Tidak Ada' }}</span>
                                </div>
                            </div>

                            <hr>

                            <!-- Tabs -->
                            <ul class="nav nav-tabs mb-3" id="productTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="desc-tab" data-bs-toggle="tab"
                                        data-bs-target="#desc" type="button" role="tab">
                                        Description
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="how-tab" data-bs-toggle="tab" data-bs-target="#how"
                                        type="button" role="tab">
                                        How To Use
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="ing-tab" data-bs-toggle="tab" data-bs-target="#ing"
                                        type="button" role="tab">
                                        Ingredients
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content mb-4" id="productTabContent">
                                <div class="tab-pane fade show active" id="desc" role="tabpanel">
                                    {!! $product->content !!}
                                </div>
                                <div class="tab-pane fade" id="how" role="tabpanel">
                                    {!! $product->how_to_use ?? '<p class="text-muted">No usage instructions available.</p>' !!}
                                </div>
                                <div class="tab-pane fade" id="ing" role="tabpanel">
                                    {!! $product->ingredients ?? '<p class="text-muted">No ingredient information available.</p>' !!}
                                </div>
                            </div>

                            <!-- User Reviews -->
                            <div class="mt-4">
                                <h5 class="fw-bold mb-3">User Reviews</h5>
                                @auth
                                    <div class="mb-4 p-3 border rounded shadow-sm bg-light">
                                        <form action="{{ route('testimonials.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <div class="mb-2">
                                                <label class="form-label">Bagikan reviewmu</label>
                                                <textarea name="message" class="form-control" rows="3" required></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="rating" class="form-label">Rating</label>
                                                <select name="rating" id="rating" class="form-control" style="color:rgb(239, 92, 114); font-size:1.5rem;" required>
                                                    <option value="5">★★★★★</option>
                                                    <option value="4">★★★★</option>
                                                    <option value="3">★★★</option>
                                                    <option value="2">★★</option>
                                                    <option value="1">★</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-pink">Add Review</button>
                                        </form>
                                    </div>
                                @else
                                    <div class="alert alert-light border">
                                        <small>
                                            Login / Register untuk memberikan review yang lebih relevan.
                                            <a href="{{ route('login') }}" class="text-pink fw-bold">Login sekarang</a>
                                        </small>
                                    </div>
                                @endauth

                                <div class="row">
    @forelse($product->testimonials()->latest()->get() as $t)
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        {{-- Avatar --}}
                        @if ($t->user && $t->user->image)
                            <img src="{{ asset('storage/' . $t->user->image) }}"
                                class="rounded-circle me-2" style="width:40px; height:40px; object-fit:cover;"
                                alt="{{ $t->name }}">
                        @else
                            @php
                                $initial = strtoupper(substr($t->name, 0, 1));
                                $colors = ['#F44336','#E91E63','#9C27B0','#3F51B5','#2196F3','#009688','#4CAF50','#FF9800','#795548','#607D8B'];
                                $color = $colors[crc32($t->name) % count($colors)];
                            @endphp
                            <div class="rounded-circle d-flex align-items-center justify-content-center me-2"
                                style="width:40px; height:40px; background-color:{{ $color }}; color:white; font-weight:bold; font-size:16px;">
                                {{ $initial }}
                            </div>
                        @endif

                        <div class="flex-grow-1">
                            <strong>{{ $t->name }}</strong>
                            <br>
                            <small class="text-muted">{{ $t->created_at->diffForHumans() }}</small>
                        </div>

                        {{-- Edit & Delete only for owner or admin --}}
                        @if(auth()->id() === $t->user_id || auth()->user()?->is_admin)
                            <div class="d-flex gap-1 ms-2">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#editReviewModal{{ $t->id }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('testimonials.destroy', $t->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus testimoni ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        @endif
                    </div>

                    {{-- Rating --}}
                    <div class="mb-2">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $t->rating)
                                <span style="color:rgb(239, 92, 114); font-size:1.5rem;">★</span> {{-- pink --}}
                            @else
                                <span style="color:#ffffff; -webkit-text-stroke: 0.5px rgb(239, 92, 114); font-size:1.5rem;">☆</span> {{-- abu-abu --}}
                            @endif
                        @endfor
                    </div>


                    <p class="mb-2">{{ $t->message }}</p>

                    @if($t->photo)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $t->photo) }}" class="img-fluid rounded shadow-sm" style="max-height:200px;">
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Modal Edit Review -->
        <div class="modal fade" id="editReviewModal{{ $t->id }}" tabindex="-1" aria-labelledby="editReviewLabel{{ $t->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('testimonials.update', $t->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="editReviewLabel{{ $t->id }}">Edit Review</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Pesan</label>
                                <textarea name="message" class="form-control" rows="3" required>{{ $t->message }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Rating</label>
                                <select name="rating" class="form-control" required>
                                    @for($i=5; $i>=1; $i--)
                                        <option value="{{ $i }}" {{ $t->rating == $i ? 'selected' : '' }}>
                                            {{ str_repeat('⭐', $i) }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Foto (opsional)</label>
                                <input type="file" name="photo" class="form-control">
                                @if($t->photo)
                                    <img src="{{ asset('storage/' . $t->photo) }}" class="img-fluid mt-2" style="max-height:150px;">
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-pink">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    @empty
        <p class="text-muted">Belum ada review untuk produk ini.</p>
    @endforelse
</div>


                                {{-- Tombol aksi --}}
                                <div class="d-flex gap-2">
                                    <form action="{{ route('cart.add', $product->slug) }}" method="POST" class="flex-grow-1">
                                        @csrf
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn btn-pink py-3 w-100"
                                            @if ($product->stock == 0) disabled @endif>
                                            <i class="bi bi-cart-plus me-2"></i>
                                            {{ $product->stock == 0 ? 'Stok Habis' : 'Tambahkan ke Keranjang' }}
                                        </button>
                                    </form>
                                    <a href="{{ route('checkout.index') }}"
                                        class="btn btn-outline-pink flex-grow-1 py-3">
                                        <i class="bi bi-bag-heart me-2"></i> Beli Sekarang
                                    </a>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sidebar produk terkait --}}
                <div class="col-lg-3 mb-3">
                    <div class="card shadow-sm border-0 p-3">
                        <h5 class="fw-bold text-pink">Produk Terkait</h5>
                        <hr class="mb-4">
                        <div class="row">
                            @forelse ($relatedProducts as $related)
                                <div class="col-12 mb-3">
                                    <a href="{{ route('home.product.show', $related->slug) }}"
                                        class="card h-100 shadow-sm border-0 text-decoration-none text-dark">
                                        @if ($related->image)
                                            <img src="{{ asset('storage/' . $related->image) }}"
                                                class="img-fluid rounded-top" alt="{{ $related->title }}"
                                                style="height: 150px; object-fit: cover;">
                                        @else
                                            <div class="d-flex align-items-center justify-content-center bg-light text-muted rounded-top"
                                                style="height: 150px;">No Image</div>
                                        @endif

                                        <div class="card-body p-3">
                                            <h6 class="card-title fw-semibold mb-1">{{ Str::limit($related->title, 40) }}
                                            </h6>
                                            @php
                                                $relatedFinalPrice = $related->price;
                                                if ($related->discount > 0) {
                                                    $relatedDiscountAmount = $related->price * $related->discount;
                                                    $relatedFinalPrice = $related->price - $relatedDiscountAmount;
                                                }
                                            @endphp
                                            @if ($related->discount > 0)
                                                <p class="card-text mb-0">
                                                    <span class="badge bg-danger me-1">{{ $related->discount * 100 }}%
                                                        OFF</span>
                                                    <s
                                                        class="text-muted small">Rp{{ number_format($related->price, 0, ',', '.') }}</s>
                                                </p>
                                                <p class="card-text text-pink fw-bold">
                                                    Rp{{ number_format($relatedFinalPrice, 0, ',', '.') }}
                                                </p>
                                            @else
                                                <p class="card-text text-pink fw-bold">
                                                    Rp{{ number_format($related->price, 0, ',', '.') }}
                                                </p>
                                            @endif
                                            <small class="text-body-secondary d-block mt-2">Stok:
                                                {{ $related->stock }}</small>
                                        </div>
                                    </a>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="alert alert-info text-center">
                                        Tidak ada produk terkait yang ditemukan.
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
    </section>

    {{-- Custom pink style --}}
    <style>
        .btn-pink {
            background-color: #f47183;
            color: #fff;
            border: none;
        }

        .btn-pink:hover {
            background-color: #e35a6f;
            color: #fff;
        }

        .btn-outline-pink {
            border: 1px solid #f47183;
            color: #f47183;
        }

        .btn-outline-pink:hover {
            background-color: #f47183;
            color: #fff;
        }

        .text-pink {
            color: #f47183 !important;
        }
    </style>
@endsection
