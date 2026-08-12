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
        align-items: center;
        justify-content: space-between;
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

    .hero-badge {
        border: none;
        min-width: 170px;
        padding: 12px 20px;
        border-radius: 16px;
        background: #ffffff;
        color: #4B49AC;
        font-weight: 800;
        font-size: 14px;
        box-shadow: 0 12px 24px rgba(31,41,55,0.18);
        text-align: center;
    }

    .filter-card,
    .table-card {
        background: #fff;
        border-radius: 22px;
        box-shadow: 0 10px 30px rgba(75, 73, 172, 0.10);
        border: 1px solid rgba(75, 73, 172, 0.06);
    }

    .filter-input {
        height: 44px;
        font-size: 14px;
        border-radius: 12px;
    }

    .filter-card .form-label {
        font-size: 12px !important;
        font-weight: 800 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.6px;
        color: #6b7280;
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

    .operator-table thead th:first-child {
        border-radius: 14px 0 0 14px;
    }

    .operator-table thead th:last-child {
        border-radius: 0 14px 14px 0;
    }

    .operator-table tbody tr {
        background: #fff;
        box-shadow: 0 5px 18px rgba(75, 73, 172, 0.06);
    }

    .operator-table tbody tr:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 24px rgba(75, 73, 172, 0.12);
        background: #f8faff;
    }

    .operator-table tbody td {
        border: none;
        padding: 14px;
        font-size: 13px;
        vertical-align: middle;
        background: #fff;
        text-align: center;
    }

    .operator-table tbody td:first-child {
        border-radius: 14px 0 0 14px;
    }

    .operator-table tbody td:last-child {
        border-radius: 0 14px 14px 0;
    }

    .operator-table .text-name {
        text-align: left;
        font-weight: 800;
        color: #1f2937;
    }

    .operator-sub {
        font-size: 11.5px;
        color: #64748b;
        margin-top: 3px;
        font-weight: 500;
        line-height: 1.35;
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

    .status-waiting {
        display: inline-flex;
        padding: 7px 11px;
        border-radius: 999px;
        background: #fff3cd;
        color: #9a6700;
        font-size: 11.5px;
        font-weight: 800;
    }

    .btn-action-detail {
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
        background: rgba(125, 160, 250, 0.14);
        color: #4B49AC;
    }

    .btn-action-detail:hover {
        background: #4B49AC;
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
        color: #4B49AC;
        font-weight: 700;
        background: #eef2ff;
    }

    .pagination .active .page-link {
        background: linear-gradient(135deg, #4B49AC, #7DA0FA);
        color: #fff;
    }
</style>

<div class="operator-page">

    <div class="operator-hero mb-4">
        <div>
            <div class="operator-hero-title">Penilaian Assessment</div>
            <div class="operator-hero-subtitle">
                Daftar assessment operator yang menunggu penilaian leader.
            </div>
        </div>

        <div class="hero-badge">
            <i class="bi bi-clipboard2-check-fill me-1"></i>
            {{ $assessments->total() }} Assessment
        </div>
    </div>
    <div class="filter-card p-3 mb-4">
        <form method="GET" action="{{ route('leader.assessments.index') }}" id="filterForm">
            <div class="row g-3 align-items-end">
                <div class="col-lg-4 col-md-6">
                    <label class="form-label fw-semibold">Cari Operator / NIK / Part</label>
                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           class="form-control filter-input auto-filter-search"
                           placeholder="Ketik nama, NIK, atau part...">
                </div>

                <div class="col-lg-3 col-md-6">
                    <label class="form-label fw-semibold">Kategori</label>
                    <select name="kategori" class="form-select filter-input auto-filter">
                        <option value="">Semua Kategori</option>
                        <option value="stamping" {{ request('kategori') == 'stamping' ? 'selected' : '' }}>Stamping</option>
                        <option value="welding" {{ request('kategori') == 'welding' ? 'selected' : '' }}>Welding</option>
                        <option value="machining" {{ request('kategori') == 'machining' ? 'selected' : '' }}>Machining</option>
                        <option value="packing" {{ request('kategori') == 'packing' ? 'selected' : '' }}>Packing</option>
                    </select>
                </div>

                <div class="col-lg-3 col-md-6">
                    <label class="form-label fw-semibold">Periode</label>
                    <select name="periode_id" class="form-select filter-input auto-filter">
                        <option value="">Semua Periode</option>
                        @foreach($assessments->getCollection()->pluck('periode')->filter()->unique('id')->sortByDesc('tahun') as $periode)
                            <option value="{{ $periode->id }}" {{ request('periode_id') == $periode->id ? 'selected' : '' }}>
                                {{ $periode->bulan }}/{{ $periode->tahun }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-lg-2 col-md-6">
                    <label class="form-label fw-semibold">Status</label>
                    <select name="status" class="form-select filter-input auto-filter">
                        <option value="">Menunggu</option>
                        <option value="submitted" {{ request('status') == 'submitted' ? 'selected' : '' }}>Submitted</option>
                    </select>
                </div>
            </div>
        </form>

        <div class="alert alert-info rounded-4 mt-3 mb-0">
            <b>Notes:</b> Assessment yang tampil adalah assessment yang sudah dikirim operator dan belum dinilai oleh leader.
            Pencarian dan filter berjalan otomatis tanpa tombol submit.
        </div>
    </div>

    <div class="table-card p-3">
        <div class="table-responsive">
            <table class="table operator-table align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 70px;">No</th>
                        <th class="text-start">Operator</th>
                        <th>NIK</th>
                        <th>Divisi</th>
                        <th>Part</th>
                        <th>Kategori</th>
                        <th>Periode</th>
                        <th>Status</th>
                        <th style="width: 90px;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($assessments as $assessment)
                        <tr>
                            <td>{{ $assessments->firstItem() + $loop->index }}</td>

                            <td class="text-name">
                                {{ $assessment->operator->nama_lengkap ?? '-' }}
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

                            <td>{{ ucfirst($assessment->part->kategori ?? '-') }}</td>

                            <td>
                                {{ $assessment->periode->bulan ?? '-' }}/{{ $assessment->periode->tahun ?? '-' }}
                            </td>

                            <td>
                                <span class="status-waiting">Menunggu Penilaian</span>
                            </td>

                            <td>
                                <a href="{{ route('leader.assessments.show', $assessment->id) }}"
                                   class="btn-action-detail"
                                   title="Nilai Assessment">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9">
                                <div class="empty-state">
                                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                    <div class="fw-semibold mb-1">Tidak ada assessment yang perlu dinilai.</div>
                                    <div class="small">
                                        Semua assessment operator sudah diproses atau belum ada assessment baru.
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="table-footer">
            <div class="text-muted small" style="font-weight: 600;">
                Menampilkan {{ $assessments->firstItem() ?? 0 }} - {{ $assessments->lastItem() ?? 0 }}
                dari {{ $assessments->total() }} assessment
            </div>

            <div>
                {{ $assessments->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

<script>
    const filterForm = document.getElementById('filterForm');
    const autoFilters = document.querySelectorAll('.auto-filter');
    const searchInput = document.querySelector('.auto-filter-search');
    let searchTimer = null;

    function submitFilterForm() {
        const fields = filterForm.querySelectorAll('input, select');

        fields.forEach(function (field) {
            if (field.value === '') {
                field.disabled = true;
            }
        });

        filterForm.submit();
    }

    autoFilters.forEach(function (filter) {
        filter.addEventListener('change', function () {
            submitFilterForm();
        });
    });

    if (searchInput) {
        searchInput.addEventListener('input', function () {
            clearTimeout(searchTimer);

            searchTimer = setTimeout(function () {
                submitFilterForm();
            }, 500);
        });
    }
</script>

@endsection