<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --bg: #FFF4E0;
            --card-bg: #FFFFFF;
            --black: #1a1a1a;
            --border: 3px solid var(--black);
            --shadow: 6px 6px 0px var(--black);
            --shadow-sm: 4px 4px 0px var(--black);
            --shadow-hover: 2px 2px 0px var(--black);
            --radius: 12px;
            --yellow: #FFE156;
            --pink: #FF6B9D;
            --cyan: #56E0E0;
            --lime: #B8FF56;
            --orange: #FFB347;
            --font-main: 'Space Grotesk', sans-serif;
            --font-mono: 'Space Mono', monospace;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: var(--font-main);
            background-color: var(--bg);
            color: var(--black);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            
        }

        .bg-decor { position: fixed; inset: 0; pointer-events: none; z-index: 0; overflow: hidden; }
        .bg-decor .shape { position: absolute; border: var(--border); border-radius: var(--radius); }
        .bg-decor .shape-1 { width: 100px; height: 100px; background: var(--cyan); top: 10%; left: 6%; transform: rotate(20deg); animation: float 6s ease-in-out infinite; --rot: 20deg; }
        .bg-decor .shape-2 { width: 70px; height: 70px; background: var(--lime); top: 18%; right: 8%; border-radius: 50%; animation: float 8s ease-in-out infinite reverse; --rot: 0deg; }
        .bg-decor .shape-3 { width: 90px; height: 90px; background: var(--yellow); bottom: 15%; left: 10%; border-radius: 50%; animation: float 7s ease-in-out infinite 1s; --rot: 0deg; }
        .bg-decor .shape-4 { width: 50px; height: 50px; background: var(--pink); bottom: 22%; right: 12%; transform: rotate(-30deg); animation: float 9s ease-in-out infinite 0.5s; --rot: -30deg; }
        .bg-decor .dot { position: absolute; width: 10px; height: 10px; background: var(--black); border-radius: 50%; }
        .bg-decor .dot:nth-child(5) { top: 30%; left: 50%; animation: pulse 3s infinite; }
        .bg-decor .dot:nth-child(6) { top: 65%; left: 75%; animation: pulse 3s infinite 1s; }
        .bg-decor .dot:nth-child(7) { top: 45%; left: 20%; animation: pulse 3s infinite 2s; }
        .bg-decor::after { content: ''; position: absolute; inset: 0; background-image: linear-gradient(var(--black) 1px, transparent 1px), linear-gradient(90deg, var(--black) 1px, transparent 1px); background-size: 60px 60px; opacity: 0.04; }

        @keyframes float { 0%, 100% { transform: translateY(0) rotate(var(--rot, 0deg)); } 50% { transform: translateY(-20px) rotate(var(--rot, 0deg)); } }
        @keyframes pulse { 0%, 100% { transform: scale(1); opacity: 1; } 50% { transform: scale(1.8); opacity: 0.3; } }
        @keyframes wiggle { 0%, 100% { transform: rotate(var(--wr, 15deg)); } 25% { transform: rotate(calc(var(--wr, 15deg) + 8deg)); } 75% { transform: rotate(calc(var(--wr, 15deg) - 8deg)); } }

        .auth-wrapper { position: relative; z-index: 1; width: 100%; max-width: 440px; padding: 16px; }
        .auth-card { background: var(--card-bg); border: var(--border); border-radius: var(--radius); box-shadow: var(--shadow); padding: 36px 32px; position: relative; }

        .auth-header { text-align: center; margin-bottom: 28px; }
        .auth-header .icon-badge { display: inline-flex; align-items: center; justify-content: center; width: 56px; height: 56px; border: var(--border); border-radius: var(--radius); box-shadow: var(--shadow-sm); margin-bottom: 14px; font-size: 24px; background: var(--cyan); transition: transform 0.3s ease; }
        .auth-header .icon-badge:hover { transform: rotate(-8deg) scale(1.08); }
        .auth-header h1 { font-size: 28px; font-weight: 700; letter-spacing: -0.5px; }
        .auth-header p { font-family: var(--font-mono); font-size: 13px; color: #666; margin-top: 6px; }

        .sticker { position: absolute; border: var(--border); display: flex; align-items: center; justify-content: center; font-size: 18px; z-index: 2; pointer-events: none; }
        .sticker-star { width: 36px; height: 36px; background: var(--cyan); border-radius: 8px; top: -12px; right: 20px; transform: rotate(15deg); animation: wiggle 3s ease-in-out infinite; --wr: 15deg; }
        .sticker-circle { width: 28px; height: 28px; background: var(--yellow); border-radius: 50%; bottom: -8px; left: 24px; animation: wiggle 4s ease-in-out infinite 0.5s; --wr: 0deg; }
        .sticker-diamond { width: 30px; height: 30px; background: var(--pink); top: 40%; right: -10px; transform: rotate(45deg); animation: wiggle 3.5s ease-in-out infinite 1s; --wr: 45deg; }

        .input-group { margin-bottom: 18px; }
        .input-group label { display: block; font-family: var(--font-mono); font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px; }
        .input-wrapper { position: relative; display: flex; align-items: center; }
        .input-wrapper .icon-left { position: absolute; left: 14px; z-index: 1; font-size: 15px; color: #999; transition: color 0.2s; pointer-events: none; }
        .input-wrapper input { width: 100%; padding: 12px 42px 12px 42px; border: var(--border); border-radius: 8px; font-family: var(--font-main); font-size: 15px; background: #FAFAFA; color: var(--black); outline: none; transition: box-shadow 0.2s ease, background 0.2s ease, transform 0.15s ease; }
        .input-wrapper input::placeholder { color: #bbb; }
        .input-wrapper input:focus { background: #fff; box-shadow: var(--shadow-sm); transform: translate(-1px, -1px); }
        .input-wrapper input:focus ~ .icon-left { color: var(--black); }

        .toggle-pw { position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; font-size: 15px; color: #999; padding: 4px; z-index: 2; }
        .toggle-pw:hover { color: var(--black); }

        .pw-strength { margin-top: -10px; margin-bottom: 4px; display: flex; gap: 4px; opacity: 0; transition: opacity 0.3s; }
        .pw-strength.visible { opacity: 1; }
        .pw-strength .bar { flex: 1; height: 5px; border: 2px solid var(--black); border-radius: 4px; background: transparent; transition: background 0.3s; }
        .pw-strength .bar.filled-weak { background: var(--pink); }
        .pw-strength .bar.filled-medium { background: var(--orange); }
        .pw-strength .bar.filled-strong { background: var(--lime); }
        .pw-strength-label { font-family: var(--font-mono); font-size: 11px; margin-bottom: 12px; transition: color 0.3s; color: #999; }

        .btn-submit { width: 100%; padding: 14px; border: var(--border); border-radius: 8px; font-family: var(--font-main); font-size: 16px; font-weight: 700; cursor: pointer; background: var(--cyan); box-shadow: var(--shadow); color: var(--black); transition: box-shadow 0.2s ease, transform 0.15s ease; margin-top: 6px; position: relative; overflow: hidden; }
        .btn-submit:hover { transform: translate(2px, 2px); box-shadow: var(--shadow-hover); }
        .btn-submit:active { transform: translate(4px, 4px); box-shadow: 0px 0px 0px var(--black); }
        .btn-submit::after { content: ''; position: absolute; top: -50%; left: -50%; width: 200%; height: 200%; background: linear-gradient(45deg, transparent 40%, rgba(255,255,255,0.25) 50%, transparent 60%); transform: translateX(-100%); }
        .btn-submit:hover::after { animation: shimmer 0.6s ease forwards; }
        @keyframes shimmer { to { transform: translateX(100%); } }

        .divider { display: flex; align-items: center; gap: 12px; margin: 20px 0; }
        .divider::before, .divider::after { content: ''; flex: 1; height: 2px; background: var(--black); opacity: 0.12; }
        .divider span { font-family: var(--font-mono); font-size: 11px; color: #999; text-transform: uppercase; letter-spacing: 1px; }

        .social-row { display: flex; gap: 10px; }
        .social-btn { flex: 1; padding: 11px; border: var(--border); border-radius: 8px; background: var(--card-bg); font-family: var(--font-main); font-size: 13px; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; transition: box-shadow 0.2s ease, transform 0.15s ease; color: var(--black); }
        .social-btn:hover { transform: translate(2px, 2px); box-shadow: var(--shadow-sm); }
        .social-btn:active { transform: translate(3px, 3px); box-shadow: 1px 1px 0px var(--black); }
        .social-btn i { font-size: 16px; }

        .auth-footer { text-align: center; margin-top: 20px; font-size: 14px; color: #666; }
        .auth-footer a { color: var(--black); font-weight: 700; text-decoration: none; border-bottom: 2px solid transparent; transition: border-color 0.2s; padding-bottom: 1px; }
        .auth-footer a:hover { border-bottom-color: var(--black); }

        .toast-container { position: fixed; top: 24px; right: 24px; z-index: 999; display: flex; flex-direction: column; gap: 10px; }
        .toast-msg { background: var(--card-bg); border: var(--border); border-radius: 8px; box-shadow: var(--shadow-sm); padding: 12px 20px; font-family: var(--font-main); font-size: 14px; font-weight: 600; display: flex; align-items: center; gap: 10px; animation: toastIn 0.4s ease; max-width: 320px; }
        .toast-msg.success { border-left: 6px solid var(--lime); }
        .toast-msg.error { border-left: 6px solid var(--pink); }
        .toast-msg.hiding { animation: toastOut 0.3s ease forwards; }
        @keyframes toastIn { from { opacity: 0; transform: translateX(40px); } to { opacity: 1; transform: translateX(0); } }
        @keyframes toastOut { from { opacity: 1; transform: translateX(0); } to { opacity: 0; transform: translateX(40px); } }

        .alert-error { background: #fff0f0; border: var(--border); border-left: 6px solid var(--pink); border-radius: 8px; padding: 12px 16px; margin-bottom: 20px; font-size: 14px; box-shadow: var(--shadow-sm); }
        .alert-error ul { margin: 0; padding-left: 18px; }
        .alert-error li { margin-bottom: 4px; color: #333; }

        @media (max-width: 480px) { .auth-wrapper { padding: 12px; } .auth-card { padding: 28px 20px; } .social-row { flex-direction: column; } }
        @media (prefers-reduced-motion: reduce) { *, *::before, *::after { animation-duration: 0.01ms !important; transition-duration: 0.01ms !important; } }
    </style>
</head>
<body>

    <div class="bg-decor" aria-hidden="true">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
        <div class="shape shape-4"></div>
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
    </div>

    <div class="toast-container" id="toastContainer"></div>

    <div class="auth-wrapper">
        <div class="auth-card">
            <div class="sticker sticker-star" aria-hidden="true"><i class="fa-solid fa-sparkles"></i></div>
            <div class="sticker sticker-circle" aria-hidden="true"><i class="fa-solid fa-heart" style="font-size:12px;"></i></div>
            <div class="sticker sticker-diamond" aria-hidden="true"><i class="fa-solid fa-fire" style="font-size:14px;"></i></div>

            <div class="auth-header">
                <div class="icon-badge"><i class="fa-solid fa-user-plus"></i></div>
                <h1>Daftar Akun</h1>
                <p>buat akun baru kamu</p>
            </div>

            @if($errors->any())
                <div class="alert-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" novalidate>
                @csrf

                <div class="input-group">
                    <label for="name">Nama Lengkap</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-user icon-left"></i>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="John Doe" required autocomplete="name">
                    </div>
                </div>

                <div class="input-group">
                    <label for="email">Email</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-envelope icon-left"></i>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="kamu@email.com" required autocomplete="email">
                    </div>
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-lock icon-left"></i>
                        <input type="password" name="password" id="password" placeholder="Minimal 6 karakter" required autocomplete="new-password" oninput="checkPasswordStrength(this.value)">
                        <button type="button" class="toggle-pw" onclick="togglePassword('password', this)" aria-label="Tampilkan password">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="pw-strength" id="pwStrength">
                    <div class="bar" id="pwBar1"></div>
                    <div class="bar" id="pwBar2"></div>
                    <div class="bar" id="pwBar3"></div>
                    <div class="bar" id="pwBar4"></div>
                </div>
                <div class="pw-strength-label" id="pwStrengthLabel"></div>

                <div class="input-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-shield-halved icon-left"></i>
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Ulangi password" required autocomplete="new-password">
                        <button type="button" class="toggle-pw" onclick="togglePassword('password_confirmation', this)" aria-label="Tampilkan password">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-submit">
                    <span>Daftar Sekarang</span>
                </button>

                <div class="divider"><span>atau</span></div>

                <div class="social-row">
                    <button type="button" class="social-btn" onclick="showToast('Daftar via Google berhasil!', 'success')">
                        <i class="fa-brands fa-google"></i> Google
                    </button>
                    <button type="button" class="social-btn" onclick="showToast('Daftar via GitHub berhasil!', 'success')">
                        <i class="fa-brands fa-github"></i> GitHub
                    </button>
                </div>

                <p class="auth-footer">
                    Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
                </p>
            </form>
        </div>
    </div>

    <script>
        function togglePassword(id, btn) {
            const input = document.getElementById(id);
            const icon = btn.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }

        function checkPasswordStrength(pw) {
            const bars = [
                document.getElementById('pwBar1'),
                document.getElementById('pwBar2'),
                document.getElementById('pwBar3'),
                document.getElementById('pwBar4')
            ];
            const label = document.getElementById('pwStrengthLabel');
            const container = document.getElementById('pwStrength');

            bars.forEach(b => b.className = 'bar');
            label.textContent = '';

            if (pw.length === 0) { container.classList.remove('visible'); return; }
            container.classList.add('visible');

            let score = 0;
            if (pw.length >= 6) score++;
            if (pw.length >= 10) score++;
            if (/[A-Z]/.test(pw) && /[a-z]/.test(pw)) score++;
            if (/[0-9]/.test(pw)) score++;
            if (/[^A-Za-z0-9]/.test(pw)) score++;

            let level = 0;
            if (score >= 1) level = 1;
            if (score >= 2) level = 2;
            if (score >= 3) level = 3;
            if (score >= 5) level = 4;

            const levels = [
                { cls: '', text: '', color: '#999' },
                { cls: 'filled-weak', text: 'Lemah', color: '#FF6B9D' },
                { cls: 'filled-medium', text: 'Cukup', color: '#FFB347' },
                { cls: 'filled-strong', text: 'Kuat', color: '#B8FF56' },
                { cls: 'filled-strong', text: 'Sangat Kuat', color: '#56E0E0' }
            ];

            for (let i = 0; i < level; i++) bars[i].classList.add(levels[level].cls);
            label.textContent = levels[level].text;
            label.style.color = levels[level].color;
        }

        function showToast(message, type) {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = `toast-msg ${type}`;
            const iconClass = type === 'success' ? 'fa-circle-check' : 'fa-circle-xmark';
            toast.innerHTML = `<i class="fa-solid ${iconClass}"></i> ${message}`;
            container.appendChild(toast);
            setTimeout(() => {
                toast.classList.add('hiding');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }
    </script>
</body>
</html>