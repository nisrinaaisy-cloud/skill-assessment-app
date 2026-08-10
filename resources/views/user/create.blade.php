@extends('layouts.app')
@section('content')
<style>
	.form-card{
		background:#fff;
		border-radius:22px;
		padding:28px;
		box-shadow:0 10px 30px rgba(75,73,172,.10);
		border:1px solid rgba(75,73,172,.06);
	}
	.page-hero{
		background:linear-gradient(135deg,#4B49AC 0%,#7978E9 55%,#F3797E 100%);
		border-radius:18px;
		padding:18px 22px;
		color:#fff;
		margin-bottom:24px;
		box-shadow:0 14px 32px rgba(75,73,172,.24);
	}
	.page-title{
		font-size:22px;
		font-weight:800;
	}
	.page-subtitle{
		font-size:13px;
		opacity:.9;
	}
	.form-label{
		font-size:12px;
		font-weight:800;
		text-transform:uppercase;
		color:#6b7280;
	}
	.form-control,
	.form-select{
		height:46px;
		border-radius:12px;
	}
	.btn-save{
		border:none;
		background:linear-gradient(135deg,#4B49AC,#7978E9);
		color:#fff;
		border-radius:14px;
		padding:11px 22px;
		font-weight:700;
	}
	.btn-back{
		border:none;
		background:#eef2ff;
		color:#4B49AC;
		border-radius:14px;
		padding:11px 22px;
		font-weight:700;
		text-decoration:none;
	}
	.divisi-box{
		border:1px solid #dbe2f0;
		border-radius:14px;
		padding:14px;
		background:#f8faff;
		max-height:180px;
		overflow-y:auto;
	}
	.divisi-item{
		display:flex;
		align-items:center;
		gap:10px;
		padding:8px 10px;
		border-radius:10px;
		cursor:pointer;
	}
	.divisi-item:hover{
		background:#eef2ff;
	}
	.divisi-item input{
		width:18px;
		height:18px;
		accent-color:#4B49AC;
		cursor:pointer;
	}
	.divisi-item label{
		font-size:13px;
		font-weight:600;
		color:#374151;
		cursor:pointer;
		margin:0;
	}
	.divisi-info{
		font-size:12px;
		color:#6b7280;
		margin-top:7px;
	}
	.production-info{
		display:none;
		padding:12px 14px;
		border-radius:12px;
		background:#eef2ff;
		color:#4B49AC;
		font-size:13px;
		font-weight:700;
	}
</style>
<div class="page-hero">
	<div class="page-title">Tambah User</div>
	<div class="page-subtitle">Kelola akun Admin, Leader, Foreman, dan Kabag.</div>
</div>
@if($errors->any())
	<div class="alert alert-danger rounded-4 border-0">
		<ul class="mb-0">
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif
<div class="form-card">
	<form action="{{ route('user.store') }}" method="POST">
		@csrf
		<div class="row g-3">
			<div class="col-md-6">
				<label class="form-label">Nama</label>
				<input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
			</div>
			<div class="col-md-6">
				<label class="form-label">NIK</label>
				<input type="text" name="employee_nik" class="form-control" value="{{ old('employee_nik') }}" placeholder="NIK karyawan">
			</div>
			<div class="col-md-6">
				<label class="form-label">Username</label>
				<input type="text" name="username" class="form-control" value="{{ old('username') }}" required>
			</div>
			<div class="col-md-6">
				<label class="form-label">Email</label>
				<input type="email" name="email" class="form-control" value="{{ old('email') }}">
			</div>
			<div class="col-md-6">
				<label class="form-label">Jabatan</label>
				<select name="role" id="role" class="form-select" required>
					<option value="">Pilih Jabatan</option>
					<option value="admin" {{ old('role')==='admin'?'selected':'' }}>Admin</option>
					<option value="leader" {{ old('role')==='leader'?'selected':'' }}>Leader</option>
					<option value="foreman" {{ old('role')==='foreman'?'selected':'' }}>Foreman</option>
					<option value="kabag" {{ old('role')==='kabag'?'selected':'' }}>Kabag</option>
				</select>
			</div>
			<div class="col-md-6">
				<label class="form-label">Cakupan Divisi</label>
				<div id="productionInfo" class="production-info">
					<i class="bi bi-building me-1"></i>
					Mencakup seluruh Produksi: Stamping, Machining, Welding, dan Packing.
				</div>
				<div id="divisiBox" class="divisi-box">
					@foreach($divisis as $divisi)
						<div class="divisi-item">
							<input type="checkbox" name="divisi_ids[]" value="{{ $divisi->id }}" id="divisi_{{ $divisi->id }}" {{ in_array($divisi->id,old('divisi_ids',[]))?'checked':'' }}>
							<label for="divisi_{{ $divisi->id }}">{{ strtoupper($divisi->nama_divisi) }}</label>
						</div>
					@endforeach
				</div>
				<div id="divisiInfo" class="divisi-info">
					Pilih satu atau lebih divisi jika user adalah Leader atau Foreman.
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label">Password</label>
				<input type="password" name="password" class="form-control" required>
			</div>
		</div>
		<div class="mt-4 pt-3 border-top d-flex justify-content-between align-items-center">
			<a href="{{ route('user.index') }}" class="btn-back">Kembali</a>
			<button type="submit" class="btn-save">Simpan User</button>
		</div>
	</form>
</div>
<script>
	const role=document.getElementById('role');
	const divisiBox=document.getElementById('divisiBox');
	const productionInfo=document.getElementById('productionInfo');
	const divisiInfo=document.getElementById('divisiInfo');
	const divisiCheckboxes=document.querySelectorAll('input[name="divisi_ids[]"]');
	function updateDivisi(){
		const isProductionRole=role.value==='admin'||role.value==='kabag';
		divisiBox.style.display=isProductionRole?'none':'block';
		productionInfo.style.display=isProductionRole?'block':'none';
		divisiInfo.style.display=isProductionRole?'none':'block';
		divisiCheckboxes.forEach(function(checkbox){
			checkbox.disabled=isProductionRole;
		});
	}
	role.addEventListener('change',updateDivisi);
	updateDivisi();
</script>
@endsection