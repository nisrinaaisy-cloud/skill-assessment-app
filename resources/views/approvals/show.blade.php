@extends('layouts.app')

@section('content')

<style>
    .approval-board-page {
        --primary: #4B49AC;
        --primary-soft: #F3F2FF;
        --blue: #7DA0FA;
        --purple: #7978E9;
        --pink: #F3797E;
        --text: #13233E;
        --muted: #667085;
        --border: #E4E9F7;
        --soft: #F8FAFF;

        color: var(--text);
    }

    .approval-board-header {
        min-height: 58px;
        padding: 10px 16px;
        margin-bottom: 12px;
        border-radius: 18px;
        background: #fff;
        border: 1px solid rgba(75,73,172,.10);
        box-shadow: 0 8px 22px rgba(75,73,172,.07);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
    }

    .page-title {
        display: flex;
        align-items: center;
        gap: 10px;
        min-width: 0;
    }

    .page-title-icon {
        width: 38px;
        height: 38px;
        border-radius: 13px;
        background: linear-gradient(135deg, var(--primary), var(--blue));
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 17px;
        flex: 0 0 auto;
    }

    .page-title-main {
        font-size: 18px;
        font-weight: 950;
        line-height: 1.15;
        color: var(--text);
    }

    .page-title-sub {
        margin-top: 3px;
        font-size: 11.5px;
        font-weight: 750;
        color: var(--muted);
        line-height: 1.3;
    }

    .btn-back-board {
        min-width: 116px;
        height: 40px;
        border-radius: 13px;
        background: var(--primary-soft);
        color: var(--primary);
        font-weight: 950;
        font-size: 12.5px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        flex: 0 0 auto;
    }

    .board-layout {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 360px;
        gap: 12px;
        align-items: start;
    }

    .board-left {
        display: grid;
        gap: 12px;
    }

    .board-card {
        background: #fff;
        border-radius: 18px;
        border: 1px solid rgba(75,73,172,.09);
        box-shadow: 0 8px 22px rgba(75,73,172,.07);
    }

    .summary-card {
        padding: 12px 14px;
    }

    .summary-grid {
        display: grid;
        grid-template-columns: 1.25fr .85fr 1fr .65fr .55fr;
        gap: 10px;
    }

    .summary-item {
        min-width: 0;
        padding-right: 10px;
        border-right: 1px solid #EEF2FF;
    }

    .summary-item:last-child {
        border-right: none;
        padding-right: 0;
    }

    .summary-label {
        font-size: 9.5px;
        font-weight: 950;
        color: var(--muted);
        text-transform: uppercase;
        letter-spacing: .45px;
        margin-bottom: 4px;
    }

    .summary-value {
        font-size: 12.8px;
        font-weight: 950;
        color: var(--text);
        line-height: 1.2;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .summary-sub {
        margin-top: 3px;
        font-size: 10.2px;
        font-weight: 800;
        color: var(--muted);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .section-head {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 12.5px;
        font-weight: 950;
        color: var(--text);
        text-transform: uppercase;
        letter-spacing: .35px;
        margin-bottom: 10px;
    }

    .section-head i {
        color: var(--primary);
        font-size: 15px;
    }

    .flow-card {
        padding: 12px 14px 14px;
    }

    .timeline {
        display: grid;
        grid-template-columns: 1fr 26px 1fr 26px 1fr;
        gap: 8px;
        align-items: center;
    }

    .timeline-item {
        min-height: 76px;
        padding: 11px 12px;
        border-radius: 16px;
        background: var(--soft);
        border: 1px solid #E8EDFA;
        display: grid;
        grid-template-columns: 34px 1fr;
        gap: 10px;
        align-items: center;
    }

    .timeline-icon {
        width: 32px;
        height: 32px;
        border-radius: 11px;
        background: #EEF3FF;
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
    }

    .timeline-title {
        font-size: 12px;
        font-weight: 950;
        color: var(--text);
        line-height: 1.2;
    }

    .timeline-sub {
        margin-top: 3px;
        font-size: 10.5px;
        font-weight: 800;
        color: var(--muted);
        line-height: 1.35;
    }

    .timeline-arrow {
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-size: 18px;
    }

    .status-pill {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: fit-content;
        margin-top: 6px;
        padding: 5px 9px;
        border-radius: 999px;
        font-size: 10px;
        font-weight: 950;
        line-height: 1;
    }

    .status-approved {
        background: #DCFCE7;
        color: #15803D;
    }

    .status-pending {
        background: #FFF3CD;
        color: #9A6700;
    }

    .status-rejected {
        background: #FEE2E2;
        color: #DC2626;
    }

    .answer-card {
        padding: 12px 14px 14px;
    }

    .answer-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 10px;
    }

    .answer-box-wrap {
        min-width: 0;
    }

    .answer-label,
    .approval-form .form-label {
        display: block;
        font-size: 10px !important;
        font-weight: 950 !important;
        text-transform: uppercase !important;
        letter-spacing: .45px;
        color: var(--muted);
        margin-bottom: 6px;
    }

    .answer-box {
        height: 92px;
        padding: 10px 11px;
        border-radius: 14px;
        background: var(--soft);
        border: 1px solid #E8EDFA;
        color: var(--text);
        font-size: 12px;
        line-height: 1.5;
        overflow-y: auto;
        word-break: break-word;
    }

    .decision-card {
        padding: 14px;
        position: sticky;
        top: 16px;
    }

    .score-hero {
        padding: 14px;
        border-radius: 16px;
        background: linear-gradient(135deg, var(--primary), var(--blue));
        color: #fff;
        margin-bottom: 12px;
    }

    .score-hero-label {
        font-size: 10px;
        font-weight: 950;
        text-transform: uppercase;
        letter-spacing: .5px;
        opacity: .82;
        margin-bottom: 7px;
    }

    .score-hero-value {
        font-size: 34px;
        line-height: 1;
        font-weight: 950;
    }

    .score-hero-sub {
        margin-top: 7px;
        font-size: 11.5px;
        font-weight: 850;
        opacity: .9;
    }

    .score-list {
        display: grid;
        gap: 8px;
        margin-bottom: 12px;
    }

    .score-row {
        display: grid;
        grid-template-columns: 1fr auto;
        gap: 10px;
        align-items: center;
        min-height: 40px;
        padding: 9px 11px;
        border-radius: 13px;
        background: var(--soft);
        border: 1px solid #E8EDFA;
    }

    .score-row span:first-child {
        font-size: 11px;
        font-weight: 900;
        color: var(--muted);
        text-transform: uppercase;
        letter-spacing: .35px;
    }

    .score-row span:last-child {
        font-size: 14px;
        font-weight: 950;
        color: var(--primary);
    }

    .note-box {
        padding: 10px 11px;
        border-radius: 13px;
        background: #FFF8E6;
        border: 1px solid #FADFA1;
        color: #7C5700;
        margin-bottom: 10px;
    }

    .note-title {
        font-size: 10px;
        font-weight: 950;
        text-transform: uppercase;
        letter-spacing: .45px;
        margin-bottom: 5px;
    }

    .note-text {
        font-size: 11.8px;
        font-weight: 800;
        line-height: 1.45;
    }

    .approval-form textarea {
        min-height: 74px;
        border-radius: 14px;
        border: 1px solid #D7DFF2;
        font-size: 12.5px;
        font-weight: 750;
        resize: vertical;
    }

    .approval-form textarea:focus {
        border-color: var(--blue);
        box-shadow: 0 0 0 .2rem rgba(125,160,250,.14);
    }

    .btn-submit-score {
        width: 100%;
        min-height: 44px;
        border: none;
        border-radius: 14px;
        background: linear-gradient(135deg, var(--primary), var(--blue));
        color: #fff;
        font-size: 13px;
        font-weight: 950;
        box-shadow: 0 9px 20px rgba(75,73,172,.20);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-submit-score:hover {
        color: #fff;
        transform: translateY(-1px);
    }

    .btn-disabled-info {
        border-radius: 14px;
        background: #EEF3FF;
        color: var(--primary);
        padding: 12px;
        font-size: 12px;
        font-weight: 850;
        line-height: 1.45;
    }

    @media (max-width: 1400px) {
        .board-layout {
            grid-template-columns: 1fr;
        }

        .decision-card {
            position: static;
        }
    }

    @media (max-width: 1100px) {
        .summary-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .summary-item {
            border-right: none;
            border-bottom: 1px solid #EEF2FF;
            padding-bottom: 8px;
        }

        .timeline {
            grid-template-columns: 1fr;
        }

        .timeline-arrow {
            display: none;
        }

        .answer-grid {
            grid-template-columns: 1fr;
        }
    }
    /* ===== FINAL FIX APPROVAL DETAIL: BALANCE HEIGHT & SPACING ===== */

        .approval-board-page {
            min-height: calc(100vh - 125px);
            display: flex;
            flex-direction: column;
            gap: 16px;
            padding: 10px 4px 24px;
        }

        .approval-board-header {
            min-height: 74px !important;
            padding: 14px 20px !important;
            margin-bottom: 0 !important;
        }

        .board-layout {
            flex: 1;
            grid-template-columns: minmax(0, 1fr) 390px !important;
            gap: 16px !important;
            align-items: stretch !important;
        }

        .board-left {
            display: grid !important;
            grid-template-rows: auto auto minmax(285px, 1fr);
            gap: 16px !important;
            height: 100%;
        }

        .board-card {
            border-radius: 22px !important;
        }

        .summary-card {
            padding: 17px 18px !important;
        }

        .summary-grid {
            gap: 16px !important;
        }

        .flow-card {
            padding: 18px 18px !important;
        }

        .timeline {
            gap: 14px !important;
        }

        .timeline-item {
            min-height: 104px !important;
            padding: 16px 16px !important;
        }

        .answer-card {
            min-height: 305px !important;
            padding: 18px !important;
            display: flex;
            flex-direction: column;
        }

        .answer-grid {
            flex: 1;
            gap: 14px !important;
        }

        .answer-box {
            height: 170px !important;
            padding: 14px !important;
            font-size: 12.5px !important;
        }

        .decision-card {
            min-height: 100%;
            padding: 18px !important;
            display: flex;
            flex-direction: column;
        }

        .score-hero {
            padding: 20px 18px !important;
            margin-bottom: 16px !important;
        }

        .score-hero-value {
            font-size: 38px !important;
        }

        .score-list {
            gap: 11px !important;
            margin-bottom: 16px !important;
        }

        .score-row {
            min-height: 46px !important;
            padding: 11px 13px !important;
        }

        .approval-form {
            margin-top: auto;
        }

        .approval-form textarea {
            min-height: 96px !important;
        }

        .btn-submit-score {
            min-height: 50px !important;
            margin-top: 6px;
        }

        .section-head {
            margin-bottom: 14px !important;
        }

        @media (max-width: 1400px) {
            .approval-board-page {
                min-height: auto;
            }

            .board-layout {
                grid-template-columns: 1fr !important;
            }

            .board-left {
                grid-template-rows: auto !important;
            }

            .decision-card {
                min-height: auto;
            }
        }
</style>

@php
    $assessment = $approval->assessment;
    $penilaian = $assessment?->penilaian;
    $answer = $assessment?->answer;
    $role = auth()->user()->role;
    $category = strtolower($assessment->part->kategori ?? '');

    $canProcessForeman = $role === 'foreman' && $approval->status_foreman === 'pending';

    $canProcessKabag = $role === 'kabag'
        && $approval->status_foreman === 'approved'
        && $approval->status_kabag === 'pending';

    $foremanClass = match($approval->status_foreman) {
        'approved' => 'status-approved',
        'rejected' => 'status-rejected',
        default => 'status-pending',
    };

    $kabagClass = match($approval->status_kabag) {
        'approved' => 'status-approved',
        'rejected' => 'status-rejected',
        default => 'status-pending',
    };

    $leaderName = $penilaian?->leader?->name ?? '-';
    $foremanName = $approval->foreman?->name ?? '-';
    $kabagName = $approval->kabag?->name ?? '-';

    $foremanTime = $approval->foreman_approved_at
        ? $approval->foreman_approved_at->format('d/m/Y H:i')
        : 'Belum approve';

    $kabagTime = $approval->kabag_approved_at
        ? $approval->kabag_approved_at->format('d/m/Y H:i')
        : 'Belum approve';

    $leaderStatus = strtoupper(str_replace('_', ' ', $penilaian->status_lulus ?? 'lulus'));
@endphp

<div class="approval-board-page">

    

    <div class="board-layout">
        <div class="board-left">
            <div class="board-card summary-card">
                <div class="summary-grid">
                    <div class="summary-item">
                        <div class="summary-label">Operator</div>
                        <div class="summary-value">{{ $assessment->operator->nama_lengkap ?? '-' }}</div>
                        <div class="summary-sub">NIK: {{ $assessment->operator->nik ?? '-' }}</div>
                    </div>

                    <div class="summary-item">
                        <div class="summary-label">Divisi</div>
                        <div class="summary-value">{{ $assessment->operator->divisi->nama_divisi ?? '-' }}</div>
                        <div class="summary-sub">Area kerja</div>
                    </div>

                    <div class="summary-item">
                        <div class="summary-label">Part</div>
                        <div class="summary-value">{{ $assessment->part->nama_part ?? '-' }}</div>
                        <div class="summary-sub">{{ ucfirst($assessment->part->kategori ?? '-') }}</div>
                    </div>

                    <div class="summary-item">
                        <div class="summary-label">Periode</div>
                        <div class="summary-value">
                            {{ $assessment->periode->bulan ?? '-' }}/{{ $assessment->periode->tahun ?? '-' }}
                        </div>
                        <div class="summary-sub">Attempt ke-{{ $assessment->attempt_no ?? 1 }}</div>
                    </div>

                    <div class="summary-item">
                        <div class="summary-label">Keputusan</div>
                        <div class="summary-value">{{ $leaderStatus }}</div>
                        <div class="summary-sub">Leader result</div>
                    </div>
                </div>
            </div>

            <div class="board-card flow-card">
                <div class="section-head">
                    <i class="bi bi-diagram-3"></i>
                    Alur Approval
                </div>

                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-icon">
                            <i class="bi bi-clipboard-check"></i>
                        </div>

                        <div>
                            <div class="timeline-title">Leader</div>
                            <div class="timeline-sub">Dinilai oleh: <strong>{{ $leaderName }}</strong></div>
                            <span class="status-pill status-approved">{{ $leaderStatus }}</span>
                        </div>
                    </div>

                    <div class="timeline-arrow">
                        <i class="bi bi-arrow-right"></i>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-icon">
                            <i class="bi bi-person-check"></i>
                        </div>

                        <div>
                            <div class="timeline-title">Foreman</div>
                            <div class="timeline-sub">
                                Oleh: <strong>{{ $foremanName }}</strong><br>
                                {{ $foremanTime }}
                            </div>
                            <span class="status-pill {{ $foremanClass }}">
                                {{ ucfirst($approval->status_foreman ?? 'pending') }}
                            </span>
                        </div>
                    </div>

                    <div class="timeline-arrow">
                        <i class="bi bi-arrow-right"></i>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-icon">
                            <i class="bi bi-patch-check"></i>
                        </div>

                        <div>
                            <div class="timeline-title">Kabag</div>
                            <div class="timeline-sub">
                                Oleh: <strong>{{ $kabagName }}</strong><br>
                                {{ $kabagTime }}
                            </div>
                            <span class="status-pill {{ $kabagClass }}">
                                {{ ucfirst($approval->status_kabag ?? 'pending') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="board-card answer-card">
                <div class="section-head">
                    <i class="bi bi-card-text"></i>
                    Jawaban Operator
                </div>

                <div class="answer-grid">
                    <div class="answer-box-wrap">
                        <label class="answer-label">Flow Process</label>
                        <div class="answer-box">
                            {!! nl2br(e($answer->flow_process ?? '-')) !!}
                        </div>
                    </div>

                    @if($category === 'packing')
                        <div class="answer-box-wrap">
                            <label class="answer-label">Standar Packing</label>
                            <div class="answer-box">
                                {!! nl2br(e($answer->standard_packing ?? '-')) !!}
                            </div>
                        </div>
                    @else
                        <div class="answer-box-wrap">
                            <label class="answer-label">Nama Subpart / Material</label>
                            <div class="answer-box">
                                {!! nl2br(e($answer->nama_subpart ?? '-')) !!}
                            </div>
                        </div>
                    @endif

                    <div class="answer-box-wrap">
                        <label class="answer-label">Q-Point</label>
                        <div class="answer-box">
                            {!! nl2br(e($answer->q_point ?? '-')) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="board-card decision-card">
            <div class="score-hero">
                <div class="score-hero-label">Total Nilai</div>
                <div class="score-hero-value">{{ $penilaian->total_nilai ?? '-' }}</div>
                <div class="score-hero-sub">{{ $leaderStatus }}</div>
            </div>

            <div class="score-list">
                <div class="score-row">
                    <span>Flow</span>
                    <span>{{ $penilaian->nilai_flow ?? '-' }}</span>
                </div>

                @if($category === 'packing')
                    <div class="score-row">
                        <span>Packing</span>
                        <span>{{ $penilaian->nilai_packing ?? '-' }}</span>
                    </div>
                @else
                    <div class="score-row">
                        <span>Sub Part</span>
                        <span>{{ $penilaian->nilai_subpart ?? '-' }}</span>
                    </div>
                @endif

                <div class="score-row">
                    <span>Q-Point</span>
                    <span>{{ $penilaian->nilai_qpoint ?? '-' }}</span>
                </div>
            </div>
            @if(!empty($penilaian->catatan_penilai))
                <div class="note-box">
                    <div class="note-title">Catatan Leader</div>
                    <div class="note-text">{{ $penilaian->catatan_penilai }}</div>
                </div>
            @endif
            @if(!empty($approval->foreman_note))
                <div class="note-box">
                    <div class="note-title">Catatan Foreman</div>
                    <div class="note-text">{{ $approval->foreman_note }}</div>
                </div>
            @endif
            @if(!empty($approval->kabag_note))
                <div class="note-box">
                    <div class="note-title">Catatan Kabag</div>
                    <div class="note-text">{{ $approval->kabag_note }}</div>
                </div>
            @endif
            @if($canProcessForeman || $canProcessKabag)
                <form action="{{ route('approvals.approve', $approval->id) }}"
                      method="POST"
                      class="approval-form">
                    @csrf
                    <div class="mb-2">
                        <label class="form-label">Catatan Approval</label>
                        <textarea name="note"
                                  class="form-control"
                                  rows="3"
                                  placeholder="Catatan opsional..."></textarea>
                    </div>

                    <button type="submit" class="btn-submit-score">
                        <i class="bi bi-check2-circle"></i>
                        @if($role === 'foreman')
                            Simpan Approval Foreman
                        @else
                            Simpan Approval Kabag
                        @endif
                    </button>
                </form>
            @else
                <div class="btn-disabled-info">
                    Approval ini sudah diproses atau belum menjadi giliran role kamu.
                </div>
            @endif
        </div>
    </div>
</div>

@endsection