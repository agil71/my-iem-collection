@extends('layouts.app')

@section('title', 'Tambah IEM')

@push('ckhead')
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
@endpush

@section('content')
<div class="form-container">
    <div class="form-header">
        <h2>
            <span class="header-icon" style="background: var(--yellow);"><i class="fa-solid fa-plus"></i></span>
            Tambah IEM Baru
        </h2>
        <a href="{{ route('products.index') }}" class="btn btn-white btn-sm">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
    </div>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Image Upload -->
        <div class="form-group">
            <label class="form-label">Foto IEM</label>
            <div class="upload-area" id="uploadArea">
                <input type="file" name="image" id="imageInput" accept="image/*" required>
                <div class="upload-placeholder">
                    <i class="fa-solid fa-cloud-arrow-up"></i>
                    <span>Klik atau drag foto ke sini</span>
                    <span style="font-size:11px; color:#bbb;">JPG, PNG — Maks 2MB</span>
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
                value="{{ old('title') }}"
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
            >{{ old('description') }}</textarea>
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
                    value="{{ old('price') }}"
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
                    value="{{ old('stock') }}"
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
            <button type="submit" class="btn btn-lime">
                <i class="fa-solid fa-floppy-disk"></i> Simpan
            </button>
            <a href="{{ route('products.index') }}" class="btn btn-white">Batal</a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    // CKEditor
    CKEDITOR.replace('description');

    // Image preview
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