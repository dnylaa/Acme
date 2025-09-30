@extends('layouts.frontend.master')

@section('title', 'Keranjang Belanja')

@section('content')
    <section class="container-xl my-5">
        <h2 class="fw-bold py-3">Keranjang Belanja Anda</h2>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('info'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                {{ session('info') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (!$cartItems->isEmpty()) {{-- Cek jika cartItems tidak kosong --}}
            <div class="row gx-4">
                <div class="col-lg-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4">
                            @foreach ($cartItems as $item)
                                {{-- Loop melalui CartItem --}}
                                @if ($item->product)
                                    {{-- Pastikan produk terkait masih ada --}}
                                    <div class="row align-items-center mb-4 pb-4 border-bottom">
                                        <div class="col-md-2">
                                            <div
                                                class="card shadow-sm border-0 h-100 d-flex flex-column text-decoration-none text-dark position-relative overflow-hidden">
                                                @if ($item->product->image)
                                                    <img src="{{ asset('storage/' . ($item->product->image ?? 'placeholder.png')) }}"
                                                        alt="{{ $item->product->title }}" class="img-fluid rounded">
                                                @else
                                                    <div class="d-flex align-items-center justify-content-center bg-primary-subtle text-muted"
                                                        style="height: 144px;">
                                                        No Image
                                                    </div>
                                                @endif
                                            </div>
                                        </div>


                                        @php
    // Normalisasi discount: kalau nilainya lebih besar dari 1, berarti disimpan dalam bentuk persen (misal 5 jadi 5%)
    $discount = $item->product->discount > 1 
        ? $item->product->discount / 100 
        : $item->product->discount;

    $discountAmount = $item->product->price * $discount;
    $finalPrice = $item->product->price - $discountAmount;
@endphp

@if ($discount > 0)
    <div class="d-flex align-items-center mb-1">
        <span class="badge bg-danger fs-6 me-2 my-3">-{{ $discount * 100 }}% OFF</span>
        <s class="text-muted fs-6">Rp{{ number_format($item->product->price, 0, ',', '.') }}</s>
    </div>
    <p class="fw-bold text-success mb-0">
        Rp{{ number_format($finalPrice, 0, ',', '.') }}
    </p>
@else
    <p class="fw-bold text-success mb-0">
        Rp{{ number_format($item->product->price, 0, ',', '.') }}
    </p>
@endif


                                        <div class="col-md-5">
                                            <h5 class="mb-1">{{ $item->product->title }}</h5>
                                            @php
                                                $itemPrice = $item->price_at_add;
                                                $finalItemPrice = $itemPrice;
                                                if ($item->discount_at_add > 0) {
                                                    $discountAmountPerUnit = $itemPrice * $item->discount_at_add;
                                                    $finalItemPrice = $itemPrice - $discountAmountPerUnit;
                                                }
                                            @endphp

                                            
                                            <small class="text-muted">Stok: {{ $item->product->stock }}</small>
                                        </div>
                                        <div class="col-md-3">
                                            <form action="{{ route('cart.update', $item->product->slug) }}" method="POST"
                                                class="d-flex align-items-center">
                                                @csrf
                                                <input type="number" name="quantity" value="{{ $item->quantity }}"
                                                    min="1" max="{{ $item->product->stock }}"
                                                    class="form-control form-control-sm text-center" style="width: 80px;">
                                                <button type="submit" class="btn btn-sm btn-outline-secondary ms-2"
                                                    @if ($item->quantity > $item->product->stock) disabled @endif>Update</button>
                                            </form>
                                        </div>
                                        <div class="col-md-2 text-end">
                                            <form action="{{ route('cart.remove', $item->product->slug) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"><i
                                                        class="bi bi-trash"></i> Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                @else
                                    {{-- Jika produk tidak ditemukan (misal sudah dihapus dari DB) --}}
                                    <div class="alert alert-warning">
                                        Produk "{{ $item->product_name ?? 'Tidak Dikenal' }}" ({{ $item->quantity }}x)
                                        tidak lagi tersedia. <form action="{{ route('cart.remove', $item->id) }}"
                                            method="POST" class="d-inline">@csrf @method('DELETE')<button type="submit"
                                                class="btn btn-link p-0 m-0 align-baseline">Hapus</button></form>
                                    </div>
                                @endif
                            @endforeach
                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <a href="{{ route('home.product.index') }}" class="btn btn-outline-primary">Lanjut
                                    Belanja</a>
                                <a href="{{ route('checkout.index') }}" class="btn btn-success">Lanjutkan ke Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                   <div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <h5 class="mb-3 fw-bold">Ringkasan Belanja</h5>
        <ul class="list-group list-group-flush mb-3">
            <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                Subtotal
                <span>Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
            </li>

            @if ($totalDiscount > 0)
                <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                    Diskon
                    <span class="text-danger">- Rp{{ number_format($totalDiscount, 0, ',', '.') }}</span>
                </li>
            @endif

            <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 fw-bold">
                Total
                <span class="fs-5 text-success">Rp{{ number_format($total, 0, ',', '.') }}</span>
            </li>
        </ul>

        <a href="{{ route('checkout.index') }}" class="btn btn-success w-100">Checkout</a>
    </div>
</div>

    
</div>

                </div>
            </div>
        @else
            <div class="alert alert-info text-center py-4" role="alert">
                Keranjang belanja Anda kosong. <br> <a href="{{ route('home.product.index') }}" class="alert-link">Mulai
                    belanja sekarang!</a>
            </div>
        @endif
    </section>
@endsection