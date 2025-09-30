@extends('layouts.frontend.master')

@section('content')
    <div class="container my-5">
        <h3 class="mb-4">Detail Pesanan</h3>

        <!-- Info Pesanan -->
        <div class="card shadow-sm rounded-3">
            <div class="card-body">
                <h5 class="card-title">Order #{{ $order->order_number }}</h5>
                <p class="text-muted">Tanggal Pesan: {{ $order->created_at->format('d M Y, H:i') }}</p>

                <table class="table table-borderless">
                    <tr>
                        <th>Nama Pelanggan</th>
                        <td>{{ $order->customer_name }}</td>
                    </tr>
                    <tr>
                        <th>No. Telepon</th>
                        <td>{{ $order->customer_phone ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if ($order->status == 'pending')
                                <span class="badge bg-warning text-dark">Menunggu</span>
                            @elseif($order->status == 'paid')
                                <span class="badge bg-success">Sudah Dibayar</span>
                            @elseif($order->status == 'shipped')
                                <span class="badge bg-info text-dark">Dikirim</span>
                            @elseif($order->status == 'completed')
                                <span class="badge bg-primary">Selesai</span>
                            @elseif($order->status == 'cancelled')
                                <span class="badge bg-danger">Dibatalkan</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Total Harga</th>
                        <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Alamat Pengiriman</th>
                        <td>{{ $order->shipping_address }},
                            {{ $order->shipping_city }},
                            {{ $order->shipping_province }},
                            {{ $order->shipping_postal_code ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Metode Pembayaran</th>
                        <td>{{ ucfirst($order->payment_method) }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Produk dalam Pesanan -->
        <div class="card shadow-sm rounded-3 mt-4">
            <div class="card-header">
                <strong>Produk dalam Pesanan</strong>
            </div>
            <div class="card-body p-0">
                @php
                    $totalOrder = 0; // Inisialisasi total order
                @endphp

                <table class="table mb-0 align-middle">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Qty</th>
                            <th>Harga/unit</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $item)
                            @php
                                // Hitung harga diskon per unit
                                $discountedPrice = $item->price_per_unit;
                                if ($item->discount_per_unit > 0) {
                                    // Jika discount_per_unit disimpan sebagai persen
                                    $discountedPrice = $item->price_per_unit * (1 - $item->discount_per_unit / 100);
                                }

                                // Hitung subtotal produk
                                $subtotal = $discountedPrice * $item->quantity;

                                // Tambahkan ke total order
                                $totalOrder += $subtotal;
                            @endphp
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('storage/' . $item->product_image) }}"
                                            alt="{{ $item->product_name }}" class="rounded me-2"
                                            style="width: 60px; height: 60px; object-fit: cover;">
                                        <div>
                                            <div class="fw-bold">{{ $item->product_name }}</div>
                                            <small class="text-muted">SKU: {{ $item->product_sku ?? '-' }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $item->quantity }}</td>
                                <td>
                                    Rp {{ number_format($discountedPrice, 0, ',', '.') }}
                                    @if ($item->discount_per_unit > 0)
                                        <br><small class="text-muted"><del>Rp
                                                {{ number_format($item->price_per_unit, 0, ',', '.') }}</del></small>
                                    @endif
                                </td>
                                <td>
                                    Rp {{ number_format($subtotal, 0, ',', '.') }}
                                </td>
                            </tr>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-end">Total Order:</th>
                            <th>Rp {{ number_format($totalOrder, 0, ',', '.') }}</th>
                        </tr>
                    </tfoot>
                </table>
                @endforeach


            </div>
        </div>

        <!-- Tombol Kembali -->
        <div class="mt-4">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">← Kembali</a>
        </div>
    </div>
@endsection
