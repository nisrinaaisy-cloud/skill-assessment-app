<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Assessment</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root{
        --primary:#4B49AC;
        --primary-dark:#343178;
        --purple:#7978E9;
        --border:#E7EBF7;
        --text:#162544;
        --muted:#6E7890;
        --bg:#F7F8FD;
        --success:#17B26A;
        --warning:#F79009;
        --danger:#F04438;
        }

        *{margin:0;padding:0;box-sizing:border-box}

        body{
            background:var(--bg);
            color:var(--text);
            font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Helvetica,Arial,sans-serif;
            font-size:14px;
            font-weight:500;
            line-height:1.45;
        }

        .operator-page{
        max-width:520px;
        margin:auto;
        padding:14px;
        }

        .btn-back{
        display:inline-flex;
        align-items:center;
        gap:8px;
        padding:9px 15px;
        border-radius:30px;
        background:#fff;
        color:var(--primary);
        font-weight:700;
        text-decoration:none;
        box-shadow:0 3px 10px rgba(0,0,0,.05);
        margin-bottom:12px;
        }

        .hero-card,.history-card{
        background:#fff;
        border:1px solid var(--border);
        border-radius:16px;
        box-shadow:0 4px 14px rgba(0,0,0,.05);
        }

        .hero-card{
        overflow:hidden;
        margin-bottom:14px;
        }

        .hero-head{
        padding:16px 18px;
        background:linear-gradient(90deg,var(--primary-dark),var(--primary),var(--purple));
        color:#fff;
        }

        .hero-head h2{
        margin:0;
        font-size:22px;
        font-weight:950;
        letter-spacing:.2px;
        }

        .hero-head p{
        margin:4px 0 0;
        font-size:13px;
        font-weight:650;
        opacity:.9;
        }

        .hero-body{
        padding:14px;
        }

        .info-card,.progress-card{
        background:#fff;
        border:1px solid var(--border);
        border-radius:14px;
        padding:12px;
        margin-bottom:12px;
        }

        .info-title{
        font-size:13px;
        font-weight:950;
        color:var(--primary);
        margin-bottom:10px;
        }

        .operator-grid{
        display:grid;
        grid-template-columns:repeat(3,1fr);
        gap:10px;
        }

       .label{
        font-size:11px;
        font-weight:850;
        text-transform:uppercase;
        letter-spacing:.35px;
        color:var(--muted);
        margin-bottom:2px;
        }

        .value{
        font-size:14px;
        font-weight:950;
        color:var(--text);
        line-height:1.3;
        }

        .progress{
        height:6px;
        border-radius:20px;
        margin-top:8px;
        }

        .progress-bar{
        background:linear-gradient(90deg,var(--primary),var(--purple));
        }

        .progress-percent{
        margin-top:5px;
        text-align:right;
        font-size:11px;
        font-weight:800;
        }

        .stat-grid{
        display:grid;
        grid-template-columns:repeat(2,1fr);
        gap:8px;
        margin-bottom:8px;
        }

        .stat-card{
        background:#fff;
        border:1px solid var(--border);
        border-radius:14px;
        padding:10px;
        text-align:center;
        }

        .stat-icon{
        font-size:20px;
        margin-bottom:4px;
        }

        .stat-number{
        font-size:22px;
        font-weight:900;
        line-height:1;
        }

        .stat-label{
        margin-top:3px;
        font-size:11px;
        font-weight:700;
        color:var(--muted);
        }

        .history-card{
        padding:12px;
        margin-bottom:10px;
        transition:.2s;
        }

        .history-card:hover{
        transform:translateY(-2px);
        box-shadow:0 8px 18px rgba(75,73,172,.08);
        }

        .history-top{
        display:flex;
        justify-content:space-between;
        gap:10px;
        }

        .part-left{
        display:flex;
        gap:10px;
        flex:1;
        }

        .part-icon{
        width:48px;
        height:48px;
        border-radius:14px;
        display:flex;
        align-items:center;
        justify-content:center;
        background:linear-gradient(135deg,var(--primary),var(--purple));
        color:#fff;
        font-size:20px;
        }

        .history-sub{
        font-size:12px;
        font-weight:700;
        color:var(--muted);
        }

        .history-sub{
        font-size:12px;
        color:var(--muted);
        }

        .info-grid{
        display:grid;
        grid-template-columns:repeat(2,1fr);
        gap:10px;
        margin:10px 0;
        }

        .approval-box{
        margin-top:10px;
        padding:10px;
        background:#F8F9FF;
        border-radius:12px;
        }

        .approval-row{
        display:flex;
        justify-content:space-between;
        align-items:center;
        padding:6px 0;
        border-bottom:1px solid #ECEEF8;
        font-size:13px;
        }

        .approval-row:last-child{
        border:none;
        }

        .history-footer{
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-top:10px;
        font-size:11px;
        color:var(--muted);
        }

        .badge-status{
        font-size:11px;
        font-weight:900;
        letter-spacing:.2px;
        }

        .badge-success{background:#ECFDF3;color:#067647;}
        .badge-warning{background:#FFF7E6;color:#B54708;}
        .badge-danger{background:#FEF3F2;color:#B42318;}

        .btn-detail,.btn-remedial{
        width:100%;
        margin-top:13px;
        padding:9px;
        border:none;
        border-radius:12px;
        font-size:13px;
        font-weight:950;
        color:#fff;
        }

        .btn-detail{
        background:linear-gradient(90deg,var(--primary),var(--purple));
        }

        .btn-remedial{
        background:#EF4444;
        }

        .empty-card{
        display:none;
        }

        hr{
        margin:10px 0;
        opacity:.12;
        }

        @media(max-width:576px){
        .operator-grid{grid-template-columns:1fr;}
        .hero-head h2{font-size:21px;}
        }
        </style>
</head>

<body>

    @php
        $target = 3;
        $lulus = $assessments->where('status', 'lulus')->count();
        $progress = min(($lulus / $target) * 100, 100);
    @endphp

    <div class="operator-page">

        <a href="{{ route('operator.assessment.pilihPart',$operator->id) }}"
        class="btn-back">

            <i class="bi bi-arrow-left"></i>

            Kembali

        </a>

        <div class="hero-card">

            <div class="hero-head">

                <h2>{{ strtoupper($operator->nama_lengkap) }}</h2>

                <p>
                    NIK : {{ $operator->nik }}
                </p>

            </div>

            <div class="hero-body">
    <div class="info-card">
        <div class="info-title"><i class="bi bi-person-badge"></i> Data Operator</div>
        <div class="operator-grid">
            <div><div class="label">Departemen</div><div class="value">{{ optional($operator->divisi)->nama_divisi }}</div></div>
            <div><div class="label">Leader</div><div class="value">{{ optional($operator->leader)->name }}</div></div>
            <div><div class="label">Periode</div><div class="value">{{ now()->translatedFormat('M Y') }}</div></div>
        </div>
    </div>

    <div class="progress-card">
        <div class="d-flex justify-content-between align-items-center">
            <strong>Progress Assessment</strong>
            <strong>{{ $lulus }}/{{ $target }}</strong>
        </div>
        <div class="progress mt-2"><div class="progress-bar" style="width:{{ $progress }}%"></div></div>
        <div class="progress-percent">{{ number_format($progress,0) }}%</div>
    </div>

    <div class="stat-grid">
        <div class="stat-card">
            <div class="stat-icon text-primary"><i class="bi bi-file-earmark-text"></i></div>
            <div class="stat-number">{{ $assessments->count() }}</div>
            <div class="stat-label">Total</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon text-success"><i class="bi bi-check-circle-fill"></i></div>
            <div class="stat-number">{{ $assessments->where('status','lulus')->count() }}</div>
            <div class="stat-label">Lulus</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon text-warning"><i class="bi bi-hourglass-split"></i></div>
            <div class="stat-number">{{ $assessments->where('status','submitted')->count() }}</div>
            <div class="stat-label">Menunggu</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon text-danger"><i class="bi bi-x-circle-fill"></i></div>
            <div class="stat-number">{{ $assessments->where('status','tidak_lulus')->count() }}</div>
            <div class="stat-label">Tidak Lulus</div>
        </div>
    </div>
</div>

</div> <!-- hero-card -->

      @forelse($assessments as $assessment)

<div class="history-card">

    <div class="history-top">

        <div class="part-left">

            <div class="part-icon">
                <i class="bi bi-box-seam"></i>
            </div>

            <div class="part-info">

                <div class="history-title">
                    {{ optional($assessment->part)->nama_part ?? '-' }}
                </div>

                <div class="history-sub">
                    No Part : {{ optional($assessment->part)->no_part ?? '-' }}
                </div>

                <div class="history-sub">
                    {{ optional($assessment->subProcess)->nama_sub_proses ?? '-' }}
                </div>

            </div>

        </div>

        <div>

            @switch($assessment->status)

                @case('lulus')
                    <span class="badge-status badge-success">
                        <i class="bi bi-check-circle-fill"></i>
                        Lulus
                    </span>
                @break

                @case('submitted')
                    <span class="badge-status badge-warning">
                        <i class="bi bi-hourglass-split"></i>
                        Menunggu
                    </span>
                @break

                @case('tidak_lulus')
                    <span class="badge-status badge-danger">
                        <i class="bi bi-x-circle-fill"></i>
                        Tidak Lulus
                    </span>
                @break

                @default
                    <span class="badge bg-secondary">
                        {{ ucfirst($assessment->status) }}
                    </span>

            @endswitch

        </div>

    </div>

    <hr>

    <div class="info-grid">

        <div>

            <div class="label">
                Periode
            </div>

            <div class="value">
                {{ optional($assessment->periode)->label ?? '-' }}
            </div>

        </div>

        <div style="text-align:right">

            <div class="label">
                Nilai
            </div>

            <div class="value">
                {{ optional($assessment->penilaian)->total_nilai ?? '-' }}
            </div>

        </div>

    </div>

    <hr>

    <div class="approval-box">

        <div class="label mb-3">
            Progress Approval
        </div>

        {{-- Leader --}}
        <div class="approval-row">

            <span>
                <i class="bi bi-person-check"></i>
                Leader
            </span>

            @if(in_array($assessment->status,['dinilai','lulus','tidak_lulus']))
                <span class="text-success fw-bold">
                    ✔ Selesai
                </span>
            @elseif($assessment->status=='submitted')
                <span class="text-warning fw-bold">
                    Diproses
                </span>
            @else
                <span>-</span>
            @endif

        </div>

        {{-- Foreman --}}
        <div class="approval-row">

            <span>
                <i class="bi bi-person-workspace"></i>
                Foreman
            </span>

            @if(optional($assessment->approval)->status_foreman=='approved')
                <span class="text-success fw-bold">
                    ✔ Approved
                </span>
            @elseif(optional($assessment->approval)->status_foreman)
                <span class="text-warning fw-bold">
                    Pending
                </span>
            @else
                <span>-</span>
            @endif

        </div>

        {{-- Kabag --}}
        <div class="approval-row">

            <span>
                <i class="bi bi-person-badge"></i>
                Kabag
            </span>

            @if(optional($assessment->approval)->status_kabag=='approved')
                <span class="text-success fw-bold">
                    ✔ Approved
                </span>
            @elseif(optional($assessment->approval)->status_kabag)
                <span class="text-warning fw-bold">
                    Pending
                </span>
            @else
                <span>-</span>
            @endif

        </div>

    </div>

    <div class="history-footer">

        <div class="small text-muted">

            <i class="bi bi-clock-history"></i>

            {{ $assessment->updated_at->format('d M Y H:i') }}

        </div>

    </div>

    @if($assessment->status=='tidak_lulus')

        <a href="{{ route('operator.assessment.form',$assessment->id) }}"
           class="btn-remedial">

            <i class="bi bi-arrow-repeat"></i>

            Lanjut Remedial

        </a>

    @else

        <button class="btn-detail">

            <i class="bi bi-eye"></i>

            Detail Assessment

        </button>

    @endif

</div>

@empty

<div class="empty-card">

    <i class="bi bi-folder2-open"></i>

    <h5>Belum Ada Riwayat Assessment</h5>

    <p>Silakan lakukan assessment terlebih dahulu.</p>

</div>

@endforelse

</div> <!-- operator-page -->

</body>

</html>