@extends('layouts.app')

@section('title', 'Koleksi IEM')

@section('content')
<div class="page-header">
    <h1><i class="fa-solid fa-headphones"></i> Koleksi IEM</h1>

    @if($isAdmin)
        <a href="{{ route('products.create') }}" class="btn btn-yellow">
            <i class="fa-solid fa-plus"></i> Tambah IEM
        </a>
    @endif
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
                        @if($p->stock > 10)
                            <span class="badge badge-lime"><i class="fa-solid fa-check"></i> Tersedia ({{ $p->stock }})</span>
                        @elseif($p->stock > 0)
                            <span class="badge badge-orange"><i class="fa-solid fa-triangle-exclamation"></i> Terbatas ({{ $p->stock }})</span>
                        @else
                            <span class="badge badge-pink"><i class="fa-solid fa-xmark"></i> Habis</span>
                        @endif

                        <div class="card-actions">
                            <a href="{{ route('products.show', $p->id) }}" class="btn btn-white btn-sm">
                                <i class="fa-solid fa-eye"></i> Detail
                            </a>

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
@endsection

@push('scripts')
<script>
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