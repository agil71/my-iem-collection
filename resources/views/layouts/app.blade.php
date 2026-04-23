<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'IEM Collection') | IEM Collection</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- CKEditor (hanya dipanggil di halaman yang butuh) -->
    @stack('ckhead')

    <style>
        /* ============================================
           CSS VARIABLES
        ============================================ */
        :root {
            --bg: #FFF4E0;
            --card-bg: #FFFFFF;
            --black: #1a1a1a;
            --border: 3px solid var(--black);
            --border-light: 2px solid var(--black);
            --shadow: 6px 6px 0px var(--black);
            --shadow-sm: 4px 4px 0px var(--black);
            --shadow-hover: 2px 2px 0px var(--black);
            --radius: 14px;
            --radius-sm: 10px;
            --yellow: #FFE156;
            --pink: #FF6B9D;
            --cyan: #56E0E0;
            --lime: #B8FF56;
            --orange: #FFB347;
            --purple: #C77DFF;
            --font-main: 'Space Grotesk', sans-serif;
            --font-mono: 'Space Mono', monospace;
        }

        /* ============================================
           RESET & BASE
        ============================================ */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: var(--font-main);
            background-color: var(--bg);
            color: var(--black);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        a { color: inherit; text-decoration: none; }

        /* ============================================
           BACKGROUND
        ============================================ */
        .bg-decor {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
        }

        .bg-decor::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(var(--black) 1px, transparent 1px),
                linear-gradient(90deg, var(--black) 1px, transparent 1px);
            background-size: 50px 50px;
            opacity: 0.035;
        }

        .bg-decor .shape {
            position: absolute;
            border: var(--border-light);
            border-radius: var(--radius-sm);
        }

        .bg-decor .s1 { width: 90px; height: 90px; background: var(--yellow); opacity: 0.5; top: 6%; left: 3%; transform: rotate(-12deg); }
        .bg-decor .s2 { width: 60px; height: 60px; background: var(--cyan); opacity: 0.4; top: 12%; right: 5%; border-radius: 50%; }
        .bg-decor .s3 { width: 50px; height: 50px; background: var(--pink); opacity: 0.35; bottom: 15%; left: 6%; transform: rotate(20deg); }
        .bg-decor .s4 { width: 70px; height: 70px; background: var(--lime); opacity: 0.4; bottom: 8%; right: 4%; border-radius: 50%; }

        /* ============================================
           NAVBAR
        ============================================ */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 100;
            background: var(--card-bg);
            border-bottom: var(--border);
            box-shadow: 0 4px 0px var(--black);
        }

        .navbar-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 14px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            font-size: 18px;
            letter-spacing: -0.3px;
        }

        .brand-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px; height: 38px;
            background: var(--yellow);
            border: var(--border-light);
            border-radius: 8px;
            box-shadow: 2px 2px 0px var(--black);
            font-size: 16px;
            transition: transform 0.2s;
        }

        .brand:hover .brand-icon { transform: rotate(-8deg) scale(1.05); }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .user-badge {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            font-weight: 600;
            color: #555;
        }

        .user-avatar {
            width: 32px; height: 32px;
            background: var(--cyan);
            border: var(--border-light);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 800;
            color: var(--black);
        }

        .btn-logout {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 14px;
            background: var(--pink);
            border: var(--border-light);
            border-radius: 8px;
            box-shadow: 2px 2px 0px var(--black);
            font-family: var(--font-main);
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: box-shadow 0.15s, transform 0.15s;
            color: var(--black);
        }

        .btn-logout:hover { transform: translate(1px, 1px); box-shadow: 1px 1px 0px var(--black); }
        .btn-logout:active { transform: translate(2px, 2px); box-shadow: 0 0 0 var(--black); }

        /* ============================================
           MAIN CONTENT
        ============================================ */
        .main-content {
            position: relative;
            z-index: 1;
            flex: 1;
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
            padding: 32px 24px 60px;
        }

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
            flex-wrap: wrap;
            gap: 14px;
        }

        .page-header h1 {
            font-size: 26px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .page-header h1 i {
            margin-right: 6px;
            font-size: 22px;
        }

        /* ============================================
           BUTTONS
        ============================================ */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            border: var(--border);
            border-radius: 8px;
            font-family: var(--font-main);
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: box-shadow 0.15s, transform 0.15s;
            text-decoration: none;
            white-space: nowrap;
        }

        .btn:active { transform: translate(3px, 3px); box-shadow: 0 0 0 var(--black); }

        .btn-yellow { background: var(--yellow); box-shadow: var(--shadow-sm); color: var(--black); }
        .btn-yellow:hover { transform: translate(2px, 2px); box-shadow: var(--shadow-hover); }

        .btn-cyan { background: var(--cyan); box-shadow: var(--shadow-sm); color: var(--black); }
        .btn-cyan:hover { transform: translate(2px, 2px); box-shadow: var(--shadow-hover); }

        .btn-pink { background: var(--pink); box-shadow: var(--shadow-sm); color: var(--black); }
        .btn-pink:hover { transform: translate(2px, 2px); box-shadow: var(--shadow-hover); }

        .btn-lime { background: var(--lime); box-shadow: var(--shadow-sm); color: var(--black); }
        .btn-lime:hover { transform: translate(2px, 2px); box-shadow: var(--shadow-hover); }

        .btn-orange { background: var(--orange); box-shadow: var(--shadow-sm); color: var(--black); }
        .btn-orange:hover { transform: translate(2px, 2px); box-shadow: var(--shadow-hover); }

        .btn-white { background: var(--card-bg); box-shadow: var(--shadow-sm); color: var(--black); }
        .btn-white:hover { transform: translate(2px, 2px); box-shadow: var(--shadow-hover); }

        .btn-sm { padding: 7px 12px; font-size: 12px; border-width: var(--border-light); }

        /* ============================================
           CARDS GRID
        ============================================ */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 22px;
        }

        .iem-card {
            background: var(--card-bg);
            border: var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            transition: box-shadow 0.2s, transform 0.2s;
            animation: cardIn 0.4s ease both;
        }

        .iem-card:hover {
            transform: translate(-2px, -2px);
            box-shadow: 8px 8px 0px var(--black);
        }

        @keyframes cardIn {
            from { opacity: 0; transform: translateY(16px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .iem-card:nth-child(2) { animation-delay: 0.05s; }
        .iem-card:nth-child(3) { animation-delay: 0.1s; }
        .iem-card:nth-child(4) { animation-delay: 0.15s; }
        .iem-card:nth-child(5) { animation-delay: 0.2s; }
        .iem-card:nth-child(6) { animation-delay: 0.25s; }

        .card-image {
            width: 100%;
            aspect-ratio: 4/3;
            object-fit: cover;
            border-bottom: var(--border);
            background: #f5f0e8;
            display: block;
        }

        .card-body {
            padding: 18px;
        }

        .card-title {
            font-size: 17px;
            font-weight: 700;
            margin-bottom: 6px;
            line-height: 1.3;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .card-price {
            font-family: var(--font-mono);
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 12px;
            color: var(--black);
        }

        .card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
        }

        .card-actions {
            display: flex;
            gap: 6px;
        }

        /* ============================================
           BADGES
        ============================================ */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 10px;
            border: var(--border-light);
            border-radius: 6px;
            font-family: var(--font-mono);
            font-size: 11px;
            font-weight: 700;
        }

        .badge-lime { background: var(--lime); }
        .badge-orange { background: var(--orange); }
        .badge-pink { background: var(--pink); }
        .badge-cyan { background: var(--cyan); }
        .badge-yellow { background: var(--yellow); }

        /* ============================================
           FORM ELEMENTS
        ============================================ */
        .form-group { margin-bottom: 22px; }

        .form-label {
            display: block;
            font-family: var(--font-mono);
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
            color: var(--black);
        }

        .form-input {
            width: 100%;
            padding: 12px 14px;
            border: var(--border);
            border-radius: 8px;
            font-family: var(--font-main);
            font-size: 15px;
            background: #FAFAFA;
            color: var(--black);
            outline: none;
            transition: box-shadow 0.2s, background 0.2s, transform 0.15s;
        }

        .form-input::placeholder { color: #bbb; }

        .form-input:focus {
            background: #fff;
            box-shadow: var(--shadow-sm);
            transform: translate(-1px, -1px);
        }

        .form-input.has-error {
            border-color: var(--pink);
            background: #fff5f7;
        }

        .form-error {
            margin-top: 6px;
            font-size: 13px;
            font-weight: 600;
            color: #e03156;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .form-error i { font-size: 12px; }

        /* File Upload */
        .upload-area {
            border: var(--border);
            border-radius: var(--radius-sm);
            padding: 32px 20px;
            text-align: center;
            background: #FAFAFA;
            cursor: pointer;
            transition: box-shadow 0.2s, background 0.2s;
            position: relative;
            overflow: hidden;
        }

        .upload-area:hover { background: #fff; box-shadow: var(--shadow-sm); }
        .upload-area.has-image { padding: 0; }

        .upload-area input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
        }

        .upload-area .upload-placeholder {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            color: #999;
        }

        .upload-area .upload-placeholder i { font-size: 32px; color: #ccc; }
        .upload-area .upload-placeholder span { font-size: 13px; font-weight: 600; }

        .upload-area .upload-preview {
            width: 100%;
            aspect-ratio: 16/9;
            object-fit: cover;
            display: none;
            border-radius: var(--radius-sm);
        }

        .upload-area.has-image .upload-placeholder { display: none; }
        .upload-area.has-image .upload-preview { display: block; }

        /* Image Preview (Edit) */
        .current-image-wrapper {
            margin-bottom: 14px;
            border: var(--border);
            border-radius: var(--radius-sm);
            overflow: hidden;
            position: relative;
        }

        .current-image-wrapper img {
            width: 100%;
            max-height: 280px;
            object-fit: cover;
            display: block;
        }

        .current-image-wrapper .img-label {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 6px 12px;
            background: var(--black);
            color: #fff;
            font-family: var(--font-mono);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* ============================================
           DETAIL / SHOW PAGE
        ============================================ */
        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 28px;
            align-items: start;
        }

        .detail-image-card {
            background: var(--card-bg);
            border: var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .detail-image-card img {
            width: 100%;
            display: block;
            background: #f5f0e8;
        }

        .detail-info-card {
            background: var(--card-bg);
            border: var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 28px;
        }

        .detail-info-card h2 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .detail-price {
            font-family: var(--font-mono);
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: var(--border-light);
        }

        .detail-desc-title {
            font-family: var(--font-mono);
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 10px;
            color: #666;
        }

        .detail-desc-content {
            font-size: 15px;
            line-height: 1.7;
            color: #333;
            margin-bottom: 24px;
        }

        .detail-desc-content img { max-width: 100%; border-radius: 8px; }
        .detail-desc-content ul, .detail-desc-content ol { padding-left: 20px; margin: 8px 0; }
        .detail-desc-content li { margin-bottom: 4px; }

        .detail-meta {
            display: flex;
            align-items: center;
            gap: 12px;
            padding-top: 20px;
            border-top: var(--border-light);
        }

        /* ============================================
           EMPTY STATE
        ============================================ */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-illustration {
            width: 120px;
            height: 120px;
            margin: 0 auto 24px;
            background: var(--yellow);
            border: var(--border);
            border-radius: 50%;
            box-shadow: var(--shadow-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            animation: emptyBounce 2s ease-in-out infinite;
        }

        @keyframes emptyBounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .empty-state h3 {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .empty-state p {
            font-size: 14px;
            color: #888;
            margin-bottom: 24px;
        }

        /* ============================================
           PAGINATION
        ============================================ */
        .pagination {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin-top: 32px;
            list-style: none;
            flex-wrap: wrap;
        }

        .pagination li a,
        .pagination li span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 38px;
            height: 38px;
            padding: 0 10px;
            border: var(--border-light);
            border-radius: 8px;
            font-family: var(--font-main);
            font-size: 13px;
            font-weight: 700;
            background: var(--card-bg);
            color: var(--black);
            transition: box-shadow 0.15s, transform 0.15s;
        }

        .pagination li a:hover {
            transform: translate(-1px, -1px);
            box-shadow: var(--shadow-sm);
        }

        .pagination li.active span {
            background: var(--yellow);
            box-shadow: 2px 2px 0px var(--black);
        }

        .pagination li.disabled span {
            background: #eee;
            color: #bbb;
            border-color: #ddd;
        }

        /* ============================================
           TOAST
        ============================================ */
        .toast-container {
            position: fixed;
            top: 80px;
            right: 24px;
            z-index: 999;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .toast-msg {
            background: var(--card-bg);
            border: var(--border);
            border-radius: 8px;
            box-shadow: var(--shadow-sm);
            padding: 12px 20px;
            font-family: var(--font-main);
            font-size: 14px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: toastIn 0.4s ease;
            max-width: 340px;
        }

        .toast-msg.success { border-left: 6px solid var(--lime); }
        .toast-msg.error { border-left: 6px solid var(--pink); }
        .toast-msg.hiding { animation: toastOut 0.3s ease forwards; }

        @keyframes toastIn { from { opacity: 0; transform: translateX(40px); } to { opacity: 1; transform: translateX(0); } }
        @keyframes toastOut { from { opacity: 1; transform: translateX(0); } to { opacity: 0; transform: translateX(40px); } }

        /* ============================================
           FORM CONTAINER (Create/Edit)
        ============================================ */
        .form-container {
            background: var(--card-bg);
            border: var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 32px;
            max-width: 720px;
        }

        .form-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .form-header h2 {
            font-size: 22px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-header h2 .header-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px; height: 36px;
            border: var(--border-light);
            border-radius: 8px;
            box-shadow: 2px 2px 0px var(--black);
            font-size: 16px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .form-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            padding-top: 8px;
        }

        /* ============================================
           CKEditor wrapper
        ============================================ */
        .cke_wrapper {
            border: var(--border) !important;
            border-radius: 8px !important;
            box-shadow: none !important;
        }

        .cke_top {
            background: #FAFAFA !important;
            border-bottom: var(--border-light) !important;
        }

        /* ============================================
           RESPONSIVE
        ============================================ */
        @media (max-width: 768px) {
            .navbar-inner { padding: 12px 16px; }
            .brand { font-size: 15px; }
            .user-badge span:last-child { display: none; }
            .main-content { padding: 20px 16px 48px; }
            .page-header h1 { font-size: 22px; }
            .cards-grid { grid-template-columns: 1fr; gap: 18px; }
            .detail-grid { grid-template-columns: 1fr; gap: 20px; }
            .form-container { padding: 24px 18px; }
            .form-row { grid-template-columns: 1fr; }
            .card-footer { flex-direction: column; align-items: stretch; }
            .card-actions { justify-content: stretch; }
            .card-actions .btn { flex: 1; justify-content: center; }
        }

        @media (max-width: 480px) {
            .brand-text { display: none; }
            .pagination li a, .pagination li span { min-width: 34px; height: 34px; font-size: 12px; }
        }

        /* ============================================
           REDUCED MOTION
        ============================================ */
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>
<body>

    <!-- Background Dekorasi -->
    <div class="bg-decor" aria-hidden="true">
        <div class="shape s1"></div>
        <div class="shape s2"></div>
        <div class="shape s3"></div>
        <div class="shape s4"></div>
    </div>

    <!-- Toast Container -->
    <div class="toast-container" id="toastContainer"></div>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-inner">
            <a href="{{ route('products.index') }}" class="brand">
                <span class="brand-icon"><i class="fa-solid fa-headphones"></i></span>
                <span class="brand-text">IEM COLLECTION</span>
            </a>
            <div class="nav-right">

                @guest
                    <a href="{{ route('login') }}" class="btn btn-white btn-sm">
                        <i class="fa-solid fa-right-to-bracket"></i> Masuk
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-yellow btn-sm">
                        <i class="fa-solid fa-user-plus"></i> Daftar
                    </a>
                @endguest

                @auth
                    <div class="user-badge">
                        <span class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                        <span>{{ auth()->user()->name }}</span>
                        @if(auth()->user()->isAdmin())
                            <span class="badge badge-yellow" style="font-size:10px; padding:2px 8px;">ADMIN</span>
                        @endif
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-logout">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i> Keluar
                        </button>
                    </form>
                @endauth

            </div>
        </div>
    </nav>

    <!-- Content -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Shared Scripts -->
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false,
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Akses Ditolak',
                text: '{{ session('error') }}',
                timer: 3500,
                showConfirmButton: false,
            });
        @endif
    </script>

    @stack('scripts')
</body>
</html>