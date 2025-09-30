@extends('layouts.admin.master')

@section('homeActive')
    text-primary
@endsection

@section('content')
    <h1 class="mb-4 ps-3" style="font-size:x-large">Dashboard</h1>
    <hr><br>

    @if (Auth::user()->isAdmin() || Auth::user()->isAuthor())
        @if (Auth::user()->isAdmin())
            <h2 class="mb-1 fw-bold ps-3">Selamat Datang, Admin 👋</h2>
            <p class="mb-5 ps-3">Kelola dan pantau semua aktivitas di sini.</p>
        @elseif (Auth::user()->isAuthor())
            <h2 class="mb-1 fw-bold ps-3">Selamat Datang, Author 👋<h2>
        @endif
    </>
        <div class="row g-4 mb-5 ps-3">
            <div class="col-lg-3 col-6">
                <div class="card text-white h-100 shadow-sm" style="background-color: #A78BFA">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-article">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M3 4m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                                    <path d="M7 8h10" />
                                    <path d="M7 12h10" />
                                    <path d="M7 16h10" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="card-title mb-0">{{ $articles->count() }}</h3>
                                <p class="card-text text-white-50">Total Artikel</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="card text-white h-100 shadow-sm" style="background-color: #6EE7B7">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-bookmarks">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M15 10v11l-5 -3l-5 3v-11a3 3 0 0 1 3 -3h4a3 3 0 0 1 3 3z" />
                                    <path d="M11 3h5a3 3 0 0 1 3 3v11" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="card-title mb-0">{{ $categories->count() }}</h3>
                                <p class="card-text text-white-50">Total Kategori</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="card text-white h-100 shadow-sm" style="background-color: #FCD34D">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-files">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M15 3v4a1 1 0 0 0 1 1h4" />
                                    <path d="M18 17h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h4l5 5v7a2 2 0 0 1 -2 2z" />
                                    <path d="M16 17v2a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h2" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="card-title mb-0">{{ $information->count() }}</h3>
                                <p class="card-text text-white-50">Total Halaman</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="card text-white h-100 shadow-sm" style="background-color: #FCA5A5">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                    <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="card-title mb-0">{{ $users->count() }}</h3>
                                <p class="card-text text-white-50">Total User</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 ps-3">
            <div class="col-lg-6">
                <div class="card shadow-sm h-100">
                    <div class="card-header">
                        List Artikel Terbaru
                    </div>
                    <div class="card-body small">
                        @forelse ($latest_articles as $val)
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div class="me-3">
                                    <a href="{{ route('admin.articles.show', $val->slug) }}"
                                        class="text-decoration-none text-dark fw-bold me-auto">
                                        {{ $val->title }}
                                    </a>
                                </div>
                                <div class="text-nowrap text-muted small" style="font-size: 0.85em;">
                                    <i class="fas fa-calendar-alt me-1"></i> {{ $val->created_at->format('d M Y') }}
                                </div>
                            </div>
                        @empty
                            <p class="text-muted">Tidak ada artikel terbaru yang tersedia.</p>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card shadow-sm h-100">
                    <div class="card-header">
                        Grafik Total Artikel
                    </div>
                    <div class="card-body">
                        <div id="myChart"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ✅ AUTHOR --}}
    @elseif (Auth::user()->role === 'author')
        <div class="row g-4 mb-5">
            {{-- Artikel milik AUTHOR --}}
            <div class="col-lg-6">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-pink text-white">Artikel Saya</div>
                    <div class="card-body small">
                        @forelse ($articles as $val)
                            <p class="mb-1">
                                <a href="{{ route('admin.articles.show', $val->slug) }}" class="fw-bold text-dark">
                                    {{ $val->title }}
                                </a>
                            </p>
                        @empty
                            <p class="text-muted">Kamu belum menulis artikel.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Order terbaru --}}
            <div class="col-lg-6">
                <div class="card shadow-sm h-100">
                    <div class="card-header">Pesanan Terbaru</div>
                    <div class="card-body small">
                        @forelse ($orders as $order)
                            <p class="mb-1">
                                <strong>#{{ $order->order_number }}</strong> - {{ ucfirst($order->status) }}
                                <span class="text-muted">
                                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                </span>
                            </p>
                        @empty
                            <p class="text-muted">Belum ada pesanan.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        {{-- 🔵 USER --}}
    @elseif (Auth::user()->role === 'user')
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-sm h-100">
                    <div class="card-header">
                        Pesanan Saya
                    </div>
                    <div class="card-body">
                        @if ($orders->count())
                            <div class="table-responsive">
                                <table class="table table-bordered align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#Order</th>
                                            <th>Tanggal</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Pembayaran</th>
                                            <th>Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td><strong>#{{ $order->order_number }}</strong></td>
                                                <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                                                <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                                <td>
                                                    <span
                                                        class="badge
    @if ($order->status === 'pending') bg-warning text-dark
    @elseif($order->status === 'paid') bg-success
    @elseif($order->status === 'shipped') bg-info text-dark
    @elseif($order->status === 'completed') bg-primary
    @elseif($order->status === 'cancelled') bg-danger
    @else bg-secondary @endif">
                                                        {{ ucfirst($order->status) }}
                                                    </span>

                                                </td>
                                                <td>{{ ucfirst($order->payment_status) }}</td>
                                                <td>
                                                    <a href="{{ route('home.orders.showdashboard', $order->id) }}"
                                                        class="btn btn-sm btn-outline-primary">
                                                        Lihat
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-muted">Kamu belum punya pesanan.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif


@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        var options = {
            chart: {
                type: 'bar', // Ubah tipe ke 'bar'
                height: 280,
            },
            series: [{
                name: 'Jumlah Artikel', // Beri nama seri data
                data: [
                    @foreach ($categories as $val)
                        {{ $val->articles->count() }},
                    @endforeach
                ]
            }],
            xaxis: {
                categories: [
                    @foreach ($categories as $val)
                        "{{ $val->name }}",
                    @endforeach
                ],
            },
            dataLabels: {
                enabled: false
            },
        };

        var chart = new ApexCharts(document.querySelector("#myChart"), options);
        chart.render();
    </script>
@endpush
