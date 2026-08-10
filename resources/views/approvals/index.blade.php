@extends('layouts.app')

@section('content')

<style>
    .approval-page {
        --primary: #4B49AC;
        --support-blue: #7DA0FA;
        --support-purple: #7978E9;
        --support-red: #F3797E;
        --text: #1f2937;
        --muted: #64748b;
        --border: #E5EAF7;
    }

    .approval-hero {
        width: 100%;
        padding: 16px 20px;
        border-radius: 18px;
        background: linear-gradient(135deg, #4B49AC 0%, #7978E9 55%, #F3797E 100%);
        color: #fff;
        box-shadow: 0 14px 32px rgba(75,73,172,.24);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        margin-bottom: 18px;
    }

    .approval-hero-title {
        font-size: 20px;
        font-weight: 850;
    }

    .approval-hero-subtitle {
        font-size: 12px;
        opacity: .86;
        margin-top: 4px;
    }

    .hero-badge {
        min-width: 170px;
        padding: 12px 20px;
        border-radius: 16px;
        background: #fff;
        color: var(--primary);
        font-weight: 850;
        font-size: 14px;
        box-shadow: 0 12px 24px rgba(31,41,55,.18);
        text-align: center;
        white-space: nowrap;
    }

    .table-card {
        background: #fff;
        border-radius: 22px;
        box-shadow: 0 10px 30px rgba(75,73,172,.10);
        border: 1px solid rgba(75,73,172,.06);
    }

    .approval-table {
        border-collapse: separate;
        border-spacing: 0 9px;
    }

    .approval-table thead th {
        font-size: 12px;
        color: var(--text);
        font-weight: 900;
        text-transform: uppercase;
        border: none;
        background: #e9edff;
        padding: 14px;
        text-align: center;
        white-space: nowrap;
        border-bottom: 2px solid rgba(75,73,172,.22);
    }

    .approval-table thead th:first-child {
        border-radius: 14px 0 0 14px;
    }

    .approval-table thead th:last-child {
        border-radius: 0 14px 14px 0;
    }

    .approval-table tbody tr {
        background: #fff;
        box-shadow: 0 5px 18px rgba(75,73,172,.06);
    }

    .approval-table tbody tr:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 24px rgba(75,73,172,.12);
        background: #f8faff;
    }

    .approval-table tbody td {
        border: none;
        padding: 14px;
        font-size: 13px;
        vertical-align: middle;
        background: #fff;
        text-align: center;
    }

    .approval-table tbody td:first-child {
        border-radius: 14px 0 0 14px;
    }

    .approval-table tbody td:last-child {
        border-radius: 0 14px 14px 0;
    }

    .text-name {
        text-align: left !important;
        font-weight: 850;
        color: var(--text);
    }

    .operator-sub {
        font-size: 11.5px;
        color: var(--muted);
        margin-top: 3px;
        font-weight: 500;
        line-height: 1.35;
    }

    .nik-badge {
        display: inline-flex;
        padding: 6px 10px;
        border-radius: 999px;
        background: #eef3ff;
        color: var(--primary);
        font-size: 12px;
        font-weight: 800;
    }

    .score-box {
        font-weight: 900;
        color: var(--primary);
    }

    .score-sub {
        font-size: 11px;
        margin-top: 3px;
        font-weight: 800;
    }

    .status-pill {
        display: inline-flex;
        padding: 7px 11px;
        border-radius: 999px;
        font-size: 11.5px;
        font-weight: 850;
        white-space: nowrap;
    }

    .status-pending {
        background: #fff3cd;
        color: #9a6700;
    }

    .status-approved {
        background: #dcfce7;
        color: #15803d;
    }

    .approval-person {
        font-size: 12px;
        font-weight: 850;
        color: var(--text);
        line-height: 1.35;
    }

    .approval-person .muted {
        display: block;
        font-size: 10.5px;
        font-weight: 750;
        color: var(--muted);
        margin-top: 2px;
    }

    .btn-action-detail {
        min-width: 92px;
        height: 38px;
        border: none;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 850;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        background: linear-gradient(135deg, #4B49AC, #7DA0FA);
        color: #fff;
        box-shadow: 0 8px 18px rgba(75,73,172,.18);
    }

    .btn-action-detail:hover {
        color: #fff;
        transform: translateY(-1px);
    }

    .empty-state {
        background: #f8fafc;
        border: 1px dashed #cbd5e1;
        border-radius: 20px;
        padding: 36px;
        text-align: center;
        color: var(--muted);
    }

    .table-footer {
        margin-top: 16px;
        padding: 14px 18px;
        border-radius: 14px;
        background: #f8faff;
        border: 1px solid #eef2ff;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
    }

    .pagination svg {
        width: 16px !important;
        height: 16px !important;
    }

    .pagination {
        margin: 0;
    }

    .pagination .page-link {
        border: none;
        margin: 0 3px;
        border-radius: 8px;
        color: var(--primary);
        font-weight: 700;
        background: #eef2ff;
    }

    .pagination .active .page-link {
        background: linear-gradient(135deg, #4B49AC, #7DA0FA);
        color: #fff;
    }

    @media (max-width: 1200px) {
        .approval-hero {
            flex-direction: column;
            align-items: flex-start;
        }

        .hero-badge {
            width: 100%;
        }
    }
</style>

@php
    $role = auth()->user()->role;
@endphp

<div class="approval-page">

    <div class="approval-hero">
        <div>
            <div class="approval-hero-title">
                @if($role === 'kabag')
                    Approval Kabag
                @else
                    Approval Foreman
                @endif
            </div>

            <div class="approval-hero-subtitle">
                @if($role === 'kabag')
                    Daftar assessment yang sudah disetujui Foreman dan menunggu approval Kabag.
                @else
                    Daftar assessment lulus yang menunggu approval Foreman sesuai divisi Foreman.
                @endif
            </div>
        </div>

        <div class="hero-badge">
            <i class="bi bi-patch-check-fill me-1"></i>
            {{ $approvals->total() }} Pending
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger border-0 shadow-sm rounded-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="table-card p-3">
        <div class="table-responsive">
            <table class="table approval-table align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width:70px;">No</th>
                        <th class="text-start">Operator</th>
                        <th>NIK</th>
                        <th>Divisi</th>
                        <th>Part</th>
                        <th>Periode</th>
                        <th>Nilai</th>
                        <th>Status Foreman</th>
                        <th>Approved Foreman</th>
                        <th>Status Kabag</th>
                        <th>Approved Kabag</th>
                        <th style="width:120px;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($approvals as $approval)
                        @php
                            $assessment = $approval->assessment;
                            $penilaian = $assessment?->penilaian;

                            $foremanClass = $approval->status_foreman === 'approved'
                                ? 'status-approved'
                                : 'status-pending';

                            $kabagClass = $approval->status_kabag === 'approved'
                                ? 'status-approved'
                                : 'status-pending';
                        @endphp

                        <tr>
                            <td>{{ $approvals->firstItem() + $loop->index }}</td>

                            <td class="text-name">
                                {{ $assessment->operator->nama ?? '-' }}
                                <div class="operator-sub">
                                    Attempt ke-{{ $assessment->attempt_no ?? 1 }}
                                </div>
                            </td>

                            <td>
                                <span class="nik-badge">
                                    {{ $assessment->operator->nik ?? '-' }}
                                </span>
                            </td>

                            <td>{{ $assessment->operator->divisi->nama_divisi ?? '-' }}</td>

                            <td>{{ $assessment->part->nama_part ?? '-' }}</td>

                            <td>
                                {{ $assessment->periode->bulan ?? '-' }}/{{ $assessment->periode->tahun ?? '-' }}
                            </td>

                            <td>
                                <div class="score-box">
                                    {{ $penilaian->total_nilai ?? '-' }}
                                </div>

                                @if($penilaian)
                                    <div class="score-sub {{ $penilaian->status_lulus ? 'text-success' : 'text-danger' }}">
                                        {{ $penilaian->status_lulus ? 'LULUS' : 'TIDAK LULUS' }}
                                    </div>
                                @endif
                            </td>

                            <td>
                                <span class="status-pill {{ $foremanClass }}">
                                    {{ ucfirst($approval->status_foreman ?? 'pending') }}
                                </span>
                            </td>

                            <td>
                                <div class="approval-person">
                                    {{ $approval->foreman->name ?? '-' }}
                                    <span class="muted">
                                        {{ $approval->foreman_approved_at ? $approval->foreman_approved_at->format('d/m/Y H:i') : 'Belum approve' }}
                                    </span>
                                </div>
                            </td>

                            <td>
                                <span class="status-pill {{ $kabagClass }}">
                                    {{ ucfirst($approval->status_kabag ?? 'pending') }}
                                </span>
                            </td>

                            <td>
                                <div class="approval-person">
                                    {{ $approval->kabag->name ?? '-' }}
                                    <span class="muted">
                                        {{ $approval->kabag_approved_at ? $approval->kabag_approved_at->format('d/m/Y H:i') : 'Belum approve' }}
                                    </span>
                                </div>
                            </td>

                            <td>
                                <a href="{{ route('approvals.show', $approval->id) }}"
                                   class="btn-action-detail"
                                   title="Review Approval">
                                    <i class="bi bi-eye-fill"></i>
                                    Review
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12">
                                <div class="empty-state">
                                    <i class="bi bi-patch-check fs-1 d-block mb-2"></i>
                                    <div class="fw-semibold mb-1">Tidak ada approval yang perlu diproses.</div>
                                    <div class="small">
                                        Semua assessment sudah diproses atau belum ada data assessment yang masuk ke tahap approval.
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="table-footer">
            <div class="text-muted small" style="font-weight:600;">
                Menampilkan {{ $approvals->firstItem() ?? 0 }} - {{ $approvals->lastItem() ?? 0 }}
                dari {{ $approvals->total() }} approval
            </div>

            <div>
                {{ $approvals->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

@endsection