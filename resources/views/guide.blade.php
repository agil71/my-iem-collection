@extends('layouts.app')

@section('title', 'Panduan IEM')

@push('home-css')
<style>
    .guide-intro { text-align:center; margin-bottom:48px; }
    .guide-intro h1 { font-size:32px; font-weight:700; letter-spacing:-1px; margin-bottom:12px; }
    .guide-intro p { font-size:16px; color:#666; max-width:600px; margin:0 auto; line-height:1.7; }

    .guide-section { margin-bottom:48px; }
    .guide-section-title {
        display:flex; align-items:center; gap:10px; font-size:20px; font-weight:700;
        margin-bottom:20px; padding-bottom:12px; border-bottom:var(--border-light);
    }
    .guide-section-title .gs-icon {
        width:36px; height:36px; border:var(--border-light); border-radius:8px;
        box-shadow:2px 2px 0px var(--black); display:flex; align-items:center;
        justify-content:center; font-size:16px; flex-shrink:0;
    }

    .guide-cards { display:grid; grid-template-columns:repeat(auto-fill, minmax(280px, 1fr)); gap:18px; }
    .guide-card {
        background:var(--card-bg); border:var(--border); border-radius:var(--radius-sm);
        box-shadow:var(--shadow-sm); padding:24px; transition:box-shadow 0.2s, transform 0.2s;
    }
    .guide-card:hover { transform:translate(-2px,-2px); box-shadow:var(--shadow); }
    .guide-card h3 { font-size:16px; font-weight:700; margin-bottom:8px; }
    .guide-card p { font-size:13px; color:#555; line-height:1.7; }

    .vs-table {
        width:100%; border-collapse:separate; border-spacing:0;
        background:var(--card-bg); border:var(--border); border-radius:var(--radius-sm);
        box-shadow:var(--shadow-sm); overflow:hidden;
    }
    .vs-table th {
        padding:14px 18px; text-align:left; font-family:var(--font-mono); font-size:12px;
        font-weight:700; text-transform:uppercase; letter-spacing:0.5px;
        background:#f5f5f5; border-bottom:var(--border-light);
    }
    html[data-theme="dark"] .vs-table th { background:#333; }
    .vs-table td {
        padding:14px 18px; font-size:14px; border-bottom:2px solid #eee;
    }
    html[data-theme="dark"] .vs-table td { border-bottom-color:#444; }
    .vs-table tr:last-child td { border-bottom:none; }

    .term-row { display:flex; gap:16px; align-items:flex-start; margin-bottom:16px; }
    .term-badge {
        flex-shrink:0; padding:6px 14px; border:var(--border-light); border-radius:6px;
        font-family:var(--font-mono); font-size:12px; font-weight:700; background:var(--yellow);
        min-width:120px; text-align:center;
    }
    .term-desc { font-size:14px; color:#444; line-height:1.6; }
    html[data-theme="dark"] .term-desc { color:#bbb; }

    @media (max-width:640px) {
        .guide-cards { grid-template-columns:1fr; }
        .vs-table { font-size:13px; }
        .vs-table th, .vs-table td { padding:10px 12px; }
    }
</style>
@endpush

@section('content')

<div class="guide-intro">
    <h1><i class="fa-solid fa-book-open" style="margin-right:8px;"></i> Panduan Dunia IEM</h1>
    <p>Baru kenal IEM? Jangan bingung. Panduan ini akan membantumu memahami istilah-istilah dan cara memilih IEM yang tepat.</p>
</div>

<!-- APA ITU IEM -->
<div class="guide-section">
    <div class="guide-section-title">
        <span class="gs-icon" style="background:var(--yellow);"><i class="fa-solid fa-headphones"></i></span>
        Apa Itu IEM?
    </div>
    <div class="guide-cards">
        <div class="guide-card">
            <h3> ear Monitor (IEM)</h3>
            <p>IEM adalah earphone yang dimasukkan <strong>menembus saluran telinga</strong> (ear canal), memberikan isolasi suara yang jauh lebih baik daripada earbud biasa. Awalnya dipakai musisi di atas panggung untuk monitoring.</p>
        </div>
        <div class="guide-card">
            <h3>Kenapa Bukan Earbud Biasa?</h3>
            <p>Earbud biasa hanya "numpang" di lubang telinga. IEM menyegel telinga, mengisolasi noise sekitar hingga -26dB. Hasilnya: detail musik terdengar jauh lebih jelas, bass lebih kencang, dan volume bisa lebih rendah (lebih aman untuk pendengaran).</p>
        </div>
    </div>
</div>

<!-- IEM VS EARBUD -->
<div class="guide-section">
    <div class="guide-section-title">
        <span class="gs-icon" style="background:var(--cyan);"><i class="fa-solid fa-code-compare"></i></span>
        IEM vs Earbud Biasa
    </div>
    <table class="vs-table">
        <thead>
            <tr><th>Aspek</th><th>Earbud Biasa</th><th>IEM</th></tr>
        </thead>
        <tbody>
            <tr><td><strong>Noise Isolation</strong></td><td>Rendah (~-5dB)</td><td><strong>Tinggi</strong> (~-26dB)</td></tr>
            <tr><td><strong>Detail Audio</strong></td><td>Standar</td><td><strong>Sangat Detail</strong></td></tr>
            <tr><td><strong>Bass Response</strong></td><td>Mengebor</td><td><strong>Tight & Akurat</strong></td></tr>
            <tr><td><strong>Soundstage</strong></td><td>Lebar (terbuka)</td><td>Dalam (tertutup)</td></tr>
            <tr><td><strong>Comfort</strong></td><td>Sangat nyaman</td><td>Perlu adaptasi</td></tr>
            <tr><td><strong>Harga</strong></td><td>Murah - Menengah</td><td>Menengah - Mahal</td></tr>
        </tbody>
    </table>
</div>

<!-- JENIS DRIVER -->
<div class="guide-section">
    <div class="guide-section-title">
        <span class="gs-icon" style="background:var(--lime);"><i class="fa-solid fa-gears"></i></span>
        Jenis-Jenis Driver
    </div>
    <div class="guide-cards">
        <div class="guide-card">
            <h3 style="color:#FF6B9D;"><i class="fa-solid fa-circle" style="font-size:10px; margin-right:6px;"></i> Dynamic Driver (DD)</h3>
            <p>Menggunakan diafragma yang bergetar. Karakter: bass powerful, punchy, dan fun. Paling umum ditemui. Contoh: Moondrop Chu 2, TRN BAX.</p>
        </div>
        <div class="guide-card">
            <h3 style="color:#56E0E0;"><i class="fa-solid fa-diamond" style="font-size:10px; margin-right:6px;"></i> Balanced Armature (BA)</h3>
            <p>Menggunakan kristal kecil yang bergetar. Karakter: detail tinggi, treble bersih, bass cepat. Sering dikombinasikan (multi-BA). Contoh: Etymotic ER2XR.</p>
        </div>
        <div class="guide-card">
            <h3 style="color:#C77DFF;"><i class="fa-solid fa-layer-group" style="font-size:10px; margin-right:6px;"></i> Planar Magnetic</h3>
            <p>Menggunakan membran tipis berlapis magnet. Karakter: sangat cepat, detail ekstrem, bass sangat akurat. Masih langka & mahal. Contoh: letshuoer S12.</p>
        </div>
        <div class="guide-card">
            <h3 style="color:#FFB347;"><i class="fa-solid fa-puzzle-piece" style="font-size:10px; margin-right:6px;"></i> Hybrid</h3>
            <p>Kombinasi 2+ jenis driver dalam satu IEM. Biasanya DD untuk bass + BA untuk mid/treble. Memberikan yang terbaik dari dua dunia. Contoh: Kiwi Ears Orchestra Lite.</p>
        </div>
    </div>
</div>

<!-- ISTILAH PENTING -->
<div class="guide-section">
    <div class="guide-section-title">
        <span class="gs-icon" style="background:var(--pink);"><i class="fa-solid fa-spell-check"></i></span>
        Istilah Penting yang Wajib Tahu
    </div>
    
    <div class="term-row">
        <span class="term-badge">Impedance</span>
        <div class="term-desc"><strong>Hambatan listrik</strong> (dalam Ohm/Ω). Semakin tinggi = butuh tenaga lebih besar. IEM 16-32Ω bisa langsung dipakai di HP. Di atas 50Ω butuh DAC/Amp.</div>
    </div>
    <div class="term-row">
        <span class="term-badge">Sensitivity</span>
        <div class="term-desc"><strong>Seberapa keras suara</strong> dengan 1mW daya (dalam dB/mW). Semakin tinggi = semakin keras. IEM umumnya 100-120 dB/mW.</div>
    </div>
    <div class="term-row">
        <span class="term-badge">Freq. Response</span>
        <div class="term-desc"><strong>Rentang frekuensi</strong> yang bisa diproduksi IEM (misal 20Hz-20kHz). 20Hz = sub-bass terdalam, 20kHz = treble tertinggi yang bisa didengar manusia.</div>
    </div>
    <div class="term-row">
        <span class="term-badge">THD</span>
        <div class="term-desc"><strong>Total Harmonic Distortion</strong>. Semakin rendah = suara makin bersih (mendekati aslinya). IEM bagus biasanya <1%.</div>
    </div>
    <div class="term-row">
        <span class="term-badge">Soundstage</span>
        <div class="term-desc"><strong>Kesan ruangan</strong> dari musik. IEM cenderung "dalam" (seperti musik di kepala), tapi IEM berkualitas bisa terasa luas.</div>
    </div>
    <div class="term-row">
        <span class="term-badge">DAC/Amp</span>
        <div class="term-desc"><strong>Digital-to-Analog Converter + Amplifier</strong>. Perangkat eksternal untuk meningkatkan kualitas audio dari HP/laptop. Tidak selalu wajib.</div>
    </div>
</div>

<!-- SOUND SIGNATURE -->
<div class="guide-section">
    <div class="guide-section-title">
        <span class="gs-icon" style="background:var(--yellow);"><i class="fa-solid fa-wave-square"></i></span>
        Sound Signature (Karakter Suara)
    </div>
    <p style="font-size:14px; color:#666; margin-bottom:20px;">Setiap IEM punya "cara" memainkan musik. Ini disebut sound signature. Kenali mana yang kamu suka:</p>
    
    <div class="guide-cards">
        <div class="guide-card" style="border-left:6px solid #FF6B9D;">
            <h3 style="color:#FF6B9D;">Basshead</h3>
            <p>Bass sangat dominan, menggelegar, sub-bass dalam. Cocok untuk: EDM, Hip-Hop, D&B. <strong>Tidak cocok</strong> untuk musik akustik.</p>
        </div>
        <div class="guide-card" style="border-left:6px solid #FFB347;">
            <h3 style="color:#FFB347;">V-Shape</h3>
            <p>Bass dan treble naik, mid sedikit mundur. Paling "fun" dan umum. Musik terasa hidup dan energik. Pilihan aman untuk pertama kali.</p>
        </div>
        <div class="guide-card" style="border-left:6px solid #56E0E0;">
            <h3 style="color:#56E0E0;">Balanced / Neutral</h3>
            <p>Semua frekuensi rata. Suara apa adanya, seperti yang direkam engineer. Cocok untuk: monitoring, classical, jazz, semua genre.</p>
        </div>
        <div class="guide-card" style="border-left:6px solid #B8FF56;">
            <h3 style="color:#668800;">Warm</h3>
            <p>Mid menonjol, treble diredam. Vokal terasa intim dan tebal. Cocok untuk: vocal, ballad, lo-fi, podcast.</p>
        </div>
        <div class="guide-card" style="border-left:6px solid #FFE156;">
            <h3 style="color:#998800;">Bright</h3>
            <p>Treble menonjol, detail tinggi. Semua instrumen terdengar jelas. Cocok untuk: rock, metal, orchestral. <strong>Warning:</strong> bisa sibilant (sssh) jika treble terlalu tajam.</p>
        </div>
        <div class="guide-card" style="border-left:6px solid #C77DFF;">
            <h3 style="color:#C77DFF;">Analytical</h3>
            <p>Ultra detail, flat, presisi. Seperti "mikroskop audio". Cocok untuk: critical listening, mixing, review. Bisa terasa "boring" untuk casual listening.</p>
        </div>
    </div>
</div>

<!-- TIPS MEMILIH -->
<div class="guide-section">
    <div class="guide-section-title">
        <span class="gs-icon" style="background:var(--lime);"><i class="fa-solid fa-lightbulb"></i></span>
        Tips Memilih IEM Pertamamu
    </div>
    <div class="guide-cards">
        <div class="guide-card">
            <h3><span style="background:var(--yellow); border:var(--border-light); border-radius:4px; padding:2px 6px; font-size:12px; margin-right:6px;">01</span> Tentukan Budget</h3>
            <p>IEM bagus itu relatif. Di bawah 200rb sudah ada yang sangat worth it (KZ, TRN). 300-700rb adalah sweet spot. Di atas 1jt adalah territory audiophile serius.</p>
        </div>
        <div class="guide-card">
            <h3><span style="background:var(--cyan); border:var(--border-light); border-radius:4px; padding:2px 6px; font-size:12px; margin-right:6px;">02</span> Kenali Genre Musikmu</h3>
            <p>Dengar EDM? Cari Basshead/V-Shape. Dengar vocal? Cari Warm. Dengar semua genre? Cari Balanced. Jangan beli IEM analytical kalau kamu cuma denger pop.</p>
        </div>
        <div class="guide-card">
            <h3><span style="background:var(--pink); border:var(--border-light); border-radius:4px; padding:2px 6px; font-size:12px; margin-right:6px;">03</span> Cek Kompatibilitas</h3>
            <p>Pastikan impedansi IEM cocok dengan sumber audio-mu. HP biasa? Pilih 16-32Ω. Pakai DAC/Amp? Bisa pilih yang lebih tinggi.</p>
        </div>
        <div class="guide-card">
            <h3><span style="background:var(--lime); border:var(--border-light); border-radius:4px; padding:2px 6px; font-size:12px; margin-right:6px;">04</span> Baca Review, Bukan Cuman Spesifikasi</h3>
            <p>Spesifikasi di kertas tidak mencerminkan pengalaman mendengar. Baca review di YouTube atau forum (Head-Fi, Reddit r/IEMs) untuk perspektif nyata.</p>
        </div>
    </div>
</div>

<!-- CTA -->
<div style="text-align:center; margin-top:40px;">
    <a href="{{ route('products.index') }}" class="btn btn-yellow" style="padding:14px 32px; font-size:16px;">
        <i class="fa-solid fa-headphones"></i> Langsung Jelajahi Koleksi
    </a>
</div>

@endsection