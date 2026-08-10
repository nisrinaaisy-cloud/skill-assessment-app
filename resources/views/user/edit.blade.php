@extends('layouts.app')
@section('content')
<style>
	.form-card{background:#fff;border-radius:22px;padding:28px;box-shadow:0 10px 30px rgba(75,73,172,.10);border:1px solid rgba(75,73,172,.06);}
	.page-hero{background:linear-gradient(135deg,#4B49AC 0%,#7978E9 55%,#F3797E 100%);border-radius:18px;padding:18px 22px;color:#fff;margin-bottom:24px;box-shadow:0 14px 32px rgba(75,73,172,.24);}
	.page-title{font-size:22px;font-weight:800;}
	.page-subtitle{font-size:13px;opacity:.9;}
	.form-label{font-size:12px;font-weight:800;text-transform:uppercase;color:#6b7280;}
	.form-control,.form-select{height:46px;border-radius:12px;}
	.btn-save{border:none;background:linear-gradient(135deg,#4B49AC,#7978E9);color:#fff;border-radius:14px;padding:11px 22px;font-weight:700;}
	.btn-back{border:none;background:#eef2ff;color:#4B49AC;border-radius:14px;padding:11px 22px;font-weight:700;text-decoration:none;}
	.btn-reset{border:none;background:#fff7ed;color:#ea580c;border-radius:14px;padding:11px 22px;font-weight:700;}
	.divisi-box{border:1px solid #dbe2f0;border-radius:14px;padding:12px 14px;background:#f8faff;max-height:160px;overflow-y:auto;}
    .divisi-item{display:flex;align-items:center;gap:10px;padding:6px 10px;border-radius:10px;cursor:pointer;}
	.divisi-item input{width:18px;height:18px;accent-color:#4B49AC;cursor:pointer;}
	.divisi-item label{font-size:13px;font-weight:600;color:#374151;cursor:pointer;margin:0;}
	.divisi-info{font-size:12px;color:#6b7280;margin-top:7px;}
	.production-info{display:none;padding:12px 14px;border-radius:12px;background:#eef2ff;color:#4B49AC;font-size:13px;font-weight:700;}
	.reset-modal-overlay{position:fixed;inset:0;background:rgba(15,23,42,.48);backdrop-filter:blur(4px);display:none;align-items:center;justify-content:center;z-index:9999;padding:20px;}
	.reset-modal-overlay.show{display:flex;}
	.reset-modal{width:100%;max-width:430px;background:#fff;border-radius:22px;padding:26px;box-shadow:0 25px 70px rgba(15,23,42,.25);animation:resetModalShow .18s ease;}
	.reset-modal-title{font-size:19px;font-weight:800;color:#1f2937;margin-bottom:7px;}
	.reset-modal-text{font-size:13px;color:#6b7280;line-height:1.6;margin-bottom:22px;}
	.reset-modal-password{display:inline-block;background:#eef2ff;color:#4B49AC;font-weight:800;padding:5px 9px;border-radius:8px;}
	.reset-modal-actions{display:flex;justify-content:space-between;align-items:center;gap:20px;}
	.btn-modal-cancel{border:none;background:#f1f5f9;color:#475569;border-radius:12px;padding:10px 18px;font-weight:700;}
	.btn-modal-confirm{border:none;background:linear-gradient(135deg,#ea580c,#f97316);color:#fff;border-radius:12px;padding:10px 18px;font-weight:700;}
	@keyframes resetModalShow{from{opacity:0;transform:translateY(8px) scale(.98);}to{opacity:1;transform:translateY(0) scale(1);}}
    .password-field{margin-top:25px;}
</style>

<div class="page-hero">
	<div class="page-title">Edit User</div>
	<div class="page-subtitle">Kelola informasi, jabatan, cakupan divisi, dan password user.</div>
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
<form action="{{ route('user.update',$user->id) }}" method="POST" id="editUserForm">
	@csrf
	@method('PUT')
	<div class="row g-3">
		<div class="col-md-6">
			<label class="form-label">Nama</label>
			<input type="text" name="name" class="form-control" value="{{ old('name',$user->name) }}" required>
		</div>
		<div class="col-md-6">
			<label class="form-label">NIK</label>
			<input type="text" name="employee_nik" class="form-control" value="{{ old('employee_nik',$user->employee_nik) }}">
		</div>
		<div class="col-md-6">
			<label class="form-label">Username</label>
			<input type="text" name="username" class="form-control" value="{{ old('username',$user->username) }}" required>
		</div>
		<div class="col-md-6">
			<label class="form-label">Email</label>
			<input type="email" name="email" class="form-control" value="{{ old('email',$user->email) }}">
		</div>
		<div class="col-md-6">
			<label class="form-label">Jabatan</label>
			<select name="role" id="role" class="form-select" required>
				<option value="admin" {{ old('role',$user->role)==='admin'?'selected':'' }}>Admin</option>
				<option value="leader" {{ old('role',$user->role)==='leader'?'selected':'' }}>Leader</option>
				<option value="foreman" {{ old('role',$user->role)==='foreman'?'selected':'' }}>Foreman</option>
				<option value="kabag" {{ old('role',$user->role)==='kabag'?'selected':'' }}>Kabag</option>
			</select>
			<div class="password-field">
				<label class="form-label">Password Baru</label>
				<input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diubah">
			</div>
		</div>
		<div class="col-md-6">
			<label class="form-label">Cakupan Divisi</label>
			<div id="productionInfo" class="production-info">
				<i class="bi bi-building me-1"></i>
				Mencakup seluruh Produksi: Stamping, Machining, Welding, dan Packing.
			</div>
			@php
				$selectedDivisis=old('divisi_ids',$user->divisis->pluck('id')->toArray());
			@endphp
			<div id="divisiBox" class="divisi-box">
				@foreach($divisis as $divisi)
					<div class="divisi-item">
						<input type="checkbox" name="divisi_ids[]" value="{{ $divisi->id }}" id="divisi_{{ $divisi->id }}" {{ in_array($divisi->id,$selectedDivisis)?'checked':'' }}>
						<label for="divisi_{{ $divisi->id }}">{{ strtoupper($divisi->nama_divisi) }}</label>
					</div>
				@endforeach
			</div>
			<div id="divisiInfo" class="divisi-info">
				Pilih satu atau lebih divisi jika user adalah Leader atau Foreman.
			</div>
		</div>
	</div>
</form>
	<div class="mt-4 pt-3 border-top d-flex justify-content-between align-items-center">
		<div>
			<div class="fw-bold">Reset Password</div>
			<div class="text-muted small">Password akan dikembalikan menjadi 12345678.</div>
		</div>
		<form action="{{ route('user.reset-password',$user->id) }}" method="POST" id="resetPasswordForm">
			@csrf
			<button type="button" class="btn-reset" onclick="openResetModal()">Reset Password</button>
		</form>
	</div>

	<div class="mt-4 pt-3 border-top d-flex justify-content-between align-items-center">
		<a href="{{ route('user.index') }}" class="btn-back">Kembali</a>
		<button type="submit" class="btn-save" form="editUserForm">Simpan Perubahan</button>
	</div>
</div>

<div class="reset-modal-overlay" id="resetPasswordModal">
	<div class="reset-modal">
		<div class="reset-modal-title">Reset Password User?</div>
		<div class="reset-modal-text">
			Password <strong>{{ strtoupper($user->name) }}</strong> akan dikembalikan menjadi
			<span class="reset-modal-password">12345678</span>.
			Password lama tidak dapat digunakan lagi.
		</div>
		<div class="reset-modal-actions">
			<button type="button" class="btn-modal-cancel" onclick="closeResetModal()">Batal</button>
			<button type="button" class="btn-modal-confirm" onclick="submitResetPassword()">Ya, Reset</button>
		</div>
	</div>
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

	function openResetModal(){
		document.getElementById('resetPasswordModal').classList.add('show');
	}

	function closeResetModal(){
		document.getElementById('resetPasswordModal').classList.remove('show');
	}

	function submitResetPassword(){
		document.getElementById('resetPasswordForm').submit();
	}

	document.getElementById('resetPasswordModal').addEventListener('click',function(e){
		if(e.target===this){
			closeResetModal();
		}
	});

	document.addEventListener('keydown',function(e){
		if(e.key==='Escape'){
			closeResetModal();
		}
	});
</script>
@endsection