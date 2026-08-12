@extends('layouts.app')

@section('content')

<style>
    .operator-hero {
        width: 100%;
        padding: 16px 20px;
        border-radius: 18px;
        background: linear-gradient(135deg, #4B49AC 0%, #7978E9 55%, #F3797E 100%);
        color: #fff;
        box-shadow: 0 14px 32px rgba(75,73,172,0.24);
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 18px;
    }

    .operator-hero-title {
        font-size: 20px;
        font-weight: 800;
        letter-spacing: -0.3px;
    }

    .operator-hero-subtitle {
        font-size: 12px;
        opacity: 0.85;
        margin-top: 4px;
    }

    .btn-reset {
        padding: 10px 22px;
        border-radius: 14px;
        font-weight: 800;
        background: #f1f5ff;
        color: #4B49AC;
        border: 1px solid rgba(75,73,172,0.15);
        transition: all 0.2s ease;
        text-decoration: none !important;
        min-width: 145px;
        text-align: center;
    }

    .btn-reset:hover {
        background: #4B49AC;
        color: #fff;
        box-shadow: 0 6px 14px rgba(75,73,172,0.2);
    }

    .info-card,
    .table-card {
        background: #fff;
        border-radius: 22px;
        box-shadow: 0 10px 30px rgba(75, 73, 172, 0.10);
        border: 1px solid rgba(75, 73, 172, 0.06);
    }

    .summary-box {
        background: #f8fafc;
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        padding: 16px 18px;
        height: 100%;
    }

    .summary-label {
        font-size: 12px;
        color: #6b7280;
        margin-bottom: 6px;
        font-weight: 700;
    }

    .summary-value {
        font-size: 15px;
        font-weight: 800;
        color: #1f2937;
    }

    .operator-table {
        border-collapse: separate;
        border-spacing: 0 9px;
    }

    .operator-table thead th {
        font-size: 12px;
        color: #1f2937;
        font-weight: 900;
        text-transform: uppercase;
        border: none;
        background: #e9edff;
        padding: 14px;
        text-align: center;
        white-space: nowrap;
        border-bottom: 2px solid rgba(75,73,172,0.22);
    }

    .operator-table tbody tr {
        background: #fff;
        box-shadow: 0 5px 18px rgba(75, 73, 172, 0.06);
    }

    .operator-table tbody td {
        border: none;
        padding: 14px;
        font-size: 13px;
        vertical-align: middle;
        background: #fff;
        text-align: center;
    }

    .text-name {
        text-align: left !important;
        font-weight: 800;
        color: #1f2937;
    }

    .nik-badge {
        display: inline-flex;
        padding: 6px 10px;
        border-radius: 999px;
        background: #eef3ff;
        color: #4B49AC;
        font-size: 12px;
        font-weight: 800;
    }

    .status-active,
    .status-inactive,
    .status-warning,
    .status-danger,
    .status-review,
    .status-approval,
    .status-complete {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        padding: 7px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 850;
        min-width: 120px;
    }

    .status-review{
        background:#f1f5f9;
        color:#64748b;
    }

    .status-approval{
        background:#fff7ed;
        color:#ea580c;
    }

    .status-complete{
        background:#ecfdf5;
        color:#059669;
    }

    .status-active {
        background: #ecfdf5;
        color: #059669;
    }

    .status-inactive {
        background: #f1f5f9;
        color: #64748b;
    }

    .status-warning {
        background: #fff7ed;
        color: #ea580c;
    }

    .status-danger {
        background: #fff0f1;
        color: #dc3545;
    }

    .btn-action-print {
        width: 38px;
        height: 38px;
        border: none;
        border-radius: 999px;
        font-size: 16px;
        font-weight: 800;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin: 2px;
        background: #ecfdf5;
        color: #059669;
    }

    .btn-action-print:hover {
        background: #059669;
        color: #fff;
    }

    .empty-state {
        background: #f8fafc;
        border: 1px dashed #cbd5e1;
        border-radius: 20px;
        padding: 36px;
        text-align: center;
        color: #64748b;
    }
</style>

<div class="operator-page">

    <div class="info-card p-3 mb-4">
        <div class="row g-3">
            <div class="col-md-3">
                <div class="summary-box">
                    <div class="summary-label">Nama Operator</div>
                    <div class="summary-value">{{ $operator->nama_lengkap }}</div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="summary-box">
                    <div class="summary-label">Periode</div>
                    <div class="summary-value">{{ $periode->bulan }}/{{ $periode->tahun }}</div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="summary-box">
                    <div class="summary-label">Jumlah Part</div>
                    <div class="summary-value">{{ $partCount }}/3</div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="summary-box">
                    <div class="summary-label">Status Periode</div>
                    <div class="summary-value">
                        <span class="{{ $periodStatus['class'] }}">{{ $periodStatus['label'] }}</span>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

    <div class="table-card p-3">
        <div class="table-responsive">
            <table class="table operator-table align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width:70px;">No</th>
                        <th class="text-start">Part</th>
                        <th>Nilai</th>
                        <th>Status</th>
                        <th>Tanggal Submit</th>
                        <th style="width:90px;">Cetak</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($partRows as $row)
                        @php
                            $assessment = $row['assessment'];
                            $statusClass=$row['display_status_class'];
                            $statusLabel=$row['display_status_label'];
                        @endphp

                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td class="text-name">
                                {{ $assessment->part->nama_part ?? '-' }}
                            </td>

                            <td>
                                @if($row['score'] !== null)
                                    <span class="nik-badge">{{ $row['score'] }}</span>
                                @else
                                    -
                                @endif
                            </td>

                            <td>
                                <span class="{{ $statusClass }}">
                                    {{ $statusLabel }}
                                </span>
                            </td>

                            <td>{{ optional($assessment->created_at)->format('d/m/Y H:i') ?? '-' }}</td>

                            <td>
                                <a href="{{ route('rekapitulasi.print',$assessment->id) }}"
                                target="_blank"
                                class="btn-action-print"
                                title="Cetak Form">
                                    <i class="bi bi-printer-fill"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                    <div class="fw-semibold mb-1">Belum ada part assessment pada periode ini.</div>
                                    <div class="small">
                                        Jika periode sebelumnya belum dikerjakan, operator perlu menyelesaikan periode tersebut terlebih dahulu.
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection
