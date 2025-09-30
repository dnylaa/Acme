@extends('layouts.frontend.master')

@section('informationActive')
    active
@endsection

@section('content')
    <!-- Header Section -->
    <header class="text-white text-center py-5"
        style="background: linear-gradient(rgba(177,156,217,0.6), rgba(255,77,148,0.6)), url('file://wsl.localhost/Ubuntu-22.04/home/dania/my_project/acme/public/assets/img/Hero%20Skincare%20Bg.jpg') center/cover no-repeat;">
            <h2 class="fw-bold mt-2">Daftar Informasi</h2>
            <p>Berbagai informasi menarik yang layak Anda baca</p>
        </div>
    </header>

    <!-- Main Content Section -->
    <section class="container-xl my-5">
        <div class="row gx-4">
            <div class="col-lg-9">
                <div class="card card-body shadow-sm border-0 shadow-sm border-0 small p-4">
                    @forelse ($information as $key => $val)
                        <div class="col-12 mb-1">
                            <a href="{{ route('home.information.show', $val->slug) }}" class="text-decoration-none">
                                <h5 class="fw-bold"><small>{{ $val->title }}</small></h5>
                            </a>
                            <p class="text-dark">{{ Str::limit(strip_tags($val->content), 250) }}</p>
                            <hr>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-info text-center" role="alert">
                                Belum ada Informasi yang tersedia.
                            </div>
                        </div>
                    @endforelse
                </div>
                <br>
                <div class="d-flex justify-content-center">
                    {{ $information->links('pagination::bootstrap-4') }}
                </div>
            </div>

            <!-- sidebar -->
            @include('home.information.sidebar')

        </div>
    </section>
@endsection
