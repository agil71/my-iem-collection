@extends('layouts.app')

@section('title', 'Koleksi IEM')

@push('home-css')
<style>
    .filters-section { margin-bottom: 24px; padding: 16px; background: var(--card-bg); border: var(--border); border-radius: var(--radius-sm); box-shadow: var(--shadow-sm); }
    .filter-row { display: flex; gap: 12px; align-items: center; flex-wrap: wrap; }
    .filter-group { display: flex; align-items: center; gap: 8px; }
    .filter-group input, .filter-group select { min-width: 140px; }
    .search-group { flex: 1; min-width: 200px; }
    .search-group input { width: 100%; }
    .price-group { display: flex; align-items: center; gap: 6px; }
    .price-group input { width: 100px; min-width: 90px; }
    .price-group span { font-weight: 600; color: var(--text-muted); }

    .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.6);
        z-index: 1000;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .modal-overlay.active { display: flex; }

    .modal-content {
        background: var(--card-bg);
        border: var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        max-width: 950px;
        width: 100%;
        max-height: 95vh;
        overflow-y: auto;
        position: relative;
        animation: modalIn 0.3s ease;
    }

    @keyframes modalIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }

    .modal-close {
        position: absolute;
        top: 16px;
        right: 16px;
        width: 36px;
        height: 36px;
        border: var(--border-light);
        border-radius: 8px;
        background: var(--card-bg);
        font-size: 18px;
        cursor: pointer;
        z-index: 10;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }

    .modal-close:hover { background: var(--pink); }

    .modal-grid {
        display: grid;
        grid-template-columns: 1fr 1.3fr;
        gap: 0;
        min-height: 500px;
    }

    .modal-image {
        background: var(--form-bg);
        border-right: var(--border-light);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modal-image img {
        width: 100%;
        height: 100%;
        max-height: 600px;
        object-fit: contain;
        display: block;
    }

    .modal-info {
        padding: 24px;
        display: flex;
        flex-direction: column;
    }

    .modal-title {
        font-size: 22px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .modal-price {
        font-family: var(--font-mono);
        font-size: 24px;
        font-weight: 700;
        color: var(--black);
        margin-bottom: 16px;
    }

    .modal-desc-title {
        font-family: var(--font-mono);
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--text-muted);
        margin-bottom: 8px;
    }

    .modal-desc {
        font-size: 14px;
        line-height: 1.7;
        color: #555;
        margin-bottom: 16px;
    }

    .modal-meta {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
    }

    .modal-stock-warning {
        background: var(--pink);
        border: var(--border);
        border-radius: 8px;
        padding: 10px 14px;
        margin-bottom: 12px;
        font-weight: 600;
        font-size: 13px;
    }

    .modal-graph {
        margin-top: 20px;
        padding: 16px;
        background: var(--form-bg);
        border-radius: var(--radius-sm);
        border: var(--border-light);
    }

    .modal-graph-title {
        font-family: var(--font-mono);
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 10px;
        color: var(--text-muted);
    }

    .modal-actions {
        display: flex;
        gap: 10px;
        margin-top: 20px;
    }

    @media (max-width: 768px) {
        .filter-row { flex-direction: column; align-items: stretch; }
        .filter-group { width: 100%; }
        .filter-group input, .filter-group select { width: 100%; }
        .price-group { width: 100%; }
        .modal-grid { grid-template-columns: 1fr; min-height: auto; }
        .modal-image { height: 280px; border-right: none; border-bottom: var(--border-light); }
        .modal-image img { max-height: 280px; }
    }
</style>
@endpush

@section('content')
<div class="page-header">
    <h1><i class="fa-solid fa-headphones"></i> Koleksi IEM</h1>

    @if($isAdmin)
        <a href="{{ route('products.create') }}" class="btn btn-yellow">
            <i class="fa-solid fa-plus"></i> Tambah IEM
        </a>
    @endif
</div>

<!-- Filters -->
<div class="filters-section">
    <form method="GET" action="{{ route('products.index') }}" class="filters-form">
        <div class="filter-row">
            <div class="filter-group search-group">
                <input
                    type="text"
                    name="search"
                    class="form-input"
                    placeholder="Cari IEM..."
                    value="{{ request('search') }}"
                >
            </div>

            <div class="filter-group">
                <select name="sound_signature" class="form-input">
                    <option value="">Semua Sound Signature</option>
                    <option value="Balanced" {{ request('sound_signature') == 'Balanced' ? 'selected' : '' }}>Balanced / Neutral</option>
                    <option value="V-Shaped" {{ request('sound_signature') == 'V-Shaped' ? 'selected' : '' }}>V-Shaped</option>
                    <option value="Warm" {{ request('sound_signature') == 'Warm' ? 'selected' : '' }}>Warm</option>
                    <option value="Bright" {{ request('sound_signature') == 'Bright' ? 'selected' : '' }}>Bright</option>
                    <option value="Basshead" {{ request('sound_signature') == 'Basshead' ? 'selected' : '' }}>Basshead</option>
                    <option value="Harman" {{ request('sound_signature') == 'Harman' ? 'selected' : '' }}>Harman-like</option>
                    <option value="U-Shaped" {{ request('sound_signature') == 'U-Shaped' ? 'selected' : '' }}>U-Shaped</option>
                    <option value="Lean" {{ request('sound_signature') == 'Lean' ? 'selected' : '' }}>Lean</option>
                </select>
            </div>

            <div class="filter-group">
                <select name="price_range" class="form-input">
                    <option value="">Semua Harga</option>
                    <option value="0-200000" {{ request('price_range') == '0-200000' ? 'selected' : '' }}>Dibawah 200rb</option>
                    <option value="200000-500000" {{ request('price_range') == '200000-500000' ? 'selected' : '' }}>200rb - 500rb</option>
                    <option value="500000-1000000" {{ request('price_range') == '500000-1000000' ? 'selected' : '' }}>500rb - 1jt</option>
                    <option value="1000000-3000000" {{ request('price_range') == '1000000-3000000' ? 'selected' : '' }}>1jt - 3jt</option>
                    <option value="3000000-999999999" {{ request('price_range') == '3000000-999999999' ? 'selected' : '' }}>Diatas 3jt</option>
                </select>
            </div>

            <div class="filter-group">
                <button type="submit" class="btn btn-yellow">
                    <i class="fa-solid fa-magnifying-glass"></i> Cari
                </button>
                <a href="{{ route('products.index') }}" class="btn btn-white">
                    <i class="fa-solid fa-rotate-left"></i> Reset
                </a>
            </div>
        </div>
    </form>
</div>

@if($products->count() > 0)
    <div class="cards-grid">
        @foreach ($products as $p)
            <div class="iem-card">
                <img
                    src="{{ asset('/storage/products/'.$p->image) }}"
                    alt="{{ $p->title }}"
                    class="card-image"
                    onerror="this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 400 300%22><rect fill=%22%23f5f0e8%22 width=%22400%22 height=%22300%22/><text x=%2250%25%22 y=%2250%25%22 dominant-baseline=%22middle%22 text-anchor=%22middle%22 font-family=%22sans-serif%22 font-size=%2216%22 fill=%22%23ccc%22>No Image</text></svg>'"
                >
                <div class="card-body">
                    <div class="card-title">{{ $p->title }}</div>
                    <div class="card-price">{{ "Rp " . number_format($p->price, 0, ',', '.') }}</div>
                    <div class="card-footer">
                        <div style="display:flex; gap:6px; flex-wrap:wrap;">
                            @if($p->stock > 10)
                                <span class="badge badge-lime"><i class="fa-solid fa-check"></i> Tersedia ({{ $p->stock }})</span>
                            @elseif($p->stock > 0)
                                <span class="badge badge-orange"><i class="fa-solid fa-triangle-exclamation"></i> Terbatas ({{ $p->stock }})</span>
                            @else
                                <span class="badge badge-pink"><i class="fa-solid fa-xmark"></i> Habis</span>
                            @endif
                            @if($p->sound_signature)
                                <span class="badge badge-cyan"><i class="fa-solid fa-music"></i> {{ $p->sound_signature }}</span>
                            @endif
                        </div>

                        <div class="card-actions">
                            <button class="btn btn-white btn-sm btn-detail" data-id="{{ $p->id }}">
                                <i class="fa-solid fa-eye"></i> Detail
                            </button>

                            @if($isAdmin)
                                <a href="{{ route('products.edit', $p->id) }}" class="btn btn-cyan btn-sm">
                                    <i class="fa-solid fa-pen"></i> Edit
                                </a>
                                <form
                                    action="{{ route('products.destroy', $p->id) }}"
                                    method="POST"
                                    class="delete-form"
                                    style="display:inline;"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-pink btn-sm">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="empty-state">
        <div class="empty-illustration">
            <i class="fa-solid fa-headphones" style="color: var(--black);"></i>
        </div>
        <h3>Belum ada IEM</h3>
        <p>Koleksi IEM masih kosong.</p>
    </div>
@endif

{{ $products->links() }}

<!-- Modal -->
<div class="modal-overlay" id="productModal">
    <div class="modal-content">
        <button class="modal-close" onclick="closeModal()">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <div class="modal-grid">
            <div class="modal-image">
                <img id="modalImage" src="" alt="">
            </div>
            <div class="modal-info">
                <h2 class="modal-title" id="modalTitle"></h2>
                <div class="modal-stock-warning" id="modalStockWarning" style="display: none;"></div>
                <div class="modal-price" id="modalPrice"></div>

                <div class="modal-desc-title">Deskripsi & Spesifikasi</div>
                <div class="modal-desc" id="modalDesc"></div>

                <div class="modal-meta" id="modalMeta"></div>

                <!-- Frequency graph hanya di halaman detail -->
                <div class="modal-graph" id="modalGraph" style="display: none;">
                    <div class="modal-graph-title"><i class="fa-solid fa-chart-line"></i> Frequency Response</div>
                    <canvas id="modalFreqChart"></canvas>
                </div>

                <a href="#" id="modalDetailLink" class="btn btn-white" style="margin-top: 10px; display: block; text-align: center;">
                    <i class="fa-solid fa-arrow-right"></i> Lihat Detail Lengkap
                </a>

                <div class="modal-actions" id="modalActions"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const productsData = @json($productsData);
    let modalChart = null;

    document.querySelectorAll('.btn-detail').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const product = productsData.find(p => p.id == id);
            if (product) showModal(product);
        });
    });

    function showModal(product) {
        document.getElementById('modalImage').src = '/storage/products/' + product.image;
        document.getElementById('modalTitle').textContent = product.title;
        document.getElementById('modalPrice').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(product.price);
        document.getElementById('modalDesc').innerHTML = (product.description && typeof product.description === 'string') ? product.description : 'Tidak ada deskripsi';

        const stockWarning = document.getElementById('modalStockWarning');
        if (product.stock > 0 && product.stock <= 5) {
            stockWarning.style.display = 'block';
            stockWarning.innerHTML = '<i class="fa-solid fa-fire"></i>🔥 Tersisa ' + product.stock + ' unit aja! Buruan sebelum kehabisan!';
        } else {
            stockWarning.style.display = 'none';
        }

        let stockBadge = '';
        if (product.stock > 10) stockBadge = '<span class="badge badge-lime"><i class="fa-solid fa-check-circle"></i> Stok Banyak</span>';
        else if (product.stock > 0) stockBadge = '<span class="badge badge-orange"><i class="fa-solid fa-triangle-exclamation"></i> Stok Terbatas!</span>';
        else stockBadge = '<span class="badge badge-pink"><i class="fa-solid fa-xmark"></i> Stok Habis</span>';

        const ssBadge = product.sound_signature ? '<span class="badge badge-cyan"><i class="fa-solid fa-music"></i> ' + product.sound_signature + '</span>' : '';
        document.getElementById('modalMeta').innerHTML = stockBadge + ' ' + ssBadge;

        // Hide graph di modal (bisa增强 dengan AJAX kalau mau)
        document.getElementById('modalGraph').style.display = 'none';
        document.getElementById('modalDetailLink').href = '/products/' + product.id;

        const actions = document.getElementById('modalActions');
        if (product.stock > 0) {
            actions.innerHTML = `
                <form action="/cart/${product.id}/add" method="POST" style="flex:1;">
                    @csrf
                    <button type="submit" class="btn btn-orange" style="width:100%; padding:14px; font-size:15px;">
                        <i class="fa-solid fa-cart-shopping"></i> 🛒 Beli Sekarang
                    </button>
                </form>
            `;
        } else {
            actions.innerHTML = `
                <div class="btn btn-pink" style="width:100%; opacity:0.7; cursor:not-allowed;">
                    <i class="fa-solid fa-face-frown"></i> Maaf, Stok Habis
                </div>
            `;
        }

        document.getElementById('productModal').classList.add('active');
    }

    function closeModal() {
        document.getElementById('productModal').classList.remove('active');
    }

    document.getElementById('productModal').addEventListener('click', function(e) {
        if (e.target === this) closeModal();
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeModal();
    });

    @if($isAdmin)
    document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Hapus IEM?',
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#FF6B9D',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    cancelButtonColor: '#999'
                }).then((result) => {
                    if (result.isConfirmed) form.submit();
                });
            });
        });
    @endif
</script>
@endpush