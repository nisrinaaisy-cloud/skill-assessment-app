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

    .operator-hero{
        width:100%;
        padding:16px 20px;
        border-radius:18px;
        background:linear-gradient(135deg,#4B49AC 0%,#7978E9 55%,#F3797E 100%);
        color:#fff;
        display:flex;
        justify-content:space-between;
        align-items:center;
        box-shadow:0 14px 32px rgba(75,73,172,.24);
    }

    .operator-hero-title{
        font-size:22px;
        font-weight:800;
    }

    .operator-hero-subtitle{
        font-size:13px;
        opacity:.85;
        margin-top:4px;
    }

    .btn-add-operator{
        min-width:180px;
        border:none;
        border-radius:16px;
        background:#fff;
        color:#4B49AC;
        padding:12px 22px;
        font-weight:800;
        text-decoration:none;
        text-align:center;
        transition:.2s;
    }

    .btn-add-operator:hover{
        background:#F8FAFC;
        color:#F3797E;
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

        .form-text {
            color: var(--muted);
            font-size: 11.5px;
            font-weight: 600;
        }

        .no-part-valid {
            color: #4B49AC !important;
            font-weight: 800;
        }

        .no-part-invalid {
            color: #F3797E !important;
            font-weight: 800;
        }

        .form-control.is-duplicate {
            border-color: #F3797E !important;
            box-shadow: 0 0 0 0.2rem rgba(243, 121, 126, 0.12) !important;
        }
    }

    .input-group .btn{
        border-radius:0 12px 12px 0;
    }
    #subProcessContainer input{
        border-radius:12px 0 0 12px;
    }
    .removeSub{
        border-radius:0 12px 12px 0;
    }
    .select2-container{
        width:100%!important;
    }

    .select2-dropdown{
        z-index:99999!important;
    }

    .select2-container--default .select2-selection--single{
        height:48px;
        border:1px solid #dbe3ff;
        border-radius:14px;
        display:flex;
        align-items:center;
        padding:0 10px;
        background:#fff;
    }

    .select2-container--default .select2-selection__rendered{
        line-height:46px;
    }

    .select2-container--default .select2-selection__arrow{
        height:46px;
    }
</style>

<div class="part-page">

<div class="operator-hero mb-4">

    <div>
        <div class="operator-hero-title">
            Tambah Part
        </div>

        <div class="operator-hero-subtitle">
            Tambahkan data master part beserta Sub Proses untuk kebutuhan Skill Assessment Operator.
        </div>
    </div>

    <a href="{{ route('parts.index') }}" class="btn btn-add-operator">
        <i class="bi bi-arrow-left-circle me-1"></i>
        Kembali
    </a>

</div>
<div class="part-form-card">
    <div class="form-body">
            @if($errors->any())
                <div class="alert-error">
                    <i class="bi bi-exclamation-circle-fill me-1"></i>
                    Terdapat data yang belum sesuai. Silakan periksa kembali form di bawah.
                </div>
            @endif

            <form action="{{ route('parts.store') }}" method="POST" id="partForm">
                @csrf

                <div class="row g-4">
                    <div class="col-lg-6">
                        <label class="form-label">
                            No Part <span class="required-mark">*</span>
                        </label>
                       <input type="text"
                            name="no_part"
                            id="no_part"
                            class="form-control @error('no_part') is-invalid @enderror"
                            value="{{ old('no_part') }}"
                            autocomplete="off">

                        <div class="form-text" id="no-part-helper">
                            No Part harus unik. Sistem akan menolak jika No Part sudah digunakan part lain.
                        </div>

                        @error('no_part')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-lg-6">
                        <label class="form-label">
                            Nama Part <span class="required-mark">*</span>
                        </label>
                        <input type="text"
                               name="nama_part"
                               class="form-control @error('nama_part') is-invalid @enderror"
                               value="{{ old('nama_part') }}">
                        @error('nama_part')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">

                    <label class="form-label">
                        Sub Proses
                    </label>

                    <div id="subProcessContainer">

                        <div class="input-group mb-2">
                            <select name="sub_process[]" class="form-select sub-process-select">
                                <option value="">Pilih Sub Proses</option>

                                @foreach($subProcesses as $subProcess)
                                    <option value="{{ $subProcess->id }}"
                                        <option value="{{ $subProcess->id }}">
                                            {{ $subProcess->nama_sub_proses }}
                                        </option>
                                        {{ $subProcess->nama_sub_proses }}
                                    </option>
                                @endforeach
                            </select>

                            <button
                                type="button"
                                class="btn btn-outline-primary addSubProcess"
                            >
                                <i class="bi bi-plus-lg"></i>
                            </button>

                        </div>

                    </div>
                </div>
                    <div class="col-lg-6">
                        <label class="form-label">
                            Divisi <span class="required-mark">*</span>
                        </label>
                    <select name="division_id" class="form-select @error('division_id') is-invalid @enderror" required>
                        <option value="">Pilih Divisi</option>
                        @foreach($divisions as $division)
                            <option value="{{ $division->id }}" {{ old('division_id')==$division->id?'selected':'' }}>{{ $division->nama_divisi }}</option>
                        @endforeach
                    </select>
                    @error('division_id')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                        @error('proses')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="col-lg-6">

                    <label class="form-label">
                        Status
                    </label>

                    <select
                        name="is_active"
                        class="form-select"
                    >

                        <option value="1" selected>
                            Aktif
                        </option>

                        <option value="0">
                            Nonaktif
                        </option>

                    </select>

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
                        Simpan Part
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
                    <i class="bi bi-box-seam-fill"></i>
                </div>

                <h5 class="fw-bold mb-2">Simpan Part Baru?</h5>

                <p class="text-muted mb-4" style="font-size: 14px;">
                    Pastikan No Part, Nama Part, Divisi, dan Sub Proses sudah benar sebelum disimpan.
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
document.addEventListener('DOMContentLoaded', function () {

    const partForm = document.getElementById('partForm');
    const submitBtn = document.getElementById('submitBtn');

    const noPartInput = document.getElementById('no_part');
    const noPartHelper = document.getElementById('no-part-helper');

    const subProcessContainer = document.getElementById('subProcessContainer');
        $('.sub-process-select').select2({
        placeholder:'Pilih Sub Proses',
        width:'100%'
    });
    let noPartDuplicate = false;
    let typingTimer = null;

    /* ===============================
        CEK DUPLIKAT NO PART
    ================================== */

    function setNoPartDefault(){
        noPartDuplicate = false;

        noPartInput.classList.remove('is-duplicate');

        noPartHelper.classList.remove(
            'no-part-valid',
            'no-part-invalid'
        );

        noPartHelper.textContent =
            'No Part harus unik. Sistem akan menolak jika No Part sudah digunakan part lain.';
    }

    function setNoPartValid(message){

        noPartDuplicate = false;

        noPartInput.classList.remove('is-duplicate');

        noPartHelper.classList.remove('no-part-invalid');
        noPartHelper.classList.add('no-part-valid');

        noPartHelper.textContent = message;
    }

    function setNoPartInvalid(message){

        noPartDuplicate = true;

        noPartInput.classList.add('is-duplicate');

        noPartHelper.classList.remove('no-part-valid');
        noPartHelper.classList.add('no-part-invalid');

        noPartHelper.textContent = message;
    }

    function checkNoPart(){

        let noPart = noPartInput.value.trim();

        if(noPart === ''){
            setNoPartDefault();
            return;
        }

        fetch(`{{ route('parts.checkNoPart') }}?no_part=${encodeURIComponent(noPart)}`)
            .then(res=>res.json())
            .then(data=>{

                if(data.exists){

                    setNoPartInvalid(data.message);

                }else{

                    setNoPartValid(data.message);

                }

            })
            .catch(()=>{

                setNoPartDefault();

            });

    }

    noPartInput.addEventListener('input',function(){

        clearTimeout(typingTimer);

        typingTimer = setTimeout(function(){

            checkNoPart();

        },400);

    });

    if(noPartInput.value.trim()!=''){
        checkNoPart();
    }

    /* ===============================
        TAMBAH SUB PROSES
    ================================== */

    subProcessContainer.addEventListener('click',function(e){
        if(e.target.closest('.addSubProcess')){
            let row = document.createElement('div');
            row.className='input-group mb-2';
            row.innerHTML=`
            <div class="input-group mb-2">
            <select name="sub_process[]" class="form-select sub-process-select">
            <option value="">Pilih Sub Proses</option>
            @foreach($subProcesses as $subProcess)
            <option value="{{ $subProcess->id }}">{{ $subProcess->nama_sub_proses }}</option>
            @endforeach
            </select>
            <button type="button" class="btn btn-outline-danger removeSub"><i class="bi bi-dash-lg"></i></button>
            </div>`;
            subProcessContainer.appendChild(row);
            $(row).find('.sub-process-select').select2({
                placeholder:'Pilih Sub Proses',
                width:'100%',
                dropdownParent: $(row)
            });
        }
    });

    /* ===============================
        HAPUS SUB PROSES
    ================================== */

    subProcessContainer.addEventListener('click',function(e){

        if(e.target.closest('.removeSub')){

            e.target.closest('.input-group').remove();

        }

    });

    /* ===============================
        SUBMIT
    ================================== */

    submitBtn.addEventListener('click',function(){

        if(noPartDuplicate){

            noPartInput.focus();

            return;

        }

        partForm.submit();

    });

});
</script>

@endsection