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

    .btn-add-operator {
        border: none;
        min-width: 180px;
        padding: 12px 20px;
        border-radius: 16px;
        background: #ffffff;
        color: #4B49AC;
        font-weight: 800;
        font-size: 14px;
        box-shadow: 0 12px 24px rgba(31,41,55,0.18);
        transition: .22s ease;
        text-decoration: none;
        text-align: center;
    }

    .btn-add-operator:hover {
        background: #f8fafc;
        color: #F3797E;
        transform: translateY(-2px);
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

    .mini-status-line {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 5px 8px;
        margin-top: 4px;
        font-size: 11.5px;
        line-height: 1.35;
    }

    .mini-done {
        color: #059669;
        font-weight: 700;
    }

    .mini-failed {
        color: #dc3545;
        font-weight: 700;
    }

    .mini-review {
        color: #64748b;
        font-weight: 700;
    }

    .mini-approval {
        color: #7c3aed;
        font-weight: 700;
    }

    .mini-less {
        color: #2563eb;
        font-weight: 700;
    }

    .mini-empty {
        color: #ea580c;
        font-weight: 700;
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
    .pagination-wrap {
        display: flex;
        align-items: center;
    }

    .pagination-wrap .pagination {
        margin: 0 !important;
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
            <div class="operator-hero-title">Rekapitulasi Data Operator</div>
            <div class="operator-hero-subtitle">
                Monitoring rekap skill assessment berdasarkan operator, periode wajib, dan status pengerjaan.
            </div>
        </div>

        <a href="{{ route('rekapitulasi.export', request()->query()) }}" class="btn-add-operator">
            <i class="bi bi-download me-1"></i>
            Download Rekap
        </a>
    </div>

    <div class="filter-card p-3 mb-4">
        <form method="GET" action="{{ route('rekapitulasi.index') }}" id="filterForm">
            <div class="row g-3 align-items-end">

                <div class="col-lg-3 col-md-6">
                    <label class="form-label fw-semibold">Cari Operator / NIK</label>
                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           class="form-control filter-input auto-filter-search"
                           placeholder="Ketik nama atau NIK...">
                </div>

                <div class="col-lg-2 col-md-6">
                    <label class="form-label fw-semibold">Periode</label>
                    <select name="periode_id" class="form-select filter-input auto-filter">
                        <option value="">Semua Periode</option>
                        @foreach($periodes as $periode)
                            <option value="{{ $periode->id }}" {{ request('periode_id') == $periode->id ? 'selected' : '' }}>
                                {{ $periode->bulan }}/{{ $periode->tahun }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-lg-2 col-md-6">
                    <label class="form-label fw-semibold">Divisi</label>
                    <select name="divisi_id" class="form-select filter-input auto-filter">
                        <option value="">Semua Divisi</option>
                        @foreach($divisis as $divisi)
                            <option value="{{ $divisi->id }}" {{ request('divisi_id') == $divisi->id ? 'selected' : '' }}>
                                {{ $divisi->nama_divisi }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-lg-2 col-md-6">
                    <label class="form-label fw-semibold">Leader</label>
                    <select name="leader_id" class="form-select filter-input auto-filter">
                        <option value="">Semua Leader</option>
                        @foreach($leaders as $leader)
                            <option value="{{ $leader->id }}" {{ request('leader_id') == $leader->id ? 'selected' : '' }}>
                                {{ $leader->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-lg-3 col-md-6">
                    <label class="form-label fw-semibold">Kondisi Rekap</label>
                    <select name="status" class="form-select filter-input auto-filter">
                        <option value="">Semua Kondisi</option>
                        <option value="tidak_lulus" {{ request('status') == 'tidak_lulus' ? 'selected' : '' }}>Ada Tidak Lulus</option>
                        <option value="submitted" {{ request('status') == 'submitted' ? 'selected' : '' }}>Menunggu Penilaian</option>
                        <option value="dinilai" {{ request('status') == 'dinilai' ? 'selected' : '' }}>Menunggu Approval</option>
                        <option value="belum_lengkap" {{ request('status') == 'belum_lengkap' ? 'selected' : '' }}>Kurang Part</option>
                        <option value="belum_mengisi" {{ request('status') == 'belum_mengisi' ? 'selected' : '' }}>Belum Mengisi</option>
                        <option value="lengkap" {{ request('status') == 'lengkap' ? 'selected' : '' }}>Semua Lengkap</option>
                    </select>
                </div>

            </div>
        </form>

        <div class="alert alert-info rounded-4 mt-3 mb-0">
            <b>Notes:</b> Ringkasan di kolom Total Periode Wajib sekarang sama dengan isi detail periode:
            selesai, tidak lulus, menunggu penilaian, menunggu approval, kurang part, dan belum mengisi.
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
                        <th>Leader</th>
                        <th>Tanggal Masuk</th>
                        <th>Terakhir Dikerjakan</th>
                        <th>Total Periode Wajib</th>
                        <th style="width: 90px;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($operatorRows as $row)
                        <tr>
                            <td>{{ $operatorRows->firstItem() + $loop->index }}</td>

                            <td class="text-name">
                                {{ $row['operator']->nama_lengkap ?? '-' }}
                                <div class="operator-sub">
                                    {{ $row['completed_period_count'] }} periode selesai
                                </div>
                            </td>

                            <td>
                                <span class="nik-badge">
                                    {{ $row['operator']->nik ?? '-' }}
                                </span>
                            </td>

                            <td>{{ $row['operator']->divisi->nama_divisi ?? '-' }}</td>

                            <td>{{ $row['operator']->leader->name ?? '-' }}</td>

                            <td>
                                @if($row['join_date'])
                                    {{ $row['join_date']->format('d/m/Y') }}
                                @else
                                    -
                                @endif
                            </td>

                            <td>
                                @if($row['latest_period'])
                                    {{ $row['latest_period']->bulan }}/{{ $row['latest_period']->tahun }}
                                @else
                                    -
                                @endif
                            </td>

                            <td>
                                <div class="fw-bold">{{ $row['required_period_count'] }} periode</div>

                                <div class="mini-status-line">
                                    <span class="mini-done">{{ $row['completed_period_count'] }} selesai</span>

                                    @if(($row['failed_period_count'] ?? 0) > 0)
                                        <span class="mini-failed">• {{ $row['failed_period_count'] }} tidak lulus</span>
                                    @endif

                                    @if(($row['waiting_scoring_period_count'] ?? 0) > 0)
                                        <span class="mini-review">• {{ $row['waiting_scoring_period_count'] }} menunggu penilaian</span>
                                    @endif

                                    @if(($row['waiting_approval_period_count'] ?? 0) > 0)
                                        <span class="mini-approval">• {{ $row['waiting_approval_period_count'] }} menunggu approval</span>
                                    @endif

                                    @if(($row['less_part_period_count'] ?? 0) > 0)
                                        <span class="mini-less">• {{ $row['less_part_period_count'] }} kurang part</span>
                                    @endif

                                    @if(($row['not_filled_period_count'] ?? 0) > 0)
                                        <span class="mini-empty">• {{ $row['not_filled_period_count'] }} belum mengisi</span>
                                    @endif
                                </div>
                            </td>

                            <td>
                                <a href="{{ route('rekapitulasi.show', $row['operator']->id) }}"
                                   class="btn-action-detail"
                                   title="Detail Periode">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9">
                                <div class="empty-state">
                                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                    <div class="fw-semibold mb-1">Data operator tidak ditemukan.</div>
                                    <div class="small">
                                        Coba ubah pencarian, divisi, leader, periode, atau kondisi rekap.
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
                Menampilkan {{ $operatorRows->firstItem() ?? 0 }} - {{ $operatorRows->lastItem() ?? 0 }}
                dari {{ $operatorRows->total() }} operator
            </div>

            <div class="pagination-wrap">
                <div class="pagination">
                    @if($operatorRows->onFirstPage())
                        <span class="page-item disabled"><span class="page-link">‹</span></span>
                    @else
                        <a class="page-item" href="{{ request()->fullUrlWithQuery(['page' => $operatorRows->currentPage() - 1]) }}">
                            <span class="page-link">‹</span>
                        </a>
                    @endif

                    @for($page = 1; $page <= $operatorRows->lastPage(); $page++)
                        @if($page == $operatorRows->currentPage())
                            <span class="page-item active"><span class="page-link">{{ $page }}</span></span>
                        @else
                            <a class="page-item" href="{{ request()->fullUrlWithQuery(['page' => $page]) }}">
                                <span class="page-link">{{ $page }}</span>
                            </a>
                        @endif
                    @endfor

                    @if($operatorRows->hasMorePages())
                        <a class="page-item" href="{{ request()->fullUrlWithQuery(['page' => $operatorRows->currentPage() + 1]) }}">
                            <span class="page-link">›</span>
                        </a>
                    @else
                        <span class="page-item disabled"><span class="page-link">›</span></span>
                    @endif
                </div>
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