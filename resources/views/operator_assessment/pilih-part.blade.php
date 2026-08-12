<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Part Assessment</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
        :root {
            --primary: #4B49AC;
            --primary-dark: #343178;
            --primary-soft: #F3F2FF;
            --support-purple: #7978E9;
            --support-pink: #F3797E;
            --text: #13233E;
            --muted: #65738F;
            --border: #E5EAF7;
            --bg: #F7F9FC;
        }

        body {
            background: var(--bg);
            color: var(--text);
        }

        .operator-page {
            max-width: 520px;
            min-height: 100vh;
            margin: 0 auto;
            padding: 18px 14px 28px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            height: 42px;
            padding: 0 14px;
            border-radius: 999px;
            border: 1px solid var(--border);
            background: #fff;
            color: var(--primary);
            text-decoration: none;
            font-size: 13px;
            font-weight: 950;
            box-shadow: 0 8px 18px rgba(24, 32, 74, 0.06);
            margin-bottom: 14px;
        }

        .hero-card {
            overflow: hidden;
            border-radius: 20px;
            background: #fff;
            border: 1px solid rgba(75, 73, 172, .12);
            box-shadow: 0 10px 25px rgba(24, 32, 74, 0.07);
            margin-bottom: 16px;
        }

        .hero-head {
            padding: 20px;
            color: #fff;
            background: linear-gradient(90deg, var(--primary-dark) 0%, var(--primary) 55%, var(--support-purple) 100%);
        }

        .hero-head h4 {
            font-size: 22px;
            font-weight: 950;
            margin: 0 0 5px;
        }

        .hero-head p {
            font-size: 13px;
            font-weight: 650;
            opacity: .9;
            margin: 0;
        }

        .hero-body {
            padding: 18px 20px 20px;
        }

        .operator-mini {
            padding: 14px;
            border-radius: 16px;
            background: linear-gradient(135deg, #F8FAFF 0%, #F4F2FF 100%);
            border: 1px solid var(--border);
            margin-bottom: 18px;
        }

        .mini-title {
            font-size: 13px;
            font-weight: 950;
            color: var(--primary);
            margin-bottom: 12px;
        }

        .info-label {
            font-size: 11px;
            color: var(--muted);
            font-weight: 850;
            text-transform: uppercase;
            margin-bottom: 2px;
        }

        .info-value {
            font-size: 14px;
            color: var(--text);
            font-weight: 950;
            margin-bottom: 10px;
        }

        .period-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 12px;
            border-radius: 999px;
            background: var(--primary-soft);
            color: var(--primary);
            font-size: 13px;
            font-weight: 950;
            margin-bottom: 14px;
        }

        .form-label {
            font-size: 13px;
            font-weight: 950;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: .4px;
        }

        .form-control {
            min-height: 54px;
            border-radius: 14px;
            border: 1px solid #D7DFF2;
            font-size: 15px;
            font-weight: 800;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 .2rem rgba(75, 73, 172, .12);
        }

        .selected-card {
            display: none;
            margin-top: 16px;
            padding: 14px;
            border-radius: 16px;
            background: linear-gradient(135deg, #F8FAFF 0%, #F4F2FF 100%);
            border: 1px solid var(--border);
        }

        .selected-title {
            font-size: 13px;
            font-weight: 950;
            color: var(--primary);
            margin-bottom: 12px;
        }

        .btn-main {
            min-height: 54px;
            border: none;
            border-radius: 15px;
            color: #fff;
            font-weight: 950;
            background: linear-gradient(135deg, var(--primary), var(--support-purple));
            box-shadow: 0 10px 18px rgba(75, 73, 172, .22);
        }

        .history-btn{
        display:flex;
        align-items:center;
        justify-content:center;
        gap:10px;

        height:52px;

        border-radius:15px;

        text-decoration:none;

        font-weight:900;

        color:#4B49AC;

        background:#F6F5FF;

        border:1px solid #DCD8FF;

        transition:.25s;
    }

    .history-btn:hover{

        color:#fff;

        background:#4B49AC;

        border-color:#4B49AC;

        transform:translateY(-2px);

        box-shadow:0 8px 18px rgba(75,73,172,.18);

    }

    .history-btn i{

        font-size:18px;

    }

        .btn-main:disabled {
            opacity: .55;
            box-shadow: none;
        }

        .btn-cancel {
            min-height: 46px;
            border-radius: 14px;
            border: 1px solid #F3C2C8;
            background: #FDEEEF;
            color: #D85E6D;
            font-weight: 950;
        }

        .help-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 18px;
            box-shadow: 0 10px 25px rgba(24, 32, 74, 0.06);
            padding: 14px;
            color: var(--muted);
            font-size: 12px;
            font-weight: 750;
            line-height: 1.5;
            margin-bottom: 12px;
        }

        .period-alert {
            background: #FFF8E6;
            border: 1px solid #FADFA1;
            border-radius: 18px;
            box-shadow: 0 10px 25px rgba(24, 32, 74, 0.05);
            padding: 14px;
            color: #7C5700;
            font-size: 12px;
            font-weight: 800;
            line-height: 1.5;
            margin-bottom: 12px;
        }

        .rule-card {
            background: #FFF8E6;
            border: 1px solid #FADFA1;
            border-radius: 18px;
            box-shadow: 0 10px 25px rgba(24, 32, 74, 0.05);
            padding: 14px;
            color: #7C5700;
            font-size: 12px;
            font-weight: 750;
            line-height: 1.5;
            margin-bottom: 12px;
        }

        .rule-card b,
        .period-alert b {
            font-weight: 950;
        }

        .sticky-back {
            position: sticky;
            top: 0;
            z-index: 20;
            padding: 8px 0 12px;
            background: linear-gradient(to bottom, var(--bg) 80%, rgba(247,249,252,0));
        }

        .suggestion-box{
            margin-top:10px;
            border:1px solid var(--border);
            border-radius:16px;
            background:#fff;
            overflow:hidden;
            display:none;
            max-height:260px;
            overflow-y:auto;
        }

        .suggestion-item{
            width:100%;
            border:none;
            background:#fff;
            padding:13px 14px;
            text-align:left;
            border-bottom:1px solid #EEF2FF;
            cursor:pointer;
        }

        .suggestion-item:last-child{
            border-bottom:none;
        }

        .suggestion-item:hover{
            background:var(--primary-soft);
        }

        .suggestion-name{
            font-size:14px;
            font-weight:950;
            color:var(--text);
            text-transform:uppercase;
        }

        .suggestion-nik{
            font-size:12px;
            font-weight:800;
            color:var(--muted);
            margin-top:2px;
        }

        .empty-text{
            padding:12px 14px;
            color:var(--muted);
            font-size:13px;
            font-weight:700;
        }

        .history-card{
    margin-bottom:18px;
    }

    .history-card a{
        display:flex;
        align-items:center;
        gap:16px;
        padding:18px;
        border-radius:18px;
        background:#fff;
        border:1px solid var(--border);
        text-decoration:none;
        transition:.25s;
        box-shadow:0 10px 22px rgba(24,32,74,.05);
    }

    .history-card a:hover{
        transform:translateY(-2px);
        box-shadow:0 16px 28px rgba(24,32,74,.10);
    }

    .history-icon{
        width:52px;
        height:52px;
        border-radius:15px;
        background:#F4F2FF;
        color:#4B49AC;
        display:flex;
        justify-content:center;
        align-items:center;
        font-size:22px;
    }

    .history-content{
        flex:1;
    }

    .history-title{
        color:#13233E;
        font-size:15px;
        font-weight:900;
    }

    .history-subtitle{
        margin-top:3px;
        color:#6E7693;
        font-size:12px;
        line-height:1.4;
    }

    .history-arrow{
        color:#4B49AC;
        font-size:20px;
    }
    </style>
</head>

<body>
<div class="operator-page">

    <div class="sticky-back">
        <a href="{{ route('operator.assessment.index') }}" class="back-link">
            <i class="bi bi-arrow-left"></i>
            Kembali
        </a>
    </div>

    <div class="hero-card">
        <div class="hero-head">
            <h4><i class="bi bi-clipboard2-check me-2"></i>Pilih Part</h4>
            <p>Cari part yang akan dikerjakan assessment-nya.</p>
        </div>

        <div class="hero-body">
            <div class="operator-mini">
                <div class="mini-title">
                    <i class="bi bi-person-check me-1"></i>
                    Data Operator
                </div>

                <div class="info-label">Nama</div>
                <div class="info-value">{{ $operator->nama_lengkap }}</div>

                <div class="info-label">NIK</div>
                <div class="info-value">{{ $operator->nik }}</div>

                <div class="info-label">Departemen</div>
                <div class="info-value mb-0">
                    {{ optional($operator->divisi)->nama_divisi ?? '-' }}
                </div>
            </div>

            <div class="rule-card">
                <i class="bi bi-exclamation-triangle-fill me-1"></i>
                <b>Catatan:</b> Operator tidak diperbolehkan mengisi part yang sama lebih dari satu kali, walaupun pada bulan yang berbeda.
                Jika assessment sebelumnya tidak lulus, operator dapat mengisi ulang sebagai remedial.
            </div>

            <form method="POST" action="{{ route('operator.assessment.mulai') }}">
                @csrf

<input type="hidden" name="operator_id" value="{{ $operator->id }}">
<input type="hidden" name="periode_id" value="{{ $periodeAktif->id }}">

    <!-- <div class="help-card">

        <div class="fw-bold mb-2">
            <i class="bi bi-graph-up-arrow me-1"></i>
            Progress Assessment
        </div>

        <div>
            Periode :
            <b>{{ $periodeAktif->label }}</b>
        </div>

        <div>
            Part Lulus :
            <b>{{ $totalLulus }}</b> / 3
        </div>

        <div>
            Sisa Assessment :
            <b>{{ $sisaPart }}</b> Part
        </div>

    </div> -->

    <div class="history-card">

        <a href="{{ route('operator.assessment.history',$operator->id) }}">

            <div class="history-icon">

                <i class="bi bi-clock-history"></i>

            </div>

            <div class="history-content">

                <div class="history-title">

                    Riwayat Assessment

                </div>

                <div class="history-subtitle">

                    Lihat part yang pernah dikerjakan,
                    status, nilai, approval dan remedial.

                </div>

            </div>

            <i class="bi bi-chevron-right history-arrow"></i>

        </a>

    </div>

    <div class="mb-3">

            <label class="form-label">
                Cari Part
            </label>

            <input
                type="text"
                id="searchPart"
                class="form-control"
                placeholder="Ketik No Part / Nama Part..."
                autocomplete="off">

            <input
                type="hidden"
                name="part_id"
                id="partId">

            <div
                id="partSuggestion"
                class="suggestion-box">
            </div>

        </div>

                    <div id="selectedCard" class="selected-card">
                        <div class="selected-title">
                            <i class="bi bi-check-circle me-1"></i>
                            Part Terpilih
                        </div>

                        <div class="info-label">No Part</div>
                        <div class="info-value" id="selectedNoPart">-</div>

                        <div class="info-label">Nama Part</div>
                        <div class="info-value" id="selectedNamaPart">-</div>

                        <div class="info-label">Sub Divisi</div>
                        <div class="info-value" id="selectedSubDivisi">-</div>

                        <button type="button" id="btnBatalPilih" class="btn btn-cancel w-100 mt-2">
                            Batal 
                        </button>
                    </div>

                <div class="mb-3">

            <label class="form-label">
                Pilih Sub Proses
            </label>

        <input
            type="text"
            id="searchSubProcess"
            class="form-control"
            placeholder="Cari Sub Proses..."
            autocomplete="off">

            <input
                type="hidden"
                name="sub_process_id"
                id="subProcessId">

            <div
                id="subSuggestion"
                class="suggestion-box">
            </div>

        </div>

               <button
                    type="submit"
                    id="btnMulai"
                    class="btn btn-main w-100"
                >
                    Mulai Assessment
                </button>
            </form>
        </div>
    </div>

</div>

    @php
    $partList=$parts->map(function($part){
    return[
    'id'=>$part->id,
    'no'=>$part->no_part,
    'nama'=>$part->nama_part,
    'kategori'=>ucfirst($part->kategori)
    ];
    })->values();
    @endphp
<script>

    const parts=@json($partList);
    const searchPart=document.getElementById('searchPart');
    const partSuggestion=document.getElementById('partSuggestion');
    const partId=document.getElementById('partId');
    const searchSub=document.getElementById('searchSubProcess');
    const subSuggestion=document.getElementById('subSuggestion');
    const subProcessId=document.getElementById('subProcessId');
    const btnMulai=document.getElementById('btnMulai');
    btnMulai.disabled=true;
    let currentSubProcess=[];
        const selectedCard = document.getElementById('selectedCard');
const selectedNoPart = document.getElementById('selectedNoPart');
const selectedNamaPart = document.getElementById('selectedNamaPart');
const selectedSubDivisi = document.getElementById('selectedSubDivisi');
const btnBatalPilih = document.getElementById('btnBatalPilih');

function renderPart(keyword){

    partSuggestion.innerHTML='';

    if(keyword.length<1){
        partSuggestion.style.display='none';
        return;
    }

    let result=parts.filter(item=>

        item.no.toLowerCase().includes(keyword.toLowerCase()) ||

        item.nama.toLowerCase().includes(keyword.toLowerCase())

    );

    if(result.length===0){

        partSuggestion.innerHTML='<div class="empty-text">Part tidak ditemukan.</div>';
        partSuggestion.style.display='block';
        return;

    }

    result.forEach(item=>{

        const button=document.createElement('button');

        button.type='button';

        button.className='suggestion-item';

        button.innerHTML = `
            <div class="suggestion-name">${item.no}</div>
            <div class="suggestion-nik">${item.nama}</div>
        `;
        button.onclick=function(){

            pilihPart(item);

        };

        partSuggestion.appendChild(button);

    });

    partSuggestion.style.display='block';

}

searchPart.addEventListener('input',function(){

    renderPart(this.value);

});

function pilihPart(part){

    partId.value=part.id;

    subProcessId.value = '';
    searchSub.value = '';
    subSuggestion.innerHTML = '';

    searchPart.value = part.nama;

    selectedNoPart.textContent = part.no;
    selectedNamaPart.textContent = part.nama;
    selectedSubDivisi.textContent = part.kategori;

    selectedCard.style.display='block';

    partSuggestion.style.display='none';

fetch("{{ url('/operator-assessment/get-sub-process') }}/" + part.id)
    .then(response => {
        if (!response.ok) {
            throw new Error('Gagal mengambil Sub Proses. HTTP ' + response.status);
        }

        return response.json();
    })
    .then(response => {

        console.log('Sub Proses Part ID ' + part.id + ':', response);

        currentSubProcess = response;

        searchSub.placeholder = 'Cari Sub Proses...';

    })
    .catch(error => {

        console.error('ERROR GET SUB PROCESS:', error);

        currentSubProcess = [];

        searchSub.placeholder = 'Sub Proses gagal dimuat...';

    });
}

searchSub.addEventListener('focus', function () {

    if (!partId.value) {

        Swal.fire({
            icon: 'warning',
            title: 'Part Belum Dipilih',
            text: 'Silakan pilih Part terlebih dahulu.',
            confirmButtonText: 'OK',
            confirmButtonColor: '#4B49AC'
        });

        searchPart.focus();

        return;

    }

    renderSub(searchSub.value);

});

searchSub.addEventListener('input', function () {

    if (!partId.value) {

        this.value='';

        return;

    }

    renderSub(this.value);

});

function renderSub(keyword){

    subSuggestion.innerHTML='';

    let result = currentSubProcess.filter(item =>
        item.nama_sub_proses
            .toLowerCase()
            .includes(keyword.toLowerCase())
    );

    if(result.length===0){

        subSuggestion.innerHTML =
            '<div class="empty-text">Sub Proses tidak ditemukan.</div>';

        subSuggestion.style.display='block';
        return;

    }

    result.forEach(item=>{

        const button=document.createElement('button');

        button.type='button';
        button.className='suggestion-item';

        button.innerHTML=`
            <div class="suggestion-name">${item.nama_sub_proses}</div>
        `;

        button.onclick=function(){

            subProcessId.value=item.id;
            searchSub.value=item.nama_sub_proses;

            subSuggestion.style.display='none';

            btnMulai.disabled=false;

        };

        subSuggestion.appendChild(button);

    });

    subSuggestion.style.display='block';

}

btnBatalPilih.onclick=function(){

    partId.value='';

    subProcessId.value='';

    searchPart.value='';

    searchSub.value='';

    selectedNoPart.textContent='-';
    selectedNamaPart.textContent='-';
    selectedSubDivisi.textContent='-';

    searchSub.placeholder='Pilih Part terlebih dahulu...';

    currentSubProcess=[];

    selectedCard.style.display='none';

    partSuggestion.style.display='none';

    subSuggestion.style.display='none';
    searchPart.focus();
    btnMulai.disabled=true;
};

document.addEventListener('click',function(e){

    if(!e.target.closest('#searchPart') &&
       !e.target.closest('#partSuggestion')){

        partSuggestion.style.display='none';

    }

    if(!e.target.closest('#searchSubProcess') &&
       !e.target.closest('#subSuggestion')){

        subSuggestion.style.display='none';

    }

});
        </script>
</body>
</html>