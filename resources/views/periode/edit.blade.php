@extends('layouts.app')

@section('content')

<style>
/* === GLOBAL CONSISTENT === */
.operator-hero {
    padding: 16px 20px;
    border-radius: 18px;
    background: linear-gradient(135deg, #4B49AC 0%, #7978E9 55%, #F3797E 100%);
    color: #fff;
    box-shadow: 0 14px 32px rgba(75,73,172,0.24);
}

.form-card, .guide-card {
    background: #fff;
    border-radius: 22px;
    box-shadow: 0 10px 30px rgba(75,73,172,0.10);
    border: 1px solid rgba(75,73,172,0.06);
    padding: 24px;
}

.section-title {
    font-size: 20px;
    font-weight: 800;
}

.section-subtitle {
    font-size: 13px;
    color: #6b7280;
    margin-bottom: 20px;
}

.form-label {
    font-size: 12px !important;
    font-weight: 800 !important;
    text-transform: uppercase !important;
}

.form-control, .form-select {
    height: 46px;
    border-radius: 12px;
}

.preview-wrapper {
    margin-top: 18px;
    padding: 18px;
    border-radius: 18px;
    background: #f8fafc;
    border: 1px solid #e5e7eb;
}

.preview-item {
    background: #fff;
    border-radius: 16px;
    padding: 14px;
    border: 1px solid #e5e7eb;
}

.btn-main {
    border-radius: 14px;
    padding: 10px 26px;
    font-weight: 800;
    color: #fff;
    background: linear-gradient(135deg, #4B49AC, #7DA0FA);
}

.btn-reset {
    padding: 10px 26px;
    border-radius: 14px;
    font-weight: 800;
    background: #f1f5ff;
    color: #4B49AC;
    border: 1px solid rgba(75,73,172,0.15);
}

.action-footer {
    margin-top: 20px;
    padding-top: 16px;
    border-top: 1px solid #eef2ff;
    display: flex;
    justify-content: space-between;
}
</style>

<div class="operator-page">

<div class="operator-hero mb-4">
    <div class="fw-bold">Edit Periode Assessment</div>
    <div class="small">Perbarui bulan, tahun, atau status periode assessment.</div>
</div>

<div class="row g-4">

<!-- FORM -->
<div class="col-lg-7">
<div class="form-card">

<div class="section-title">Form Edit Periode</div>
<div class="section-subtitle">
Pastikan perubahan periode sudah benar sebelum disimpan.
</div>

<form action="{{ route('periode.update', $periode->id) }}" method="POST" id="formPeriode">
@csrf
@method('PUT')

<div class="row g-3">

<div class="col-md-6">
<label class="form-label">Bulan</label>
<select name="bulan" id="bulan" class="form-select">
<option value="">-- Pilih Bulan --</option>
@for($i=1;$i<=12;$i++)
<option value="{{ $i }}" {{ old('bulan',$periode->bulan)==$i?'selected':'' }}>
{{ \Carbon\Carbon::create()->month($i)->format('F') }}
</option>
@endfor
</select>
</div>

<div class="col-md-6">
<label class="form-label">Tahun</label>
<input type="number" name="tahun" id="tahun" class="form-control"
value="{{ old('tahun',$periode->tahun) }}">
</div>

<div class="col-12">
<label class="form-label">Status</label>
<select name="status" id="status" class="form-select">
<option value="open" {{ old('status',$periode->status)=='open'?'selected':'' }}>Open</option>
<option value="close" {{ old('status',$periode->status)=='close'?'selected':'' }}>Close</option>
</select>
</div>

</div>

<!-- PREVIEW -->
<div class="preview-wrapper">
<div class="fw-bold mb-1">Ringkasan Periode yang Akan Diupdate</div>
<div class="small text-muted mb-3">
Bagian ini membantu memastikan perubahan sudah sesuai sebelum disimpan.
</div>

<div class="row g-3">
<div class="col-md-4">
<div class="preview-item">
<div class="small text-muted">Bulan</div>
<div class="fw-bold" id="p-bulan">-</div>
</div>
</div>

<div class="col-md-4">
<div class="preview-item">
<div class="small text-muted">Tahun</div>
<div class="fw-bold" id="p-tahun">-</div>
</div>
</div>

<div class="col-md-4">
<div class="preview-item">
<div class="small text-muted">Status</div>
<div>
<span id="p-status" class="badge rounded-pill px-3 py-2">Open</span>
</div>
</div>
</div>
</div>

<div class="small text-muted mt-3" id="p-note">
Periode akan dibuka sehingga operator masih dapat mengisi assessment.
</div>

</div>

<div class="action-footer">
<a href="{{ route('periode.index') }}" class="btn btn-reset">Batal</a>

<button type="button" class="btn btn-main" data-bs-toggle="modal" data-bs-target="#confirmModal">
Update
</button>
</div>

</form>
</div>
</div>

<!-- GUIDE -->
<div class="col-lg-5">
<div class="guide-card">

<div class="section-title">Panduan Admin</div>
<div class="section-subtitle">Gunakan panduan ini sebelum update.</div>

<div class="mb-3 p-3 rounded-4" style="background:#eef3ff">
<b>Status Open</b><br>
<span class="small text-muted">Masih bisa isi assessment</span>
</div>

<div class="mb-3 p-3 rounded-4" style="background:#fff7ed">
<b>Status Close</b><br>
<span class="small text-muted">Sudah tidak bisa diisi</span>
</div>

</div>
</div>

</div>
</div>

<!-- MODAL -->
<div class="modal fade" id="confirmModal">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content p-4 text-center">
<h5>Update Data?</h5>
<div class="d-flex gap-2">
<button class="btn btn-light w-100" data-bs-dismiss="modal">Batal</button>
<button class="btn btn-main w-100" id="submitBtn">Ya</button>
</div>
</div>
</div>
</div>

<script>
const bulan = document.getElementById('bulan');
const tahun = document.getElementById('tahun');
const status = document.getElementById('status');

function update(){
const namaBulan=["","Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Des"];

document.getElementById('p-bulan').innerText = bulan.value ? namaBulan[bulan.value] : '-';
document.getElementById('p-tahun').innerText = tahun.value || '-';

if(status.value==='open'){
p-status.innerText='Open';
p-status.style.background='#dcfce7';
p-note.innerText='Periode akan dibuka sehingga operator masih dapat mengisi assessment.';
}else{
p-status.innerText='Close';
p-status.style.background='#fee2e2';
p-note.innerText='Periode ditutup dan tidak bisa diisi.';
}
}

bulan.onchange=update;
tahun.oninput=update;
status.onchange=update;
update();

submitBtn.onclick = ()=> document.getElementById('formPeriode').submit();
</script>

@endsection