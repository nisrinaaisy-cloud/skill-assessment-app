@extends('layouts.app')

@section('content')

<style>
    .part-page {
        --primary: #4B49AC;
        --secondary: #98BDFF;
        --support-blue: #7DA0FA;
        --support-purple: #7978E9;
        --support-red: #F3797E;
        --text: #13233E;
        --muted: #65738F;
        --border: #E5EAF7;
    }

    .part-header {
        border-radius: 20px;
        overflow: hidden;
        background: linear-gradient(90deg, var(--primary) 0%, var(--support-purple) 62%, var(--support-red) 100%);
        color: #fff;
        box-shadow: 0 14px 32px rgba(75, 73, 172, 0.22);
        margin-bottom: 18px;
    }

    .part-header-inner {
        padding: 20px 22px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
    }

    .part-title-wrap {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .part-title-icon {
        width: 48px;
        height: 48px;
        border-radius: 15px;
        background: rgba(255, 255, 255, 0.16);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
    }

    .part-title {
        font-size: 21px;
        font-weight: 900;
        line-height: 1.1;
        margin: 0;
        letter-spacing: -0.3px;
    }

    .part-subtitle {
        font-size: 12.5px;
        margin: 5px 0 0;
        color: rgba(255, 255, 255, 0.86);
        font-weight: 600;
    }

    .btn-back {
        border: 1px solid rgba(255, 255, 255, 0.26);
        background: rgba(255, 255, 255, 0.14);
        color: #fff;
        border-radius: 13px;
        padding: 10px 15px;
        font-size: 13px;
        font-weight: 800;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: 0.2s ease;
        white-space: nowrap;
        text-decoration: none;
    }

    .btn-back:hover {
        background: rgba(255, 255, 255, 0.22);
        color: #fff;
        transform: translateY(-1px);
    }

    .part-form-card {
        background: #fff;
        border-radius: 22px;
        border: 1px solid var(--border);
        box-shadow: 0 10px 28px rgba(75, 73, 172, 0.08);
        overflow: hidden;
    }

    .form-body {
        padding: 22px;
    }

    .form-label {
        font-size: 12px !important;
        font-weight: 900 !important;
        text-transform: uppercase;
        letter-spacing: 0.55px;
        color: var(--muted);
        margin-bottom: 8px;
    }

    .required-mark {
        color: var(--support-red);
    }

    .form-control,
    .form-select {
        height: 48px;
        border-radius: 13px;
        border: 1px solid #DDE4F3;
        font-size: 14px;
        font-weight: 600;
        color: var(--text);
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--support-purple);
        box-shadow: 0 0 0 0.2rem rgba(75, 73, 172, 0.12);
    }

    .form-control[readonly] {
        background: #F3F6FF;
        color: var(--muted);
        cursor: not-allowed;
    }

    .invalid-feedback {
        font-size: 12px;
        font-weight: 700;
    }

    .alert-error {
        border: 1px solid rgba(243, 121, 126, 0.22);
        background: #FDEEEF;
        color: #9F4E5A;
        border-radius: 14px;
        padding: 13px 15px;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 18px;
    }

    .action-footer {
        margin-top: 24px;
        padding-top: 18px;
        border-top: 1px solid #EEF2FF;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 14px;
    }

    .btn-secondary-action {
        min-width: 150px;
        border-radius: 14px;
        padding: 11px 20px;
        font-weight: 900;
        background: #F3F6FF;
        color: var(--primary);
        border: 1px solid rgba(75, 73, 172, 0.15);
        text-align: center;
        transition: 0.2s ease;
        text-decoration: none;
    }

    .btn-secondary-action:hover {
        background: var(--primary);
        color: #fff;
    }

    .btn-primary-action {
        min-width: 180px;
        border: none;
        border-radius: 14px;
        padding: 11px 22px;
        font-weight: 900;
        color: #fff;
        background: linear-gradient(135deg, var(--primary), var(--support-blue));
        box-shadow: 0 12px 22px rgba(75, 73, 172, 0.20);
        transition: 0.2s ease;
    }

    .btn-primary-action:hover {
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 16px 28px rgba(75, 73, 172, 0.26);
    }

    .modal-icon {
        width: 58px;
        height: 58px;
        margin: 0 auto 14px;
        border-radius: 18px;
        background: #EEF4FF;
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
    }

    @media (max-width: 768px) {
        .part-header-inner,
        .form-section-head,
        .action-footer {
            flex-direction: column;
            align-items: stretch;
        }

        .btn-back,
        .btn-secondary-action,
        .btn-primary-action {
            width: 100%;
            justify-content: center;
        }
    }
</style>
<div class="part-page">
    <div class="part-header">
        <div class="part-header-inner">
            <div class="part-title-wrap">
                <div class="part-title-icon">
                    <i class="bi bi-pencil-square"></i>
                </div>
                <div>
                    <h1 class="part-title">Detail Part Division Mapping</h1>
                    <p class="part-subtitle">
                        Lihat detail mapping Divisi dan Sub Proses untuk kebutuhan Skill Assessment.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="part-form-card">
        <div class="form-body">
            @if($errors->any())
                <div class="alert-error">
                    <i class="bi bi-exclamation-circle-fill me-1"></i>
                    Terdapat data yang belum sesuai. Silakan periksa kembali form di bawah.
                </div>
            @endif
            <div class="row g-3">
        <form>
            <div class="row g-3">

                <div class="col-lg-6">
                    <label class="form-label">No Part <span class="required-mark">*</span></label>
                    <input type="text" class="form-control" value="{{ $part->no_part }}" readonly>
                </div>

                <div class="col-lg-6">
                    <label class="form-label">Nama Part <span class="required-mark">*</span></label>
                    <input type="text" class="form-control" value="{{ $part->nama_part }}" readonly>
                </div>

                <div class="col-lg-6">
                    <label class="form-label">Sub Proses</label>

                    @forelse($part->partProcesses as $process)
                        <input type="text"
                            class="form-control mb-2"
                            value="{{ optional($process->subProcess)->nama_sub_proses }}"
                            readonly>
                    @empty
                        <input type="text"
                            class="form-control"
                            value="Belum ada Sub Proses"
                            readonly>
                    @endforelse
                </div>

                <div class="col-lg-6">
                    <label class="form-label">Divisi</label>
                    <input type="text"
                        class="form-control"
                        value="{{ optional($part->partDivisions->first()?->division)->nama_divisi }}"
                        readonly>
                </div>

            </div>

            <div class="action-footer">
                <a href="{{ route('parts.index') }}" class="btn-secondary-action">
                    Kembali
                </a>

                <a href="{{ route('parts.edit',$part->id) }}" class="btn-primary-action">
                    <i class="bi bi-pencil-square me-1"></i>
                    Edit Mapping
                </a>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection