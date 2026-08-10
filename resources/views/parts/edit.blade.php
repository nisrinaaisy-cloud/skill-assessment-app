@extends('layouts.app')

@section('content')

<style>
    .part-page {
        --primary: #4B49AC;
        --secondary: #98BDFF;
        --support-blue: #7DA0FA;
        --support-purple: #7978E9;
        --support-red: #F3797E;
        --text: #13233E;
        --muted: #65738F;
        --border: #E5EAF7;
    }

    .part-header {
        border-radius: 20px;
        overflow: hidden;
        background: linear-gradient(90deg, var(--primary) 0%, var(--support-purple) 62%, var(--support-red) 100%);
        color: #fff;
        box-shadow: 0 14px 32px rgba(75, 73, 172, 0.22);
        margin-bottom: 18px;
    }

    .part-header-inner {
        padding: 20px 22px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
    }

    .part-title-wrap {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .part-title-icon {
        width: 48px;
        height: 48px;
        border-radius: 15px;
        background: rgba(255, 255, 255, 0.16);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
    }

    .part-title {
        font-size: 21px;
        font-weight: 900;
        line-height: 1.1;
        margin: 0;
        letter-spacing: -0.3px;
    }

    .part-subtitle {
        font-size: 12.5px;
        margin: 5px 0 0;
        color: rgba(255, 255, 255, 0.86);
        font-weight: 600;
    }

    .btn-back {
        border: 1px solid rgba(255, 255, 255, 0.26);
        background: rgba(255, 255, 255, 0.14);
        color: #fff;
        border-radius: 13px;
        padding: 10px 15px;
        font-size: 13px;
        font-weight: 800;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: 0.2s ease;
        white-space: nowrap;
        text-decoration: none;
    }

    .btn-back:hover {
        background: rgba(255, 255, 255, 0.22);
        color: #fff;
        transform: translateY(-1px);
    }

    .part-form-card {
        background: #fff;
        border-radius: 22px;
        border: 1px solid var(--border);
        box-shadow: 0 10px 28px rgba(75, 73, 172, 0.08);
        overflow: hidden;
    }

    .form-body {
        padding: 22px;
    }

    .form-label {
        font-size: 12px !important;
        font-weight: 900 !important;
        text-transform: uppercase;
        letter-spacing: 0.55px;
        color: var(--muted);
        margin-bottom: 8px;
    }

    .required-mark {
        color: var(--support-red);
    }

    .form-control,
    .form-select {
        height: 48px;
        border-radius: 13px;
        border: 1px solid #DDE4F3;
        font-size: 14px;
        font-weight: 600;
        color: var(--text);
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--support-purple);
        box-shadow: 0 0 0 0.2rem rgba(75, 73, 172, 0.12);
    }

    .form-control[readonly] {
        background: #F3F6FF;
        color: var(--muted);
        cursor: not-allowed;
    }

    .invalid-feedback {
        font-size: 12px;
        font-weight: 700;
    }

    .alert-error {
        border: 1px solid rgba(243, 121, 126, 0.22);
        background: #FDEEEF;
        color: #9F4E5A;
        border-radius: 14px;
        padding: 13px 15px;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 18px;
    }

    .action-footer {
        margin-top: 24px;
        padding-top: 18px;
        border-top: 1px solid #EEF2FF;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 14px;
    }

    .btn-secondary-action {
        min-width: 150px;
        border-radius: 14px;
        padding: 11px 20px;
        font-weight: 900;
        background: #F3F6FF;
        color: var(--primary);
        border: 1px solid rgba(75, 73, 172, 0.15);
        text-align: center;
        transition: 0.2s ease;
        text-decoration: none;
    }

    .btn-secondary-action:hover {
        background: var(--primary);
        color: #fff;
    }

    .btn-primary-action {
        min-width: 180px;
        border: none;
        border-radius: 14px;
        padding: 11px 22px;
        font-weight: 900;
        color: #fff;
        background: linear-gradient(135deg, var(--primary), var(--support-blue));
        box-shadow: 0 12px 22px rgba(75, 73, 172, 0.20);
        transition: 0.2s ease;
    }

    .btn-primary-action:hover {
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 16px 28px rgba(75, 73, 172, 0.26);
    }

    .modal-icon {
        width: 58px;
        height: 58px;
        margin: 0 auto 14px;
        border-radius: 18px;
        background: #EEF4FF;
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
    }

    @media (max-width: 768px) {
        .part-header-inner,
        .form-section-head,
        .action-footer {
            flex-direction: column;
            align-items: stretch;
        }

        .btn-back,
        .btn-secondary-action,
        .btn-primary-action {
            width: 100%;
            justify-content: center;
        }
    }
    .btn-add-subprocess{
            display:inline-flex;
            align-items:center;
            gap:8px;
            padding:10px 18px;
            border:none;
            border-radius:12px;
            background:linear-gradient(135deg,#5b5fcf,#7389ff);
            color:#fff;
            font-weight:600;
            transition:.2s;
        }

        .btn-add-subprocess:hover{
            transform:translateY(-1px);
            box-shadow:0 8px 20px rgba(91,95,207,.25);
        }
        .subprocess-dropdown{position:relative;flex:1;width:100%;min-width:0}
        .subprocess-search{width:100%;height:48px;padding:0 15px;border:1px solid #dbe3ff;border-radius:12px;outline:none}
        .subprocess-list{display:none;position:absolute;top:52px;left:0;right:0;max-height:250px;overflow:auto;background:#fff;border:1px solid #dbe3ff;border-radius:12px;box-shadow:0 10px 25px rgba(0,0,0,.15);z-index:9999}
        .subprocess-item{padding:10px 15px;cursor:pointer}
        .subprocess-item:hover{background:#6366f1;color:#fff}
        .input-group{align-items:flex-start}
        .input-group>.subprocess-dropdown{flex:1}
        .subprocess-search{height:48px}
        .subprocess-list{left:0;right:0;top:50px;width:100%;box-sizing:border-box}
        .confirm-popup{
            width:500px!important;
            max-width:90%!important;
            border-radius:22px!important;
            padding:28px 26px 22px!important;
        }

        .confirm-popup .swal2-icon{
            transform:scale(.82);
            margin:0 auto 8px!important;
        }

        .confirm-title{
            margin:0!important;
            font-size:24px!important;
            font-weight:700!important;
            line-height:1.35!important;
            color:#273043!important;
        }

        .confirm-text{
            margin:10px 0 22px!important;
            font-size:15px!important;
            color:#6b7280!important;
            line-height:1.6!important;
        }

        .btn-confirm{
            min-width:120px!important;
            height:46px!important;
            padding:0 26px!important;
            border:none!important;
            border-radius:12px!important;
            background:linear-gradient(135deg,#5b5ce2,#6f8df5)!important;
            color:#fff!important;
            font-size:16px!important;
            font-weight:700!important;
            box-shadow:0 10px 22px rgba(91,92,226,.25)!important;
        }

        .btn-confirm:hover{
            transform:translateY(-1px);
        }
</style>
<div class="part-page">
    <div class="part-header">
        <div class="part-header-inner">
            <div class="part-title-wrap">
                <div class="part-title-icon">
                    <i class="bi bi-pencil-square"></i>
                </div>
                <div>
                    <h1 class="part-title">Edit Part Division Mapping</h1>
                    <p class="part-subtitle">
                        Perbarui mapping Divisi dan Sub Proses untuk kebutuhan Skill Assessment.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="part-form-card">
        <div class="form-body">
            @if($errors->any())
                <div class="alert-error">
                    <i class="bi bi-exclamation-circle-fill me-1"></i>
                    Terdapat data yang belum sesuai. Silakan periksa kembali form di bawah.
                </div>
                @endif
                <form action="{{ route('parts.update', $part->id) }}" method="POST" id="partEditForm">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                <div class="col-lg-6">
                    <label class="form-label">No Part <span class="required-mark">*</span></label>
                    <input type="text" name="no_part" class="form-control" value="{{ old('no_part',$part->no_part) }}" readonly>
                </div>
                <div class="col-lg-6">
                    <label class="form-label">Nama Part <span class="required-mark">*</span></label>
                    <input type="text" name="nama_part" class="form-control" value="{{ old('nama_part',$part->nama_part) }}" readonly>
                </div>
                <div class="col-lg-6">
                    <label class="form-label">Sub Proses</label>
                    <div id="subProcessContainer">
                        @forelse($part->partProcesses as $process)
                            <div class="input-group mb-2 align-items-start">
                                 <div class="subprocess-dropdown">
                                    <input type="text" class="subprocess-search" placeholder="Cari Sub Proses..." autocomplete="off" value="{{ optional($process->subProcess)->nama_sub_proses }}">
                                    <input type="hidden" name="sub_process[]" class="subprocess-value" value="{{ optional($process->subProcess)->id }}">
                                    <div class="subprocess-list">
                                        @foreach($subProcesses as $subProcess)
                                            <div class="subprocess-item" data-id="{{ $subProcess->id }}">{{ $subProcess->nama_sub_proses }}</div>
                                        @endforeach
                                    </div>
                                </div>
                                <button type="button" class="btn btn-outline-danger removeSubProcess"><i class="bi bi-trash"></i></button>
                            </div>
                        @empty
                            <div class="input-group mb-2">
                                <div class="subprocess-dropdown flex-grow-1">
                                    <input type="text" class="subprocess-search" placeholder="Cari Sub Proses..." autocomplete="off">
                                    <input type="hidden" name="sub_process[]" class="subprocess-value">
                                    <div class="subprocess-list">
                                        @foreach($subProcesses as $subProcess)
                                            <div class="subprocess-item" data-id="{{ $subProcess->id }}">{{ $subProcess->nama_sub_proses }}</div>
                                        @endforeach
                                    </div>
                                </div>
                                <button type="button" class="btn btn-outline-danger removeSubProcess"><i class="bi bi-trash"></i></button>
                            </div>
                        @endforelse
                    </div>
                    <button type="button" class="btn-add-subprocess mt-2" id="addSubProcess">
                        <i class="bi bi-plus-circle"></i>
                        Tambah Sub Proses
                    </button>
                </div>
                <div class="col-lg-6">
                    <label class="form-label">Divisi</label>
                    <select name="division_id" class="form-select">
                        @foreach($divisions as $division)
                            <option value="{{ $division->id }}"
                                {{ optional($part->partDivisions->first())->division_id==$division->id?'selected':'' }}>
                                {{ $division->nama_divisi }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
                <div class="action-footer">
                    <a href="{{ route('parts.index') }}" class="btn-secondary-action">
                        Batal
                    </a>
                    <button type="button"
                            class="btn-primary-action"
                            data-bs-toggle="modal"
                            data-bs-target="#confirmModal">
                        <i class="bi bi-save me-1"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-body text-center p-4">
                <div class="modal-icon">
                    <i class="bi bi-pencil-square"></i>
                </div>
                <h5 class="fw-bold mb-2">Simpan Perubahan Part?</h5>
                <p class="text-muted mb-4" style="font-size: 14px;">
                    Pastikan No Part, Nama Part, Divisi, Status, dan Sub Proses sudah benar sebelum perubahan disimpan.
                </p>
                <div class="d-flex gap-3">
                    <button type="button" class="btn btn-light rounded-3 w-100" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="button" class="btn-primary-action w-100" id="submitBtn">
                        Ya, Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){

	const partEditForm=document.getElementById('partEditForm');
	const submitBtn=document.getElementById('submitBtn');
	const addSubProcess=document.getElementById('addSubProcess');
	const subProcessContainer=document.getElementById('subProcessContainer');

	submitBtn.addEventListener('click',function(){
		partEditForm.submit();
	});

	function initDropdown(drop){
		const input=drop.querySelector('.subprocess-search');
		const hidden=drop.querySelector('.subprocess-value');
		const list=drop.querySelector('.subprocess-list');

		input.addEventListener('focus',()=>list.style.display='block');

		input.addEventListener('keyup',function(){
			const key=this.value.toLowerCase();
			list.querySelectorAll('.subprocess-item').forEach(item=>{
				item.style.display=item.innerText.toLowerCase().includes(key)?'block':'none';
			});
		});

		list.querySelectorAll('.subprocess-item').forEach(item=>{
			item.addEventListener('click',function(){
				input.value=this.innerText.trim();
				hidden.value=this.dataset.id;
				list.style.display='none';
			});
		});
	}

	document.querySelectorAll('.subprocess-dropdown').forEach(drop=>initDropdown(drop));

	addSubProcess.addEventListener('click',function(){

		const row=document.createElement('div');
		row.className='input-group mb-2 align-items-start';

		row.innerHTML=`
		<div class="subprocess-dropdown">
			<input type="text" class="subprocess-search" placeholder="Cari Sub Proses..." autocomplete="off">
			<input type="hidden" name="sub_process[]" class="subprocess-value">
			<div class="subprocess-list">
				@foreach($subProcesses as $subProcess)
					<div class="subprocess-item" data-id="{{ $subProcess->id }}">{{ $subProcess->nama_sub_proses }}</div>
				@endforeach
			</div>
		</div>
		<button type="button" class="btn btn-outline-danger removeSubProcess">
			<i class="bi bi-trash"></i>
		</button>`;

		subProcessContainer.appendChild(row);
		initDropdown(row.querySelector('.subprocess-dropdown'));

	});

	document.addEventListener('click',function(e){

    if(e.target.closest('.removeSubProcess')){
        const rows=document.querySelectorAll('#subProcessContainer .input-group');
        if(rows.length<=1){
            Swal.fire({
                icon:'warning',
                title:'Sub Proses tidak boleh kosong',
                text:'Minimal harus ada 1 Sub Proses.',
                confirmButtonText:'OK',
                buttonsStyling:false,
                customClass:{
                    popup:'confirm-popup',
                    title:'confirm-title',
                    htmlContainer:'confirm-text',
                    confirmButton:'btn-confirm'
                }
            });
            return;
        }
        e.target.closest('.input-group').remove();
    }
		if(!e.target.closest('.subprocess-dropdown')){
			document.querySelectorAll('.subprocess-list').forEach(list=>{
				list.style.display='none';
			});
		}
	});

});
</script>
@endsection