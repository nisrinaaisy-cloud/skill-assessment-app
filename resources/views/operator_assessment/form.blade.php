<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Assessment</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --primary: #4B49AC;
            --primary-dark: #343178;
            --primary-soft: #F3F2FF;
            --secondary: #98BDFF;
            --secondary-strong: #7DA0FA;
            --support-purple: #7978E9;
            --support-pink: #F3797E;
            --pink-soft: #FDEEEF;
            --text: #13233E;
            --muted: #65738F;
            --border: #E5EAF7;
            --bg: #F7F9FC;
        }

        body {
            background: var(--bg);
            color: var(--text);
        }

        .operator-page {
            max-width: 520px;
            min-height: 100vh;
            margin: 0 auto;
            padding: 18px 14px 28px;
        }

        .hero-card {
            overflow: hidden;
            border-radius: 20px;
            background: #fff;
            border: 1px solid rgba(75, 73, 172, .12);
            box-shadow: 0 10px 25px rgba(24, 32, 74, 0.07);
            margin-bottom: 14px;
        }

        .hero-head {
            padding: 18px;
            color: #fff;
            background: linear-gradient(90deg, var(--primary-dark) 0%, var(--primary) 55%, var(--support-purple) 100%);
        }

        .hero-head h4 {
            font-size: 21px;
            font-weight: 950;
            margin: 0 0 5px;
        }

        .hero-head p {
            font-size: 13px;
            font-weight: 650;
            opacity: .9;
            margin: 0;
        }

        .quick-info {
            padding: 16px 18px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .info-box {
            border-radius: 14px;
            padding: 12px;
            background: #F8FAFF;
            border: 1px solid #EEF2FF;
        }

        .info-label {
            font-size: 11px;
            color: var(--muted);
            font-weight: 850;
            margin-bottom: 3px;
            text-transform: uppercase;
        }

        .info-value {
            font-size: 13px;
            font-weight: 950;
            color: var(--text);
            line-height: 1.3;
        }

        .card-shell {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 18px;
            box-shadow: 0 10px 25px rgba(24, 32, 74, 0.06);
            margin-bottom: 0px;
            overflow: hidden;
        }

        .panel-head {
            min-height: 52px;
            padding: 0 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #fff;
            font-size: 14px;
            font-weight: 950;
            background: linear-gradient(90deg, var(--primary) 0%, var(--support-purple) 70%, var(--support-pink) 100%);
        }

        .card-body-custom {
            padding: 18px;
        }

        .field-title {
            font-size: 15px;
            font-weight: 950;
            color: var(--text);
            margin-bottom: 4px;
        }

        .field-help {
            font-size: 12px;
            color: var(--muted);
            font-weight: 650;
            line-height: 1.5;
            margin-bottom: 10px;
        }

        textarea.form-control {
            min-height: 150px;
            border-radius: 15px;
            border: 1px solid #D7DFF2;
            font-size: 15px;
            line-height: 1.5;
            padding: 14px;
        }

        textarea.form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 .2rem rgba(75, 73, 172, .12);
        }

        .alert {
            border: 0;
            border-radius: 16px;
            font-size: 13px;
            font-weight: 750;
        }

        .mini-info {
            border-radius: 15px;
            padding: 14px;
            background: var(--primary-soft);
            color: var(--primary-dark);
            font-size: 13px;
            font-weight: 800;
            line-height: 1.5;
        }

        .score-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 11px;
            border-radius: 999px;
            background: #EEF4FF;
            color: var(--primary);
            font-size: 12px;
            font-weight: 950;
        }

        .btn-main {
            min-height: 56px;
            border: none;
            border-radius: 16px;
            color: #fff;
            font-weight: 950;
            background: linear-gradient(135deg, var(--primary), var(--support-purple));
            box-shadow: 0 10px 18px rgba(75, 73, 172, .22);
        }

        .btn-soft {
            min-height: 50px;
            border-radius: 15px;
            border: 1px solid var(--border);
            background: #fff;
            color: var(--primary);
            font-weight: 900;
        }

        .sticky-submit {
            position: sticky;
            bottom: 0;
            padding-top: 0px;
            padding-bottom: 4px;
            background: linear-gradient(to top, var(--bg) 82%, rgba(247,249,252,0));
        }

        @media (max-width: 380px) {
            .quick-info {
                grid-template-columns: 1fr;
            }
        }

        .sticky-back {
            position: sticky;
            top: 0;
            z-index: 20;
            padding: 8px 0 12px;
            background: linear-gradient(to bottom, var(--bg) 80%, rgba(247,249,252,0));
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            height: 42px;
            padding: 0 14px;
            border-radius: 999px;
            border: 1px solid var(--border);
            background: #fff;
            color: var(--primary);
            text-decoration: none;
            font-size: 13px;
            font-weight: 950;
            box-shadow: 0 8px 18px rgba(24, 32, 74, 0.08);
        }

        .modal-content{
    border:none;
    border-radius:22px;
    overflow:hidden;
    box-shadow:0 20px 50px rgba(24,32,74,.20);
}

    .recall-header{
        padding:18px 22px;
        color:#fff;
        background:linear-gradient(
            90deg,
            var(--primary-dark) 0%,
            var(--primary) 60%,
            var(--support-purple) 100%
        );
        display:flex;
        justify-content:space-between;
        align-items:center;
    }

    .modal-body{
        padding:26px;
        overflow-y:hidden;
    }

    .modal-footer{
        padding:18px 24px;
        border-top:1px solid var(--border);
    }

    .recall-alert{
        background:#FFF8E6;
        border:1px solid #FADFA1;
        border-radius:16px;
        padding:14px;
        color:#7C5700;
        font-size:13px;
        font-weight:800;
        margin-bottom:18px;
    }

    .recall-input{
        min-height:54px;
        border-radius:14px;
        border:1px solid #D7DFF2;
    }

    .recall-input:focus{
        border-color:var(--primary);
        box-shadow:0 0 0 .2rem rgba(75,73,172,.12);
    }

    .recall-error{
        animation: shake .35s;
        font-weight:800;
    }

    @keyframes shake{

        0%{transform:translateX(0);}
        25%{transform:translateX(-6px);}
        50%{transform:translateX(6px);}
        75%{transform:translateX(-6px);}
        100%{transform:translateX(0);}

    }
    .btn-recall{
        border:none;
        border-radius:14px;
        font-weight:900;
        color:#fff;
        background:linear-gradient(
            135deg,
            var(--primary),
            var(--support-purple)
        );
    }

    /* ===========================================================
        REMEDIAL POPUP
        =========================================================== */

        .remedial-modal .modal-dialog{
             max-width:430px;
             margin:1rem auto;
        }

        .remedial-modal .modal-content{

            border:none;
            border-radius:24px;

            width:100%;

            overflow:hidden;

            box-shadow:0 20px 60px rgba(0,0,0,.18);

        }

        /* blur background */

        .modal-backdrop.show{
            opacity:.72;
            backdrop-filter:blur(8px);
        }

        /* ================= ICON ================= */

        .remedial-icon{

            width:120px;
            height:120px;

            margin:auto;

            border-radius:50%;

            background:
                radial-gradient(circle,#ff6b6b 0%,#ff4e62 100%);

            display:flex;
            align-items:center;
            justify-content:center;

            color:#fff;

            font-size:60px;

            box-shadow:

                0 0 0 14px rgba(255,78,98,.10),
                0 0 0 28px rgba(255,78,98,.05);

            animation:

                pulseIcon 1.8s infinite;

        }

        @keyframes pulseIcon{

            0%{
                transform:scale(1);
            }

            50%{
                transform:scale(1.08);
            }

            100%{
                transform:scale(1);
            }

        }

        /* ================= TITLE ================= */

        .remedial-title{

            margin-top:30px;

            font-size:28px;

            font-weight:900;

            color:#27304d;

            text-align:center;

        }

        .remedial-subtitle{

            margin-top:8px;

            text-align:center;

            font-size:16px;

            color:#6d7286;

        }

        .remedial-subtitle b{

            color:#ff4d5f;

        }

        /* ================= INFO CARD ================= */

        .remedial-info{

            margin-top:28px;

            border:1px solid #edf1fa;

            border-radius:20px;

            padding:20px 22px;

            background:#fbfcff;

        }

        .remedial-row{

            display:flex;

            align-items:center;

            padding:13px 0;

            border-bottom:1px dashed #e7ebf5;

        }

        .remedial-row:last-child{

            border-bottom:none;

        }

        .remedial-icon-mini{

            width:42px;

            height:42px;

            border-radius:50%;

            background:#f2efff;

            color:#6d5cff;

            display:flex;

            justify-content:center;

            align-items:center;

            margin-right:14px;

            font-size:18px;

        }

        .remedial-label{

            width:130px;

            font-size:14px;

            font-weight:800;

            color:#2d3554;

        }

        .remedial-value{

            flex:1;

            font-size:14px;

            font-weight:700;

            color:#53586b;

        }

        /* ================= WARNING ================= */

        .remedial-warning{

            margin-top:24px;

            border-radius:18px;

            padding:18px;

            background:#fff8eb;

            border:1px solid #ffe2a3;

            display:flex;

            gap:14px;

        }

        .remedial-warning i{

            color:#ffb300;

            font-size:28px;

        }

        .remedial-warning span{

            font-size:14px;

            color:#4c4f5d;

            font-weight:700;

        }

        /* ================= BUTTON ================= */

        .btn-remedial{

            margin-top:28px;

            width:320px;

            height:52px;

            border:none;

            border-radius:14px;

            font-size:18px;

            font-weight:700;

            color:#fff;

            background:
                linear-gradient(
                    135deg,
                    #5d4fff,
                    #6958ff
                );

            box-shadow:
                0 12px 28px rgba(93,79,255,.30);

            transition:.25s;

        }

        /* hover */

        .btn-remedial:hover{

            transform:translateY(-2px);

        }

        /* click */

        .btn-remedial:active{

            transform:scale(.97);

        }

        /* icon muter */

        .btn-remedial i{

            margin-right:10px;

            animation:rotateLoop 2.5s linear infinite;

        }

        @keyframes rotateLoop{

            from{
                transform:rotate(0);
            }

            to{
                transform:rotate(360deg);
            }

        }
    </style>
</head>

<body>
<div class="operator-page">

    <div class="sticky-back">
        <a href="{{ route('operator.assessment.pilihPart', $assessment->operator_id) }}" class="back-link">
            <i class="bi bi-arrow-left"></i>
            Kembali
        </a>
    </div>

    <div class="hero-card">
        <div class="hero-head">
            <h4><i class="bi bi-pencil-square me-2"></i>Form Assessment</h4>
            <p>Lengkapi jawaban sesuai part yang dikerjakan.</p>
        </div>

        <div class="quick-info">
            <div class="info-box">
                <div class="info-label">Operator</div>
                <div class="info-value">{{ $assessment->operator->nama_lengkap }}</div>
            </div>

            <div class="info-box">
                <div class="info-label">NIK</div>
                <div class="info-value">{{ $assessment->operator->nik }}</div>
            </div>

            <div class="info-box">
                <div class="info-label">Part</div>
                <div class="info-value">{{ $assessment->part->nama_part }}</div>
            </div>

            <div class="info-box">
                <div class="info-label">Periode</div>
                <div class="info-value">{{ $assessment->periode->label }}</div>
            </div>
        </div>
    </div>

    @if (session('info'))
        <div class="alert alert-info">
            <i class="bi bi-info-circle me-1"></i>{{ session('info') }}
        </div>
    @endif

    @if (session('warning'))
        <div class="recall-alert">
            <i class="bi bi-exclamation-triangle me-1"></i>{{ session('warning') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <i class="bi bi-exclamation-circle me-1"></i>
            Lengkapi semua jawaban yang wajib diisi.
        </div>
    @endif

    <form action="{{ route('operator.assessment.submit', $assessment->id) }}" method="POST">
        @csrf

        <div class="card-shell">
            <div class="panel-head">
                <i class="bi bi-diagram-3"></i>
                Flow Process
            </div>

            <div class="card-body-custom">
                <div class="field-help">
                    Isi alur proses pembuatan part dari awal sampai selesai.
                </div>

                <textarea
                    name="flow_process"
                    class="form-control @error('flow_process') is-invalid @enderror"
                    placeholder="Wajib diisi"
                >{{ old('flow_process', optional($assessment->answer)->flow_process) }}</textarea>

                @error('flow_process')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        @if ($assessment->part->kategori === 'packing')
            <div class="card-shell">
                <div class="panel-head">
                    <i class="bi bi-box-seam"></i>
                    Standard Packing
                </div>

                <div class="card-body-custom">
                    <div class="field-help">
                        Isi standar packing yang digunakan untuk part ini.
                    </div>

                    <textarea
                        name="standard_packing"
                        class="form-control @error('standard_packing') is-invalid @enderror"
                        placeholder="Wajib diisi"
                    >{{ old('standard_packing', optional($assessment->answer)->standard_packing) }}</textarea>

                    @error('standard_packing')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        @else
            <div class="card-shell">
                <div class="panel-head">
                    <i class="bi bi-layers"></i>
                    Nama Subpart / Material
                </div>

                <div class="card-body-custom">
                    <div class="field-help">
                        Isi nama subpart atau material yang terdapat pada part.
                    </div>

                    <textarea
                        name="nama_subpart"
                        class="form-control @error('nama_subpart') is-invalid @enderror"
                        placeholder="Wajib diisi"
                    >{{ old('nama_subpart', optional($assessment->answer)->nama_subpart) }}</textarea>

                    @error('nama_subpart')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        @endif

        <div class="card-shell">
            <div class="panel-head">
                <i class="bi bi-check2-square"></i>
                Q-Point
            </div>

            <div class="card-body-custom">
                <div class="field-help">
                    Isi poin kualitas yang harus diperhatikan saat pengerjaan part.
                </div>

                <textarea
                    name="q_point"
                    class="form-control @error('q_point') is-invalid @enderror"
                    placeholder="Wajib diisi"
                >{{ old('q_point', optional($assessment->answer)->q_point) }}</textarea>

                @error('q_point')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="card-shell">
            <div class="card-body-custom">
                <div class="d-flex justify-content-between align-items-center gap-2 mb-3">
                    <div>
                        <div class="field-title mb-1">Informasi Penilaian</div>
                        <div class="field-help mb-0">Nilai akan diberikan oleh leader setelah assessment dikirim.</div>
                    </div>

                    @if ($assessment->part->kategori === 'packing')
                        <span class="score-pill">
                            <i class="bi bi-bullseye"></i> Min 80
                        </span>
                    @else
                        <span class="score-pill">
                            <i class="bi bi-bullseye"></i> Min 85
                        </span>
                    @endif
                </div>

                <div class="mini-info">
                    <i class="bi bi-info-circle me-1"></i>
                    Setelah submit, jawaban tidak bisa diedit dan status akan menjadi
                    <b>Menunggu Penilaian Leader</b>.
                </div>
            </div>
        </div>
    <div class="card-body-custom">
</div>
        <div class="sticky-submit">
            <button
                type="button"
                class="btn btn-main w-100 mb-2"
                data-bs-toggle="modal"
                data-bs-target="#recallModal"
            >
                Submit Assessment
                <i class="bi bi-send-fill ms-1"></i>
            </button>
        </div>
        <div class="modal fade" id="recallModal" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="recall-header">
                <h5 class="mb-0">
                    <i class="bi bi-brain me-2"></i>
                    Recall Test
                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">
                </button>
            </div>

            <div class="modal-body">

                <div class="alert alert-warning">
                    Untuk memastikan pemahaman operator terhadap part yang dikerjakan,
                    silakan isi data berikut tanpa melihat referensi.
                </div>

                @if($recallType == 1)

                    <div class="mb-3">
                        <label class="form-label">
                            Nama Part
                        </label>

                        <input
                            type="text"
                            name="recall_nama_part"
                            class="form-control recall-input"
                            autocomplete="off"
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Nomor Part
                        </label>

                        <input
                            type="text"
                            name="recall_no_part"
                            class="form-control recall-input"
                            autocomplete="off"
                        >
                    </div>

                @elseif($recallType == 2)

                    <div class="mb-3">
                        <label class="form-label">
                            Nama Part
                        </label>

                        <input
                            type="text"
                            name="recall_nama_part"
                            class="form-control recall-input"
                            autocomplete="off"
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Sub Proses
                        </label>

                        <input
                            type="text"
                            name="recall_proses"
                            class="form-control recall-input"
                            autocomplete="off"
                        >
                    </div>

                @else

                    <div class="mb-3">
                        <label class="form-label">
                            Nomor Part
                        </label>

                        <input
                            type="text"
                            name="recall_no_part"
                            class="form-control recall-input"
                            autocomplete="off"
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Sub Proses
                        </label>

                        <input
                            type="text"
                            name="recall_proses"
                            class="form-control recall-input"
                            autocomplete="off"
                        >
                    </div>

                @endif

                @error('recall')

                <div
                    class="alert alert-danger recall-error"
                >
                    <i class="bi bi-x-circle-fill me-2"></i>
                    {{ $message }}
                </div>

                @enderror

            </div>

            <div class="modal-footer">

                <button
                    type="submit"
                    class="btn btn-recall"
                >
                    Submit
                </button>

            </div>

        </div>

    </div>

</div>
    </form>
<div class="modal fade remedial-modal"
     id="remedialModal"
     data-bs-backdrop="static"
     data-bs-keyboard="false"
     tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-body px-4 py-4 text-center">

                <div class="remedial-icon">

                    <i class="bi bi-exclamation-lg"></i>

                </div>

                <div class="remedial-title">

                    Assessment Belum Lulus

                </div>

                <div class="remedial-subtitle">

                    Anda harus menyelesaikan
                    <b>Remedial Assessment</b>

                </div>

                <div class="remedial-info">

                    <div class="remedial-row">

                        <div class="remedial-icon-mini">

                            <i class="bi bi-box"></i>

                        </div>

                        <div class="remedial-label">

                            Part

                        </div>

                        <div class="remedial-value">

                            {{ session('failedAssessment.part') }}

                        </div>

                    </div>

                    <div class="remedial-row">

                        <div class="remedial-icon-mini">

                            <i class="bi bi-diagram-3"></i>

                        </div>

                        <div class="remedial-label">

                            Sub Process

                        </div>

                        <div class="remedial-value">

                            {{ session('failedAssessment.subProcess') }}

                        </div>

                    </div>

                    <div class="remedial-row">

                        <div class="remedial-icon-mini">

                            <i class="bi bi-calendar-event"></i>

                        </div>

                        <div class="remedial-label">

                            Periode

                        </div>

                        <div class="remedial-value">

                            {{ session('failedAssessment.periode') }}

                        </div>

                    </div>

                </div>

                <div class="remedial-warning">

                    <i class="bi bi-info-circle-fill"></i>

                    <span>

                        Assessment baru tidak dapat dilanjutkan sebelum remedial selesai.

                    </span>

                </div>

                <button
                    onclick="window.location='{{ session('failedAssessment.url') }}'"
                    class="btn-remedial">

                    <i class="bi bi-arrow-repeat"></i>

                    Lanjut Remedial

                </button>

            </div>

        </div>

    </div>

</div>
</div>
@if ($errors->has('recall'))

<script>

document.addEventListener('DOMContentLoaded', function () {

    const recallModal =
        new bootstrap.Modal(
            document.getElementById('recallModal')
        );

    recallModal.show();

});

</script>

@endif

@if(session('remedial'))

<script>

document.addEventListener('DOMContentLoaded', function () {

    const remedialModal = new bootstrap.Modal(

        document.getElementById('remedialModal')

    );

    remedialModal.show();

});

</script>

@endif
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>