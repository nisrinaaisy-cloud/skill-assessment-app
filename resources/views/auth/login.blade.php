<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Skill Assessment PT. MWT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --primary: #4B49AC;
            --primary-light: #98BDFF;
            --support-blue: #7DA0FA;
            --support-purple: #7978E9;
            --support-red: #F3797E;
            --white: #ffffff;
            --text-dark: #111B45;
            --text-muted: #CBD5E1;
            --border-glass: rgba(255,255,255,.18);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            width: 100%;
            height: 100vh;
            overflow: hidden;
            background:
                linear-gradient(rgba(9, 14, 45, .68), rgba(9, 14, 45, .70)),
                url("{{ asset('images/login-bg.jpg') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: #fff;
        }

        .page {
            width: 100%;
            height: 100vh;
            padding: 34px 46px;
            display: grid;
            grid-template-columns: 47% 53%;
            gap: 42px;
            align-items: center;
        }

        .left-panel,
        .right-panel {
            position: relative;
            height: 100%;
            min-height: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .dots-left,
        .dots-right {
            position: absolute;
            display: grid;
            grid-template-columns: repeat(5, 8px);
            gap: 14px;
            z-index: 1;
        }

        .dots-left {
            left: 28px;
            top: 24px;
        }

        .dots-right {
            right: 28px;
            top: 24px;
        }

        .dots-left span,
        .dots-right span {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: rgba(255,255,255,.55);
        }

        .login-card {
            position: relative;
            z-index: 3;
            width: min(100%, 500px);
            padding: 38px 38px 30px;
            border-radius: 28px;
            background: #fff;
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1px solid rgba(255, 255, 255, .75);
            box-shadow: 0 24px 70px rgba(0,0,0,.24);
        }

        .login-card .form-label {
            color: #111B45;
        }

        .login-card .input-group {
            background: #EEF4FF;
            border: 1px solid #D9E2F3;
        }

        .login-card .input-icon,
        .login-card .password-toggle {
            color: #6B7280;
        }

        .login-card .form-input {
            color: #111B45;
        }

        .login-card .form-input::placeholder {
            color: #8A94A8;
        }

        .login-card .remember-label {
            color: #6B7280;
        }

        .login-card .bottom-note {
            color: #6B7280;
        }

        .logo-wrap {
            text-align: center;
            margin-bottom: 15px;
        }

        .logo-wrap img {
            max-height: 78px;
            width: auto;
            object-fit: contain;
        }

        .title-line {
            width: 82px;
            height: 4px;
            border-radius: 999px;
            background: linear-gradient(90deg, var(--support-purple), var(--support-red));
            margin: 0 auto 24px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 850;
            color: #fff;
        }

        .input-group {
            position: relative;
            display: flex;
            align-items: center;
            height: 52px;
            border: 1px solid rgba(255,255,255,.18);
            border-radius: 14px;
            background: rgba(255,255,255,.10);
            overflow: hidden;
            transition: .2s ease;
        }

        .input-group:focus-within {
            border-color: rgba(152,189,255,.75);
            box-shadow: 0 0 0 3px rgba(125,160,250,.18);
            background: rgba(255,255,255,.16);
        }

        .input-icon {
            width: 48px;
            text-align: center;
            color: rgba(255,255,255,.82);
            font-size: 18px;
            flex-shrink: 0;
        }

        .form-input {
            flex: 1;
            border: none;
            outline: none;
            background: transparent;
            font-size: 14px;
            color: #fff;
            height: 100%;
            padding-right: 12px;
            font-weight: 650;
        }

        .form-input::placeholder {
            color: rgba(255,255,255,.52);
        }

        .password-toggle {
            width: 54px;
            height: 100%;
            border: none;
            background: rgba(255,255,255,.05);
            color: rgba(255,255,255,.82);
            font-size: 18px;
            cursor: pointer;
            flex-shrink: 0;
        }

        .remember-row {
            margin: 5px 0 20px;
        }

        .remember-label {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            color: rgba(255,255,255,.78);
            cursor: pointer;
        }

        .remember-label input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: var(--support-purple);
        }

        .btn-login {
            width: 100%;
            height: 54px;
            border: none;
            border-radius: 16px;
            background: linear-gradient(90deg, #6b35ff 0%, #5f7ff4 70%, #62a0ff 100%);
            color: #fff;
            font-size: 16px;
            font-weight: 900;
            cursor: pointer;
            box-shadow: 0 16px 30px rgba(91,82,220,.30);
            transition: .2s ease;
        }

        .btn-login:hover {
            transform: translateY(-1px);
            box-shadow: 0 20px 34px rgba(91,82,220,.38);
        }

        .btn-login i {
            margin-right: 8px;
        }

        .bottom-note {
            text-align: center;
            margin-top: 18px;
            font-size: 12px;
            color: rgba(255,255,255,.70);
            line-height: 1.7;
        }

        .right-content {
            position: relative;
            z-index: 3;
            width: 100%;
            max-width: 820px;
            padding: 34px 36px;
            border-radius: 32px;
            background: rgba(17, 22, 58, .40);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,.14);
            box-shadow: 0 24px 70px rgba(0,0,0,.22);
        }

        .sigma-badge {
            width: fit-content;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 999px;
            color: #fff;
            font-size: 13px;
            font-weight: 900;
            background: linear-gradient(90deg, #694dff 0%, #7978E9 55%, #F3797E 100%);
            box-shadow: 0 10px 22px rgba(105,77,255,.22);
            margin-bottom: 18px;
        }

        .hero-title {
            font-size: clamp(42px, 4.4vw, 62px);
            line-height: 1.02;
            font-weight: 950;
            letter-spacing: -1.4px;
            margin-bottom: 24px;
        }

        .hero-title .accent-purple {
            color: #fff;
        }

        .hero-title .accent-orange {
            color: var(--support-red);
        }

        .feature-list {
            display: grid;
            gap: 14px;
            margin-bottom: 16px;
        }

        .feature-card {
            min-height: 86px;
            background: rgba(255,255,255,.10);
            border: 1px solid rgba(255,255,255,.14);
            border-radius: 18px;
            padding: 15px 18px;
            display: grid;
            grid-template-columns: 56px 1fr 24px;
            align-items: center;
            gap: 16px;
            box-shadow: 0 12px 28px rgba(0,0,0,.10);
        }

        .feature-icon {
            width: 50px;
            height: 50px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 23px;
            background: linear-gradient(135deg, #6d4dff, #7DA0FA);
            color: #fff;
        }

        .feature-card.orange .feature-icon {
            background: linear-gradient(135deg, #F3797E, #FB8C9B);
        }

        .feature-title {
            font-size: 16px;
            font-weight: 900;
            color: #fff;
            margin-bottom: 4px;
        }

        .feature-desc {
            font-size: 13px;
            color: rgba(255,255,255,.76);
            line-height: 1.45;
        }

        .feature-arrow {
            font-size: 28px;
            color: #7DA0FA;
            text-align: right;
        }

        .feature-card.orange .feature-arrow {
            color: var(--support-red);
        }

        .right-summary {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
        }

        .summary-mini {
            min-height: 118px;
            padding: 17px;
            border-radius: 18px;
            background: rgba(255,255,255,.09);
            border: 1px solid rgba(255,255,255,.13);
            box-shadow: 0 12px 28px rgba(0,0,0,.10);
        }

        .summary-mini i {
            font-size: 24px;
            color: #7DA0FA;
        }

        .summary-mini b {
            display: block;
            margin-top: 11px;
            font-size: 15px;
            color: #fff;
            font-weight: 900;
        }

        .summary-mini span {
            display: block;
            margin-top: 5px;
            font-size: 12.5px;
            color: rgba(255,255,255,.72);
            line-height: 1.4;
        }

        @media (max-width: 1100px) {
            body {
                height: auto;
                overflow-y: auto;
            }

            .page {
                height: auto;
                min-height: 100vh;
                grid-template-columns: 1fr;
                padding: 24px;
            }

            .left-panel,
            .right-panel {
                height: auto;
                min-height: auto;
            }

            .right-content {
                max-width: 100%;
            }
        }

        @media (max-width: 576px) {
            .page {
                padding: 14px;
                gap: 18px;
            }

            .login-card,
            .right-content {
                border-radius: 24px;
                padding: 26px 22px;
            }

            .dots-left,
            .dots-right,
            .feature-arrow {
                display: none;
            }

            .feature-card {
                grid-template-columns: 50px 1fr;
            }

            .right-summary {
                grid-template-columns: 1fr;
            }

            .hero-title {
                font-size: 36px;
            }
        }
    </style>
</head>

<body>
    <div class="page">
        <div class="left-panel">
            <div class="dots-left">
                <span></span><span></span><span></span><span></span><span></span>
                <span></span><span></span><span></span><span></span><span></span>
                <span></span><span></span><span></span><span></span><span></span>
            </div>

            <div class="login-card">
                <div class="logo-wrap">
                    <img src="{{ asset('images/logo-mwt.png') }}" alt="Logo PT MWT">
                </div>

                <div class="title-line"></div>

                @if ($errors->has('login'))
                    <div style="background:rgba(254,226,226,.92);color:#b91c1c;border:1px solid #fecdd3;padding:12px 14px;border-radius:14px;margin-bottom:16px;font-size:13px;font-weight:700;">
                        {{ $errors->first('login') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login.process') }}">
                    @csrf

                    <div class="form-group">
                        <label class="form-label">Username</label>
                        <div class="input-group">
                            <div class="input-icon"><i class="bi bi-person"></i></div>
                            <input
                                type="text"
                                name="username"
                                class="form-input"
                                value="{{ old('username') }}"
                                placeholder="Masukkan username"
                                required
                            >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <div class="input-icon"><i class="bi bi-lock"></i></div>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-input"
                                placeholder="Masukkan password"
                                required
                            >
                            <button type="button" class="password-toggle" onclick="togglePassword()">
                                <i class="bi bi-eye" id="eyeIcon"></i>
                            </button>
                        </div>
                    </div>

                    <div class="remember-row">
                        <label class="remember-label">
                            <input type="checkbox" name="remember">
                            <span>Ingat saya</span>
                        </label>
                    </div>

                    <button type="submit" class="btn-login">
                        <i class="bi bi-box-arrow-in-right"></i>Login
                    </button>
                </form>

                <div class="bottom-note">
                    Team SIGMA · Sistem Administrasi Produksi Stamping, Welding, Machining, dan Packing
                </div>
            </div>
        </div>

        <div class="right-panel">
            <div class="dots-right">
                <span></span><span></span><span></span><span></span><span></span>
                <span></span><span></span><span></span><span></span><span></span>
                <span></span><span></span><span></span><span></span><span></span>
            </div>

            <div class="right-content">
                <div class="sigma-badge">
                    <i class="bi bi-stars"></i>
                    Team SIGMA
                </div>

                <div class="hero-title">
                    <span class="accent-purple">Skill Assessment</span>
                    <span class="accent-orange">System</span>
                </div>

                <div class="feature-list">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="bi bi-person-workspace"></i></div>
                        <div>
                            <div class="feature-title">Produksi Stamping</div>
                            <div class="feature-desc">Monitoring pengisian, penilaian, dan kontrol assessment operator stamping.</div>
                        </div>
                        <div class="feature-arrow">›</div>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon"><i class="bi bi-tools"></i></div>
                        <div>
                            <div class="feature-title">Produksi Welding</div>
                            <div class="feature-desc">Monitoring pengisian, penilaian, dan kontrol assessment operator welding.</div>
                        </div>
                        <div class="feature-arrow">›</div>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon"><i class="bi bi-gear-wide-connected"></i></div>
                        <div>
                            <div class="feature-title">Produksi Machining</div>
                            <div class="feature-desc">Monitoring pengisian, penilaian, dan kontrol assessment operator machining.</div>
                        </div>
                        <div class="feature-arrow">›</div>
                    </div>

                    <div class="feature-card orange">
                        <div class="feature-icon"><i class="bi bi-box-seam"></i></div>
                        <div>
                            <div class="feature-title">Produksi Packing</div>
                            <div class="feature-desc">Monitoring pengisian, penilaian, dan kontrol assessment operator packing.</div>
                        </div>
                        <div class="feature-arrow">›</div>
                    </div>
                </div>

                <div class="right-summary">
                    <div class="summary-mini">
                        <i class="bi bi-clipboard-check"></i>
                        <b>Assessment</b>
                        <span>Pengisian dan penilaian operator.</span>
                    </div>

                    <div class="summary-mini">
                        <i class="bi bi-person-check"></i>
                        <b>Approval</b>
                        <span>Kontrol leader, foreman, dan kabag.</span>
                    </div>

                    <div class="summary-mini">
                        <i class="bi bi-bar-chart-line"></i>
                        <b>Monitoring</b>
                        <span>Rekap hasil kompetensi produksi.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const password = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (password.type === 'password') {
                password.type = 'text';
                eyeIcon.className = 'bi bi-eye-slash';
            } else {
                password.type = 'password';
                eyeIcon.className = 'bi bi-eye';
            }
        }
    </script>
</body>
</html>