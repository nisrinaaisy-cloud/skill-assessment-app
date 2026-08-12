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
        min-width: 200px;
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

    .filter-card .form-label {
        font-size: 12px !important;
        font-weight: 800 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.6px;
        color: #6b7280;
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

    .operator-table .text-name{
        text-align:center !important;
        font-weight:700;
        color:#1f2937;
        padding-left:0 !important;
        padding-right:0 !important;
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

    .total-data-badge {
        display: inline-flex;
        align-items: center;
        padding: 10px 16px;
        border-radius: 999px;
        color: #fff;
        font-size: 13px;
        font-weight: 850;
        background: linear-gradient(135deg, #4B49AC, #7978E9, #F3797E);
        box-shadow: 0 10px 22px rgba(75,73,172,0.20);
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

    .leader-badge{
        display:inline-flex;
        align-items:center;
        justify-content:center;
        padding:5px 10px;
        border-radius:7px;
        background:#dbeafe;
        color:#2563eb;
        font-size:11px;
        font-weight:800;
        white-space:nowrap;
    }
    .mapping-badge{
        display:inline-flex;
        align-items:center;
        justify-content:center;
        padding:5px 10px;
        border-radius:7px;
        background:#6b7280;
        color:#fff;
        font-size:11px;
        font-weight:800;
        white-space:nowrap;
}

    .filter-input{
        color:#24304f !important;
        background-color:#fff !important;
    }

    .filter-input option{
        color:#24304f !important;
        background-color:#fff !important;
    }

    .filter-input option:checked{
        color:#24304f !important;
        background-color:#eef2ff !important;
    }
</style>

<div class="operator-page">

    <div class="operator-hero mb-4">
        <div>
            <div class="operator-hero-title">Data Operator</div>
            <div class="operator-hero-subtitle">
                Monitoring data manpower produksi berdasarkan divisi dan leader.
            </div>
        </div>

        <a href="{{ route('operators.create') }}" class="btn btn-add-operator">
            <i class="bi bi-plus-circle me-1"></i>
            Tambah Operator
        </a>
    </div>
    <div class="filter-card p-3 mb-4">
        <form method="GET" action="{{ route('operators.index') }}" id="filterForm">
            <div class="row g-3 align-items-end">

                <div class="col-lg-5 col-md-6">
                    <label class="form-label fw-semibold">Search Nama / NIK</label>
                    <input
                        type="text"
                        name="search"
                        class="form-control filter-input"
                        placeholder="Cari nama atau NIK..."
                        value="{{ request('search') }}"
                        id="searchInput">
                </div>

                <div class="col-lg-3 col-md-6">
                <label class="form-label fw-semibold">Divisi</label>

                <select
                    name="divisi_id"
                    id="divisi_id"
                    class="form-select filter-input auto-submit">

                    <option value="">Semua Divisi</option>

                    @foreach($divisis as $divisi)
                        <option
                            value="{{ $divisi->id }}"
                            {{ request('divisi_id') == $divisi->id ? 'selected' : '' }}>

                            {{ $divisi->nama_divisi }}

                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-4 col-md-6">
                <label class="form-label fw-semibold">Leader</label>
                <select
                    name="leader_id"
                    id="leader_id"
                    class="form-select filter-input auto-submit">
                    <option value="">Semua Leader</option>
                    @foreach($leaders as $leader)
                        <option
                            value="{{ $leader->id }}"
                            {{ request('leader_id') == $leader->id ? 'selected' : '' }}>
                            {{ $leader->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            </div>
        </form>
    </div>

    <div class="table-card p-3">
        <div class="table-responsive">
            <table class="table operator-table align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 70px;">No</th>
                        <th style="width:28%;text-align:center;">
                            Nama Operator
                        </th>
                        <th>NIK</th>
                        <th>Divisi</th>
                        <th>Leader</th>
                        <th style="width: 120px;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($operators as $index => $operator)
                        <tr>
                            <td>{{ $operators->firstItem() + $index }}</td>

                            <td class="text-name">{{ $operator->nama_lengkap }}</td>

                            <td>
                                <span class="nik-badge">{{ $operator->nik }}</span>
                            </td>

                            <td>{{ $operator->divisi->nama_divisi ?? '-' }}</td>

                            <td>
                                @if($operator->leader)
                                    <span class="leader-badge">
                                        {{ strtoupper($operator->leader->name) }}
                                    </span>
                                @else
                                    <span class="mapping-badge unmapped">
                                        Belum Mapping
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('operators.edit', $operator->id) }}" class="btn-action-edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <button
                                        type="button"
                                        class="btn-action-delete"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal"
                                        data-id="{{ $operator->id }}"
                                    >
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                    <div class="fw-semibold mb-1">Belum ada data operator.</div>
                                    <div class="small">
                                        Data operator akan tampil setelah ditambahkan atau setelah pencarian/filter sesuai.
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
                    Menampilkan {{ $operators->firstItem() ?? 0 }} - {{ $operators->lastItem() ?? 0 }}
                    dari {{ $operators->total() }} data
                </div>

                <div>
                    {{ $operators->onEachSide(1)->links('pagination::bootstrap-4') }}
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

                <h5 class="fw-bold mb-2">Hapus Data Operator?</h5>

                <p class="text-muted mb-4" style="font-size:14px;">
                    Data yang dihapus tidak dapat dikembalikan.
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
    const filterForm = document.getElementById('filterForm');
    const searchInput = document.getElementById('searchInput');
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

    if (searchInput) {
        searchInput.addEventListener('input', function () {
            clearTimeout(searchTimer);

            searchTimer = setTimeout(function () {
                submitFilterForm();
            }, 500);
        });
    }

    const divisi = document.getElementById('divisi_id');
    const leader = document.getElementById('leader_id');

    divisi.addEventListener('change', function () {

        leader.selectedIndex = 0;

        submitFilterForm();

    });

    leader.addEventListener('change', function () {

        submitFilterForm();

    });

    const deleteModal = document.getElementById('deleteModal');

    if (deleteModal) {
        deleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');

            const form = document.getElementById('deleteForm');
            form.action = `/operators/${id}`;
        });
    }
</script>

@endsection