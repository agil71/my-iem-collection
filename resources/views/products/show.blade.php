@extends('layouts.app')

@section('title', $product->title)

@section('content')
<div class="page-header">
    <h1><i class="fa-solid fa-headphones"></i> Detail IEM</h1>
    <div style="display:flex; gap:10px; flex-wrap:wrap;">
        @if($isAdmin)
            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-cyan btn-sm">
                <i class="fa-solid fa-pen"></i> Edit
            </a>
        @endif
        <a href="{{ route('products.index') }}" class="btn btn-white btn-sm">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<div class="detail-grid">
    <div class="detail-image-card">
        <img
            src="{{ asset('/storage/products/'.$product->image) }}"
            alt="{{ $product->title }}"
            onerror="this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 400 300%22><rect fill=%22%23f5f0e8%22 width=%22400%22 height=%22300%22/><text x=%2250%25%22 y=%2250%25%22 dominant-baseline=%22middle%22 text-anchor=%22middle%22 font-family=%22sans-serif%22 font-size=%2216%22 fill=%22%23ccc%22>No Image</text></svg>'"
        >
    </div>

    <div class="detail-info-card">
        <h2>{{ $product->title }}</h2>
        <div class="detail-price">{{ "Rp " . number_format($product->price, 0, ',', '.') }}</div>

        <div class="detail-desc-title">Deskripsi / Spesifikasi</div>
        <div class="detail-desc-content">
            {!! $product->description !!}
        </div>

        <div class="detail-meta">
            @if($product->stock > 10)
                <span class="badge badge-lime"><i class="fa-solid fa-check"></i> Tersedia</span>
            @elseif($product->stock > 0)
                <span class="badge badge-orange"><i class="fa-solid fa-triangle-exclamation"></i> Terbatas</span>
            @else
                <span class="badge badge-pink"><i class="fa-solid fa-xmark"></i> Habis</span>
            @endif
            <span class="badge badge-cyan"><i class="fa-solid fa-box"></i> Stok: {{ $product->stock }}</span>
        </div>
    </div>
</div>
@endsection