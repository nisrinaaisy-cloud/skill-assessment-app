<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MWT Digital Portal</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --primary: #4B49AC;
            --primary-soft: #F3F2FF;
            --secondary: #98BDFF;
            --blue: #7DA0FA;
            --purple: #7978E9;
            --pink: #F3797E;
            --pink-soft: #FDEEEF;
            --text: #142341;
            --muted: #65738F;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            height: 100vh;
            overflow: hidden;
            font-family: 'Segoe UI', sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at 12% 12%, rgba(152,189,255,.36), transparent 28%),
                radial-gradient(circle at 88% 18%, rgba(121,120,233,.22), transparent 30%),
                radial-gradient(circle at 55% 100%, rgba(243,121,126,.13), transparent 30%),
                linear-gradient(135deg, #F4F7FF 0%, #F8F7FF 48%, #FFF8FA 100%);
        }

        .page {
            height: 100vh;
            padding: 12px 24px;
            display: grid;
            grid-template-rows: 58px minmax(0, 1fr) 150px;
            gap: 12px;
        }

        .topbar {
            border-radius: 20px;
            background: rgba(255,255,255,.92);
            border: 1px solid rgba(213,220,242,.9);
            box-shadow: 0 12px 26px rgba(52,49,120,.075);
            backdrop-filter: blur(10px);
            padding: 0 18px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .brand img {
            width: 74px;
            height: 39px;
            object-fit: contain;
            background: #fff;
            border-radius: 12px;
            padding: 5px;
            border: 1px solid #EEF2FF;
        }

        .brand h1 {
            margin: 0;
            font-size: 22px;
            line-height: 1;
            font-weight: 950;
            color: #0D2363;
        }

        .brand p {
            margin: 4px 0 0;
            font-size: 12px;
            font-weight: 850;
            color: #395078;
        }

        .top-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .top-pill {
            height: 38px;
            padding: 0 17px;
            border-radius: 999px;
            background: #F4F2FF;
            border: 1px solid rgba(75,73,172,.16);
            color: var(--primary);
            font-size: 13px;
            font-weight: 950;
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            white-space: nowrap;
        }

        .hero-row {
            min-height: 0;
            display: grid;
            grid-template-columns: 1fr 1.08fr;
            gap: 14px;
        }

        .hero-card {
            position: relative;
            overflow: hidden;
            border-radius: 24px;
            color: white;
            padding: 22px 24px;
            background:
                radial-gradient(circle at 88% 8%, rgba(152,189,255,.20), transparent 32%),
                radial-gradient(circle at 58% 58%, rgba(121,120,233,.18), transparent 35%),
                linear-gradient(135deg, #111C5C 0%, #2E328B 46%, #5E5BE7 100%);
            box-shadow: 0 20px 46px rgba(52,49,120,.22);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 12px;
        }

        .badge-main {
            width: fit-content;
            padding: 8px 16px;
            border-radius: 999px;
            background: rgba(255,255,255,.13);
            border: 1px solid rgba(255,255,255,.24);
            font-size: 12px;
            font-weight: 950;
            letter-spacing: .4px;
            text-transform: uppercase;
            flex: 0 0 auto;
        }

        .hero-content {
            flex: 0 0 auto;
        }

        .hero-content h2 {
            font-size: clamp(30px, 2.45vw, 41px);
            line-height: 1.08;
            font-weight: 950;
            margin: 0 0 10px;
            letter-spacing: -.8px;
        }

        .hero-content h2 span {
            display: block;
            color: #B7C9FF;
        }

        .hero-content p {
            max-width: 760px;
            margin: 0;
            color: rgba(255,255,255,.92);
            font-size: clamp(13px, .95vw, 14.5px);
            line-height: 1.45;
            font-weight: 600;
        }

        .process-strip {
            flex: 0 0 auto;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }

        .process-item {
            min-height: 78px;
            border-radius: 16px;
            padding: 10px;
            background: rgba(255,255,255,.11);
            border: 1px solid rgba(255,255,255,.18);
            display: grid;
            grid-template-columns: 34px 1fr;
            gap: 9px;
            align-items: center;
            position: relative;
        }

        .process-num {
            position: absolute;
            top: 7px;
            right: 9px;
            font-size: 10px;
            font-weight: 950;
            color: rgba(255,255,255,.65);
        }

        .process-icon {
            width: 34px;
            height: 34px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--blue), var(--secondary));
            color: white;
            font-size: 16px;
        }

        .process-item:nth-child(4) .process-icon {
            background: linear-gradient(135deg, var(--pink), #FB8C9B);
        }

        .process-item b {
            display: block;
            font-size: 12px;
            font-weight: 950;
            margin-bottom: 2px;
        }

        .process-item span {
            display: block;
            font-size: 10px;
            line-height: 1.22;
            color: rgba(255,255,255,.78);
            font-weight: 650;
        }

        .feature-row {
            flex: 0 0 auto;
            padding-top: 10px;
            border-top: 1px solid rgba(255,255,255,.18);
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }

        .feature-box {
            min-height: 66px;
            border-radius: 17px;
            padding: 10px;
            background: rgba(255,255,255,.11);
            border: 1px solid rgba(255,255,255,.17);
            display: grid;
            grid-template-columns: 44px 1fr;
            align-items: center;
            gap: 10px;
        }

        .feature-icon {
            width: 44px;
            height: 44px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
        }

        .feature-box:nth-child(1) .feature-icon {
            background: linear-gradient(135deg, var(--primary), var(--purple));
        }

        .feature-box:nth-child(2) .feature-icon {
            background: linear-gradient(135deg, var(--blue), var(--secondary));
        }

        .feature-box:nth-child(3) .feature-icon {
            background: linear-gradient(135deg, var(--pink), #FB8C9B);
        }

        .feature-box h4 {
            margin: 0 0 3px;
            font-size: 13px;
            font-weight: 950;
        }

        .feature-box p {
            margin: 0;
            font-size: 10.8px;
            line-height: 1.28;
            color: rgba(255,255,255,.86);
            font-weight: 600;
        }

        .photo-card {
            position: relative;
            overflow: hidden;
            border-radius: 24px;
            box-shadow: 0 20px 46px rgba(52,49,120,.18);
            border: 1px solid rgba(255,255,255,.65);
            background: #fff;
            min-height: 0;
        }

        .photo-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .photo-card::after {
            content: "";
            position: absolute;
            inset: auto 0 0 0;
            height: 34%;
            background: linear-gradient(0deg, rgba(16,22,54,.88), rgba(16,22,54,.08));
        }

        .photo-caption {
            position: absolute;
            left: 28px;
            right: 28px;
            bottom: 22px;
            z-index: 2;
            color: white;
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .caption-icon {
            width: 58px;
            height: 58px;
            flex: 0 0 58px;
            border-radius: 21px;
            background: linear-gradient(135deg, var(--primary), var(--blue));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            box-shadow: 0 18px 36px rgba(0,0,0,.20);
        }

        .photo-caption h3 {
            font-size: 23px;
            font-weight: 950;
            margin: 0 0 5px;
        }

        .photo-caption p {
            margin: 0;
            font-size: 15px;
            line-height: 1.45;
            font-weight: 600;
            color: rgba(255,255,255,.90);
        }

        .system-section {
            border-radius: 22px;
            background: rgba(255,255,255,.90);
            border: 1px solid rgba(213,220,242,.88);
            box-shadow: 0 14px 30px rgba(52,49,120,.075);
            backdrop-filter: blur(10px);
            padding: 12px 18px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            overflow: hidden;
        }

        .system-card {
            position: relative;
            overflow: hidden;
            border-radius: 18px;
            padding: 12px 16px;
            display: grid;
            grid-template-columns: 58px 1fr 150px;
            align-items: center;
            gap: 14px;
            text-decoration: none;
            color: var(--text);
            background: #fff;
            border: 1px solid #E2E8FF;
            box-shadow: 0 10px 24px rgba(52,49,120,.06);
        }

        .system-card:hover {
            transform: translateY(-3px);
            color: var(--text);
            box-shadow: 0 18px 35px rgba(75,73,172,.13);
        }

        .system-card::before {
            content: "";
            position: absolute;
            right: -42px;
            top: -42px;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            opacity: .13;
        }

        .system-card.assessment::before { background: var(--primary); }
        .system-card.safety::before { background: var(--blue); }
        .system-card.verify::before { background: var(--pink); }

        .system-icon {
            width: 58px;
            height: 58px;
            border-radius: 17px;
            font-size: 28px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 14px 24px rgba(52,49,120,.14);
        }

        .assessment .system-icon {
            background: linear-gradient(135deg, var(--primary), var(--purple));
        }

        .safety .system-icon {
            background: linear-gradient(135deg, var(--blue), var(--secondary));
        }

        .verify .system-icon {
            background: linear-gradient(135deg, var(--pink), #FB8C9B);
        }

        .system-content {
            min-width: 0;
        }

        .system-card h3 {
            margin: 0 0 4px;
            font-size: 18px;
            line-height: 1.08;
            font-weight: 950;
            color: #0D1B46;
        }

        .system-card p {
            margin: 0;
            font-size: 12.5px;
            line-height: 1.35;
            color: #365074;
            font-weight: 600;
        }

        .system-action {
            position: relative;
            z-index: 3;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 10px;
        }

        .status {
            border-radius: 999px;
            padding: 6px 11px;
            font-size: 10px;
            font-weight: 950;
        }

        .assessment .status {
            background: var(--primary-soft);
            color: var(--primary);
        }

        .safety .status {
            background: #EEF4FF;
            color: #1A6BFF;
        }

        .verify .status {
            background: var(--pink-soft);
            color: #C83F59;
        }

        .system-button {
            width: 145px;
            height: 42px;
            border-radius: 999px;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 13px;
            font-weight: 950;
            color: #fff;
            box-shadow: 0 12px 22px rgba(52,49,120,.20);
        }

        .assessment .system-button {
            background: linear-gradient(135deg, var(--primary), var(--purple));
        }

        .safety .system-button {
            background: linear-gradient(135deg, var(--blue), var(--secondary));
        }

        .verify .system-button {
            background: linear-gradient(135deg, var(--pink), #FB8C9B);
        }

        .disabled-card {
            cursor: not-allowed;
        }

        .disabled-card .system-button {
            opacity: .75;
            pointer-events: none;
        }

        @media (max-width: 900px) {
            body {
                height: auto;
                overflow-y: auto;
            }

            .page {
                height: auto;
                min-height: 100vh;
                grid-template-rows: auto auto auto;
            }

            .hero-row,
            .system-section {
                grid-template-columns: 1fr;
            }

            .photo-card {
                min-height: 320px;
            }

            .system-card {
                min-height: 130px;
                grid-template-columns: 58px 1fr;
            }

            .system-action {
                grid-column: 1 / -1;
                align-items: flex-start;
            }
        }
    </style>
</head>

<body>

<div class="page">

    <header class="topbar">
        <div class="brand">
            <img src="{{ asset('images/logo-mwt.png') }}" alt="Logo MWT">
            <div>
                <h1>MWT Digital Portal</h1>
                <p>Integrated Manufacturing System</p>
            </div>
        </div>

        <div class="top-actions">
            <a href="{{ route('operator.assessment.index') }}" class="top-pill">
                <i class="bi bi-qr-code-scan"></i>
                Operator Assessment
            </a>

            <div class="top-pill">
                <i class="bi bi-calendar2-check"></i>
                {{ now()->translatedFormat('d M Y') }}
            </div>
        </div>
    </header>

    <section class="hero-row">

        <div class="hero-card">
            <div class="badge-main">
                <i class="bi bi-stars me-1"></i>
                Manufacturing Digital System
            </div>

            <div class="hero-content">
                <h2>
                    Pusat Akses Digital untuk Sistem Produksi
                    <span>PT. Mada Wikri Tunggal</span>
                </h2>

                <p>
                    Portal terintegrasi untuk mengakses sistem produksi secara cepat,
                    terstruktur, dan mudah digunakan oleh seluruh user produksi.
                </p>
            </div>

            <div class="process-strip">
                <div class="process-item">
                    <div class="process-num">01</div>
                    <div class="process-icon">
                        <i class="bi bi-cursor"></i>
                    </div>
                    <div>
                        <b>Pilih Sistem</b>
                        <span>User memilih modul yang dibutuhkan.</span>
                    </div>
                </div>

                <div class="process-item">
                    <div class="process-num">02</div>
                    <div class="process-icon">
                        <i class="bi bi-person-lock"></i>
                    </div>
                    <div>
                        <b>Login Role</b>
                        <span>Akses mengikuti role masing-masing.</span>
                    </div>
                </div>

                <div class="process-item">
                    <div class="process-num">03</div>
                    <div class="process-icon">
                        <i class="bi bi-clipboard-data"></i>
                    </div>
                    <div>
                        <b>Proses Data</b>
                        <span>Assessment dan monitoring berjalan.</span>
                    </div>
                </div>

                <div class="process-item">
                    <div class="process-num">04</div>
                    <div class="process-icon">
                        <i class="bi bi-bar-chart-line"></i>
                    </div>
                    <div>
                        <b>Rekap Hasil</b>
                        <span>Data siap dipantau dan dievaluasi.</span>
                    </div>
                </div>
            </div>

            <div class="feature-row">
                <div class="feature-box">
                    <div class="feature-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <div>
                        <h4>Akses Terarah</h4>
                        <p>User memilih sistem sesuai kebutuhan kerja.</p>
                    </div>
                </div>

                <div class="feature-box">
                    <div class="feature-icon">
                        <i class="bi bi-lightning-charge"></i>
                    </div>
                    <div>
                        <h4>Alur Lebih Cepat</h4>
                        <p>Mengurangi pencarian menu yang terpisah.</p>
                    </div>
                </div>

                <div class="feature-box">
                    <div class="feature-icon">
                        <i class="bi bi-diagram-3"></i>
                    </div>
                    <div>
                        <h4>Siap Dikembangkan</h4>
                        <p>Portal dapat menampung sistem berikutnya.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="photo-card">
            <img src="{{ asset('images/team-photo.jpg') }}" alt="Foto Tim MWT">

            <div class="photo-caption">
                <div class="caption-icon">
                    <i class="bi bi-people"></i>
                </div>
                <div>
                    <h3>Satu Portal, Banyak Kemudahan</h3>
                    <p>
                        Semua sistem produksi terhubung dalam satu portal.
                        Bekerja lebih cepat, aman, dan terkontrol.
                    </p>
                </div>
            </div>
        </div>

    </section>

    <section class="system-section">

        <a href="{{ route('login', ['system' => 'skill-assessment']) }}" class="system-card assessment">
            <div class="system-icon">
                <i class="bi bi-clipboard-check"></i>
            </div>

            <div class="system-content">
                <h3>Skill Assessment</h3>
                <p>Assessment, penilaian, approval, dan rekap kompetensi operator.</p>
            </div>

            <div class="system-action">
                <span class="status">AKTIF</span>
                <div class="system-button">
                    Akses Sistem <i class="bi bi-arrow-right"></i>
                </div>
            </div>
        </a>

        <a href="javascript:void(0)" class="system-card safety disabled-card">
            <div class="system-icon">
                <i class="bi bi-shield-check"></i>
            </div>

            <div class="system-content">
                <h3>Safety Patrol</h3>
                <p>Temuan safety, evidence, dan tindak lanjut patrol.</p>
            </div>
            <div class="system-action">
                <span class="status">PENGEMBANGAN</span>
                <div class="system-button">
                    Segera Hadir <i class="bi bi-lock"></i>
                </div>
            </div>
        </a>

        <a href="javascript:void(0)" class="system-card verify disabled-card">
            <div class="system-icon">
                <i class="bi bi-person-check"></i>
            </div>

            <div class="system-content">
                <h3>Verifikasi Awal Kerja</h3>
                <p>Checklist kesiapan operator, APD, mesin, dan area kerja sebelum bekerja.</p>
            </div>

            <div class="system-action">
                <span class="status">PENGEMBANGAN</span>
                <div class="system-button">
                    Segera Hadir <i class="bi bi-lock"></i>
                </div>
            </div>
        </a>

    </section>

</div>

</body>
</html>