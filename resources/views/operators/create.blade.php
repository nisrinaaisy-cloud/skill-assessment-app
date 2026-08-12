@extends('layouts.app')

@section('content')
<style>
	.operator-page {
		--primary: #4B49AC;
		--support-blue: #7DA0FA;
		--support-purple: #7978E9;
		--support-red: #F3797E;
		--text: #13233E;
		--muted: #65738F;
		--border: #E5EAF7;
	}
	.operator-header {
		width: 100%;
		margin-bottom: 18px;
		border-radius: 18px;
		overflow: hidden;
		background: linear-gradient(90deg,#4B49AC 0%,#7978E9 60%,#F3797E 100%);
		color: #fff;
		box-shadow: 0 10px 25px rgba(75,73,172,.16);
	}
	.operator-header-inner {
		min-height: 82px;
		padding: 16px 20px;
		display: flex;
		align-items: center;
	}
	.operator-title-wrap {
		display: flex;
		align-items: center;
		gap: 13px;
	}
	.operator-title-icon {
		width: 44px;
		height: 44px;
		border-radius: 13px;
		background: rgba(255,255,255,.16);
		display: flex;
		align-items: center;
		justify-content: center;
		font-size: 20px;
		flex-shrink: 0;
	}
	.operator-title {
		margin: 0;
		font-size: 20px;
		font-weight: 900;
		line-height: 1.1;
	}
	.operator-subtitle {
		margin: 4px 0 0;
		font-size: 12px;
		font-weight: 600;
		color: rgba(255,255,255,.85);
	}
	.operator-form-card {
		width: 100%;
		background: #fff;
		border: 1px solid var(--border);
		border-radius: 20px;
		box-shadow: 0 8px 25px rgba(75,73,172,.08);
		overflow: hidden;
	}
	.form-body {
		width: 100%;
		padding: 22px;
	}
	.operator-fields {
		width: 100%;
		display: grid;
		grid-template-columns: repeat(2,minmax(0,1fr));
		column-gap: 20px;
		row-gap: 16px;
	}
	.operator-field {
		width: 100%;
		min-width: 0;
	}
	.form-label {
		display: block;
		margin-bottom: 7px;
		font-size: 11.5px !important;
		font-weight: 900 !important;
		color: #65738F;
		text-transform: uppercase;
		letter-spacing: .45px;
	}
	.required-mark {
		color: #F3797E;
	}
	.operator-form-card .form-control,
	.operator-form-card .form-select {
		width: 100% !important;
		height: 44px;
		padding: 0 13px;
		border: 1px solid #DDE4F3;
		border-radius: 11px;
		background: #fff;
		color: #13233E;
		font-size: 13px;
		font-weight: 600;
		box-sizing: border-box;
	}
	.operator-form-card .form-control:focus,
	.operator-form-card .form-select:focus {
		border-color: #7978E9;
		box-shadow: 0 0 0 3px rgba(121,120,233,.10);
	}
	.operator-form-card .form-select:disabled {
		background: #F1F4FA;
		color: #65738F;
		opacity: 1;
		cursor: not-allowed;
	}
	.form-text {
		margin-top: 5px;
		font-size: 10.5px;
		line-height: 1.35;
		color: #65738F;
		font-weight: 600;
	}
	.invalid-feedback {
		font-size: 11px;
		font-weight: 700;
	}
	.alert-error {
		margin-bottom: 16px;
		padding: 11px 14px;
		border-radius: 12px;
		border: 1px solid rgba(243,121,126,.22);
		background: #FDEEEF;
		color: #9F4E5A;
		font-size: 12px;
		font-weight: 700;
	}
	.action-footer {
		width: 100%;
		margin-top: 18px;
		padding-top: 15px;
		border-top: 1px solid #EEF2FF;
		display: flex;
		align-items: center;
		justify-content: space-between;
		gap: 10px;
	}
	.btn-secondary-action {
		min-width: 125px;
		padding: 9px 18px;
		border-radius: 11px;
		border: 1px solid rgba(75,73,172,.15);
		background: #F3F6FF;
		color: #4B49AC;
		font-size: 12.5px;
		font-weight: 900;
		text-align: center;
		text-decoration: none;
		transition: .2s ease;
	}
	.btn-secondary-action:hover {
		background: #4B49AC;
		color: #fff;
	}
	.btn-primary-action {
		min-width: 170px;
		padding: 9px 20px;
		border: 0;
		border-radius: 11px;
		background: linear-gradient(135deg,#4B49AC,#7DA0FA);
		color: #fff;
		font-size: 12.5px;
		font-weight: 900;
		box-shadow: 0 7px 16px rgba(75,73,172,.18);
		transition: .2s ease;
	}
	.btn-primary-action:hover {
		color: #fff;
		transform: translateY(-1px);
		box-shadow: 0 10px 20px rgba(75,73,172,.24);
	}
	.modal-icon {
		width: 56px;
		height: 56px;
		margin: 0 auto 13px;
		border-radius: 17px;
		background: #EEF4FF;
		color: #4B49AC;
		display: flex;
		align-items: center;
		justify-content: center;
		font-size: 26px;
	}
	@media (max-width:768px) {
		.operator-fields {
			grid-template-columns: 1fr;
		}
		.action-footer {
			flex-direction: column;
			align-items: stretch;
		}
		.btn-secondary-action,
		.btn-primary-action {
			width: 100%;
		}
	}
</style>

<div class="operator-page">
	<div class="operator-header">
		<div class="operator-header-inner">
			<div class="operator-title-wrap">
				<div class="operator-title-icon"><i class="bi bi-person-plus-fill"></i></div>
				<div>
					<h1 class="operator-title">Tambah Operator</h1>
					<p class="operator-subtitle">Tambahkan data operator baru ke sistem skill assessment.</p>
				</div>
			</div>
		</div>
	</div>
	<div class="operator-form-card">
		<div class="form-body">
			@if($errors->any())
				<div class="alert-error"><i class="bi bi-exclamation-circle-fill me-1"></i>Terdapat data yang belum sesuai. Silakan periksa kembali form di bawah.</div>
			@endif
			<form action="{{ route('operators.store') }}" method="POST" id="operatorForm">
				@csrf
				<div class="operator-fields">
					<div class="operator-field">
						<label class="form-label">Nama Operator <span class="required-mark">*</span></label>
						<input type="text" name="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror" value="{{ old('nama_lengkap') }}">
						@error('nama_lengkap')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>
					<div class="operator-field">
						<label class="form-label">NIK <span class="required-mark">*</span></label>
						<input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik') }}">
						<div class="form-text">NIK harus unik. Sistem akan menolak jika NIK sudah digunakan operator lain.</div>
						@error('nik')
							<div class="invalid-feedback d-block">{{ $message }}</div>
						@enderror
					</div>
					<div class="operator-field">
						<label class="form-label">Divisi <span class="required-mark">*</span></label>
						<select name="divisi_id" id="divisi_id" class="form-select @error('divisi_id') is-invalid @enderror">
							<option value="">Pilih Divisi</option>
							@foreach($divisis as $divisi)
								<option value="{{ $divisi->id }}" {{ old('divisi_id') == $divisi->id ? 'selected' : '' }}>{{ $divisi->nama_divisi }}</option>
							@endforeach
						</select>
						@error('divisi_id')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>
					<div class="operator-field">
						<label class="form-label">Leader <span class="required-mark">*</span></label>
						<select name="leader_id" id="leader_id" class="form-select @error('leader_id') is-invalid @enderror" disabled>
							<option value="">Pilih divisi terlebih dahulu</option>
							@foreach($leaders as $leader)
								@if($leader->leader)
									<option value="{{ $leader->leader->id }}" data-divisi="{{ $leader->divisi_id }}" {{ old('leader_id') == $leader->leader->id ? 'selected' : '' }}>{{ $leader->leader->name }}</option>
								@endif
							@endforeach
						</select>
						<div class="form-text">Leader akan menyesuaikan divisi yang dipilih.</div>
						@error('leader_id')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>
				</div>
				<div class="action-footer">
					<a href="{{ route('operators.index') }}" class="btn-secondary-action">Batal</a>
					<button type="button" class="btn-primary-action" data-bs-toggle="modal" data-bs-target="#confirmModal"><i class="bi bi-save me-1"></i>Simpan Operator</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content rounded-4 border-0 shadow">
			<div class="modal-body text-center p-4">
				<div class="modal-icon"><i class="bi bi-person-plus-fill"></i></div>
				<h5 class="fw-bold mb-2">Simpan Operator Baru?</h5>
				<p class="text-muted mb-4" style="font-size:14px;">Pastikan nama, NIK, divisi, dan leader sudah benar sebelum data disimpan.</p>
				<div class="d-flex gap-3">
					<button type="button" class="btn btn-light rounded-3 w-100" data-bs-dismiss="modal">Batal</button>
					<button type="button" class="btn-primary-action w-100" id="submitBtn">Ya, Simpan</button>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
document.addEventListener('DOMContentLoaded',function(){
	const divisiSelect=document.getElementById('divisi_id');
	const leaderSelect=document.getElementById('leader_id');
	const operatorForm=document.getElementById('operatorForm');
	const submitBtn=document.getElementById('submitBtn');
	const allLeaderOptions=Array.from(leaderSelect.options).map(option=>option.cloneNode(true));
	const selectedLeader="{{ old('leader_id') }}";
	function setDefaultLeaderOption(text){
		leaderSelect.innerHTML='';
		const defaultOption=document.createElement('option');
		defaultOption.value='';
		defaultOption.textContent=text;
		leaderSelect.appendChild(defaultOption);
	}
	function filterLeader(resetValue=false){
		const selectedDivisi=divisiSelect.value;
		if(!selectedDivisi){
			setDefaultLeaderOption('Pilih divisi terlebih dahulu');
			leaderSelect.disabled=true;
			return;
		}
		setDefaultLeaderOption('Pilih Leader');
		let hasLeader=false;
		allLeaderOptions.forEach(option=>{
			if(!option.value)return;
			if(option.dataset.divisi===selectedDivisi){
				leaderSelect.appendChild(option.cloneNode(true));
				hasLeader=true;
			}
		});
		if(!hasLeader){
			setDefaultLeaderOption('Leader belum tersedia untuk divisi ini');
			leaderSelect.disabled=true;
			return;
		}
		leaderSelect.disabled=false;
		if(!resetValue&&selectedLeader){
			leaderSelect.value=selectedLeader;
		}else{
			leaderSelect.value='';
		}
	}
	divisiSelect.addEventListener('change',function(){
		filterLeader(true);
	});
	filterLeader(false);
	submitBtn.addEventListener('click',function(){
		operatorForm.submit();
	});
});
</script>
@endsection