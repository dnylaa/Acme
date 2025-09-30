@extends('layouts.admin.master')

@section('productsActive')
    text-primary
@endsection

@section('content')
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Produk</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Produk</li>
        </ol>
    </nav>
    <hr><br>

    {{-- Summernote CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan!</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">

            <div class="col-lg-6 mb-3">
                <label for="title" class="form-label">Nama Produk</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                    value="{{ old('title') }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-lg-6 mb-3">
                <label for="sku" class="form-label">SKU</label>
                <input type="text" name="sku" class="form-control @error('sku') is-invalid @enderror"
                    value="{{ old('sku') }}" required>
                @error('sku')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>



            <div class="col-lg-6 mb-3">
                <label for="product_type_id" class="form-label">Jenis Produk</label>
                <select name="product_type_id" class="form-select @error('product_type_id') is-invalid @enderror" required>
                    <option value="">Pilih Jenis Produk</option>
                    @foreach ($productTypes as $productType)
                        <option value="{{ $productType->id }}"
                            {{ old('product_type_id') == $productType->id ? 'selected' : '' }}>
                            {{ $productType->name }}
                        </option>
                    @endforeach
                </select>
                @error('product_type_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-lg-6 mb-3">
                <label for="price" class="form-label">Harga (Rp)</label>
                <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                    value="{{ old('price') }}" required>
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-lg-6 mb-3">
                <label for="discount" class="form-label">Diskon (%)</label>
                <input type="number" name="discount" class="form-control @error('discount') is-invalid @enderror"
                    value="{{ old('discount') }}">
                @error('discount')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-lg-6 mb-3">
                <label for="stock" class="form-label">Stok</label>
                <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror"
                    value="{{ old('stock') }}" required>
                @error('stock')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-lg-6 mb-3">
                <label for="image" class="form-label">Gambar Produk</label>
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-lg-6 mb-3">
                <label for="meta_desc" class="form-label">Meta Deskripsi</label>
                <input type="text" name="meta_desc" class="form-control @error('meta_desc') is-invalid @enderror"
                    value="{{ old('meta_desc') }}" required>
                @error('meta_desc')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-lg-12 mb-3">
                <label for="content" class="form-label">Deskripsi Produk</label>
                <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" rows="10"
                    required>{{ old('content') }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="how_to_use" class="form-label">How to Use</label>
                <textarea name="how_to_use" id="how_to_use" class="form-control" rows="3">{{ old('how_to_use', $product->how_to_use ?? '') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="ingredients" class="form-label">Ingredients</label>
                <textarea name="ingredients" id="ingredients" class="form-control" rows="3">{{ old('ingredients', $product->ingredients ?? '') }}</textarea>
            </div>


            <div class="col-lg-12 mb-3">
                <label class="form-label">Status Produk</label>
                <div class="d-flex">
                    <div class="form-check me-3">
                        <input class="form-check-input @error('status') is-invalid @enderror" type="radio"
                            name="status" id="statusDraft" value="0" {{ old('status') == '0' ? 'checked' : '' }}>
                        <label class="form-check-label" for="statusDraft">Draft</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input @error('status') is-invalid @enderror" type="radio"
                            name="status" id="statusPublished" value="1"
                            {{ old('status', '1') == '1' ? 'checked' : '' }}>
                        <label class="form-check-label" for="statusPublished">Published</label>
                    </div>
                </div>
                @error('status')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-lg-12 mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i> Tambahkan Produk
                </button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary ms-2">Kembali</a>
            </div>

        </div>
    </form>
@endsection

@push('scripts')
    {{-- jQuery --}}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    {{-- Summernote --}}
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#content').summernote({
                placeholder: 'Tulis deskripsi produk di sini...',
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview']]
                ]
            });

            $('#how_to_use').summernote({
                placeholder: 'Tulis cara penggunaan produk di sini...',
                height: 200,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['view', ['codeview']]
                ]
            });

            $('#ingredients').summernote({
                placeholder: 'Tulis bahan-bahan produk di sini...',
                height: 200,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['view', ['codeview']]
                ]
            });
        });
    </script>
@endpush

