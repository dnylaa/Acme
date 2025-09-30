@extends('layouts.frontend.master')

@section('content')
<div class="container my-5">
    <!-- Judul -->
    <div class="text-center mb-4">
        <h2 class="fw-bold text-primary">Detail Pesanan</h2>
        <p class="text-muted">Terima kasih sudah berbelanja di Acme Skincare ✨</p>
    </div>

    <!-- Info Order -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="fw-bold mb-3">Informasi Pesanan</h5>
            <p><strong>No. Pesanan:</strong> {{ $order->order_number }}</p>
            <p><strong>Status Pesanan:</strong> 
                <span class="badge 
                    @if($order->status == 'pending') bg-warning 
                    @elseif($order->status == 'paid') bg-success 
                    @elseif($order->status == 'shipped') bg-info 
                    @else bg-secondary @endif">
                    {{ ucfirst($order->status) }}
                </span>
            </p>
            <p><strong>Total:</strong> Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
            <p><strong>Metode Pembayaran:</strong> {{ ucfirst($order->payment_method) }}</p>
        </div>
    </div>

    <!-- Info Customer -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="fw-bold mb-3">Informasi Pelanggan</h5>
            <p><strong>Nama:</strong> {{ $order->customer_name }}</p>
            <p><strong>Email:</strong> {{ $order->customer_email }}</p>
            <p><strong>Telepon:</strong> {{ $order->customer_phone }}</p>
            <p><strong>Alamat:</strong> 
                {{ $order->shipping_address }}, 
                {{ $order->shipping_city }}, 
                {{ $order->shipping_province }}, 
                {{ $order->shipping_postal_code }}
            </p>
        </div>
    </div>

    <!-- Item Pesanan -->
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="fw-bold mb-3">Produk Dipesan</h5>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Produk</th>
                            <th>Qty</th>
                            <th>Harga</th>
                            <th>Diskon</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('storage/' . $item->product_image) }}" 
                                         alt="{{ $item->product_name }}" 
                                         class="rounded me-2" 
                                         style="width: 60px; height: 60px; object-fit: cover;">
                                    <div>
                                        <div class="fw-bold">{{ $item->product_name }}</div>
                                        <small class="text-muted">SKU: {{ $item->product_sku }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $item->quantity }}</td>
                            <td>Rp {{ number_format($item->price_per_unit, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($item->discount_per_unit, 0, ',', '.') }}</td>
                            <td>
                                Rp {{ number_format(($item->price_per_unit - $item->discount_per_unit) * $item->quantity, 0, ',', '.') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="text-end mt-3">
                <h5 class="fw-bold">Total: Rp {{ number_format($order->total_amount, 0, ',', '.') }}</h5>
            </div>
        </div>
    </div>

    <!-- Tombol -->
    <div class="text-center mt-4">
        
        
    </div>
</div>
@endsection
