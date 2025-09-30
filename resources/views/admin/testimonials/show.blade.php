@extends('layouts.frontend.master')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        @if($testimonial->photo)
                            <img src="{{ asset('storage/' . $testimonial->photo) }}" 
                                 class="rounded-circle me-3"
                                 style="width:60px; height:60px; object-fit:cover;"
                                 alt="{{ $testimonial->name }}">
                        @else
                            <img src="{{ asset('images/default-user.png') }}" 
                                 class="rounded-circle me-3"
                                 style="width:60px; height:60px; object-fit:cover;"
                                 alt="{{ $testimonial->name }}">
                        @endif
                        <div>
                            <h5 class="mb-0">{{ $testimonial->name }}</h5>
                            <small class="text-muted">{{ $testimonial->created_at->format('d M Y, H:i') }}</small>
                        </div>
                    </div>

                    {{-- Rating --}}
                    @if($testimonial->rating)
                        <p class="mb-2">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $testimonial->rating)
                                    ⭐
                                @else
                                    ☆
                                @endif
                            @endfor
                        </p>
                    @endif

                    <p class="fs-5">"{{ $testimonial->message }}"</p>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('products.show', $testimonial->product_id) }}" class="btn btn-outline-secondary">
                    ← Kembali ke Produk
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
