<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Assessment</title>

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
            padding: 22px 14px 28px;
            display: flex;
            align-items: center;
        }

        .status-shell {
            width: 100%;
            overflow: hidden;
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 22px;
            box-shadow: 0 14px 30px rgba(24, 32, 74, 0.08);
        }

        .status-head {
            padding: 22px 20px;
            color: #fff;
            text-align: center;
            background: linear-gradient(90deg, var(--primary-dark) 0%, var(--primary) 58%, var(--support-purple) 100%);
        }

        .status-icon {
            width: 72px;
            height: 72px;
            margin: 0 auto 14px;
            border-radius: 24px;
            background: rgba(255,255,255,.18);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 34px;
        }

        .status-head h4 {
            font-size: 22px;
            font-weight: 950;
            margin-bottom: 6px;
        }

        .status-head p {
            margin: 0;
            font-size: 13px;
            font-weight: 650;
            opacity: .9;
        }

        .status-body {
            padding: 20px;
        }

        .info-box {
            border-radius: 16px;
            padding: 14px;
            background: #F8FAFF;
            border: 1px solid #EEF2FF;
            margin-bottom: 14px;
        }

        .info-label {
            font-size: 11px;
            color: var(--muted);
            font-weight: 850;
            text-transform: uppercase;
            margin-bottom: 3px;
        }

        .info-value {
            font-size: 14px;
            font-weight: 950;
            color: var(--text);
            margin-bottom: 10px;
        }

        .info-value:last-child {
            margin-bottom: 0;
        }

        .status-pill {
            display: inline-flex;
            justify-content: center;
            padding: 8px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 950;
            background: var(--primary-soft);
            color: var(--primary);
        }

        .btn-main {
            min-height: 54px;
            border: none;
            border-radius: 16px;
            color: #fff;
            font-weight: 950;
            background: linear-gradient(135deg, var(--primary), var(--support-purple));
            box-shadow: 0 10px 18px rgba(75, 73, 172, .22);
        }
    </style>
</head>

<body>
<div class="operator-page">

    <div class="status-shell">
        <div class="status-head">
            <div class="status-icon">
                @if ($type === 'success')
                    <i class="bi bi-check-circle-fill"></i>
                @elseif ($type === 'warning')
                    <i class="bi bi-exclamation-triangle-fill"></i>
                @elseif ($type === 'danger')
                    <i class="bi bi-x-circle-fill"></i>
                @else
                    <i class="bi bi-hourglass-split"></i>
                @endif
            </div>

            <h4>{{ $title }}</h4>
            <p>{{ $message }}</p>
        </div>

        <div class="status-body">
            @isset($assessment)
                <div class="info-box">
                    <div class="info-label">Operator</div>
                    <div class="info-value">{{ optional($assessment->operator)->nama ?? '-' }}</div>

                    <div class="info-label">Part</div>
                    <div class="info-value">
                        {{ optional($assessment->part)->no_part ?? '-' }} —
                        {{ optional($assessment->part)->nama_part ?? '-' }}
                    </div>

                    <div class="info-label">Periode</div>
                    <div class="info-value">{{ optional($assessment->periode)->label ?? '-' }}</div>

                    <div class="info-label">Status</div>
                    <span class="status-pill">
                        {{ str_replace('_', ' ', strtoupper($assessment->status)) }}
                    </span>
                </div>
            @endisset

            <a href="{{ route('operator.assessment.index') }}" class="btn btn-main w-100">
                Kembali ke Awal
            </a>
        </div>
    </div>

</div>
</body>
</html>