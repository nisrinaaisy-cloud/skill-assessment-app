@extends('layouts.app')
@section('content')
    <style>
        .operator-hero{
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
        .operator-hero-title{
            font-size:20px;
            font-weight:800;
        }
        .operator-hero-subtitle{
            font-size:12px;
            opacity:.85;
            margin-top:4px;
        }
        .btn-add{
            border:none;
            padding:12px 22px;
            border-radius:16px;
            background:#fff;
            color:#4B49AC;
            font-weight:800;
            box-shadow:0 12px 24px rgba(31,41,55,.18);
            text-decoration:none;
        }
        .btn-add:hover{
            color:#F3797E;
            background:#f8fafc;
        }
        .filter-card,.table-card{
            background:#fff;
            border-radius:22px;
            box-shadow:0 10px 30px rgba(75,73,172,.10);
            border:1px solid rgba(75,73,172,.06);
        }
        .filter-input{
            height:46px;
            border-radius:12px;
            font-size:15px;
        }
        .filter-card .form-label{
            font-size:12px;
            font-weight:800;
            text-transform:uppercase;
            color:#6b7280;
        }
        .operator-table thead th{
            background:#e9edff;
            border:none;
            font-size:12px;
            font-weight:900;
            text-transform:uppercase;
            padding:15px;
            text-align:center;
        }
        .operator-table tbody td{
            padding:8px 12px;
            vertical-align:middle;
            text-align:center;
            font-size:13px;
            font-weight:500;
            line-height:1.4;
        }
        .text-name{
            text-align:left;
            font-weight:700;
            color:#1f2937;
        }
        .operator-table tbody tr{
            transition:.25s;
        }

        .operator-table tbody tr:hover{
            background:#f8faff;
            transform:translateY(-2px);
            box-shadow:0 10px 24px rgba(75,73,172,.12);
        }
        .nik-badge{
            display:inline-flex;
            padding:6px 10px;
            border-radius:999px;
            background:#eef3ff;
            color:#4B49AC;
            font-size:12px;
            font-weight:700;
        }
        .operator-table thead th:first-child{
            border-radius:14px 0 0 14px;
        }

        .operator-table thead th:last-child{
            border-radius:0 14px 14px 0;
        }

        .operator-table tbody td:first-child{
            border-radius:14px 0 0 14px;
        }

        .operator-table tbody td:last-child{
            border-radius:0 14px 14px 0;
        }

        .operator-table tbody td{
            padding:16px 14px;
            background:#fff;
            border:none;
            vertical-align:middle;
        }

        .operator-table tbody tr{
            border-bottom:1px solid #eef2ff;
        }

        .operator-table tbody tr:hover{
            background:#f8faff;
            box-shadow:0 10px 24px rgba(75,73,172,.12);
        }
        .btn-action-detail{
            border:none;
            border-radius:999px;
            padding:7px 12px;
            background:#eef3ff;
            color:#4B49AC;
            font-size:18px;
            font-weight:800;
            text-decoration:none;
        }

        .btn-action-detail:hover{
            background:#4B49AC;
            color:#fff;
        }
        .btn-action-edit{
            border:none;
            border-radius:999px;
            padding:7px 12px;
            background:rgba(125,160,250,.14);
            color:#4B49AC;
            font-size:18px;
            font-weight:800;
            text-decoration:none;
            display:inline-flex;
            align-items:center;
            justify-content:center;
        }
        .btn-action-edit:hover{
            background:#4B49AC;
            color:#fff;
        }
        .btn-action-delete{
            border:none;
            border-radius:999px;
            padding:7px 12px;
            background:#fff0f1;
            color:#dc3545;
            font-size:18px;
            font-weight:800;
            display:inline-flex;
            align-items:center;
            justify-content:center;
        }
        .btn-action-delete:hover{
            background:#dc3545;
            color:#fff;
        }
        .table-card{
            background:#fff;
            border-radius:22px;
            box-shadow:0 10px 30px rgba(75,73,172,.10);
            border:1px solid rgba(75,73,172,.06);
        }
        .operator-page{
            width:100%;
        }
        .operator-table tbody tr{
            border-bottom:1px solid #eef2ff;
        }

        .operator-table{
            border-collapse:collapse;
            width:100%;
        }

        .operator-table tbody td{
            border:none;
        }

        .operator-table thead th{
            border-bottom:2px solid rgba(75,73,172,.18);
        }

        .table-text{
            font-size:15px;
            font-weight:500;
        }
    </style>

    <div class="operator-hero mb-4">
        <div>
            <div class="operator-hero-title">Leader Assignment</div>
            <div class="operator-hero-subtitle">
                Monitoring Leader berdasarkan Divisi Produksi.
            </div>
        </div>

        <a href="{{ route('leader-assignments.create') }}" class="btn btn-add">
            <i class="bi bi-plus-circle me-1"></i>
            Tambah Leader
        </a>
    </div>
    <div class="table-card p-3">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table operator-table align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width:35%;text-align:center;">Nama Leader</th>
                        <th style="width:20%;text-align:center;">NIK</th>
                        <th style="width:25%;text-align:center;">Divisi</th>
                        <th style="width:20%;text-align:center;">Aksi</th>
                    </tr>
                </thead>
                    <tbody class="align-middle">
                        @forelse($leaders as $leader)
                            <tr>
                                <td class="fw-bold text-center">
                                    {{ strtoupper($leader->leader?->name ?? 'Belum Dipilih') }}
                                </td>
                                <td class="text-center">
                                    <span class="nik-badge">
                                        {{ $leader->leader?->employee_nik ?? 'Belum Ada NIK' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    {{ strtoupper($leader->divisi?->nama_divisi ?? 'Belum Ada Divisi') }}
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('leader-assignments.show',$leader->id) }}" class="btn-action-edit">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <form action="{{ route('leader-assignments.destroy',$leader->id) }}" method="POST" class="m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action-delete">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    <i class="bi bi-people" style="font-size:60px;color:#cbd5e1"></i>
                                    <div class="fw-bold mt-3">Belum Ada Leader</div>
                                    <div class="text-muted">Silakan tambahkan Leader Assignment terlebih dahulu.</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<div class="modal fade" id="addLeaderModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('leader-assignments.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header text-white"
	style="background:linear-gradient(135deg,#4B49AC,#7978E9);">
                <h5 class="modal-title">Tambah Leader</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
           <div class="modal-body">
            <label class="form-label">Pilih Divisi</label>
            <select
            name="divisi_id"
            id="divisi_id"
            class="form-select filter-input"
            required>
                <option value="">-- Pilih Divisi --</option>
                @foreach($divisis as $divisi)
                    <option value="{{ $divisi->id }}">{{ $divisi->nama_divisi }}</option>
                @endforeach
            </select>

            <label class="form-label">Pilih Leader</label>
            <select name="leader_id" id="leader_id" class="form-select filter-input" required>
                <option value="">-- Pilih Leader --</option>
            </select>
        </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button
                    class="btn text-white px-4"
                    style="background:#4B49AC">
                    <i class="bi bi-check-circle me-1"></i>
                    Simpan Leader
                </button>
            </div>
        </form>
    </div>
</div>
@push('scripts')
<script>
	const divisiSelect=document.getElementById('divisi_id');
const leaderSelect=document.getElementById('leader_id');
if(divisiSelect&&leaderSelect){
	divisiSelect.addEventListener('change',function(){
		const divisi=this.value;
		leaderSelect.innerHTML='<option value="">Memuat Leader...</option>';
		leaderSelect.disabled=true;
		if(!divisi){
			leaderSelect.innerHTML='<option value="">-- Pilih Leader --</option>';
			return;
		}
		fetch(`{{ url('/leader-assignments/leaders') }}/${divisi}`)
			.then(response=>{
				if(!response.ok) throw new Error('Gagal mengambil data Leader.');
				return response.json();
			})
			.then(data=>{
				leaderSelect.innerHTML='<option value="">-- Pilih Leader --</option>';
				if(data.length===0){
					leaderSelect.innerHTML='<option value="">Belum ada Leader untuk divisi ini</option>';
					return;
				}
				data.forEach(item=>{
					const option=document.createElement('option');
					option.value=item.id;
					option.textContent=`${item.employee_nik??'-'} - ${item.name}`;
					leaderSelect.appendChild(option);
				});
				leaderSelect.disabled=false;
			})
			.catch(error=>{
				console.error(error);
				leaderSelect.innerHTML='<option value="">Gagal memuat Leader</option>';
			});
	});
}
</script>
@endpush
@endsection