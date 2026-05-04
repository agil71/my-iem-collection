@extends('layouts.app')

@section('title', $product->title)

@section('content')
<div class="page-header">
    <h1><i class="fa-solid fa-star"></i> {{ $product->title }}</h1>
    <div style="display:flex; gap:10px; flex-wrap:wrap;">
        @if($isAdmin)
            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-cyan btn-sm">
                <i class="fa-solid fa-pen"></i> Edit
            </a>
        @endif
        <a href="{{ route('products.index') }}" class="btn btn-white btn-sm">
            <i class="fa-solid fa-arrow-left"></i> Lihat Produk Lain
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
        
        @if($product->stock > 0 && $product->stock <= 5)
            <div style="background: var(--pink); border: var(--border); border-radius: 8px; padding: 10px 14px; margin-bottom: 12px; display: flex; align-items: center; gap: 8px; font-weight: 600; font-size: 13px;">
                <i class="fa-solid fa-fire"></i>🔥 Tersisa {{ $product->stock }} unit aja! Buruan sebelum kehabisan!
            </div>
        @endif
        
        <div class="detail-price">{{ "Rp " . number_format($product->price, 0, ',', '.') }}</div>

        <div class="detail-desc-title">📝 Deskripsi & Spesifikasi</div>
        <div class="detail-desc-content">
            {!! $product->description !!}
        </div>

        <div class="detail-meta">
            @if($product->stock > 10)
                <span class="badge badge-lime"><i class="fa-solid fa-check-circle"></i> Stok Banyak</span>
            @elseif($product->stock > 0)
                <span class="badge badge-orange"><i class="fa-solid fa-triangle-exclamation"></i> Stok Terbatas!</span>
            @else
                <span class="badge badge-pink"><i class="fa-solid fa-xmark"></i> Stok Habis</span>
            @endif
            <span class="badge badge-cyan"><i class="fa-solid fa-music"></i> {{ $product->sound_signature }}</span>
        </div>

        @if($product->frequency_data && is_array($product->frequency_data))
        <div class="detail-graph">
            <div class="detail-graph-title"><i class="fa-solid fa-chart-line"></i> Frequency Response</div>
            <canvas id="freqChart"></canvas>
        </div>
        @endif

        @if($product->stock > 0)
            @if(isset($cartItems[(string)$product->id]))
                <form action="{{ route('cart.remove', $product->id) }}" method="POST" style="margin-top: 20px;">
                    @csrf
                    <button type="submit" class="btn btn-pink" style="width:100%; justify-content: center;">
                        <i class="fa-solid fa-cart-xmark"></i> Hapus dari Keranjang
                    </button>
                </form>
                <div style="text-align:center; margin-top:8px; font-size:13px; color:var(--text-muted);">
                    <i class="fa-solid fa-circle-check" style="color:var(--lime);"></i> ✓ Sudah ada di keranjang ({{ $cartItems[(string)$product->id]['qty'] }}x)
                </div>
            @else
                <form action="{{ route('cart.add', $product->id) }}" method="POST" style="margin-top: 20px;">
                    @csrf
                    <button type="submit" class="btn btn-orange" style="width:100%; justify-content: center; padding: 16px; font-size: 16px;">
                        <i class="fa-solid fa-cart-shopping"></i> 🛒 Beli Sekarang
                    </button>
                </form>
            @endif
        @else
            <div class="btn btn-pink" style="width:100%; justify-content: center; opacity: 0.7; cursor: not-allowed; margin-top: 20px;">
                <i class="fa-solid fa-face-frown"></i> Maaf, Stok Habis
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
@if($product->frequency_data && is_array($product->frequency_data))
<script>
    const freqData = {!! json_encode($product->frequency_data) !!};
    const ctx = document.getElementById('freqChart').getContext('2d');
    
    const labels = freqData.map(d => d.freq);
    const dbValues = freqData.map(d => d.db);
    const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
    const gridColor = isDark ? 'rgba(245, 240, 232, 0.1)' : 'rgba(0, 0, 0, 0.1)';
    const textColor = isDark ? '#f5f0e8' : '#1a1a1a';
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Frequency Response (dB)',
                data: dbValues,
                borderColor: '#FF6B9D',
                backgroundColor: 'rgba(255, 107, 157, 0.1)',
                fill: true,
                tension: 0.4,
                pointRadius: 4,
                pointBackgroundColor: '#FF6B9D',
                pointBorderColor: isDark ? '#2d2d2d' : '#fff',
                pointBorderWidth: 2,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: isDark ? '#2d2d2d' : '#fff',
                    titleColor: textColor,
                    bodyColor: textColor,
                    borderColor: isDark ? '#f5f0e8' : '#1a1a1a',
                    borderWidth: 2,
                    padding: 12,
                    titleFormatter: function(value) {
                        return value + ' Hz';
                    },
                    labelFormatter: function(value) {
                        return value.formattedValue + ' dB';
                    }
                }
            },
            scales: {
                x: {
                    type: 'logarithmic',
                    title: {
                        display: true,
                        text: 'Frequency (Hz)',
                        color: textColor,
                        font: { weight: 'bold' }
                    },
                    grid: {
                        color: gridColor
                    },
                    ticks: {
                        color: textColor,
                        callback: function(value) {
                            return value + ' Hz';
                        }
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Output (dB)',
                        color: textColor,
                        font: { weight: 'bold' }
                    },
                    grid: {
                        color: gridColor
                    },
                    ticks: {
                        color: textColor
                    }
                }
            }
        }
    });
</script>
@endif
@endpush

@push('home-css')
<style>
    .detail-graph {
        margin-top: 20px;
        padding: 20px;
        background: var(--form-bg);
        border-radius: var(--radius-sm);
        border: var(--border-light);
    }
    .detail-graph-title {
        font-family: var(--font-mono);
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 12px;
        color: var(--text-muted);
    }
    .detail-graph canvas {
        max-height: 250px;
    }
</style>
@endpush