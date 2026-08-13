@extends('layouts.app')

@section('content')

<style>
    .operator-page {
        --primary: #4B49AC;
        --secondary: #98BDFF;
        --support-blue: #7DA0FA;
        --support-purple: #7978E9;
        --support-red: #F3797E;
        --text: #13233E;
        --muted: #65738F;
        --border: #E5EAF7;
    }

    .operator-header {
        border-radius: 20px;
        overflow: hidden;
        background: linear-gradient(90deg, var(--primary) 0%, var(--support-purple) 62%, var(--support-red) 100%);
        color: #fff;
        box-shadow: 0 14px 32px rgba(75, 73, 172, 0.22);
        margin-bottom: 18px;
    }

    .operator-header-inner {
        padding: 20px 22px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
    }

    .operator-title-wrap {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .operator-title-icon {
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

    .operator-title {
        font-size: 21px;
        font-weight: 900;
        line-height: 1.1;
        margin: 0;
        letter-spacing: -0.3px;
    }

    .operator-subtitle {
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
    }

    .btn-back:hover {
        background: rgba(255, 255, 255, 0.22);
        color: #fff;
        transform: translateY(-1px);
    }

    .operator-form-card {
        background: #fff;
        border-radius: 22px;
        border: 1px solid var(--border);
        box-shadow: 0 10px 28px rgba(75, 73, 172, 0.08);
        overflow: hidden;
    }

    .form-section-head {
        padding: 17px 22px;
        background: linear-gradient(135deg, #F8FAFF 0%, #F4F2FF 100%);
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
    }

    .form-section-title {
        font-size: 15px;
        font-weight: 900;
        color: var(--text);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 9px;
    }

    .form-section-note {
        font-size: 12px;
        color: var(--muted);
        font-weight: 700;
        margin-top: 3px;
    }

    .operator-badge {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 8px 12px;
        border-radius: 999px;
        background: #EEF4FF;
        color: var(--primary);
        font-size: 12px;
        font-weight: 900;
        white-space: nowrap;
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

    .form-text {
        color: var(--muted);
        font-size: 11.5px;
        font-weight: 600;
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
        .operator-header-inner,
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

        .form-select:disabled {
            background-color: #F3F6FF;
            color: #94a3b8;
            cursor: not-allowed;
            opacity: 0.9;
        }
    }
</style>

<div class="operator-page">

    <div class="operator-header">
        <div class="operator-header-inner">
            <div class="operator-title-wrap">
                <div class="operator-title-icon">
                    <i class="bi bi-pencil-square"></i>
                </div>

                <div>
                    <h1 class="operator-title">Edit Operator</h1>
                    <p class="operator-subtitle">
                        Perbarui data operator tanpa mengubah status aktif secara manual.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="operator-form-card">
       

        <div class="form-body">
            @if($errors->any())
                <div class="alert-error">
                    <i class="bi bi-exclamation-circle-fill me-1"></i>
                    Terdapat data yang belum sesuai. Silakan periksa kembali form di bawah.
                </div>
            @endif

            <form action="{{ route('operators.update', $operator->id) }}" method="POST" id="operatorEditForm">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-lg-6">
                        <label class="form-label">
                            Nama Operator <span class="required-mark">*</span>
                        </label>
                        <input type="text"
                               name="nama_lengkap"
                               class="form-control @error('nama_lengkap') is-invalid @enderror"
                               value="{{ old('nama_lengkap', $operator->nama_lengkap) }}"
                               placeholder="Contoh: Ahmad Kartiko">
                        @error('nama_lengkap')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-lg-6">
                        <label class="form-label">
                            NIK <span class="required-mark">*</span>
                        </label>
                        <input type="text"
                            name="nik"
                            class="form-control"
                            value="{{ $operator->nik }}"
                            readonly
                            style="background:#F3F6FF; color:#65738F; cursor:not-allowed;">

                        <div class="form-text">
                            NIK tidak dapat diubah setelah operator ditambahkan.
                        </div>
                        @error('nik')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-lg-6">
                        <label class="form-label">
                            Divisi <span class="required-mark">*</span>
                        </label>
                        <select name="divisi_id"
                                id="divisi_id"
                                class="form-select @error('divisi_id') is-invalid @enderror">
                            <option value="">Pilih Divisi</option>
                            @foreach($divisis as $divisi)
                                <option value="{{ $divisi->id }}" {{ old('divisi_id', $operator->divisi_id) == $divisi->id ? 'selected' : '' }}>
                                    {{ $divisi->nama_divisi }}
                                </option>
                            @endforeach
                        </select>
                        @error('divisi_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-lg-6">
                        <label class="form-label">
                            Leader <span class="required-mark">*</span>
                        </label>
                        <select name="leader_id"
                                id="leader_id"
                                class="form-select @error('leader_id') is-invalid @enderror">
                            <option value="">Pilih Leader</option>
                            @foreach($leaders as $leader)
                                <option value="{{ $leader->id }}"
                                        data-divisi="{{ $leader->divisi_id }}"
                                        {{ old('leader_id', $operator->leader_id) == $leader->id ? 'selected' : '' }}>
                                    {{ $leader->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="form-text">
                            Leader akan menyesuaikan divisi yang dipilih.
                        </div>
                        @error('leader_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="action-footer">
                    <a href="{{ route('operators.index') }}" class="btn-secondary-action">
                        Batal
                    </a>

                    <button type="button"
                            class="btn-primary-action"
                            data-bs-toggle="modal"
                            data-bs-target="#confirmModal">
                        <i class="bi bi-save me-1"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-body text-center p-4">
                <div class="modal-icon">
                    <i class="bi bi-pencil-square"></i>
                </div>

                <h5 class="fw-bold mb-2">Simpan Perubahan Operator?</h5>

                <p class="text-muted mb-4" style="font-size: 14px;">
                    Pastikan perubahan nama, NIK, divisi, dan leader sudah benar sebelum disimpan.
                </p>

                <div class="d-flex gap-3">
                    <button type="button" class="btn btn-light rounded-3 w-100" data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="button" class="btn-primary-action w-100" id="submitBtn">
                        Ya, Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const divisiSelect = document.getElementById('divisi_id');
    const leaderSelect = document.getElementById('leader_id');
    const operatorEditForm = document.getElementById('operatorEditForm');
    const submitBtn = document.getElementById('submitBtn');

    const allLeaderOptions = Array.from(leaderSelect.options).map(option => option.cloneNode(true));
    const selectedLeader = "{{ old('leader_id', $operator->leader_id) }}";

    function setDefaultLeaderOption(text) {
        leaderSelect.innerHTML = '';

        const defaultOption = document.createElement('option');
        defaultOption.value = '';
        defaultOption.textContent = text;
        leaderSelect.appendChild(defaultOption);
    }

    function filterLeader(resetValue = false) {
        const selectedDivisi = divisiSelect.value;

        if (!selectedDivisi) {
            setDefaultLeaderOption('Pilih divisi terlebih dahulu');
            leaderSelect.disabled = true;
            return;
        }

        setDefaultLeaderOption('Pilih Leader');

        let hasLeader = false;

        allLeaderOptions.forEach(option => {
            if (!option.value) return;

            if (option.dataset.divisi === selectedDivisi) {
                leaderSelect.appendChild(option.cloneNode(true));
                hasLeader = true;
            }
        });

        if (!hasLeader) {
            setDefaultLeaderOption('Leader belum tersedia untuk divisi ini');
            leaderSelect.disabled = true;
            return;
        }

        leaderSelect.disabled = false;

        if (!resetValue && selectedLeader) {
            leaderSelect.value = selectedLeader;
        } else {
            leaderSelect.value = '';
        }
    }

    divisiSelect.addEventListener('change', function () {
        filterLeader(true);
    });

    filterLeader(false);

    submitBtn.addEventListener('click', function () {
        operatorEditForm.submit();
    });
});
</script>

@endsection