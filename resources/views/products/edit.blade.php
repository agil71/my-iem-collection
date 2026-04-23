@extends('layouts.app')

@section('title', 'Edit IEM')

@push('ckhead')
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
@endpush

@section('content')
<div class="form-container">
    <div class="form-header">
        <h2>
            <span class="header-icon" style="background: var(--cyan);"><i class="fa-solid fa-pen"></i></span>
            Edit IEM
        </h2>
        <a href="{{ route('products.index') }}" class="btn btn-white btn-sm">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
    </div>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Current Image -->
        <div class="form-group">
            <label class="form-label">Foto Saat Ini</label>
            <div class="current-image-wrapper">
                <img
                    src="{{ asset('/storage/products/'.$product->image) }}"
                    alt="{{ $product->title }}"
                    onerror="this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 400 300%22><rect fill=%22%23f5f0e8%22 width=%22400%22 height=%22300%22/><text x=%2250%25%22 y=%2250%25%22 dominant-baseline=%22middle%22 text-anchor=%22middle%22 font-family=%22sans-serif%22 font-size=%2216%22 fill=%22%23ccc%22>No Image</text></svg>'"
                >
                <div class="img-label">Foto saat ini</div>
            </div>
        </div>

        <!-- New Image Upload -->
        <div class="form-group">
            <label class="form-label">Ganti Foto (opsional)</label>
            <div class="upload-area" id="uploadArea">
                <input type="file" name="image" id="imageInput" accept="image/*">
                <div class="upload-placeholder">
                    <i class="fa-solid fa-cloud-arrow-up"></i>
                    <span>Klik untuk ganti foto</span>
                    <span style="font-size:11px; color:#bbb;">Kosongkan jika tidak ingin mengubah</span>
                </div>
                <img class="upload-preview" id="imagePreview" alt="Preview">
            </div>
            @error('image')
                <div class="form-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
            @enderror
        </div>

        <!-- Title -->
        <div class="form-group">
            <label class="form-label">Nama IEM</label>
            <input
                type="text"
                name="title"
                class="form-input @error('title') has-error @enderror"
                value="{{ old('title', $product->title) }}"
                placeholder="Contoh: Moondrop Chu 2"
                required
            >
            @error('title')
                <div class="form-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
            @enderror
        </div>

        <!-- Description -->
        <div class="form-group">
            <label class="form-label">Deskripsi / Spesifikasi</label>
            <textarea
                name="description"
                id="description"
                rows="6"
                class="form-input @error('description') has-error @enderror"
                placeholder="Driver type, frequency response, impedance, sensitivity, dll."
                required
            >{{ old('description', $product->description) }}</textarea>
            @error('description')
                <div class="form-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
            @enderror
        </div>

        <!-- Price & Stock -->
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Harga (Rp)</label>
                <input
                    type="number"
                    name="price"
                    class="form-input @error('price') has-error @enderror"
                    value="{{ old('price', $product->price) }}"
                    placeholder="450000"
                    required
                >
                @error('price')
                    <div class="form-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Stok</label>
                <input
                    type="number"
                    name="stock"
                    class="form-input @error('stock') has-error @enderror"
                    value="{{ old('stock', $product->stock) }}"
                    placeholder="10"
                    required
                >
                @error('stock')
                    <div class="form-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Actions -->
        <div class="form-actions">
            <button type="submit" class="btn btn-cyan">
                <i class="fa-solid fa-floppy-disk"></i> Update
            </button>
            <button type="reset" class="btn btn-orange">
                <i class="fa-solid fa-rotate-left"></i> Reset
            </button>
            <a href="{{ route('products.index') }}" class="btn btn-white">Batal</a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    CKEDITOR.replace('description');

    const imageInput = document.getElementById('imageInput');
    const uploadArea = document.getElementById('uploadArea');
    const imagePreview = document.getElementById('imagePreview');

    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                uploadArea.classList.add('has-image');
            };
            reader.readAsDataURL(file);
        } else {
            uploadArea.classList.remove('has-image');
        }
    });
</script>
@endpush