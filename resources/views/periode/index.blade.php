@extends('layouts.app')

@section('content')

<style>
    .operator-header {
        background: #fff;
        border-radius: 22px;
        padding: 20px 24px;
        box-shadow: 0 10px 30px rgba(75, 73, 172, 0.10);
        border-left: 5px solid #7978E9;
    }

    .operator-title {
        font-size: 24px;
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 4px;
    }

    .operator-subtitle {
        color: #6b7280;
        font-size: 13px;
        margin: 0;
    }

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
        min-width: 190px;
        padding: 12px 22px;
        border-radius: 16px;
        background: #ffffff;
        color: #4B49AC;
        font-weight: 800;
        font-size: 15px;
        box-shadow: 0 12px 24px rgba(31,41,55,0.18);
        transition: .22s ease;
        justify-content: center;
        text-decoration: none !important;
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
        height: 46px;
        font-size: 15px;
        border-radius: 12px;
    }

    .filter-card .form-label {
        font-size: 12px !important;
        font-weight: 800 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.6px;
        color: #6b7280;
    }

    .btn-reset {
        padding: 8px 14px;
        font-size: 13px;
        border-radius: 12px;
        height: 42px;
        font-weight: 700;
        background: #f1f5ff;
        color: #4B49AC;
        border: 1px solid rgba(75,73,172,0.15);
        transition: all 0.2s ease;
    }

    .btn-reset:hover {
        background: #4B49AC;
        color: #fff;
        box-shadow: 0 6px 14px rgba(75,73,172,0.2);
    }

    .btn-main {
        border: none;
        border-radius: 14px;
        padding: 10px 16px;
        font-weight: 700;
        color: #fff;
        background: linear-gradient(135deg, #4B49AC, #7DA0FA);
        box-shadow: 0 10px 20px rgba(75, 73, 172, 0.18);
        transition: .2s ease;
    }

    .btn-main:hover {
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 14px 26px rgba(75, 73, 172, 0.25);
    }

    .btn-filter {
        border: none;
        border-radius: 12px;
        background: linear-gradient(135deg, #4B49AC, #7DA0FA);
        color: #fff;
        font-weight: 700;
        height: 42px;
    }

    .operator-table {
        border-collapse: collapse;
        border-spacing: 0 10px;
    }

    .operator-table-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 22px 28px;
        border-radius: 20px;
        background: linear-gradient(135deg, #4B49AC 0%, #7978E9 50%, #F3797E 100%);
        color: #fff;
        box-shadow: 0 12px 28px rgba(75,73,172,0.25);
        width: 100%;
    }

    .table-title {
        font-size: 20px;
        font-weight: 800;
    }

    .table-subtitle {
        font-size: 14px;
        opacity: 0.9;
        margin-top: 4px;
    }

    .table-meta {
        background: rgba(255,255,255,0.2);
        padding: 6px 12px;
        border-radius: 10px;
        font-size: 12px;
        font-weight: 600;
    }

    .operator-table thead th {
        font-size: 12px;
        color: #1f2937;
        font-weight: 900;
        text-transform: uppercase;
        border: none;
        background: #e9edff;
        padding: 15px 14px;
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
        border-bottom: 1px solid #eef2ff;
    }

    .operator-table tbody tr:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 24px rgba(75, 73, 172, 0.12);
        background: #f8faff;
    }

    .operator-table tbody td {
        border: none;
        padding: 16px 14px;
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
        font-weight: 700;
        color: #1f2937;
    }

    .nik-badge {
        display: inline-flex;
        padding: 6px 10px;
        border-radius: 999px;
        background: #eef3ff;
        color: #4B49AC;
        font-size: 12px;
        font-weight: 700;
    }

    .status-active {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 11px;
        border-radius: 999px;
        background: #ecfdf5;
        color: #059669;
        font-size: 12px;
        font-weight: 800;
    }

    .status-inactive {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 11px;
        border-radius: 999px;
        background: #f1f5f9;
        color: #64748b;
        font-size: 12px;
        font-weight: 800;
    }

    .status-warning {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 11px;
        border-radius: 999px;
        background: #fff7ed;
        color: #ea580c;
        font-size: 12px;
        font-weight: 800;
    }

    .status-danger {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 11px;
        border-radius: 999px;
        background: #fff0f1;
        color: #dc3545;
        font-size: 12px;
        font-weight: 800;
    }

    .btn-action-edit {
        border: none;
        border-radius: 999px;
        padding: 7px 12px;
        background: rgba(125, 160, 250, 0.14);
        color: #4B49AC;
        font-size: 18px;
        font-weight: 800;
        text-decoration: none;
    }

    .btn-action-edit:hover {
        background: #4B49AC;
        color: #fff;
    }

    .btn-action-delete {
        border: none;
        border-radius: 999px;
        padding: 7px 12px;
        background: #fff0f1;
        color: #dc3545;
        font-size: 18px;
        font-weight: 800;
    }

    .btn-action-delete:hover {
        background: #dc3545;
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
        font-weight: 600;
        background: #eef2ff;
        transition: all 0.2s ease;
    }

    .pagination .page-link:hover {
        background: #dbe4ff;
        color: #4B49AC;
    }

    .pagination .active .page-link {
        background: linear-gradient(135deg, #4B49AC, #7DA0FA);
        color: #fff;
        box-shadow: 0 6px 14px rgba(75,73,172,0.25);
    }

    .pagination .page-link:focus {
        box-shadow: none;
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
        backdrop-filter: blur(6px);
    }
</style>

<div class="operator-page">

    <div class="operator-hero mb-4">
        <div>
            <div class="operator-hero-title">Data Periode</div>
            <div class="operator-hero-subtitle">
                Pengelolaan periode assessment berdasarkan bulan, tahun, dan status aktif.
            </div>
        </div>

        <a href="{{ route('periode.create') }}" class="btn btn-add-operator">
            <i class="bi bi-plus-circle me-1"></i>
            Tambah Periode
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success rounded-4 border-0 shadow-sm">
            {{ session('success') }}
        </div>
    @endif
            <div class="filter-card p-3 mb-4">
        <form method="GET" action="{{ route('periode.index') }}">
            <div class="row g-3 align-items-end">

                <div class="col-lg-4 col-md-6">
                    <label class="form-label fw-semibold">Bulan</label>
                    <select name="bulan" class="form-select filter-input">
                        <option value="">Semua Bulan</option>
                        <option value="1" {{ request('bulan') == '1' ? 'selected' : '' }}>Januari</option>
                        <option value="2" {{ request('bulan') == '2' ? 'selected' : '' }}>Februari</option>
                        <option value="3" {{ request('bulan') == '3' ? 'selected' : '' }}>Maret</option>
                        <option value="4" {{ request('bulan') == '4' ? 'selected' : '' }}>April</option>
                        <option value="5" {{ request('bulan') == '5' ? 'selected' : '' }}>Mei</option>
                        <option value="6" {{ request('bulan') == '6' ? 'selected' : '' }}>Juni</option>
                        <option value="7" {{ request('bulan') == '7' ? 'selected' : '' }}>Juli</option>
                        <option value="8" {{ request('bulan') == '8' ? 'selected' : '' }}>Agustus</option>
                        <option value="9" {{ request('bulan') == '9' ? 'selected' : '' }}>September</option>
                        <option value="10" {{ request('bulan') == '10' ? 'selected' : '' }}>Oktober</option>
                        <option value="11" {{ request('bulan') == '11' ? 'selected' : '' }}>November</option>
                        <option value="12" {{ request('bulan') == '12' ? 'selected' : '' }}>Desember</option>
                    </select>
                </div>

                <div class="col-lg-3 col-md-6">
                    <label class="form-label fw-semibold">Tahun</label>
                    <input type="number"
                        name="tahun"
                        class="form-control filter-input"
                        placeholder="Semua Tahun"
                        value="{{ request('tahun') }}">
                </div>

                <div class="col-lg-3 col-md-6">
                    <label class="form-label fw-semibold">Status</label>
                    <select name="status" class="form-select filter-input">
                        <option value="">Semua Status</option>
                        <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Open</option>
                        <option value="close" {{ request('status') == 'close' ? 'selected' : '' }}>Close</option>
                    </select>
                </div>

                <div class="col-lg-1 col-md-3 d-flex align-items-end">
                    <button class="btn btn-filter w-100">
                        <i class="bi bi-funnel"></i>
                    </button>
                </div>

                <div class="col-lg-1 col-md-3 d-flex align-items-end">
                    <a href="{{ route('periode.index') }}" class="btn btn-reset w-100">
                        Reset
                    </a>
                </div>

            </div>
        </form>
    </div>
        <div class="table-responsive">
            <table class="table operator-table align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 70px;">No</th>
                        <th>Bulan</th>
                        <th>Tahun</th>
                        <th>Status</th>
                        <th style="width: 120px;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($periodes as $i => $p)
                        <tr>
                           <td>{{ $periodes->firstItem() + $i }}</td>
                           <td>
                                {{ \Carbon\Carbon::create()->month($p->bulan)->translatedFormat('F') }}
                            </td>
                            <td>{{ $p->tahun }}</td>
                            <td>
                                @if($p->status == 'open')
                                    <span class="status-active">
                                        <i class="bi bi-check-circle-fill"></i>
                                        Open
                                    </span>
                                @else
                                    <span class="status-inactive">
                                        <i class="bi bi-dash-circle-fill"></i>
                                        Close
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('periode.edit', $p->id) }}" class="btn-action-edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <button
                                        type="button"
                                        class="btn-action-delete"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal"
                                        data-id="{{ $p->id }}"
                                    >
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                    <div class="fw-semibold mb-1">Belum ada data periode.</div>
                                    <div class="small">
                                        Data periode akan tampil setelah ditambahkan.
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="table-footer">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 w-100">

                <div class="text-muted small" style="font-weight: 500;">
                    Menampilkan {{ $periodes->firstItem() }} - {{ $periodes->lastItem() }} 
                    dari {{ $periodes->total() }} data
                </div>

                <div>
                    {{ $periodes->onEachSide(1)->links('pagination::bootstrap-4') }}
                </div>

            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow">
            <div class="modal-body p-4 text-center">
                <div style="
                    width: 60px;
                    height: 60px;
                    margin: 0 auto 16px;
                    border-radius: 16px;
                    background: #fff0f1;
                    color: #dc3545;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 26px;
                ">
                    <i class="bi bi-trash"></i>
                </div>

                <h5 class="fw-bold mb-2">Hapus Data Periode?</h5>

                <p class="text-muted mb-4" style="font-size:14px;">
                    Data periode yang dihapus tidak dapat dikembalikan.
                </p>

                <div class="d-flex gap-3">
                    <button type="button" class="btn btn-light w-100" data-bs-dismiss="modal">
                        Batal
                    </button>

                    <form id="deleteForm" method="POST" class="w-100">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100">
                            Ya, Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const deleteModal = document.getElementById('deleteModal');

    if (deleteModal) {
        deleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');

            const form = document.getElementById('deleteForm');
            form.action = `/periode/${id}`;
        });
    }
</script>

@endsection