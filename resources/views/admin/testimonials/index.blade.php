@extends('layouts.admin.master')

@section('testimonialsActive')
    text-primary
@endsection

@section('content')
    <h1 class="mb-4" style="font-size:x-large">Manajemen Testimoni</h1>
    <hr><br>

    <div class="row">
        <div class="col-md-12">
            @if ($testimonials->isEmpty())
                <div class="alert alert-warning text-center" role="alert">
                    Tidak ada testimonial yang ditemukan.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover small align-middle">
                        <thead>
                            <tr class="text-center bg-light">
                                <th>No.</th>
                                <th>User</th>
                                <th>Produk</th>
                                <th>Rating</th>
                                <th>Pesan</th>
                                <th>Status</th>
                                <th>Dikirim Pada</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($testimonials as $val)
                                <tr>
                                    <td class="text-center">
                                        {{ $loop->iteration + ($testimonials->currentPage() - 1) * $testimonials->perPage() }}
                                    </td>
                                    <td>
                                        <strong>{{ $val->name }}</strong><br>
                                        <small class="text-muted">ID: {{ $val->user_id }}</small>
                                    </td>
                                    <td>
                                        @if ($val->product)
                                            <a href="{{ route('admin.products.show', $val->product->slug) }}"
                                               class="text-decoration-none">
                                                {{ $val->product->title }}
                                            </a>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $val->rating)
                                                <span style="color:#ff69b4; font-size:1rem;">★</span>
                                            @else
                                                <span style="color:#ffffff; -webkit-text-stroke: 0.8px #ff69b4; font-size:1rem;">★</span>
                                            @endif
                                        @endfor
                                    </td>
                                    <td>"{{ $val->message }}"</td>
                                    <td class="text-center">
                                            <span class="badge bg-success">Approved</span>
                                    </td>
                                    <td class="text-center">
                                        {{ $val->created_at->format('d M Y H:i') }}
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">

                                            <!-- Tombol Delete -->
                                            <form action="{{ route('admin.testimonials.destroy', $val->id) }}"
                                                  method="POST" onsubmit="return confirm('Yakin hapus testimoni ini?');"
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end">
                    {{ $testimonials->links('pagination::bootstrap-4') }}
                </div>
            @endif
        </div>
    </div>
@endsection
