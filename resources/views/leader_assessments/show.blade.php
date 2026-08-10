@extends('layouts.app')

@section('content')

<style>
    .assessment-page {
        --primary: #4B49AC;
        --support-blue: #7DA0FA;
        --support-purple: #7978E9;
        --support-red: #F3797E;
        --text: #1f2937;
        --muted: #64748b;
        --border: #E5EAF7;
    }

    .assessment-hero {
        width: 100%;
        padding: 16px 20px;
        border-radius: 18px;
        background: linear-gradient(135deg, #4B49AC 0%, #7978E9 55%, #F3797E 100%);
        color: #fff;
        box-shadow: 0 14px 32px rgba(75,73,172,0.24);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        margin-bottom: 18px;
    }

    .assessment-hero-title {
        font-size: 20px;
        font-weight: 850;
        letter-spacing: -0.3px;
    }

    .assessment-hero-subtitle {
        font-size: 12px;
        opacity: 0.86;
        margin-top: 4px;
    }

    .btn-back-hero {
        border: none;
        min-width: 138px;
        padding: 11px 18px;
        border-radius: 15px;
        background: #ffffff;
        color: var(--primary);
        font-weight: 850;
        font-size: 13px;
        box-shadow: 0 12px 24px rgba(31,41,55,0.18);
        text-decoration: none;
        text-align: center;
        transition: .22s ease;
        white-space: nowrap;
    }

    .btn-back-hero:hover {
        background: #f8fafc;
        color: var(--support-red);
        transform: translateY(-2px);
    }

    .summary-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 12px;
        margin-bottom: 18px;
    }

    .summary-card,
    .clean-card {
        background: #fff;
        border-radius: 22px;
        box-shadow: 0 10px 30px rgba(75, 73, 172, 0.10);
        border: 1px solid rgba(75, 73, 172, 0.06);
    }

    .summary-card {
        padding: 15px 16px;
        min-height: 92px;
    }

    .summary-label {
        font-size: 10.5px;
        font-weight: 900;
        color: var(--muted);
        text-transform: uppercase;
        letter-spacing: .5px;
        margin-bottom: 8px;
    }

    .summary-value {
        font-size: 15px;
        font-weight: 900;
        color: var(--text);
        line-height: 1.25;
    }

    .summary-sub {
        font-size: 11px;
        color: var(--muted);
        margin-top: 4px;
        font-weight: 650;
    }

    .clean-card {
        padding: 18px;
        margin-bottom: 18px;
    }

    .card-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 15px;
        padding-bottom: 12px;
        border-bottom: 1px solid #EEF2FF;
    }

    .card-title-custom {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        font-weight: 950;
        color: #1f2937;
        text-transform: uppercase;
        letter-spacing: .45px;
        margin: 0;
    }

    .card-title-custom i {
        color: var(--primary);
        font-size: 16px;
    }

    .status-pill {
        display: inline-flex;
        align-items: center;
        padding: 7px 11px;
        border-radius: 999px;
        background: #FFF3CD;
        color: #9A6700;
        font-size: 11px;
        font-weight: 850;
        white-space: nowrap;
    }

    .answer-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
    }

    .answer-block {
        min-width: 0;
    }

    .answer-label,
    .score-form .form-label {
        display: block;
        font-size: 11px !important;
        font-weight: 900 !important;
        text-transform: uppercase !important;
        letter-spacing: .55px;
        color: var(--muted);
        margin-bottom: 8px;
    }

    .answer-box {
        padding: 14px 15px;
        border-radius: 16px;
        background: #F8FAFF;
        border: 1px solid #E8EDFA;
        color: #1f2937;
        font-size: 13px;
        line-height: 1.65;
        min-height: 130px;
        max-height: 210px;
        overflow-y: auto;
        word-break: break-word;
    }

    .bottom-grid {
        display: grid;
        grid-template-columns: 320px minmax(0, 1fr) 320px;
        gap: 18px;
        align-items: stretch;
    }

    .bottom-grid .clean-card {
        margin-bottom: 0;
        height: 100%;
    }

    .rubric-list {
        display: grid;
        gap: 10px;
    }

    .rubric-item {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        padding: 10px 12px;
        border-radius: 14px;
        background: #F8FAFF;
        border: 1px solid #E8EDFA;
        font-size: 12.5px;
        min-height: 52px;
        align-items: center;
    }

    .rubric-item span:first-child {
        color: var(--muted);
        font-weight: 800;
    }

    .rubric-item span:last-child {
        color: var(--primary);
        font-weight: 950;
    }

    .info-table {
        width: 100%;
        border-collapse: collapse;
    }

    .info-table tr {
        border-bottom: 1px solid #EEF2FF;
    }

    .info-table tr:last-child {
        border-bottom: none;
    }

    .info-table td {
        padding: 11px 0;
        font-size: 12.5px;
        vertical-align: middle;
    }

    .info-label {
        color: var(--muted);
        font-weight: 750;
    }

    .info-value {
        color: var(--text);
        font-weight: 900;
        text-align: right;
    }

    .score-form .form-control {
        height: 44px;
        font-size: 14px;
        border-radius: 12px;
        border: 1px solid #D7DFF2;
        font-weight: 750;
    }

    .score-form textarea.form-control {
        height: auto;
        min-height: 112px;
        resize: vertical;
    }

    .score-form .form-control:focus {
        border-color: var(--support-blue);
        box-shadow: 0 0 0 .2rem rgba(125,160,250,.14);
    }

    .score-help {
        margin-top: 6px;
        font-size: 11px;
        color: var(--muted);
        font-weight: 650;
    }

    .score-limit-message {
        margin-top: 5px;
        font-size: 11px;
        color: #dc3545;
        font-weight: 700;
    }

    .btn-submit-score {
        border: none;
        padding: 12px 22px;
        border-radius: 14px;
        background: linear-gradient(135deg, #4B49AC, #7DA0FA);
        color: #fff;
        font-weight: 850;
        box-shadow: 0 10px 22px rgba(75,73,172,.22);
    }

    .btn-submit-score:hover {
        color: #fff;
        transform: translateY(-1px);
    }

    .btn-cancel-score {
        padding: 12px 20px;
        border-radius: 14px;
        font-weight: 850;
        background: #F1F5F9;
        color: #475569;
        border: none;
        text-decoration: none;
    }

    .btn-cancel-score:hover {
        background: #E2E8F0;
        color: #1E293B;
    }

    @media (max-width: 1400px) {
        .bottom-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 1200px) {
        .summary-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .answer-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .assessment-hero {
            flex-direction: column;
            align-items: flex-start;
        }

        .btn-back-hero {
            width: 100%;
        }

        .summary-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="assessment-page">

    <div class="assessment-hero">
        <div>
            <div class="assessment-hero-title">Form Penilaian Assessment</div>
            <div class="assessment-hero-subtitle">
                Review jawaban operator dan isi nilai berdasarkan nilai maksimal assessment.
            </div>
        </div>
    </div>

    @if(session('error'))
        <div class="alert alert-danger border-0 shadow-sm rounded-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="summary-grid">
        <div class="summary-card">
            <div class="summary-label">Operator</div>
            <div class="summary-value">{{ $assessment->operator->nama ?? '-' }}</div>
            <div class="summary-sub">{{ $assessment->operator->nik ?? '-' }}</div>
        </div>

        <div class="summary-card">
            <div class="summary-label">Divisi</div>
            <div class="summary-value">{{ $assessment->operator->divisi->nama_divisi ?? '-' }}</div>
            <div class="summary-sub">Leader aktif</div>
        </div>

        <div class="summary-card">
            <div class="summary-label">Part</div>
            <div class="summary-value">{{ $assessment->part->nama_part ?? '-' }}</div>
            <div class="summary-sub">{{ ucfirst($assessment->part->kategori ?? '-') }}</div>
        </div>

        <div class="summary-card">
            <div class="summary-label">Periode</div>
            <div class="summary-value">
                {{ $assessment->periode->bulan ?? '-' }}/{{ $assessment->periode->tahun ?? '-' }}
            </div>
            <div class="summary-sub">Attempt ke-{{ $assessment->attempt_no ?? 1 }}</div>
        </div>
    </div>

    <div class="clean-card">
        <div class="card-head">
            <h5 class="card-title-custom">
                <i class="bi bi-card-text"></i>
                Jawaban Operator
            </h5>

            <span class="status-pill">Menunggu Penilaian</span>
        </div>

        <div class="answer-grid">
            <div class="answer-block">
                <label class="answer-label">Flow Process</label>
                <div class="answer-box">
                    {!! nl2br(e($assessment->answer->flow_process ?? '-')) !!}
                </div>
            </div>

            @if(strtolower($assessment->part->kategori ?? '') === 'packing')
                <div class="answer-block">
                    <label class="answer-label">Standar Packing</label>
                    <div class="answer-box">
                        {!! nl2br(e($assessment->answer->standard_packing ?? '-')) !!}
                    </div>
                </div>
            @else
                <div class="answer-block">
                    <label class="answer-label">Nama Subpart / Material</label>
                    <div class="answer-box">
                        {!! nl2br(e($assessment->answer->nama_subpart ?? '-')) !!}
                    </div>
                </div>
            @endif

            <div class="answer-block">
                <label class="answer-label">Q-Point</label>
                <div class="answer-box">
                    {!! nl2br(e($assessment->answer->q_point ?? '-')) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="bottom-grid">
        <div class="clean-card">
            <div class="card-head">
                <h5 class="card-title-custom">
                    <i class="bi bi-award"></i>
                    Nilai Maksimal
                </h5>
            </div>

            <div class="rubric-list">
                @if(strtolower($assessment->part->kategori ?? '') === 'packing')
                    <div class="rubric-item"><span>Q-Point</span><span>Maks. 50</span></div>
                    <div class="rubric-item"><span>Standar Packing</span><span>Maks. 30</span></div>
                    <div class="rubric-item"><span>Flow Process</span><span>Maks. 20</span></div>
                    <div class="rubric-item"><span>Minimal Lulus</span><span>80</span></div>
                @else
                    <div class="rubric-item"><span>Flow Process</span><span>Maks. 30</span></div>
                    <div class="rubric-item"><span>Nama Subpart</span><span>Maks. 30</span></div>
                    <div class="rubric-item"><span>Q-Point</span><span>Maks. 40</span></div>
                    <div class="rubric-item"><span>Minimal Lulus</span><span>85</span></div>
                @endif
            </div>
        </div>

        <div class="clean-card">
            <div class="card-head">
                <h5 class="card-title-custom">
                    <i class="bi bi-pencil-square"></i>
                    Input Nilai Leader
                </h5>
            </div>

            <form action="{{ route('leader.assessments.store', $assessment->id) }}" method="POST" class="score-form" id="scoreForm">
                @csrf

                <div class="row g-3">

                    @if(strtolower($assessment->part->kategori ?? '') === 'packing')
                        <div class="col-md-4">
                            <label class="form-label">Nilai Q-Point</label>
                            <input type="number"
                                   name="nilai_qpoint"
                                   class="form-control score-input @error('nilai_qpoint') is-invalid @enderror"
                                   min="0"
                                   max="50"
                                   data-max-score="50"
                                   data-score-label="Q-Point"
                                   value="{{ old('nilai_qpoint') }}"
                                   required>
                            <div class="score-help">Maksimal 50</div>
                            <div class="score-limit-message d-none"></div>
                            @error('nilai_qpoint')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Nilai Standar Packing</label>
                            <input type="number"
                                   name="nilai_packing"
                                   class="form-control score-input @error('nilai_packing') is-invalid @enderror"
                                   min="0"
                                   max="30"
                                   data-max-score="30"
                                   data-score-label="Standar Packing"
                                   value="{{ old('nilai_packing') }}"
                                   required>
                            <div class="score-help">Maksimal 30</div>
                            <div class="score-limit-message d-none"></div>
                            @error('nilai_packing')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Nilai Flow Proses</label>
                            <input type="number"
                                   name="nilai_flow"
                                   class="form-control score-input @error('nilai_flow') is-invalid @enderror"
                                   min="0"
                                   max="20"
                                   data-max-score="20"
                                   data-score-label="Flow Proses"
                                   value="{{ old('nilai_flow') }}"
                                   required>
                            <div class="score-help">Maksimal 20</div>
                            <div class="score-limit-message d-none"></div>
                            @error('nilai_flow')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @else
                        <div class="col-md-4">
                            <label class="form-label">Nilai Flow Proses</label>
                            <input type="number"
                                   name="nilai_flow"
                                   class="form-control score-input @error('nilai_flow') is-invalid @enderror"
                                   min="0"
                                   max="30"
                                   data-max-score="30"
                                   data-score-label="Flow Proses"
                                   value="{{ old('nilai_flow') }}"
                                   required>
                            <div class="score-help">Maksimal 30</div>
                            <div class="score-limit-message d-none"></div>
                            @error('nilai_flow')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Nilai Nama Subpart</label>
                            <input type="number"
                                   name="nilai_subpart"
                                   class="form-control score-input @error('nilai_subpart') is-invalid @enderror"
                                   min="0"
                                   max="30"
                                   data-max-score="30"
                                   data-score-label="Nama Subpart"
                                   value="{{ old('nilai_subpart') }}"
                                   required>
                            <div class="score-help">Maksimal 30</div>
                            <div class="score-limit-message d-none"></div>
                            @error('nilai_subpart')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Nilai Q-Point</label>
                            <input type="number"
                                   name="nilai_qpoint"
                                   class="form-control score-input @error('nilai_qpoint') is-invalid @enderror"
                                   min="0"
                                   max="40"
                                   data-max-score="40"
                                   data-score-label="Q-Point"
                                   value="{{ old('nilai_qpoint') }}"
                                   required>
                            <div class="score-help">Maksimal 40</div>
                            <div class="score-limit-message d-none"></div>
                            @error('nilai_qpoint')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif

                    <div class="col-md-12">
                        <label class="form-label">Catatan Penilai</label>
                        <textarea name="catatan_penilai"
                                  class="form-control @error('catatan_penilai') is-invalid @enderror"
                                  rows="4"
                                  placeholder="Tulis catatan jika ada...">{{ old('catatan_penilai') }}</textarea>
                        @error('catatan_penilai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <button type="submit" class="btn-submit-score">
                        <i class="bi bi-send-check-fill me-1"></i>
                        Simpan Penilaian
                    </button>
                </div>
            </form>
        </div>

        <div class="clean-card">
            <div class="card-head">
                <h5 class="card-title-custom">
                    <i class="bi bi-info-circle"></i>
                    Detail Assessment
                </h5>
            </div>

            <table class="info-table">
                <tr>
                    <td class="info-label">Status</td>
                    <td class="info-value">{{ strtoupper(str_replace('_', ' ', $assessment->status ?? '-')) }}</td>
                </tr>

                <tr>
                    <td class="info-label">Kategori</td>
                    <td class="info-value">{{ ucfirst($assessment->part->kategori ?? '-') }}</td>
                </tr>

                <tr>
                    <td class="info-label">Minimal Lulus</td>
                    <td class="info-value">
                        {{ strtolower($assessment->part->kategori ?? '') === 'packing' ? '80' : '85' }}
                    </td>
                </tr>

                <tr>
                    <td class="info-label">Attempt</td>
                    <td class="info-value">{{ $assessment->attempt_no ?? 1 }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>

<script>
    const scoreForm = document.getElementById('scoreForm');
    const scoreInputs = document.querySelectorAll('.score-input');

    function validateScoreInput(input) {
        const maxScore = Number(input.dataset.maxScore);
        const label = input.dataset.scoreLabel;
        const value = Number(input.value);
        const messageBox = input.parentElement.querySelector('.score-limit-message');

        if (input.value !== '' && value > maxScore) {
            input.classList.add('is-invalid');
            messageBox.textContent = 'Maksimal nilai ' + label + ' adalah ' + maxScore + '.';
            messageBox.classList.remove('d-none');
            return false;
        }

        messageBox.textContent = '';
        messageBox.classList.add('d-none');

        if (!input.classList.contains('server-error')) {
            input.classList.remove('is-invalid');
        }

        return true;
    }

    scoreInputs.forEach(function (input) {
        input.addEventListener('input', function () {
            validateScoreInput(input);
        });
    });

    if (scoreForm) {
        scoreForm.addEventListener('submit', function (event) {
            let isValid = true;
            let firstInvalidInput = null;

            scoreInputs.forEach(function (input) {
                const currentValid = validateScoreInput(input);

                if (!currentValid) {
                    isValid = false;

                    if (!firstInvalidInput) {
                        firstInvalidInput = input;
                    }
                }
            });

            if (!isValid) {
                event.preventDefault();

                if (firstInvalidInput) {
                    firstInvalidInput.focus();
                }
            }
        });
    }
</script>

@endsection