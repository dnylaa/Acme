@extends('layouts.frontend.head')

<div class="card card-body shadow-sm border-0 small p-0 mb-4">
    <div class="list-group">
        <a href="#" class="list-group-item list-group-item-action active" aria-current="true" style="background-color: #f47183;">
            Pilih Tipe
        </a>
        @forelse ($productTypes as $val)
            <a href="{{ route('home.product.productTypes', $val->id) }}"
                class="list-group-item list-group-item-action">{{ $val->name }}</a>
        @empty
            <a href="#" class="list-group-item list-group-item-action">Belum Ada Tipe</a>
        @endforelse
    </div>
</div>
