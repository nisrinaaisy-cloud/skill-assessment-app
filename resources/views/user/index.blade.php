@extends('layouts.app')
@section('content')
<style>
	.user-hero{
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
	.user-hero-title{font-size:20px;font-weight:800;}
	.user-hero-subtitle{font-size:12px;opacity:.85;margin-top:4px;}
	.btn-add-user{
		border:none;
		min-width:190px;
		padding:12px 22px;
		border-radius:16px;
		background:#fff;
		color:#4B49AC;
		font-weight:800;
		text-decoration:none!important;
		text-align:center;
		box-shadow:0 12px 24px rgba(31,41,55,.18);
	}
	.btn-add-user:hover{background:#f8fafc;color:#F3797E;}
	.table-card,.filter-card{
		background:#fff;
		border-radius:22px;
		box-shadow:0 10px 30px rgba(75,73,172,.10);
		border:1px solid rgba(75,73,172,.06);
	}
	.filter-input{height:46px;border-radius:12px;}
	.user-table{border-collapse:collapse;border-spacing:0 10px;}
	.user-table thead th{
		background:#e9edff;
		text-align:center;
		font-size:12px;
		font-weight:900;
		text-transform:uppercase;
		padding:15px 14px;
		border:none;
		white-space:nowrap;
		border-bottom:2px solid rgba(75,73,172,.22);
	}
	.user-table thead th:first-child{border-radius:14px 0 0 14px;}
	.user-table thead th:last-child{border-radius:0 14px 14px 0;}
	.user-table tbody tr{border-bottom:1px solid #eef2ff;}
	.user-table tbody tr:hover{
		transform:translateY(-2px);
		box-shadow:0 10px 24px rgba(75,73,172,.12);
		background:#f8faff;
	}
	.user-table tbody td{
		border:none;
		text-align:center;
		vertical-align:middle;
		padding:16px 14px;
		font-size:13px;
		background:#fff;
	}
	.user-table tbody td:first-child{border-radius:14px 0 0 14px;}
	.user-table tbody td:last-child{border-radius:0 14px 14px 0;}
	.nik-badge{
		display:inline-flex;
		align-items:center;
		padding:6px 10px;
		border-radius:999px;
		background:#eef3ff;
		color:#4B49AC;
		font-size:12px;
		font-weight:700;
	}
	.role-badge{
        display:inline-flex;
        align-items:center;
        padding:6px 11px;
        border-radius:999px;
        font-size:12px;
        font-weight:800;
    }
    .role-admin{background:#ede9fe;color:#7c3aed;}
    .role-leader{background:#dbeafe;color:#2563eb;}
    .role-foreman{background:#ffedd5;color:#ea580c;}
    .role-kabag{background:#dcfce7;color:#16a34a;}
	}
	.divisi-badge{
        display:inline-flex;
        align-items:center;
        justify-content:center;
        padding:6px 11px;
        border-radius:999px;
        background:#eef3ff;
        color:#4B49AC;
        font-size:12px;
        font-weight:800;
        white-space:nowrap;
    }
	.btn-action{
		border:none;
		border-radius:999px;
		padding:7px 12px;
		font-size:18px;
		font-weight:800;
	}
	.btn-edit{
		background:rgba(125,160,250,.14);
		color:#4B49AC;
		text-decoration:none;
	}
	.btn-edit:hover{background:#4B49AC;color:#fff;}
	.btn-delete{background:#fff0f1;color:#dc3545;}
	.btn-delete:hover{background:#dc3545;color:#fff;}
	.empty-state{
		background:#f8fafc;
		border:1px dashed #cbd5e1;
		border-radius:20px;
		padding:36px;
		text-align:center;
		color:#64748b;
	}
	.table-footer{
		margin-top:16px;
		padding:14px 18px;
		border-radius:14px;
		background:#f8faff;
		border:1px solid #eef2ff;
		display:flex;
		justify-content:space-between;
		align-items:center;
		gap:12px;
		backdrop-filter:blur(6px);
	}
	.custom-pagination nav{display:flex;align-items:center;}
	.custom-pagination .pagination{display:flex;align-items:center;gap:5px;margin:0;}
	.custom-pagination .page-item{margin:0;}
	.custom-pagination .page-link{
		width:34px;
		height:34px;
		padding:0;
		display:flex;
		align-items:center;
		justify-content:center;
		border:0;
		border-radius:9px;
		background:#eef2ff;
		color:#4B49AC;
		font-size:13px;
		font-weight:700;
		text-decoration:none;
		box-shadow:none;
	}
	.custom-pagination .page-link:hover{background:#dddffc;color:#4B49AC;}
	.custom-pagination .page-item.active .page-link{
		background:linear-gradient(135deg,#4B49AC,#7978E9);
		color:#fff;
		box-shadow:0 5px 12px rgba(75,73,172,.22);
	}
	.custom-pagination .page-item.disabled .page-link{background:#f4f6fb;color:#b8bfd0;}
    .delete-modal{
        position:fixed;
        inset:0;
        z-index:9999;
        display:none;
        align-items:center;
        justify-content:center;
        background:rgba(15,23,42,.45);
        backdrop-filter:blur(4px);
    }
    .delete-modal.show{display:flex;}
    .delete-modal-box{
        width:420px;
        max-width:calc(100% - 32px);
        background:#fff;
        border-radius:20px;
        padding:26px;
        text-align:center;
        box-shadow:0 20px 60px rgba(15,23,42,.25);
        animation:deleteModalIn .18s ease-out;
    }
    .delete-modal-icon{
        width:58px;
        height:58px;
        margin:0 auto 16px;
        border-radius:50%;
        display:flex;
        align-items:center;
        justify-content:center;
        background:#fff0f1;
        color:#dc3545;
        font-size:25px;
    }
    .delete-modal-title{
        margin:0 0 8px;
        color:#17204a;
        font-size:20px;
        font-weight:800;
    }
    .delete-modal-text{
        margin:0;
        color:#64748b;
        font-size:13px;
        line-height:1.6;
    }
    .delete-modal-name{
        display:block;
        margin-top:6px;
        color:#4B49AC;
        font-weight:800;
    }
    .delete-modal-actions{
        display:flex;
        justify-content:center;
        gap:10px;
        margin-top:22px;
    }
    .delete-modal-btn{
        min-width:110px;
        border:none;
        border-radius:10px;
        padding:10px 18px;
        font-size:13px;
        font-weight:800;
        cursor:pointer;
    }
    .delete-modal-cancel{
        background:#eef2ff;
        color:#4B49AC;
    }
    .delete-modal-confirm{
        background:#dc3545;
        color:#fff;
    }
    .delete-modal-confirm:hover{background:#c82333;}
    @keyframes deleteModalIn{
        from{opacity:0;transform:translateY(8px) scale(.98);}
        to{opacity:1;transform:translateY(0) scale(1);}
    }
</style>
<div class="user-page">
	<div class="user-hero mb-4">
		<div>
			<div class="user-hero-title">User Management</div>
			<div class="user-hero-subtitle">Kelola akun login Admin, Leader, Foreman, dan Kabag Skill Assessment.</div>
		</div>
		<a href="{{ route('user.create') }}" class="btn-add-user">
			<i class="bi bi-plus-circle me-1"></i>
			Tambah User
		</a>
	</div>
	<div class="filter-card p-3 mb-4">
		<form method="GET" action="{{ route('user.index') }}" id="userSearchForm">
			<div class="row">
				<div class="col-lg-12">
					<label class="form-label fw-bold">Search</label>
					<input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, NIK, username, atau jabatan..." class="form-control filter-input">
				</div>
			</div>
		</form>
	</div>
	<div class="table-card p-3">
		<div class="table-responsive">
			<table class="table user-table align-middle mb-0">
				<thead>
					<tr>
						<th style="width:70px;">No</th>
						<th>Nama</th>
						<th>NIK</th>
						<th>Username</th>
						<th>Jabatan</th>
						<th>Cakupan Divisi</th>
						<th style="width:120px;">Aksi</th>
					</tr>
				</thead>
				<tbody>
					@forelse($users as $index=>$user)
						<tr>
							<td>{{ $users->firstItem()+$index }}</td>
							<td class="fw-bold">{{ strtoupper($user->name) }}</td>
							<td>
								<span class="nik-badge">{{ $user->employee_nik??'-' }}</span>
							</td>
							<td>{{ $user->username }}</td>
							<td>
								<span class="role-badge role-{{ strtolower($user->role) }}">{{ strtoupper($user->role) }}</span>
							</td>
							<td>
                                @php
                                    $divisiNames = $user->divisis->pluck('nama_divisi')->map(fn($nama) => strtoupper($nama))->values();
                                    if($divisiNames->isEmpty() && $user->divisi){
                                        $divisiNames = collect([strtoupper($user->divisi->nama_divisi)]);
                                    }
                                @endphp
                                @if(in_array(strtolower($user->role),['admin','kabag']))
                                    <span class="divisi-badge">PRODUKSI</span>
                                @elseif($divisiNames->isNotEmpty())
                                    <span class="divisi-badge">{{ $divisiNames->implode(', ') }}</span>
                                @else
                                    <span class="divisi-badge">BELUM DISET</span>
                                @endif
                            </td>
							<td>
								<div class="d-flex justify-content-center gap-2">
									<a href="{{ route('user.edit',$user->id) }}" class="btn-action btn-edit" title="Edit">
										<i class="bi bi-pencil-square"></i>
									</a>
                                    <form action="{{ route('user.destroy',$user->id) }}" method="POST" class="delete-user-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn-action btn-delete btn-delete-user" title="Hapus" data-name="{{ strtoupper($user->name) }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
								</div>
							</td>
						</tr>
					@empty
						<tr>
							<td colspan="7">
								<div class="empty-state">
									<i class="bi bi-inbox fs-1 d-block mb-2"></i>
									<div class="fw-semibold mb-1">Belum ada data user.</div>
									<div class="small">Data user akan tampil setelah ditambahkan atau setelah pencarian sesuai.</div>
								</div>
							</td>
						</tr>
					@endforelse
				</tbody>
			</table>
		</div>
		<div class="table-footer">
			<div class="text-muted small">
				Menampilkan {{ $users->firstItem()??0 }} - {{ $users->lastItem()??0 }} dari {{ $users->total() }} data
			</div>
			<div class="custom-pagination">
				{{ $users->onEachSide(1)->links('pagination::bootstrap-4') }}
			</div>
		</div>
	</div>
</div>
<div class="delete-modal" id="deleteUserModal">
    <div class="delete-modal-box">
        <div class="delete-modal-icon">
            <i class="bi bi-trash3-fill"></i>
        </div>
        <h3 class="delete-modal-title">Hapus User?</h3>
        <p class="delete-modal-text">
            Apakah Anda yakin ingin menghapus user berikut?
            <span class="delete-modal-name" id="deleteUserName"></span>
        </p>
        <div class="delete-modal-actions">
            <button type="button" class="delete-modal-btn delete-modal-cancel" id="deleteCancel">
                Batal
            </button>
            <button type="button" class="delete-modal-btn delete-modal-confirm" id="deleteConfirm">
                Hapus
            </button>
        </div>
    </div>
</div>
<script>
	const searchInput=document.querySelector('input[name="search"]');
	let searchTimer=null;
	if(searchInput){
		searchInput.addEventListener('input',function(){
			clearTimeout(searchTimer);
			searchTimer=setTimeout(function(){
				document.getElementById('userSearchForm').submit();
			},500);
		});
	}
	const deleteModal=document.getElementById('deleteUserModal');
	const deleteUserName=document.getElementById('deleteUserName');
	const deleteCancel=document.getElementById('deleteCancel');
	const deleteConfirm=document.getElementById('deleteConfirm');
	let deleteForm=null;
	document.querySelectorAll('.btn-delete-user').forEach(function(button){
		button.addEventListener('click',function(){
			deleteForm=this.closest('.delete-user-form');
			deleteUserName.textContent=this.dataset.name;
			deleteModal.classList.add('show');
		});
	});
	deleteCancel.addEventListener('click',function(){
		deleteModal.classList.remove('show');
		deleteForm=null;
	});
	deleteConfirm.addEventListener('click',function(){
		if(deleteForm){
			deleteForm.submit();
		}
	});
	deleteModal.addEventListener('click',function(e){
		if(e.target===deleteModal){
			deleteModal.classList.remove('show');
			deleteForm=null;
		}
	});
	document.addEventListener('keydown',function(e){
		if(e.key==='Escape'){
			deleteModal.classList.remove('show');
			deleteForm=null;
		}
	});
</script>
@endsection