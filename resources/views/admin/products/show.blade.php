@extends('layouts.admin.master')

@section('productsActive')
    text-primary
@endsection

@section('content')
    <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>';">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Produk</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Produk</li>
        </ol>
    </nav>
    <hr><br>

    <div class="card">
        <div class="card-header">
            <h4>Detail Produk: {{ $product->title }}</h4>
            <div class="float-end">
                <a href="{{ route('admin.products.edit', $product->slug) }}" class="btn btn-sm btn-success">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                {{-- Gambar --}}
                <div class="col-md-4 text-center mb-3">
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded shadow" width="250"
                            alt="Gambar Produk">
                    @else
                        <p class="text-muted">Tidak ada gambar</p>
                    @endif
                </div>

                {{-- Detail Produk --}}
                <div class="col-md-8">
                    <table class="table table-bordered">
                        <tr>
                            <th>Judul Produk</th>
                            <td>{{ $product->title }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Produk</th>
                            <td>{{ $product->productType->name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>SKU</th>
                            <td>{{ $product->sku ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Harga Awal</th>
                            <td>Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Diskon</th>
                            <td>{{ $product->discount ?? 0 }}%</td>
                        </tr>
                        <tr>
                            <th>Harga Setelah Diskon</th>
                            @php
                                $discount = $product->discount ?? 0;
                                $finalPrice = $product->price - ($product->price * $discount) / 100;
                            @endphp
                            <td>Rp{{ number_format($finalPrice, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Stok</th>
                            <td>{{ $product->stock }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if ($product->status)
                                    <span class="badge bg-primary">Published</span>
                                @else
                                    <span class="badge bg-secondary">Draft</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Diperbarui Pada</th>
                            <td>{{ $product->updated_at->format('d M Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            {{-- Konten / Deskripsi Produk --}}
            <div class="mt-4">
                <h5>Deskripsi Produk</h5>
                <div class="border p-3 rounded" style="background-color: #f9f9f9;">
                    {!! $product->content !!}
                </div>
            </div>

            {{-- How to Use --}}
            @if (!empty($product->how_to_use))
                <div class="mt-4">
                    <h5>Cara Pemakaian</h5>
                    <div class="border p-3 rounded" style="background-color: #f9f9f9;">
                        {!! $product->how_to_use !!}
                    </div>
                </div>
            @endif

            {{-- Ingredients --}}
            @if (!empty($product->ingredients))
                <div class="mt-4">
                    <h5>Ingredients</h5>
                    <div class="border p-3 rounded" style="background-color: #f9f9f9;">
                        {!! $product->ingredients !!}
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection
