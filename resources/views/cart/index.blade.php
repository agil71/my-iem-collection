@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
<div class="page-header">
    <h1><i class="fa-solid fa-cart-shopping"></i> Keranjang Belanja</h1>
    @if(count($items) > 0)
        <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('Kosongkan keranjang?')">
            @csrf
            <button type="submit" class="btn btn-pink btn-sm">
                <i class="fa-solid fa-trash"></i> Kosongkan
            </button>
        </form>
    @endif
</div>

@if(count($items) === 0)
    <div class="empty-state">
        <div class="empty-illustration">
            <i class="fa-solid fa-cart-shopping"></i>
        </div>
        <h3>Keranjang Belanjamu Kosong</h3>
        <p>Yuk, pilih IEM favoritmu sekarang! Stocks Terbatas - Jangan sampai kehabisan!</p>
        <a href="{{ route('products.index') }}" class="btn btn-yellow">
            <i class="fa-solid fa-shopping-bag"></i> Belanja Sekarang
        </a>
    </div>
@else
    <div class="cart-layout">
        <div class="cart-items">
            @foreach($items as $item)
                <div class="cart-item">
                    <div class="cart-item-image">
                        <img src="{{ asset('storage/products/' . $item['image']) }}" alt="{{ $item['title'] }}">
                    </div>
                    <div class="cart-item-info">
                        <a href="{{ route('products.show', $item['product_id']) }}" class="cart-item-title">{{ $item['title'] }}</a>
                        <div class="cart-item-price">Rp {{ number_format($item['price'], 0, ',', '.') }}</div>
                        <div class="cart-item-stock">Stok: {{ $item['stock'] }}</div>
                    </div>
                    <div class="cart-item-actions">
                        <form action="{{ route('cart.update', $item['product_id']) }}" method="POST" class="qty-form">
                            @csrf
                            <button type="button" class="qty-btn" onclick="this.parentElement.querySelector('input').stepDown()">-</button>
                            <input type="number" name="qty" value="{{ $item['qty'] }}" min="1" max="{{ $item['stock'] }}" class="qty-input" onchange="this.form.submit()">
                            <button type="button" class="qty-btn" onclick="this.parentElement.querySelector('input').stepUp()">+</button>
                        </form>
                        <div class="cart-item-subtotal">
                            Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}
                        </div>
                        <form action="{{ route('cart.remove', $item['product_id']) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-pink btn-sm">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="cart-summary">
            <div class="cart-summary-card">
                <h3><i class="fa-solid fa-receipt"></i> Ringkasan Belanja</h3>
                <div class="summary-row">
                    <span>Total Barang</span>
                    <span>{{ array_sum(array_column($items, 'qty')) }} item</span>
                </div>
                <div class="summary-row total">
                    <span>Total Pembayaran</span>
                    <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
                <a href="{{ route('checkout') }}" class="btn btn-yellow" style="width:100%; justify-content: center; padding: 14px;">
                    <i class="fa-solid fa-bag-shopping"></i> 💳 Pesan Sekarang
                </a>
                <a href="{{ route('products.index') }}" class="btn btn-white" style="width:100%; margin-top: 8px; justify-content: center;">
                    <i class="fa-solid fa-arrow-left"></i> Tambah Produk Lain
                </a>
            </div>
        </div>
    </div>
@endif

<style>
    .cart-layout {
        display: grid;
        grid-template-columns: 1fr 340px;
        gap: 24px;
        align-items: start;
    }

    .cart-items {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .cart-item {
        background: var(--card-bg);
        border: var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow-sm);
        padding: 16px;
        display: grid;
        grid-template-columns: 90px 1fr auto;
        gap: 16px;
        align-items: center;
    }

    .cart-item-image {
        width: 70px;
        height: 50px;
        border-radius: 6px;
        border: var(--border-light);
        overflow: hidden;
        flex-shrink: 0;
    }

    .cart-item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        max-width: 100%;
    }

    .cart-item-title {
        font-weight: 700;
        font-size: 15px;
        display: block;
        margin-bottom: 4px;
    }

    .cart-item-title:hover { text-decoration: underline; }

    .cart-item-price {
        font-family: var(--font-mono);
        font-size: 14px;
        font-weight: 700;
        color: var(--yellow);
    }

    .cart-item-stock {
        font-size: 12px;
        color: #888;
        margin-top: 2px;
    }

    .cart-item-actions {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 10px;
    }

    .qty-form {
        display: flex;
        align-items: center;
        gap: 0;
        border: var(--border-light);
        border-radius: 8px;
        overflow: hidden;
    }

    .qty-btn {
        width: 32px;
        height: 32px;
        background: var(--bg);
        border: none;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        transition: background 0.15s;
    }

    .qty-btn:hover { background: var(--yellow); }

    .qty-input {
        width: 50px;
        height: 32px;
        border: none;
        border-left: var(--border-light);
        border-right: var(--border-light);
        text-align: center;
        font-family: var(--font-mono);
        font-size: 13px;
        font-weight: 700;
        background: var(--card-bg);
        outline: none;
        -moz-appearance: textfield;
    }

    .qty-input::-webkit-outer-spin-button,
    .qty-input::-webkit-inner-spin-button { -webkit-appearance: none; }

    .cart-item-subtotal {
        font-family: var(--font-mono);
        font-size: 15px;
        font-weight: 700;
    }

    .cart-summary-card {
        background: var(--card-bg);
        border: var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        padding: 24px;
        position: sticky;
        top: 90px;
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
        padding: 10px 0;
        border-bottom: var(--border-light);
        font-size: 14px;
    }

    .summary-row.total {
        font-size: 18px;
        font-weight: 700;
        font-family: var(--font-mono);
        border-bottom: none;
        padding-top: 14px;
    }

    @media (max-width: 768px) {
        .cart-layout { grid-template-columns: 1fr; }
        .cart-item { grid-template-columns: 70px 1fr; gap: 12px; }
        .cart-item-actions { grid-column: 1 / -1; flex-direction: row; align-items: center; justify-content: space-between; }
        .cart-summary-card { position: static; }
    }
</style>
@endsection