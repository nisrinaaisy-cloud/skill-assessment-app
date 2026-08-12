@extends('layouts.app')

@section('content')

<style>
	.leader-hero{
		width:100%;
		padding:16px 20px;
		border-radius:18px;
		background:linear-gradient(135deg,#4B49AC 0%,#7978E9 55%,#F3797E 100%);
		color:#fff;
		box-shadow:0 14px 32px rgba(75,73,172,.24);
		display:flex;
		align-items:center;
		justify-content:space-between;
		gap:18px;
	}
	.leader-hero-title{
		font-size:20px;
		font-weight:800;
		letter-spacing:-.3px;
	}
	.leader-hero-subtitle{
		font-size:12px;
		opacity:.85;
		margin-top:4px;
	}
	.form-card{
		background:#fff;
		border-radius:22px;
		padding:28px;
		box-shadow:0 10px 30px rgba(75,73,172,.10);
		border:1px solid rgba(75,73,172,.06);
	}
	.form-label{
		font-size:12px;
		font-weight:900!important;
		text-transform:uppercase;
		color:#516184;
		letter-spacing:.4px;
		margin-bottom:8px;
	}
	.form-select{
		height:48px;
		border-radius:14px;
		border:1px solid #d9e2f2;
		font-size:15px;
		box-shadow:none!important;
	}
	.form-select:focus{
		border-color:#98BDFF;
		box-shadow:0 0 0 .2rem rgba(152,189,255,.25)!important;
	}
	.btn-save{
		min-width:130px;
		height:46px;
		border:none;
		border-radius:14px;
		background:#4B49AC;
		color:#fff;
		font-weight:800;
	}
	.btn-save:hover{
		background:#3f3d95;
		color:#fff;
	}
	.btn-cancel{
		min-width:90px;
		height:46px;
		border:1px solid #d9e2f2;
		border-radius:14px;
		background:#fff;
		color:#4B49AC;
		font-weight:800;
		text-decoration:none;
		display:inline-flex;
		align-items:center;
		justify-content:center;
	}
	.btn-cancel:hover{
		background:#f8fafc;
		color:#4B49AC;
	}
	.leader-info{
		margin-top:20px;
		padding:16px 18px;
		border-radius:14px;
		background:#f8faff;
		border:1px solid #eef2ff;
		display:none;
	}
	.leader-info.show{
		display:block;
	}
	.assignment-note{
		margin-top:14px;
		padding:11px 14px;
		border-radius:12px;
		background:#f8faff;
		border:1px solid #e1e7f5;
		color:#64748b;
		font-size:14px;
		line-height:1.45;
	}
	.leader-info-title{
		font-size:13px;
		font-weight:800;
		color:#1f2937;
	}
	.leader-info-text{
		font-size:12px;
		color:#6b7280;
		margin-top:4px;
	}
</style>

<div class="leader-page">

	<div class="leader-hero mb-4">
		<div>
			<div class="leader-hero-title">Tambah Leader Assignment</div>
			<div class="leader-hero-subtitle">
				Pilih divisi terlebih dahulu, kemudian pilih Leader yang terdaftar pada divisi tersebut.
			</div>
		</div>
	</div>

	@if(session('error'))
		<div class="alert alert-danger rounded-4 border-0 shadow-sm">
			{{ session('error') }}
		</div>
	@endif

	@if($errors->any())
		<div class="alert alert-danger rounded-4 border-0 shadow-sm">
			<ul class="mb-0">
				@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif

	<div class="form-card">
		<form action="{{ route('leader-assignments.store') }}" method="POST">
			@csrf

			<div class="row g-3">
				<div class="col-md-6">
					<label class="form-label">Divisi</label>
					<select name="divisi_id" id="divisi_id" class="form-select" required>
						<option value="">Pilih Divisi</option>
						@foreach($divisis as $divisi)
							<option value="{{ $divisi->id }}">
								{{ $divisi->nama_divisi }}
							</option>
						@endforeach
					</select>
				</div>

				<div class="col-md-6">
					<label class="form-label">Leader</label>
					<select name="leader_id" id="leader_id" class="form-select" required disabled>
						<option value="">Pilih divisi terlebih dahulu</option>
					</select>
				</div>
			</div>

			<div class="leader-info" id="leaderInfo">
				<div class="leader-info-title" id="leaderInfoName"></div>
				<div class="leader-info-text" id="leaderInfoNik"></div>
			</div>
			<div class="assignment-note">
			<div class="assignment-note-title"><i class="bi bi-info-circle me-1"></i>Petunjuk Leader Assignment</div>
				<ul>
					<li>Pastikan Leader sudah dibuat terlebih dahulu di <strong>User Management</strong>.</li>
					<li>User harus memiliki jabatan <strong>Leader</strong>, username, dan password.</li>
					<li>Pastikan cakupan divisi Leader sudah sesuai.</li>
					<li>Pilih Divisi, lalu pilih Leader yang tersedia.</li>
					<li>Klik <strong>Simpan</strong> untuk menetapkan Leader pada divisi.</li>
				</ul>
			</div>
			<div class="mt-4 pt-3 border-top d-flex justify-content-between align-items-center">
				<a href="{{ route('leader-assignments.index') }}" class="btn-cancel">
					Batal
				</a>

				<button type="submit" class="btn-save">
					Simpan
				</button>
			</div>
		</form>
	</div>

</div>

<script>
	const divisiSelect=document.getElementById('divisi_id');
	const leaderSelect=document.getElementById('leader_id');
	const leaderInfo=document.getElementById('leaderInfo');
	const leaderInfoName=document.getElementById('leaderInfoName');
	const leaderInfoNik=document.getElementById('leaderInfoNik');

	divisiSelect.addEventListener('change',function(){
		const divisiId=this.value;

		leaderSelect.innerHTML='<option value="">Memuat Leader...</option>';
		leaderSelect.disabled=true;
		leaderInfo.classList.remove('show');

		if(!divisiId){
			leaderSelect.innerHTML='<option value="">Pilih divisi terlebih dahulu</option>';
			return;
		}

		fetch('{{ url('/leader-assignments/leaders') }}/'+divisiId)
			.then(response=>{
				if(!response.ok){
					throw new Error('Gagal mengambil data Leader.');
				}
				return response.json();
			})
			.then(data=>{
				leaderSelect.innerHTML='';

				if(data.length===0){
					leaderSelect.innerHTML='<option value="">Belum ada akun Leader pada divisi ini</option>';
					leaderSelect.disabled=true;
					return;
				}

				leaderSelect.innerHTML='<option value="">Pilih Leader</option>';

				data.forEach(function(leader){
					const option=document.createElement('option');
					option.value=leader.id;
					option.textContent=leader.name+(leader.employee_nik?' - '+leader.employee_nik:'');
					option.dataset.name=leader.name;
					option.dataset.nik=leader.employee_nik||'-';
					leaderSelect.appendChild(option);
				});

				leaderSelect.disabled=false;
			})
			.catch(error=>{
				leaderSelect.innerHTML='<option value="">Gagal memuat Leader</option>';
				leaderSelect.disabled=true;
				console.error(error);
			});
	});

	leaderSelect.addEventListener('change',function(){
		const option=this.options[this.selectedIndex];

		if(!this.value){
			leaderInfo.classList.remove('show');
			return;
		}

		leaderInfoName.textContent=option.dataset.name;
		leaderInfoNik.textContent='NIK: '+option.dataset.nik;
		leaderInfo.classList.add('show');
	});
</script>

@endsection