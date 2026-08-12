@extends('layouts.app')
@section('content')
<style>
.leader-hero{
	width:100%;
	padding:14px 20px;
	border-radius:22px;
	background:linear-gradient(135deg,#4B49AC 0%,#7978E9 55%,#F3797E 100%);
	display:flex;
	align-items:center;
	justify-content:space-between;
	color:#fff;
	box-shadow:0 15px 35px rgba(75,73,172,.22);
}
.leader-title{
	font-size:17px;
	font-weight:800;
}
.leader-subtitle{
	font-size:12px;
	opacity:.9;
	margin-top:4px;
}
.btn-back{
	background:#fff;
	color:#4B49AC;
	border:none;
	border-radius:16px;
	padding:12px 26px;
	font-weight:800;
	text-decoration:none;
	transition:.2s;
}
.btn-back:hover{
	background:#f5f7ff;
	color:#F3797E;
}
.info-card{
	background:#fff;
	border-radius:18px;
	padding:14px 18px;
	box-shadow:0 8px 18px rgba(75,73,172,.08);
	border:1px solid #eef2ff;
	min-height:74px;
	display:flex;
	align-items:center;
	gap:18px;
}
.info-icon{
	width:40px;
	height:40px;
	border-radius:50%;
	background:#eef2ff;
	color:#4B49AC;
	display:flex;
	align-items:center;
	justify-content:center;
	font-size:17px;
	flex-shrink:0;
}
.info-label{
	font-size:11px;
	font-weight:800;
	color:#6b7280;
	text-transform:uppercase;
	line-height:1;
	margin-bottom:6px;
}
.info-value{
	font-size:15px;
	font-weight:800;
	color:#1f2937;
	line-height:1.2;
}
.table-card{
	background:#fff;
	border-radius:20px;
	padding:16px 18px;
	box-shadow:0 10px 25px rgba(75,73,172,.08);
	border:1px solid #eef2ff;
}
.search-box{
	height:50px;
	border:1px solid #d7defd;
}
.search-box:focus{
	border-color:#4B49AC;
	box-shadow:0 0 0 .15rem rgba(75,73,172,.12);
}
.input-group{
	max-width:850px;
}
.input-group .input-group-text{
	border-radius:14px 0 0 14px;
}
.input-group .form-control{
	border-radius:0 14px 14px 0;
}
.form-check-input{
	width:20px;
	height:20px;
	cursor:pointer;
	accent-color:#4B49AC;
}
.form-check-label{
	font-weight:700;
	color:#1f2937;
}
.badge-total{
	min-width:145px;
	justify-content:center;
	display:inline-flex;
	align-items:center;
	padding:10px 18px;
	border-radius:999px;
	background:#eef2ff;
	color:#4B49AC;
	font-weight:800;
	font-size:13px;
}
.btn-save{
	background:linear-gradient(135deg,#4B49AC,#7978E9);
	border:none;
	color:#fff;
	padding:11px 28px;
	border-radius:14px;
	font-weight:800;
}
.btn-save:hover{
	color:#fff;
	transform:translateY(-1px);
	box-shadow:0 8px 18px rgba(75,73,172,.20);
}
.btn-cancel{
	padding:11px 22px;
	border-radius:14px;
	font-weight:800;
}
.operator-list{
	display:flex;
	flex-direction:column;
	gap:8px;
	max-height:480px;
	overflow-y:auto;
	padding-right:8px;
}
.operator-list::-webkit-scrollbar{
	width:8px;
}
.operator-list::-webkit-scrollbar-track{
	background:#eef2ff;
	border-radius:10px;
}
.operator-list::-webkit-scrollbar-thumb{
	background:#7978E9;
	border-radius:10px;
}
.operator-list::-webkit-scrollbar-thumb:hover{
	background:#4B49AC;
}
.operator-card{
	display:flex;
	align-items:center;
	justify-content:space-between;
	padding:12px 16px;
	border:1.5px solid #d7defd;
	border-radius:18px;
	background:#fff;
	cursor:pointer;
	transition:.2s;
}
.operator-card:hover{
	border-color:#7978E9;
	background:#f8faff;
	transform:translateY(-1px);
}
.operator-card.checked{
	background:#eef3ff;
	border-color:#4B49AC;
	box-shadow:0 8px 18px rgba(75,73,172,.12);
}
.operator-card.checked .operator-avatar{
	background:linear-gradient(135deg,#F3797E,#4B49AC);
}
.operator-card.checked .operator-name{
	color:#4B49AC;
}
.operator-left{
	display:flex;
	align-items:center;
	gap:12px;
}
.operator-avatar{
	width:38px;
	height:38px;
	border-radius:50%;
	background:linear-gradient(135deg,#4B49AC,#7978E9);
	color:#fff;
	font-size:16px;
	font-weight:800;
	display:flex;
	align-items:center;
	justify-content:center;
	flex-shrink:0;
}
.operator-info{
	display:flex;
	flex-direction:column;
}
.operator-name{
	font-size:14px;
	font-weight:800;
	color:#1f2937;
	margin-bottom:2px;
}
.operator-nik{
	font-size:12px;
	color:#6b7280;
}
.operator-check{
	width:22px;
	height:22px;
	cursor:pointer;
	accent-color:#4B49AC;
	flex-shrink:0;
}
</style>
<div class="leader-page">
	</div>
	@if($errors->any())
		<div class="alert alert-danger rounded-4 border-0 shadow-sm">
			<ul class="mb-0">
				@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
	<div class="row g-4 mb-4">
		<div class="col-lg-4">
			<div class="info-card">
				<div class="info-icon">
					<i class="bi bi-person"></i>
				</div>
				<div>
					<div class="info-label">Leader</div>
					<div class="info-value">{{ $leader->leader->name ?? '-' }}</div>
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="info-card">
				<div class="info-icon">
					<i class="bi bi-person-vcard"></i>
				</div>
				<div>
					<div class="info-label">NIK</div>
					<div class="info-value">{{ $leader->leader->employee_nik ?? '-' }}</div>
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="info-card">
				<div class="info-icon">
					<i class="bi bi-building"></i>
				</div>
				<div>
					<div class="info-label">Divisi</div>
					<div class="info-value">{{ $leader->divisi->nama_divisi ?? '-' }}</div>
				</div>
			</div>
		</div>
	</div>
	<div class="table-card">
		<div class="d-flex align-items-center gap-4 mb-3">
			<div class="flex-grow-1">
				<div class="input-group w-100">
					<span class="input-group-text bg-white border-end-0 search-box">
						<i class="bi bi-search"></i>
					</span>
					<input type="text" id="searchOperator" class="form-control border-start-0 shadow-none search-box" placeholder="Cari Nama / NIK Operator...">
				</div>
			</div>
			<div class="d-flex align-items-center gap-3">
				<div class="form-check m-0">
					<input class="form-check-input" type="checkbox" id="checkAll">
					<label class="form-check-label ms-1" for="checkAll">Pilih Semua</label>
				</div>
				<div class="badge-total">
					<span id="selectedCount">0</span> / {{ $operators->count() }} Operator
				</div>
			</div>
		</div>
		<form method="POST" action="{{ route('leader-assignments.mapping',$leader->id) }}" id="mappingForm">
			@csrf
			<div class="operator-list">
				@forelse($operators as $operator)
					@php
						$isChecked=(int)$operator->leader_id===(int)$leader->leader_id;
					@endphp
					<div class="operator-card operator-row {{ $isChecked?'checked':'' }}" data-search="{{ strtolower($operator->nama_lengkap.' '.$operator->nik) }}">
						<div class="operator-left">
							<div class="operator-avatar">{{ strtoupper(substr($operator->nama_lengkap,0,1)) }}</div>
							<div class="operator-info">
								<div class="operator-name">{{ $operator->nama_lengkap }}</div>
								<div class="operator-nik">{{ $operator->nik }}</div>
							</div>
						</div>
						<input class="operator-check" type="checkbox" name="operators[]" value="{{ $operator->id }}" {{ $isChecked?'checked':'' }}>
					</div>
				@empty
					<div class="text-center py-5">
						<i class="bi bi-inbox text-muted" style="font-size:55px;"></i>
						<h5 class="mt-3 mb-2">Belum ada operator</h5>
						<p class="text-muted mb-0">Belum ada operator pada divisi ini.</p>
					</div>
				@endforelse
			</div>
			<div class="d-flex justify-content-between align-items-center mt-4">
				<a href="{{ route('leader-assignments.index') }}" class="btn btn-light btn-cancel">Batal</a>
				<button type="submit" class="btn btn-save">Simpan Mapping</button>
			</div>
		</form>
	</div>
</div>
<script>
function updateCounter(){
	const checkboxes=document.querySelectorAll('.operator-check');
	const checked=document.querySelectorAll('.operator-check:checked').length;
	document.getElementById('selectedCount').innerText=checked;
	document.getElementById('checkAll').checked=checkboxes.length>0&&checked===checkboxes.length;
}
document.querySelectorAll('.operator-card').forEach(function(card){
	card.addEventListener('click',function(e){
		if(e.target.classList.contains('operator-check')){
			return;
		}
		const checkbox=this.querySelector('.operator-check');
		checkbox.checked=!checkbox.checked;
		this.classList.toggle('checked',checkbox.checked);
		updateCounter();
	});
});
document.querySelectorAll('.operator-check').forEach(function(checkbox){
	checkbox.addEventListener('change',function(){
		this.closest('.operator-card').classList.toggle('checked',this.checked);
		updateCounter();
	});
});
document.getElementById('checkAll').addEventListener('change',function(){
	const checked=this.checked;
	document.querySelectorAll('.operator-check').forEach(function(checkbox){
		checkbox.checked=checked;
		checkbox.closest('.operator-card').classList.toggle('checked',checked);
	});
	updateCounter();
});
document.getElementById('searchOperator').addEventListener('input',function(){
	const keyword=this.value.toLowerCase().trim();
	document.querySelectorAll('.operator-row').forEach(function(row){
		const text=row.dataset.search||'';
		row.style.display=text.includes(keyword)?'flex':'none';
	});
});
updateCounter();
</script>
@endsection