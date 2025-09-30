@extends('layouts.admin.master')

@section('productsActive')
    text-primary
@endsection

@section('content')
    <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>';">
        <ol class="breadcrumb">
            <li class="breadcrumb-item ms-3"><a href="{{ route('admin.products.index') }}">Produk</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Produk</li>
        </ol>
    </nav>
    <hr><br>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

    <div class="row ms-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">Edit Produk</div>
                <div class="card-body">
                    <form action="{{ route('admin.products.update', $product->slug) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            {{-- Nama Produk --}}
                            <div class="col-md-6 mb-3">
                                <label for="title" class="form-label">Nama Produk</label>
                                <input type="text" name="title"
                                    class="form-control @error('title') is-invalid @enderror"
                                    value="{{ old('title', $product->title) }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="sku" class="form-label">Nama Produk</label>
                                <input type="text" name="sku"
                                    class="form-control @error('sku') is-invalid @enderror"
                                    value="{{ old('sku', $product->sku) }}" required>
                                @error('sku')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Jenis Produk --}}
                            <div class="col-md-6 mb-3">
                                <label for="product_type_id" class="form-label">Jenis Produk</label>
                                <select name="product_type_id"
                                    class="form-select @error('product_type_id') is-invalid @enderror" required>
                                    <option value="">Pilih Jenis Produk</option>
                                    @foreach ($productTypes as $type)
                                        <option value="{{ $type->id }}"
                                            {{ old('product_type_id', $product->product_type_id) == $type->id ? 'selected' : '' }}>
                                            {{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('product_type_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Meta Deskripsi --}}
                            <div class="col-md-6 mb-3">
                                <label for="meta_desc" class="form-label">Meta Deskripsi</label>
                                <input type="text" name="meta_desc"
                                    class="form-control @error('meta_desc') is-invalid @enderror"
                                    value="{{ old('meta_desc', $product->meta_desc) }}" required>
                                @error('meta_desc')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Harga --}}
                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label">Harga</label>
                                <input type="number" name="price"
                                    class="form-control @error('price') is-invalid @enderror"
                                    value="{{ old('price', $product->price) }}" required>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Diskon --}}
                            <div class="col-md-6 mb-3">
                                <label for="discount" class="form-label">Diskon (%)</label>
                                <input type="number" name="discount" min="0" max="100"
                                    class="form-control @error('discount') is-invalid @enderror"
                                    value="{{ old('discount', $product->discount) }}">
                                @error('discount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Harga Setelah Diskon --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Harga Setelah Diskon</label>
                                @php
                                    $discount = $product->discount ?? 0;
                                    $finalPrice = $product->price - ($product->price * $discount) / 100;
                                @endphp
                                <input type="text" class="form-control"
                                    value="Rp {{ number_format($finalPrice, 0, ',', '.') }}" readonly>
                            </div>

                            {{-- Stok --}}
                            <div class="col-md-6 mb-3">
                                <label for="stock" class="form-label">Stok</label>
                                <input type="number" name="stock" min="0"
                                    class="form-control @error('stock') is-invalid @enderror"
                                    value="{{ old('stock', $product->stock) }}" required>
                                @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Gambar --}}
                            <div class="col-md-6 mb-3">
                                <label for="image" class="form-label">Gambar Produk</label>
                                <input type="file" name="image"
                                    class="form-control @error('image') is-invalid @enderror">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                @if ($product->image)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $product->image) }}" width="100"
                                            alt="Preview Gambar">
                                    </div>
                                @endif
                            </div>

                            {{-- Konten --}}
                            <div class="col-md-12 mb-3">
                                <label for="content" class="form-label">Konten</label>
                                <textarea name="content" id="content" rows="10" class="form-control @error('content') is-invalid @enderror"
                                    required>{{ old('content', $product->content) }}</textarea>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Cara Penggunaan dan Bahan-bahan --}}
                            <div class="mb-3">
                                <label for="how_to_use" class="form-label">How to Use</label>
                                <textarea name="how_to_use" id="how_to_use" class="form-control" rows="3">{{ old('how_to_use', $product->how_to_use ?? '') }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="ingredients" class="form-label">Ingredients</label>
                                <textarea name="ingredients" id="ingredients" class="form-control" rows="3">{{ old('ingredients', $product->ingredients ?? '') }}</textarea>
                            </div>

                            {{-- Status --}}
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Status Produk</label>
                                <div class="d-flex">
                                    <div class="form-check me-3">
                                        <input class="form-check-input @error('status') is-invalid @enderror"
                                            type="radio" name="status" id="draft" value="0"
                                            {{ old('status', $product->status) == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="draft">Draft</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input @error('status') is-invalid @enderror"
                                            type="radio" name="status" id="published" value="1"
                                            {{ old('status', $product->status) == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="published">Published</label>
                                    </div>
                                </div>
                                @error('status')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Update Produk</button>
                            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- jQuery --}}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    {{-- Summernote --}}
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#content').summernote({
            placeholder: 'Tulis konten produk di sini...',
            tabsize: 2,
            height: 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        $('#how_to_use').summernote({
            placeholder: 'Edit cara penggunaan produk...',
            height: 200,
            toolbar: [
                ['font', ['bold', 'italic', 'underline']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link']],
                ['view', ['fullscreen', 'codeview']]
            ]
        });

        $('#ingredients').summernote({
            placeholder: 'Edit bahan-bahan produk...',
            height: 200,
            toolbar: [
                ['font', ['bold', 'italic', 'underline']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link']],
                ['view', ['fullscreen', 'codeview']]
            ]
        });
    });
</script>

@endpush
