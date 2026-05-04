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
                    <span style="font-size:11px; color:var(--text-muted);">Kosongkan jika tidak ingin mengubah</span>
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

        <!-- Sound Signature -->
        <div class="form-group">
            <label class="form-label">Sound Signature</label>
            <select name="sound_signature" class="form-input" required>
                <option value="">-- Pilih Sound Signature --</option>
                <option value="Balanced" {{ old('sound_signature', $product->sound_signature) == 'Balanced' ? 'selected' : '' }}>Balanced / Neutral - Rata, natural</option>
                <option value="V-Shaped" {{ old('sound_signature', $product->sound_signature) == 'V-Shaped' ? 'selected' : '' }}>V-Shaped - Bass + Trebleboost</option>
                <option value="Warm" {{ old('sound_signature', $product->sound_signature) == 'Warm' ? 'selected' : '' }}>Warm - Bassbump, treble roll-off</option>
                <option value="Bright" {{ old('sound_signature', $product->sound_signature) == 'Bright' ? 'selected' : '' }}>Bright - Treble forward, detail tinggi</option>
                <option value="Basshead" {{ old('sound_signature', $product->sound_signature) == 'Basshead' ? 'selected' : '' }}>Basshead - Bass dominant, sub-bass rumble</option>
                <option value="Harman" {{ old('sound_signature', $product->sound_signature) == 'Harman' ? 'selected' : '' }}>Harman-like - Bass boost, balanced mids</option>
                <option value="U-Shaped" {{ old('sound_signature', $product->sound_signature) == 'U-Shaped' ? 'selected' : '' }}>U-Shaped - Warm, vocal forward</option>
                <option value="Lean" {{ old('sound_signature', $product->sound_signature) == 'Lean' ? 'selected' : '' }}>Lean - Min bass, treble forward</option>
            </select>
        </div>

        <!-- Frequency Response Data -->
        <div class="form-group">
            <label class="form-label">Frequency Response Graph (JSON)</label>
            <textarea
                name="frequency_data"
                class="form-input"
                rows="4"
                placeholder='[{"freq":20,"db":-12},{"freq":50,"db":-3},{"freq":100,"db":0},{"freq":500,"db":2},{"freq":1000,"db":3},{"freq":2000,"db":1},{"freq":4000,"db":-2},{"freq":8000,"db":-8},{"freq":16000,"db":-15}]'
            >{{ old('frequency_data', is_array($product->frequency_data) ? json_encode($product->frequency_data) : $product->frequency_data) }}</textarea>
            <small style="color: var(--text-muted); font-size: 12px;">
                Format: Array JSON dengan key "freq" (Hz) dan "db" (dB)
            </small>
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