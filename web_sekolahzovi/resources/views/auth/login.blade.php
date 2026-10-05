<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - SmkH3bAt!</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
        --navy-900: #0b2569;
        --navy-800: #12358c;
        --navy-700: #1b3f9a;
        --ink: #0f1f4d;
        --muted: #6b7690;
        --line: #e3e7f0;
        --field: #f6f8fc;
    }

    html, body { height: 100%; }

    body {
        font-family: 'Manrope', system-ui, -apple-system, 'Segoe UI', sans-serif;
        color: var(--ink);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 24px;
        /* Foto latar: public/images/lapangan 1.JPG (ganti nama file kalau mau foto lain) */
        background:
            linear-gradient(rgba(14, 38, 94, .55), rgba(14, 38, 94, .55)),
            url("{{ asset('images/lapangan 1.JPG') }}") center / cover no-repeat fixed;
        background-color: #1d3566;
    }

    /* ===== Kartu utama ===== */
    .login-card {
        width: 100%;
        max-width: 800px;
        min-height: 570px;
        display: grid;
        grid-template-columns: 42% 58%;
        border-radius: 28px;
        overflow: hidden;
        background: rgba(255, 255, 255, .94);
        box-shadow: 0 30px 80px rgba(5, 15, 45, .45);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
    }

    /* ===== Panel kiri ===== */
    .panel-brand {
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 32px 30px;
        color: #fff;
        background: linear-gradient(160deg, var(--navy-700) 0%, var(--navy-800) 45%, var(--navy-900) 100%);
    }

    .brand {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        font-weight: 800;
        font-size: 18px;
        letter-spacing: -.2px;
    }

    .brand-icon {
        width: 34px;
        height: 34px;
        border-radius: 10px;
        background: #fff;
        display: grid;
        place-items: center;
    }

    .brand-icon svg { width: 22px; height: 22px; }

    .brand-copy { margin-top: auto; margin-bottom: auto; }

    .brand-copy h2 {
        font-size: 21px;
        line-height: 1.4;
        font-weight: 800;
        letter-spacing: -.3px;
        max-width: 300px;
    }

    .brand-copy p {
        margin-top: 22px;
        font-size: 12.5px;
        line-height: 1.7;
        color: rgba(255, 255, 255, .72);
        max-width: 300px;
    }

    .brand-foot { display: flex; flex-direction: column; gap: 6px; }

    .back-home {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 12.5px;
        font-weight: 700;
        color: #fff;
        text-decoration: none;
        padding: 9px 14px;
        border: 1px solid rgba(255, 255, 255, .35);
        border-radius: 10px;
        transition: background .15s, border-color .15s;
    }

    .back-home:hover { background: rgba(255, 255, 255, .12); border-color: rgba(255, 255, 255, .6); }
    .back-home:focus-visible { outline: 3px solid rgba(255, 255, 255, .5); outline-offset: 2px; }
    .back-home svg { width: 14px; height: 14px; }

    /* ===== Panel kanan ===== */
    .panel-form {
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 40px 44px;
    }

    .panel-form h1 {
        font-size: 22px;
        font-weight: 800;
        letter-spacing: -.4px;
    }

    .panel-form .subtitle {
        margin-top: 6px;
        font-size: 13px;
        color: var(--muted);
    }

    .tab {
        margin-top: 26px;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        padding: 12px 0;
        font-size: 12.5px;
        font-weight: 700;
        color: var(--ink);
        border-bottom: 2px solid var(--ink);
    }

    .tab svg { width: 14px; height: 14px; }

    form { margin-top: 26px; display: flex; flex-direction: column; gap: 18px; }

    .field label,
    .label-row label {
        display: block;
        margin-bottom: 8px;
        font-size: 10.5px;
        font-weight: 800;
        letter-spacing: 1.1px;
        color: #3b4766;
        text-transform: uppercase;
    }

    .label-row {
        display: flex;
        justify-content: space-between;
        align-items: baseline;
    }

    .label-row a {
        font-size: 11.5px;
        font-weight: 700;
        color: var(--navy-800);
        text-decoration: none;
    }

    .label-row a:hover { text-decoration: underline; }

    .input-wrap { position: relative; }

    .input-wrap .icon-left {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        width: 16px;
        height: 16px;
        color: #8a94ad;
        pointer-events: none;
    }

    .input-wrap input {
        width: 100%;
        height: 48px;
        padding: 0 44px 0 40px;
        border: 1px solid var(--line);
        border-radius: 12px;
        background: var(--field);
        font-family: inherit;
        font-size: 13.5px;
        color: var(--ink);
        outline: none;
        transition: border-color .15s, box-shadow .15s, background .15s;
    }

    .input-wrap input::placeholder { color: #a3abc0; }

    .input-wrap input:focus {
        background: #fff;
        border-color: var(--navy-800);
        box-shadow: 0 0 0 4px rgba(27, 63, 154, .14);
    }

    .toggle-pass {
        position: absolute;
        right: 8px;
        top: 50%;
        transform: translateY(-50%);
        width: 34px;
        height: 34px;
        border: 0;
        background: transparent;
        color: #8a94ad;
        display: grid;
        place-items: center;
        cursor: pointer;
        border-radius: 8px;
    }

    .toggle-pass:hover { color: var(--ink); }
    .toggle-pass:focus-visible { outline: 2px solid var(--navy-800); }
    .toggle-pass svg { width: 18px; height: 18px; }

    .remember {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 12.5px;
        color: #4a5572;
        cursor: pointer;
        user-select: none;
    }

    .remember input {
        width: 16px;
        height: 16px;
        accent-color: var(--navy-800);
    }

    .btn-submit {
        height: 50px;
        border: 0;
        border-radius: 12px;
        background: var(--navy-900);
        color: #fff;
        font-family: inherit;
        font-size: 13px;
        font-weight: 800;
        letter-spacing: 1.4px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        cursor: pointer;
        box-shadow: 0 10px 22px rgba(11, 37, 105, .28);
        transition: transform .15s, box-shadow .15s, background .15s;
    }

    .btn-submit:hover { background: #0e2f84; transform: translateY(-1px); }
    .btn-submit:active { transform: translateY(0); }
    .btn-submit:focus-visible { outline: 3px solid rgba(27, 63, 154, .4); outline-offset: 2px; }
    .btn-submit svg { width: 16px; height: 16px; }

    .footer-note {
        margin-top: 26px;
        text-align: center;
        font-size: 12px;
        color: var(--muted);
    }

    .footer-note a {
        color: var(--navy-800);
        font-weight: 700;
        text-decoration: none;
    }

    .footer-note a:hover { text-decoration: underline; }

    .alert-error {
        padding: 10px 14px;
        border-radius: 10px;
        background: #fdecec;
        color: #b42318;
        font-size: 12.5px;
        font-weight: 600;
    }

    /* ===== Responsif ===== */
    @media (max-width: 860px) {
        .login-card { grid-template-columns: 1fr; max-width: 460px; }
        .panel-brand { display: none; }
        .panel-form { padding: 40px 28px; }
    }
    </style>
</head>
<body>

    <main class="login-card">

{{-- ===== Panel kiri ===== --}}
        <section class="panel-brand">
            <div class="brand">
                <img src="{{ asset('images/logo sekolah.jpg') }}" alt="Logo SMK" class="brand-logo" style="height: 35px; width: auto; margin-right: 8px;">
                SmkH3bAt!
            </div>

            <div class="brand-copy">
                <h2>&ldquo;SMKN 4 Bogor, Langkah Awal Menuju Masa Depan Gemilang.&rdquo;</h2>
                <p>Tenaga pendidik yang profesional, fasilitas pembelajaran yang memadai, serta kerja sama dengan dunia usaha dan dunia industri. SMKN 4 Bogor memberikan peserta didik bekal, melanjutkan pendidikan, maupun langsung berkarier.</p>
            </div>

            <div class="brand-foot">
                <a href="{{ route('home') }}" class="back-home">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M19 12H5M11 18l-6-6 6-6"/>
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>
        </section>

        {{-- ===== Panel kanan ===== --}}
        <section class="panel-form">
            <h1>Selamat Datang</h1>
            <p class="subtitle">Kelola portal yang dipersonalisasi untuk Anda di bawah ini.</p>

            <div class="tab">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <circle cx="12" cy="8" r="4"/>
                    <path d="M4 21c0-4 3.6-7 8-7s8 3 8 7"/>
                </svg>
                Login Admin
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                @if ($errors->any())
                    <div class="alert-error" role="alert">{{ $errors->first() }}</div>
                @endif

                <div class="field">
                    <label for="email">Nama Pengguna atau Email</label>
                    <div class="input-wrap">
                        <svg class="icon-left" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <circle cx="12" cy="12" r="4"/>
                            <path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-4 8"/>
                        </svg>
                        <input type="text" id="email" name="email" value="{{ old('email') }}"
                               placeholder="nama@smkn4bogor.sch.id" autocomplete="username" required autofocus>
                    </div>
                </div>

                <div class="field">
                    <div class="label-row">
                        <label for="password">Kata Sandi</label>
                        <a href="https://wa.me/62XXXXXXXXXXX?text=Halo%20Admin%2C%20saya%20lupa%20kata%20sandi%20akun%20SmkH3bAt%21" target="_blank" rel="noopener">lupa sandi?</a>
                    </div>
                    <div class="input-wrap">
                        <svg class="icon-left" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <rect x="4" y="11" width="16" height="10" rx="2"/>
                            <path d="M8 11V7a4 4 0 0 1 8 0v4"/>
                        </svg>
                        <input type="password" id="password" name="password"
                               placeholder="••••••••" autocomplete="current-password" required>
                        <button type="button" class="toggle-pass" id="togglePass" aria-label="Tampilkan kata sandi">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7S2 12 2 12Z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <label class="remember">
                    <input type="checkbox" name="remember">
                    Tetap masuk di perangkat ini
                </label>

                <button type="submit" class="btn-submit">
                    MASUK
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M5 12h14M13 6l6 6-6 6"/>
                    </svg>
                </button>
            </form>

            <p class="footer-note">Belum punya akun? <a href="https://wa.me/62XXXXXXXXXXX?text=Halo%20Admin%2C%20saya%20ingin%20meminta%20akun%20SmkH3bAt%21" target="_blank" rel="noopener">Hubungi Admin</a></p>
        </section>

    </main>

    <script>
        (function () {
            var btn = document.getElementById('togglePass');
            var input = document.getElementById('password');
            btn.addEventListener('click', function () {
                var show = input.type === 'password';
                input.type = show ? 'text' : 'password';
                btn.setAttribute('aria-label', show ? 'Sembunyikan kata sandi' : 'Tampilkan kata sandi');
            });
        })();
    </script>
</body>
</html>