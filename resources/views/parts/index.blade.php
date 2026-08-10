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
        table-layout:fixed;
        width:100%;
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

   .operator-table thead th{
        background:#E9EDFF;
        color:#1F2937;
        font-weight:800;
        font-size:13px;
        text-transform:uppercase;
        letter-spacing:.3px;
        padding:16px 14px;
        border-bottom:2px solid rgba(75,73,172,.15);
        text-align:center;
    }

    /* Header Nama Part */

    .operator-table thead th:nth-child(3){
        text-align:center !important;
        padding-left:0 !important;
        padding-right:0 !important;
    }

    .operator-table tbody td{
        padding:14px 14px;
        vertical-align:middle;
        border-bottom:1px solid #F0F1F7;
    }

    .operator-table tbody tr:hover{
        background:#F6F7FF;
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
        background:#F6F7FF;

    }
   .operator-table tbody td {
        padding:12px;
        font-size:13px;
        border-bottom:1px solid #ECECFA;
        vertical-align:middle;
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

    .badge-subproses{
        display:inline-block;
        margin:2px;
        padding:4px 10px;
        border-radius:999px;
        background:#EEF2FF;
        color:#4B49AC;
        font-size:11px;
        font-weight:700;
    }

    .badge-divisi{
        display:inline-flex;
        align-items:center;
        justify-content:center;
        min-width:100px;
        height:26px;
        padding:5px 12px;
        border-radius:7px;
        background:#dbeafe;
        color:#2563eb;
        font-size:11px;
        font-weight:800;
        white-space:nowrap;
    }

    .operator-table thead th:nth-child(4),
    .operator-table tbody td:nth-child(4){
        text-align:center;
        width:260px;
    }

    .operator-table thead th:nth-child(5),
    .operator-table tbody td:nth-child(5){
        text-align:center;
        width:140px;
    }

    .operator-table thead th:nth-child(6),
    .operator-table tbody td:nth-child(6){
        text-align:center;
        width:120px;
    }

    .part-name{
        display:inline-block;
        width:320px;
        max-width:100%;
        margin-left:60px;   /* geser ke kanan */
        text-align:left;
        font-weight:700;
        color:#1F2937;
        line-height:1.45;
    }

    /* Lebar kolom tabel */

    .operator-table th:nth-child(1),
    .operator-table td:nth-child(1){
        width:60px;
        text-align:center;
    }

    .operator-table th:nth-child(2),
    .operator-table td:nth-child(2){
        width:200px;
        text-align:center;
    }

    .operator-table th:nth-child(3),
    .operator-table td:nth-child(3){
        width:440px;
    }

    .operator-table th:nth-child(4),
    .operator-table td:nth-child(4){
        width:270px;
        text-align:center;
    }

    .operator-table th:nth-child(5),
    .operator-table td:nth-child(5){
        width:130px;
        text-align:center;
    }

    .operator-table th:nth-child(6),
    .operator-table td:nth-child(6){
        width:110px;
        text-align:center;
    }

    .nama-part-wrapper{
        display:inline-block;
        width:100%;
        text-align:center;      /* tepat di tengah */
        white-space:normal;
        word-break:break-word;
        line-height:1.4;
        font-weight:600;
        color:#1f2937;
    }
    .badge-unmapped{
        background:#6b7280;
        color:#fff;
    }
</style>

<div class="operator-page">

    <div class="operator-hero mb-4">
        <div>
            <div class="operator-hero-title">Part Division Mapping</div>
            <div class="operator-hero-subtitle">
                Mapping divisi pada master part untuk kebutuhan Skill Assessment.
            </div>
        </div>
    </div>
    <div class="filter-card p-3 mb-4">
        <form method="GET" action="{{ route('parts.index') }}" id="filterForm">
        <div class="row g-3 align-items-end">

            <div class="col-lg-8">
                <label class="form-label fw-semibold">
                    Search Nama / No Part
                </label>

                <input
                    type="text"
                    name="search"
                    id="searchInput"
                    value="{{ request('search') }}"
                    class="form-control filter-input"
                    placeholder="Cari Nama Part / No Part..."
                >
            </div>

            <div class="col-lg-4">
                <label class="form-label fw-semibold">
                    Divisi
                </label>

            <select
                name="division_id"
                id="divisionFilter"
                class="form-select"
            >
                <option value="">Semua Divisi</option>
                @foreach($divisions as $division)
                    <option value="{{ $division->id }}" {{ request('division_id')==$division->id?'selected':'' }}>
                        {{ $division->nama_divisi }}
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
                        <th style="width:70px;">No</th>
                        <th>No Part</th>
                        <th class="text-start">Nama Part</th>
                        <th>Divisi</th>
                        <th style="width:120px;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($parts as $index => $part)
                        <tr>
                            <td>{{ $parts->firstItem() + $index }}</td>

                            <td>
                                <span class="nik-badge">
                                    {{ $part->no_part }}
                                </span>
                            </td>

                           <td>
                                <div class="nama-part-wrapper">
                                    {{ $part->nama_part }}
                                </div>
                            </td>
                            <td class="text-center">
                                @if($part->partDivisions->isNotEmpty())
                                    <span class="badge-divisi">
                                        {{ $part->partDivisions->first()->division->nama_divisi }}
                                    </span>
                                @else
                                    <span class="badge-divisi badge-unmapped">
                                        Belum Mapping
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('parts.show',$part->id) }}" class="btn-action-edit">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <form action="{{ route('parts.destroy', $part->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-action-delete" type="submit">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                    <div class="fw-semibold mb-1">Belum ada data part.</div>
                                    <div class="small">
                                        Data part akan tampil setelah ditambahkan atau setelah pencarian sesuai.
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
                    Menampilkan {{ $parts->firstItem() ?? 0 }} - {{ $parts->lastItem() ?? 0 }}
                    dari {{ $parts->total() }} data
                </div>

                <div>
                    {{ $parts->onEachSide(1)->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    const filterForm = document.getElementById('filterForm');
    const searchInput = document.getElementById('searchInput');
    const divisionFilter = document.getElementById('divisionFilter');
    let searchTimer = null;

    function submitSearchForm() {
        if (searchInput.value.trim() === '') {
            searchInput.disabled = true;
        }

        filterForm.submit();
    }

    if (searchInput) {
        searchInput.addEventListener('input', function () {
            clearTimeout(searchTimer);

            searchTimer = setTimeout(function () {
                submitSearchForm();
            }, 500);
        });
    if (divisionFilter) {
        divisionFilter.addEventListener('change', function () {
            filterForm.submit();
        });
    }
    }
</script>

@endsection