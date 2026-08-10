<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skill Assessment Operator</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --primary: #4B49AC;
            --primary-dark: #343178;
            --primary-soft: #F3F2FF;
            --secondary: #98BDFF;
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

        .suggestion-box {
            margin-top: 10px;
            border: 1px solid var(--border);
            border-radius: 16px;
            background: #fff;
            overflow: hidden;
            display: none;
            max-height: 260px;
            overflow-y: auto;
        }

        .suggestion-item {
            width: 100%;
            border: none;
            background: #fff;
            padding: 13px 14px;
            text-align: left;
            border-bottom: 1px solid #EEF2FF;
        }

        .suggestion-item:last-child {
            border-bottom: none;
        }

        .suggestion-item:hover {
            background: var(--primary-soft);
        }

        .suggestion-name {
            font-size: 14px;
            font-weight: 950;
            color: var(--text);
            text-transform: uppercase;
        }

        .suggestion-nik {
            font-size: 12px;
            font-weight: 800;
            color: var(--muted);
            margin-top: 2px;
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

        .btn-main {
            min-height: 54px;
            border: none;
            border-radius: 15px;
            color: #fff;
            font-weight: 950;
            background: linear-gradient(135deg, var(--primary), var(--support-purple));
            box-shadow: 0 10px 18px rgba(75, 73, 172, .22);
        }

        .btn-main:disabled {
            opacity: .55;
            box-shadow: none;
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
        }

        .empty-text {
            padding: 12px 14px;
            color: var(--muted);
            font-size: 13px;
            font-weight: 750;
        }

        .btn-cancel {
            min-height: 46px;
            border-radius: 14px;
            border: 1px solid #F3C2C8;
            background: #FDEEEF;
            color: #D85E6D;
            font-weight: 950;
        }
    </style>
</head>

<body>
<div class="operator-page">

    <div class="hero-card">
        <div class="hero-head">
            <h4><i class="bi bi-clipboard-check me-2"></i>Skill Assessment</h4>
            <p>Cari nama operator, lalu pastikan data yang muncul sudah benar.</p>
        </div>

        <div class="hero-body">
            <form action="{{ route('operator.assessment.pilihOperator') }}" method="POST">
                @csrf

                <input type="hidden" name="operator_id" id="operatorId">

                <div class="mb-3">
                    <label class="form-label">Cari Nama Operator</label>
                    <input
                        type="text"
                        id="searchOperator"
                        class="form-control"
                        placeholder="Ketik nama operator..."
                        autocomplete="off"
                    >

                    <div id="suggestionBox" class="suggestion-box"></div>

                    @error('operator_id')
                        <div class="text-danger small mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div id="selectedCard" class="selected-card">
                    <div class="selected-title">
                        <i class="bi bi-person-check me-1"></i>
                        Data Operator Terpilih
                    </div>

                    <div class="info-label">Nama</div>
                    <div class="info-value" id="selectedNama">-</div>

                    <div class="info-label">NIK</div>
                    <div class="info-value" id="selectedNik">-</div>

                    <div class="info-label">Tanggal Masuk</div>
                    <div class="info-value" id="selectedTanggalMasuk">-</div>

                    <div class="info-label">Departemen</div>
                    <div class="info-value" id="selectedDepartemen">-</div>

                    <div class="info-label">Leader</div>
                    <div class="info-value" id="selectedLeader">-</div>

                    <div class="mt-3">
                    <label class="form-label">Email</label>

                    <input
                        type="email"
                        name="email"
                        id="email"
                        class="form-control"
                        placeholder="Masukkan Email"
                        required>

                    @error('email')
                        <div class="text-danger small mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                    <button type="button" id="btnBatalPilih" class="btn btn-cancel w-100 mt-2">
                        Batal 
                    </button>
                </div>
                <button id="btnLanjut" class="btn btn-main w-100 mt-4" disabled>
                    Lanjut 
                </button>
            </form>
        </div>
    </div>

    <div class="help-card">
        <i class="bi bi-info-circle me-1"></i>
        Jika ada nama yang sama, pilih berdasarkan NIK. Setelah nama dipilih, data operator akan muncul otomatis.
    </div>

</div>

  @php
    use Carbon\Carbon;

    $operatorList = $operators->map(function ($operator) {

        $tanggalMasuk = '-';

        if (!empty($operator->nik) &&
            preg_match('/\.(\d{6})\./', trim($operator->nik), $match)) {

            try {

                $yy = substr($match[1],0,2);
                $mm = substr($match[1],2,2);
                $dd = substr($match[1],4,2);

                $tanggalMasuk = Carbon::create(
                    2000 + (int)$yy,
                    (int)$mm,
                    (int)$dd
                )->translatedFormat('d F Y');

            } catch (\Throwable $e) {

                $tanggalMasuk='-';

            }

        }

        return [

            'id'=>$operator->id,

            'nama'=>$operator->nama_lengkap,

            'nik'=>$operator->nik,

            'email'=>$operator->email,

            'tanggal_masuk'=>$tanggalMasuk,

            'departemen'=>optional($operator->divisi)->nama_divisi ?? '-',

            'leader'=>optional($operator->leader)->name ?? '-',

        ];

    })->values();
    @endphp

    <script>
        const operators = @json($operatorList);

    const searchInput = document.getElementById('searchOperator');
    const suggestionBox = document.getElementById('suggestionBox');
    const operatorId = document.getElementById('operatorId');
    const selectedCard = document.getElementById('selectedCard');
    const btnLanjut = document.getElementById('btnLanjut');
    const btnBatalPilih = document.getElementById('btnBatalPilih');

    const selectedNama = document.getElementById('selectedNama');
    const selectedNik = document.getElementById('selectedNik');
    const selectedTanggalMasuk = document.getElementById('selectedTanggalMasuk');
    const selectedDepartemen = document.getElementById('selectedDepartemen');
    const selectedLeader = document.getElementById('selectedLeader');

    function resetSelected() {
        operatorId.value = '';
        selectedCard.style.display = 'none';
        btnLanjut.disabled = true;
    }

    function selectOperator(operator) {
        operatorId.value = operator.id;

        searchInput.value = operator.nama + ' - ' + operator.nik;

        selectedNama.textContent = operator.nama;
        selectedNik.textContent = operator.nik;

        selectedTanggalMasuk.textContent =
        operator.tanggal_masuk;
        selectedDepartemen.textContent = operator.departemen;
        selectedLeader.textContent = operator.leader;
        document.getElementById('email').value = operator.email ?? '';

        selectedCard.style.display = 'block';
        suggestionBox.style.display = 'none';
        btnLanjut.disabled = false;
    }

    function renderSuggestions(keyword) {
        suggestionBox.innerHTML = '';

        if (keyword.length < 1) {
            suggestionBox.style.display = 'none';
            return;
        }

        const results = operators
            .filter(operator =>
                operator.nama.toLowerCase().includes(keyword.toLowerCase()) ||
                operator.nik.toLowerCase().includes(keyword.toLowerCase())
            )
            .sort((a, b) => a.nama.localeCompare(b.nama))
            .slice(0, 12);

        if (results.length === 0) {
            suggestionBox.innerHTML = `<div class="empty-text">Operator tidak ditemukan.</div>`;
            suggestionBox.style.display = 'block';
            return;
        }

        results.forEach(operator => {
            const button = document.createElement('button');
            button.type = 'button';
            button.className = 'suggestion-item';
            button.innerHTML = `
                <div class="suggestion-name">${operator.nama}</div>
                <div class="suggestion-nik">${operator.nik}</div>
            `;

            button.addEventListener('click', function () {
                selectOperator(operator);
            });

            suggestionBox.appendChild(button);
        });

        suggestionBox.style.display = 'block';
    }

    searchInput.addEventListener('input', function () {
        resetSelected();
        renderSuggestions(this.value);
    });

    document.addEventListener('click', function (event) {
        if (!event.target.closest('.hero-body')) {
            suggestionBox.style.display = 'none';
        }
    });

        btnBatalPilih.addEventListener('click', function () {
        operatorId.value = '';
        searchInput.value = '';
        selectedCard.style.display = 'none';
        suggestionBox.style.display = 'none';
        btnLanjut.disabled = true;
        searchInput.focus();
    });
</script>
</body>
</html>