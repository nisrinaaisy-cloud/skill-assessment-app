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

    .form-card,
    .guide-card {
        background: #fff;
        border-radius: 22px;
        box-shadow: 0 10px 30px rgba(75, 73, 172, 0.10);
        border: 1px solid rgba(75, 73, 172, 0.06);
        padding: 24px;
        height: 100%;
    }

    .section-title {
        font-size: 20px;
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 4px;
    }

    .section-subtitle {
        font-size: 13px;
        color: #6b7280;
        margin-bottom: 22px;
    }

    .form-label {
        font-size: 12px !important;
        font-weight: 800 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.6px;
        color: #6b7280;
    }

    .form-control,
    .form-select {
        height: 46px;
        font-size: 15px;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #7978E9;
        box-shadow: 0 0 0 0.2rem rgba(75,73,172,0.12);
    }

    .preview-wrapper {
        margin-top: 18px;
        padding: 18px;
        border-radius: 18px;
        background: #f8fafc;
        border: 1px solid #e5e7eb;
    }

    .preview-title {
        font-size: 15px;
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 4px;
    }

    .preview-subtitle {
        font-size: 12px;
        color: #6b7280;
        margin-bottom: 14px;
    }

    .preview-item {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        padding: 14px 16px;
        height: 100%;
    }

    .preview-label {
        font-size: 12px;
        color: #6b7280;
        margin-bottom: 6px;
    }

    .preview-value {
        font-weight: 800;
        color: #1f2937;
    }

    .preview-note {
        margin-top: 14px;
        font-size: 13px;
        color: #6b7280;
    }

    .guide-box {
        border-radius: 18px;
        padding: 16px 18px;
        margin-bottom: 14px;
    }

    .guide-box-title {
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 6px;
    }

    .guide-box-desc {
        font-size: 13px;
        color: #4b5563;
        line-height: 1.6;
    }

    .guide-open {
        background: #eef3ff;
    }

    .guide-close {
        background: #fff7ed;
    }

    .guide-function {
        background: #f5f3ff;
    }

    .guide-note {
        background: #fff0f1;
        margin-bottom: 0;
    }

    .guide-note ul {
        margin-bottom: 0;
        padding-left: 18px;
        font-size: 13px;
        color: #4b5563;
        line-height: 1.8;
    }

    .status-preview {
        display: inline-flex;
        padding: 7px 14px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 800;
    }

    .btn-main {
        border: none;
        border-radius: 14px;
        padding: 10px 26px;
        font-weight: 800;
        color: #fff;
        background: linear-gradient(135deg, #4B49AC, #7DA0FA);
        box-shadow: 0 10px 20px rgba(75, 73, 172, 0.18);
        transition: .2s ease;
        min-width: 150px;
    }

    .btn-main:hover {
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 14px 26px rgba(75, 73, 172, 0.25);
    }

    .btn-reset {
        padding: 10px 26px;
        border-radius: 14px;
        font-weight: 800;
        background: #f1f5ff;
        color: #4B49AC;
        border: 1px solid rgba(75,73,172,0.15);
        transition: all 0.2s ease;
        text-decoration: none !important;
        min-width: 150px;
        text-align: center;
    }

    .btn-reset:hover {
        background: #4B49AC;
        color: #fff;
        box-shadow: 0 6px 14px rgba(75,73,172,0.2);
    }

    .action-footer {
        margin-top: 20px;
        padding-top: 16px;
        border-top: 1px solid #eef2ff;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .invalid-feedback {
        font-size: 12px;
        font-weight: 600;
    }
</style>

<div class="operator-page">

    <div class="operator-hero mb-4">
        <div class="operator-hero-title">Tambah Periode Assessment</div>
        <div class="operator-hero-subtitle">
            Atur periode bulanan assessment operator yang dibuka atau ditutup oleh admin.
        </div>
    </div>

    <div class="row g-4 align-items-stretch">
        <div class="col-lg-7">
            <div class="form-card">
                <div class="section-title">Form Periode</div>
                <div class="section-subtitle">
                    Pilih bulan, tahun, dan status periode assessment yang ingin diatur.
                </div>

                <form action="{{ route('periode.store') }}" method="POST" id="periodeForm">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Bulan</label>
                            <select name="bulan" id="bulan" class="form-select @error('bulan') is-invalid @enderror">
                                <option value="">-- Pilih Bulan --</option>
                                <option value="1" {{ old('bulan') == '1' ? 'selected' : '' }}>Januari</option>
                                <option value="2" {{ old('bulan') == '2' ? 'selected' : '' }}>Februari</option>
                                <option value="3" {{ old('bulan') == '3' ? 'selected' : '' }}>Maret</option>
                                <option value="4" {{ old('bulan') == '4' ? 'selected' : '' }}>April</option>
                                <option value="5" {{ old('bulan') == '5' ? 'selected' : '' }}>Mei</option>
                                <option value="6" {{ old('bulan') == '6' ? 'selected' : '' }}>Juni</option>
                                <option value="7" {{ old('bulan') == '7' ? 'selected' : '' }}>Juli</option>
                                <option value="8" {{ old('bulan') == '8' ? 'selected' : '' }}>Agustus</option>
                                <option value="9" {{ old('bulan') == '9' ? 'selected' : '' }}>September</option>
                                <option value="10" {{ old('bulan') == '10' ? 'selected' : '' }}>Oktober</option>
                                <option value="11" {{ old('bulan') == '11' ? 'selected' : '' }}>November</option>
                                <option value="12" {{ old('bulan') == '12' ? 'selected' : '' }}>Desember</option>
                            </select>
                            @error('bulan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Tahun</label>
                            <input type="number"
                                   name="tahun"
                                   id="tahun"
                                   class="form-control @error('tahun') is-invalid @enderror"
                                   value="{{ old('tahun', date('Y')) }}"
                                   min="2020"
                                   max="2100">
                            @error('tahun')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Status Periode</label>
                            <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                                <option value="open" {{ old('status') == 'open' ? 'selected' : '' }}>Open</option>
                                <option value="close" {{ old('status') == 'close' ? 'selected' : '' }}>Close</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="preview-wrapper">
                        <div class="preview-title">Ringkasan Periode yang Akan Dibuat</div>
                        <div class="preview-subtitle">
                            Bagian ini membantu admin memastikan periode yang dipilih sudah sesuai sebelum disimpan.
                        </div>

                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="preview-item">
                                    <div class="preview-label">Bulan</div>
                                    <div class="preview-value" id="preview-bulan">Belum dipilih</div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="preview-item">
                                    <div class="preview-label">Tahun</div>
                                    <div class="preview-value" id="preview-tahun">Belum dipilih</div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="preview-item">
                                    <div class="preview-label">Status</div>
                                    <span class="status-preview" id="preview-status" style="background: #dcfce7; color: #166534;">
                                        Open
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="preview-note" id="preview-note">
                            Periode akan dibuka sehingga operator masih dapat mengisi assessment pada bulan tersebut.
                        </div>
                    </div>

                    <div class="action-footer">
                        <a href="{{ route('periode.index') }}" class="btn btn-reset">
                            Batal
                        </a>

                        <button type="button" class="btn btn-main" data-bs-toggle="modal" data-bs-target="#confirmModal">
                            <i class="bi bi-save me-1"></i>
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="guide-card">
                <div class="section-title">Panduan Admin</div>
                <div class="section-subtitle">
                    Keterangan singkat untuk membantu admin saat mengatur periode assessment.
                </div>

                <div class="guide-box guide-open">
                    <div class="guide-box-title">Status Open</div>
                    <div class="guide-box-desc">
                        Digunakan jika operator masih diperbolehkan mengisi assessment pada periode tersebut.
                    </div>
                </div>

                <div class="guide-box guide-close">
                    <div class="guide-box-title">Status Close</div>
                    <div class="guide-box-desc">
                        Digunakan jika periode assessment sudah ditutup dan tidak bisa dipakai untuk pengisian baru.
                    </div>
                </div>

                <div class="guide-box guide-function">
                    <div class="guide-box-title">Fungsi Menu Ini</div>
                    <div class="guide-box-desc">
                        Master Periode dipakai untuk mengatur bulan assessment aktif, memisahkan data per bulan,
                        dan membantu kontrol periode mana yang sedang berjalan.
                    </div>
                </div>

                <div class="guide-box guide-note">
                    <div class="guide-box-title">Catatan Penting</div>
                    <ul>
                        <li>Buat periode baru di awal bulan assessment.</li>
                        <li>Pastikan status sesuai kondisi lapangan.</li>
                        <li>Periode lama bisa tetap dibuka jika ada pengisian yang tertunda.</li>
                        <li>Cek kembali ringkasan sebelum menyimpan.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="confirmModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-body text-center p-4">
                <h5 class="fw-bold mb-3">Simpan Data Periode?</h5>
                <p class="text-muted mb-4">
                    Pastikan data periode sudah benar sebelum disimpan.
                </p>

                <div class="d-flex gap-3">
                    <button type="button" class="btn btn-light w-100" data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="button" class="btn btn-main w-100" id="submitBtn">
                        Ya, Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const bulan = document.getElementById('bulan');
        const tahun = document.getElementById('tahun');
        const status = document.getElementById('status');

        const previewBulan = document.getElementById('preview-bulan');
        const previewTahun = document.getElementById('preview-tahun');
        const previewStatus = document.getElementById('preview-status');
        const previewNote = document.getElementById('preview-note');

        const periodeForm = document.getElementById('periodeForm');
        const submitBtn = document.getElementById('submitBtn');

        const namaBulan = {
            1: 'Januari',
            2: 'Februari',
            3: 'Maret',
            4: 'April',
            5: 'Mei',
            6: 'Juni',
            7: 'Juli',
            8: 'Agustus',
            9: 'September',
            10: 'Oktober',
            11: 'November',
            12: 'Desember'
        };

        function updatePreview() {
            const bulanVal = bulan.value;
            const tahunVal = tahun.value;
            const statusVal = status.value;

            previewBulan.textContent = bulanVal ? namaBulan[bulanVal] : 'Belum dipilih';
            previewTahun.textContent = tahunVal ? tahunVal : 'Belum dipilih';

            if (statusVal === 'open') {
                previewStatus.textContent = 'Open';
                previewStatus.style.background = '#dcfce7';
                previewStatus.style.color = '#166534';
                previewNote.textContent = 'Periode akan dibuka sehingga operator masih dapat mengisi assessment pada bulan tersebut.';
            } else {
                previewStatus.textContent = 'Close';
                previewStatus.style.background = '#fee2e2';
                previewStatus.style.color = '#991b1b';
                previewNote.textContent = 'Periode akan ditutup sehingga assessment pada bulan tersebut tidak dapat diisi kembali.';
            }
        }

        bulan.addEventListener('change', updatePreview);
        tahun.addEventListener('input', updatePreview);
        status.addEventListener('change', updatePreview);

        submitBtn.addEventListener('click', function () {
            periodeForm.submit();
        });

        updatePreview();
    });
</script>

@endsection