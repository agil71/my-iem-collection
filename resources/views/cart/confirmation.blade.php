@extends('layouts.app')

@section('title', 'Pesanan Berhasil')

@section('content')
<div class="success-container">
    <div class="success-icon">
        <i class="fa-solid fa-check"></i>
    </div>
    
    <h1>Pesanan Berhasil!</h1>
    <p class="success-desc">Terima kasih telah melakukan pemesanan. Kami akan memproses pesanan Anda segera.</p>
    
    <div class="order-info-card">
        <div class="order-header">
            <div>
                <span class="order-label">Nomor Pesanan</span>
                <span class="order-id">{{ $order['order_id'] }}</span>
            </div>
            <div>
                <span class="order-label">Tanggal</span>
                <span class="order-date">{{ $order['date'] }}</span>
            </div>
        </div>

        <div class="order-section">
            <h3><i class="fa-solid fa-user"></i> Data Pemesan</h3>
            <div class="order-detail">
                <p><strong>Nama:</strong> {{ $order['name'] }}</p>
                <p><strong>Telepon:</strong> {{ $order['phone'] }}</p>
                <p><strong>Alamat:</strong> {{ $order['address'] }}</p>
                @if($order['notes'])
                    <p><strong>Catatan:</strong> {{ $order['notes'] }}</p>
                @endif
            </div>
        </div>

        <div class="order-section">
            <h3><i class="fa-solid fa-bag-shopping"></i> Rincian Pesanan</h3>
            <div class="order-items">
                @foreach($order['items'] as $item)
                    <div class="order-product">
                        <div class="order-product-info">
                            <span class="order-product-name">{{ $item['title'] }}</span>
                            <span class="order-product-qty">x{{ $item['qty'] }}</span>
                        </div>
                        <span class="order-product-price">Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</span>
                    </div>
                @endforeach
            </div>
            <div class="order-total">
                <span>Total Pembayaran</span>
                <span>Rp {{ number_format($order['total'], 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    <div class="success-actions">
        <a href="{{ route('products.index') }}" class="btn btn-yellow">
            <i class="fa-solid fa-headphones"></i> Lanjut Belanja
        </a>
        <a href="{{ route('home') }}" class="btn btn-white">
            <i class="fa-solid fa-house"></i> Ke Beranda
        </a>
    </div>
</div>

<style>
    .success-container {
        max-width: 600px;
        margin: 0 auto;
        text-align: center;
    }

    .success-icon {
        width: 100px;
        height: 100px;
        background: var(--lime);
        border: var(--border);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
        margin: 0 auto 24px;
        box-shadow: var(--shadow);
        animation: popIn 0.5s ease;
    }

    @keyframes popIn {
        0% { transform: scale(0); }
        70% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }

    .success-container h1 {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .success-desc {
        color: #666;
        margin-bottom: 32px;
    }

    .order-info-card {
        background: var(--card-bg);
        border: var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        text-align: left;
        overflow: hidden;
    }

    .order-header {
        display: flex;
        justify-content: space-between;
        padding: 20px 24px;
        background: var(--yellow);
        border-bottom: var(--border);
    }

    .order-label {
        display: block;
        font-family: var(--font-mono);
        font-size: 11px;
        color: #666;
        text-transform: uppercase;
        margin-bottom: 4px;
    }

    .order-id {
        font-size: 18px;
        font-weight: 700;
    }

    .order-date {
        font-family: var(--font-mono);
        font-size: 14px;
        font-weight: 700;
    }

    .order-section {
        padding: 20px 24px;
        border-bottom: var(--border-light);
    }

    .order-section:last-child {
        border-bottom: none;
    }

    .order-section h3 {
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .order-detail p {
        font-size: 14px;
        margin-bottom: 6px;
    }

    .order-items {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-bottom: 16px;
    }

    .order-product {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .order-product-info {
        display: flex;
        gap: 8px;
    }

    .order-product-name {
        font-size: 14px;
        font-weight: 600;
    }

    .order-product-qty {
        font-size: 12px;
        color: #888;
        font-family: var(--font-mono);
    }

    .order-product-price {
        font-family: var(--font-mono);
        font-weight: 700;
    }

    .order-total {
        display: flex;
        justify-content: space-between;
        padding-top: 14px;
        border-top: var(--border-light);
        font-size: 18px;
        font-weight: 700;
        font-family: var(--font-mono);
    }

    .success-actions {
        display: flex;
        gap: 12px;
        justify-content: center;
        margin-top: 28px;
    }

    @media (max-width: 480px) {
        .success-actions {
            flex-direction: column;
        }
        .success-actions .btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endsection