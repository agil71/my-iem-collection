@extends('layouts.app')

@section('title', 'Temukan IEM Impianmu')

@push('home-css')
<style>
    /* ============================================
       HERO SECTION
    ============================================ */
    .hero {
        text-align: center;
        padding: 60px 0 50px;
        position: relative;
    }

    .hero-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 16px;
        background: var(--yellow);
        border: var(--border-light);
        border-radius: 100px;
        font-family: var(--font-mono);
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 24px;
        box-shadow: 2px 2px 0px var(--black);
    }

    .hero h1 {
        font-size: clamp(36px, 6vw, 64px);
        font-weight: 700;
        line-height: 1.1;
        letter-spacing: -2px;
        margin-bottom: 20px;
    }

    .hero h1 .highlight {
        position: relative;
        display: inline-block;
    }

    .hero h1 .highlight::after {
        content: '';
        position: absolute;
        bottom: 2px;
        left: -4px;
        right: -4px;
        height: 14px;
        background: var(--cyan);
        z-index: -1;
        transform: rotate(-1deg);
        border: var(--border-light);
    }

    .hero-desc {
        font-size: 17px;
        color: var(--text-muted);
        max-width: 520px;
        margin: 0 auto 32px;
        line-height: 1.7;
    }

    .hero-actions {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 14px;
        flex-wrap: wrap;
    }

    .hero-visual {
        margin-top: 50px;
        position: relative;
        max-width: 700px;
        margin-left: auto;
        margin-right: auto;
    }

    .hero-image-card {
        background: var(--card-bg);
        border: var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        padding: 20px;
        position: relative;
        z-index: 2;
    }

    .hero-image-card img {
        width: 100%;
        border-radius: 10px;
        border: var(--border-light);
        display: block;
        background: var(--form-bg);
        aspect-ratio: 16/9;
        object-fit: cover;
    }

    .hero-float-card {
        position: absolute;
        background: var(--card-bg);
        border: var(--border-light);
        border-radius: 10px;
        box-shadow: var(--shadow-sm);
        padding: 12px 16px;
        font-family: var(--font-mono);
        font-size: 13px;
        font-weight: 700;
        z-index: 3;
        display: flex;
        align-items: center;
        gap: 8px;
        animation: floatCard 4s ease-in-out infinite;
    }

    .hero-float-card.card-a {
        top: -16px;
        right: -10px;
        background: var(--lime);
        animation-delay: 0s;
    }

    .hero-float-card.card-b {
        bottom: -10px;
        left: -10px;
        background: var(--yellow);
        animation-delay: 1s;
    }

    .hero-float-card.card-c {
        top: 40%;
        right: -30px;
        background: var(--pink);
        animation-delay: 2s;
    }

    @keyframes floatCard {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    /* ============================================
       BRAND MARQUEE
    ============================================ */
    .brands-section {
        padding: 40px 0;
        border-top: var(--border-light);
        border-bottom: var(--border-light);
        margin-bottom: 50px;
        overflow: hidden;
    }

    .marquee-track {
        display: flex;
        gap: 24px;
        animation: marquee 25s linear infinite;
        width: max-content;
    }

    .marquee-track:hover {
        animation-play-state: paused;
    }

    .brand-chip {
        flex-shrink: 0;
        padding: 10px 24px;
        background: var(--card-bg);
        border: var(--border-light);
        border-radius: 100px;
        font-family: var(--font-mono);
        font-size: 14px;
        font-weight: 700;
        white-space: nowrap;
        box-shadow: 2px 2px 0px var(--black);
        transition: transform 0.2s, box-shadow 0.2s;
        cursor: default;
    }

    .brand-chip:hover {
        transform: translate(-2px, -2px);
        box-shadow: 4px 4px 0px var(--black);
    }

    @keyframes marquee {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }

    /* ============================================
       SECTION HEADERS
    ============================================ */
    .section-header {
        margin-bottom: 32px;
    }

    .section-header h2 {
        font-size: 28px;
        font-weight: 700;
        letter-spacing: -0.5px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-header h2 .icon-box {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px; height: 40px;
        border: var(--border-light);
        border-radius: 8px;
        box-shadow: 2px 2px 0px var(--black);
        font-size: 18px;
    }

    .section-header p {
        margin-top: 6px;
        font-size: 15px;
        color: #666;
    }

    .section-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-family: var(--font-mono);
        font-size: 13px;
        font-weight: 700;
        border-bottom: 2px solid var(--black);
        padding-bottom: 2px;
        transition: gap 0.2s;
    }

    .section-link:hover { gap: 10px; }

    /* ============================================
       FEATURED PRODUCTS (Home version)
    ============================================ */
    .featured-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
        margin-bottom: 60px;
    }

    .featured-card {
        background: var(--card-bg);
        border: var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow-sm);
        overflow: hidden;
        transition: box-shadow 0.2s, transform 0.2s;
    }

    .featured-card:hover {
        transform: translate(-2px, -2px);
        box-shadow: var(--shadow);
    }

    .featured-card img {
        width: 100%;
        aspect-ratio: 4/3;
        object-fit: cover;
        border-bottom: var(--border-light);
        background: var(--form-bg);
        display: block;
    }

    .featured-card .fc-body {
        padding: 16px;
    }

    .featured-card .fc-title {
        font-size: 15px;
        font-weight: 700;
        margin-bottom: 4px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .featured-card .fc-price {
        font-family: var(--font-mono);
        font-size: 14px;
        font-weight: 700;
    }

    .featured-card .fc-link {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 10px;
        font-size: 12px;
        font-weight: 700;
        border-top: var(--border-light);
        background: var(--form-bg);
        transition: background 0.2s, color 0.2s;
    }

    .featured-card .fc-link:hover {
        background: var(--yellow);
    }

    /* ============================================
       FEATURES SECTION
    ============================================ */
    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        margin-bottom: 60px;
    }

    .feature-card {
        background: var(--card-bg);
        border: var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow-sm);
        padding: 28px 22px;
        transition: box-shadow 0.2s, transform 0.2s;
    }

    .feature-card:hover {
        transform: translate(-2px, -2px);
        box-shadow: var(--shadow);
    }

    .feature-card .fc-icon {
        width: 48px; height: 48px;
        border: var(--border-light);
        border-radius: 10px;
        box-shadow: 2px 2px 0px var(--black);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        margin-bottom: 16px;
    }

    .feature-card h3 {
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .feature-card p {
        font-size: 13px;
        color: #666;
        line-height: 1.6;
    }

    /* ============================================
       STATS SECTION
    ============================================ */
    .stats-section {
        background: var(--black);
        border: var(--border);
        border-radius: var(--radius);
        box-shadow: 8px 8px 0px rgba(0,0,0,0.3);
        padding: 40px 24px;
        margin-bottom: 60px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        text-align: center;
    }

    .stat-item .stat-number {
        font-size: 40px;
        font-weight: 700;
        color: var(--yellow);
        line-height: 1;
        margin-bottom: 6px;
    }

    .stat-item .stat-label {
        font-family: var(--font-mono);
        font-size: 12px;
        font-weight: 700;
        color: #aaa;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* ============================================
       CTA SECTION
    ============================================ */
    .cta-section {
        text-align: center;
        padding: 50px 24px;
        background: var(--yellow);
        border: var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        position: relative;
        overflow: hidden;
    }

    .cta-section h2 {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 10px;
        position: relative;
        z-index: 1;
    }

    .cta-section p {
        font-size: 15px;
        color: #444;
        margin-bottom: 24px;
        position: relative;
        z-index: 1;
    }

    .cta-section .cta-actions {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        flex-wrap: wrap;
        position: relative;
        z-index: 1;
    }

    .cta-section .btn-dark {
        background: var(--text);
        color: var(--bg);
    }

    .cta-section .btn-dark:hover {
        background: var(--text-muted);
    }

    .cta-deco {
        position: absolute;
        border: var(--border-light);
        border-radius: 50%;
        opacity: 0.15;
    }

    .cta-deco.d1 { width: 200px; height: 200px; top: -60px; right: -40px; }
    .cta-deco.d2 { width: 120px; height: 120px; bottom: -30px; left: 20px; }
    .cta-deco.d3 { width: 80px; height: 80px; top: 20px; left: -20px; border-radius: 10px; transform: rotate(20deg); }

    /* ============================================
       RESPONSIVE
    ============================================ */
    @media (max-width: 768px) {
        .hero { padding: 40px 0 30px; }
        .hero-visual { margin-top: 36px; }
        .hero-float-card.card-c { display: none; }
        .hero-float-card.card-a { right: 10px; top: -10px; font-size: 11px; padding: 8px 12px; }
        .hero-float-card.card-b { left: 10px; bottom: -8px; font-size: 11px; padding: 8px 12px; }
        .stats-grid { grid-template-columns: 1fr; gap: 24px; }
        .stat-item .stat-number { font-size: 32px; }
        .featured-grid { grid-template-columns: 1fr 1fr; gap: 14px; }
        .featured-card .fc-title { font-size: 13px; }
        .features-grid { grid-template-columns: 1fr; }
    }

    @media (max-width: 480px) {
        .featured-grid { grid-template-columns: 1fr; }
        .hero-actions { flex-direction: column; }
        .hero-actions .btn { width: 100%; justify-content: center; }
    }
</style>
@endpush

@section('content')

<!-- ========== HERO ========== -->
<section class="hero">
    <div class="hero-eyebrow">
        <i class="fa-solid fa-bolt"></i> 🔥 Cari Iem Sesuai Genre Musik Lo!
    </div>

    <h1>
        Yok <span class="highlight">Upgrade</span> <br>Audio Lo Sekarang!
    </h1>

    <p class="hero-desc">
        Udah cape sama earphone biasa? Saatnya cobain IEM! Dijamin suara-nya mantul 🎧
        Paling lengkap, harga oke, delivery cepat ke seluruh Indo!
    </p>

    <div class="hero-actions">
        <a href="{{ route('products.index') }}" class="btn btn-yellow" style="padding: 14px 28px; font-size: 15px;">
            <i class="fa-solid fa-shopping-bag"></i> Gas Langsung
        </a>

        @guest
            <a href="{{ route('register') }}" class="btn btn-white" style="padding: 14px 28px; font-size: 15px;">
                <i class="fa-solid fa-gift"></i> Dapet Promo Cup
            </a>
        @endguest

        @auth
            @if(auth()->user()->isAdmin())
                <a href="{{ route('products.create') }}" class="btn btn-cyan" style="padding: 14px 28px; font-size: 15px;">
                    <i class="fa-solid fa-plus"></i> Tambah IEM
                </a>
            @endif
        @endauth
    </div>

    <div class="hero-visual">
        <div class="hero-image-card">
            @if($featured->count() > 0)
                <img src="{{ asset('/storage/products/'.$featured->first()->image) }}" alt="IEM Featured"
                     onerror="this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 800 450%22><rect fill=%22%23f5f0e8%22 width=%22800%22 height=%22450%22/><text x=%2250%25%22 y=%2250%25%22 dominant-baseline=%22middle%22 text-anchor=%22middle%22 font-family=%22sans-serif%22 font-size=%2224%22 fill=%22%23ccc%22>IEM Collection</text></svg>'">
            @else
                <img src="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 800 450'><rect fill='%23f5f0e8' width='800' height='450'/><text x='50%25' y='50%25' dominant-baseline='middle' text-anchor='middle' font-family='sans-serif' font-size='24' fill='%23ccc'>IEM Collection</text></svg>" alt="Placeholder">
            @endif
        </div>

        <div class="hero-float-card card-a">
            <i class="fa-solid fa-star" style="color: var(--orange);"></i> Best Seller!
        </div>
        <div class="hero-float-card card-b">
            <i class="fa-solid fa-box"></i> {{ $totalIem }}+ IEM
        </div>
        <div class="hero-float-card card-c">
            <i class="fa-solid fa-fire"></i>🔥🔥🔥 Hot!
        </div>
    </div>
</section>

<!-- ========== BRANDS MARQUEE ========== -->
<section class="brands-section" aria-label="Brand IEM">
    <div style="text-align:center; margin-bottom: 16px; font-weight: 700; font-size: 14px; color: #666;">
        ✨ Brand Favorit Semua Orang ✨
    </div>
    <div class="marquee-track">
        @php
            $brands = ['Moondrop', 'TRN', '7Hz', 'KZ', 'Tangzu', 'LETSHUOER', 'Tripowin', 'Final Audio', 'Kiwi Ears', 'Shozy', 'Etymotic', 'Oriveti', 'SpinFit', 'TRN', 'Moondrop', '7Hz', 'KZ', 'Tangzu', 'LETSHUOER', 'Tripowin', 'Final Audio', 'Kiwi Ears', 'Shozy'];
        @endphp
        @foreach ($brands as $brand)
            <span class="brand-chip">{{ $brand }}</span>
        @endforeach
    </div>
</section>

<!-- ========== FEATURED PRODUCTS ========== -->
<section>
    <div class="section-header" style="display:flex; align-items:flex-end; justify-content:space-between; flex-wrap:wrap; gap:12px;">
        <div>
            <h2>
                <span class="icon-box" style="background: var(--lime);"><i class="fa-solid fa-fire"></i></span>
               🔥 Best Seller Banget!
            </h2>
            <p>IEM yang paling banyak dibeli orang — wajib coba!</p>
        </div>
        <a href="{{ route('products.index') }}" class="section-link">
            Lihat Semua <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>

    @if($featured->count() > 0)
        <div class="featured-grid">
            @foreach ($featured as $item)
                <a href="{{ route('products.show', $item->id) }}" class="featured-card">
                    <img src="{{ asset('/storage/products/'.$item->image) }}" alt="{{ $item->title }}"
                         onerror="this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 400 300%22><rect fill=%22%23f5f0e8%22 width=%22400%22 height=%22300%22/><text x=%2250%25%22 y=%2250%25%22 dominant-baseline=%22middle%22 text-anchor=%22middle%22 font-family=%22sans-serif%22 font-size=%2216%22 fill=%22%23ccc%22>No Image</text></svg>'">
                    <div class="fc-body">
                        <div class="fc-title">{{ $item->title }}</div>
                        <div class="fc-price">{{ "Rp " . number_format($item->price, 0, ',', '.') }}</div>
                    </div>
                    <div class="fc-link">
                        <i class="fa-solid fa-eye"></i> Lihat Detail
                    </div>
                </a>
            @endforeach
        </div>
    @else
        <div class="empty-state" style="padding: 40px 20px;">
            <div class="empty-illustration" style="width: 80px; height: 80px; font-size: 32px;">
                <i class="fa-solid fa-headphones" style="color: var(--black);"></i>
            </div>
            <h3 style="font-size: 18px;">Belum ada IEM</h3>
            <p style="font-size: 13px;">Koleksi masih kosong, nantikan update terbaru!</p>
        </div>
    @endif
</section>

<!-- ========== FEATURES ========== -->
<section>
    <div class="section-header">
        <h2>
            <span class="icon-box" style="background: var(--cyan);"><i class="fa-solid fa-shield-halved"></i></span>
            🤝 Gas Bareng, Pasti Untung!
        </h2>
        <p>Kenapa banyak yang pilih belanja di sini? Ini alasannya...</p>
    </div>

    <div class="features-grid">
        <div class="feature-card">
            <div class="fc-icon" style="background: var(--yellow);"><i class="fa-solid fa-medal"></i></div>
            <h3>100% Ori & Terjamin</h3>
            <p>Gak perlu worry soal fake! Semua produk pasti ori dan passing QC ketat.</p>
        </div>

        <div class="feature-card">
            <div class="fc-icon" style="background: var(--cyan);"><i class="fa-solid fa-tags"></i></div>
            <h3>Budget Friendly</h3>
            <p>Bandingin aja sama tempat lain — harga kita paling friendly tanpa kompromi kualitas.</p>
        </div>

        <div class="feature-card">
            <div class="fc-icon" style="background: var(--pink);"><i class="fa-solid fa-headset"></i></div>
            <h3>Chat Gratis Tanpa Ribet</h3>
            <p>Ragu Pilih IEM apa? Chat aja, kitaantuin sampe ketemu yang paling Cocok!</p>
        </div>

        <div class="feature-card">
            <div class="fc-icon" style="background: var(--lime);"><i class="fa-solid fa-truck-fast"></i></div>
            <h3>Kirim Cepat ke Seluruh Indo</h3>
            <p>Order hari ini, besok sudah di jalan. Gas poll!</p>
        </div>
    </div>
</section>

<!-- ========== STATS ========== -->
<section class="stats-section">
    <div class="stats-grid">
        <div class="stat-item">
            <div class="stat-number">{{ $totalIem }}+</div>
            <div class="stat-label">IEM Tersedia</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">{{ $totalUser }}+</div>
            <div class="stat-label">Happy Customers</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">12+</div>
            <div class="stat-label">Brand Tersedia</div>
        </div>
    </div>
</section>

<!-- ========== CTA ========== -->
<section class="cta-section">
    <div class="cta-deco d1"></div>
    <div class="cta-deco d2"></div>
    <div class="cta-deco d3"></div>

    @guest
        <h2>🎉 Buruan! Daftar Sekarang Dapat Bonus!</h2>
        <p>Gak pake ribet, daftar terus langsung klaim promo-nya. Stock terbatas, buruan gas!</p>
        <div class="cta-actions">
            <a href="{{ route('register') }}" class="btn btn-dark" style="padding: 14px 28px; font-size: 15px;">
                <i class="fa-solid fa-gift"></i> Daftar Sekarang!
            </a>
            <a href="{{ route('products.index') }}" class="btn btn-white" style="padding: 14px 28px; font-size: 15px;">
                <i class="fa-solid fa-eye"></i> Cek Dulu Sini
            </a>
        </div>
    @else
        <h2>🚀 Ga Ketemu yang Cocok? Gas Cari Lagi!</h2>
        <p>Banyak lagi koleksi yang bisa lo explore. Siapa tau ada yang lebih oke!</p>
        <div class="cta-actions">
            <a href="{{ route('products.index') }}" class="btn btn-dark" style="padding: 14px 28px; font-size: 15px;">
                <i class="fa-solid fa-shopping-bag"></i> Lanjut Belanja!
            </a>
        </div>
    @endauth
</section>

@endsection