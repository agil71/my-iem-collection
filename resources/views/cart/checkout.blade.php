@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="page-header">
    <h1><i class="fa-solid fa-credit-card"></i> Checkout</h1>
    <a href="{{ route('cart.index') }}" class="btn btn-white btn-sm">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Keranjang
    </a>
</div>

<div class="checkout-layout">
    <div class="checkout-form-section">
        <div class="form-container">
            <div class="form-header">
                <h2>
                    <span class="header-icon" style="background: var(--yellow);">
                        <i class="fa-solid fa-user"></i>
                    </span>
                    Informasi Pemesan
                </h2>
            </div>

            <form action="/checkout" method="POST">
                @csrf

                @if($errors->any())
                    <div style="background: var(--pink); border: var(--border); border-radius: 8px; padding: 12px; margin-bottom: 16px;">
                        @foreach($errors->all() as $error)
                            <p style="margin:0; font-size:13px;"><i class="fa-solid fa-triangle-exclamation"></i> {{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                <div class="form-group">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" class="form-input" placeholder="Masukkan nama lengkap" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Nomor Telepon</label>
                    <input type="tel" name="phone" class="form-input" placeholder="Contoh: 081234567890" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Alamat Pengiriman</label>
                    <textarea name="address" class="form-input" rows="4" placeholder="Masukkan alamat lengkap..." required></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Catatan (Opsional)</label>
                    <textarea name="notes" class="form-input" rows="2" placeholder="Catatan tambahan untuk pesanan..."></textarea>
                </div>

                <button type="submit" class="btn btn-yellow" style="width: 100%; justify-content: center; padding: 14px;">
                    <i class="fa-solid fa-check"></i> Pesan Sekarang
                </button>
            </form>
        </div>
    </div>

    <div class="checkout-summary-section">
        <div class="cart-summary-card">
            <h3><i class="fa-solid fa-bag-shopping"></i> Ringkasan Pesanan</h3>
            
            @foreach($items as $item)
                <div class="order-item">
                    <div class="order-item-info">
                        <span class="order-item-title">{{ $item['title'] }}</span>
                        <span class="order-item-qty">x{{ $item['qty'] }}</span>
                    </div>
                    <span class="order-item-price">Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</span>
                </div>
            @endforeach

            <div class="summary-row">
                <span>Total Barang</span>
                <span>{{ array_sum(array_column($items, 'qty')) }} item</span>
            </div>
            <div class="summary-row total">
                <span>Total Pembayaran</span>
                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>
</div>

<style>
    .checkout-layout {
        display: grid;
        grid-template-columns: 1fr 360px;
        gap: 24px;
        align-items: start;
    }

    .order-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: var(--border-light);
    }

    .order-item-info {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .order-item-title {
        font-size: 14px;
        font-weight: 600;
    }

    .order-item-qty {
        font-size: 12px;
        color: #888;
        font-family: var(--font-mono);
    }

    .order-item-price {
        font-family: var(--font-mono);
        font-weight: 700;
    }

    .cart-summary-card {
        background: var(--card-bg);
        border: var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        padding: 24px;
    }

    .cart-summary-card h3 {
        font-size: 18px;
        margin-bottom: 18px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: var(--border-light);
        font-size: 14px;
    }

    .summary-row.total {
        font-size: 20px;
        font-weight: 700;
        font-family: var(--font-mono);
        border-bottom: none;
        padding-top: 14px;
    }

    @media (max-width: 768px) {
        .checkout-layout { grid-template-columns: 1fr; }
    }
</style>
@endsection