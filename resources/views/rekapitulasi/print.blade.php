<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Print Skill Assessment</title>
@php
use SimpleSoftwareIO\QrCode\Facades\QrCode;
@endphp
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            color: #000;
            margin: 0;
            padding: 10px;
            background: #fff;
        }

        .print-button {
            margin-bottom: 10px;
            padding: 8px 16px;
            background: #4B49AC;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
        }

        .sheet {
            width: 1060px;
            margin: 0 auto;
            background: #fff;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 2px solid #222;
            padding: 4px 6px;
            vertical-align: top;
        }

        .title {
            text-align: center;
            font-weight: 800;
            font-size: 16px;
            padding: 3px;
        }

        .label {
            width: 150px;
            font-weight: 700;
        }

        .value {
            width: 350px;
        }

        .right-label {
            width: 170px;
            font-weight: 700;
        }

        .right-value {
            width: 330px;
        }

        .section-title {
            font-weight: 800;
            margin: 10px 0 10px 0;
            line-height: 1;
        }

        .section-title.nilai {
            font-weight: 800;
            margin: 7px 0 2px 0;
            line-height: 1;
        }

        .theory-table th {
            text-align: left;
            font-weight: 700;
            height: 22px;
        }

        .theory-box {
            height: 170px;
            font-size: 14px;
            line-height: 1.65;
        }

        .flow-col {
            width: 34%;
        }

        .subpart-col {
            width: 32%;
        }

        .qpoint-col {
            width: 34%;
        }

        .middle-area {
            margin-top: 10px;
            display: grid;
            grid-template-columns: 52% 43%;
            gap: 5%;
            align-items: start;
        }

        .score-title {
            text-align: center;
            font-weight: 800;
            padding: 3px;
        }

        .score-head {
            text-align: center;
            font-weight: 700;
            height: 26px;
        }

        .score-value {
            height: 70px;
            text-align: center;
            vertical-align: middle;
            font-size: 22px;
        }

        .score-max {
            text-align: center;
            font-weight: 700;
            height: 28px;
        }

        .signature-table th {
            text-align: center;
            font-weight: 700;
            height: 26px;
        }

        .signature-box {
            height: 110px;
            text-align: center;
            vertical-align: middle;
        }

        .signature-name {
            text-align: center;
            height: 26px;
            font-size: 12px;
            vertical-align: middle;
        }

        .signature-footer-row td {
            height: 24px;
            text-align: center;
            font-weight: 700;
            vertical-align: middle;
        }

        .signature-footer-empty {
            border: none !important;
        }

        .footer-box {
            text-align: center;
            font-weight: 700;
        }

        .bottom-area {
            margin-top: 22px;
            width: 44%;
        }

        .assessment-table th {
            text-align: center;
            font-weight: 800;
            height: 26px;
        }

        .assessment-row td {
            height: 78px;
            vertical-align: middle;
        }

        .assessment-label {
            font-weight: 700;
            width: 38%;
        }

        .assessment-min {
            text-align: center;
            width: 18%;
            font-weight: 700;
        }

        .assessment-actual {
            text-align: center;
            width: 22%;
            font-size: 18px;
        }

        .assessment-judge {
            text-align: center;
            width: 22%;
            font-size: 15px;
            font-weight: 700;
        }

        @page {
            size: A4 landscape;
            margin: 8mm;
        }

        @media print {
            body {
                padding: 0;
            }

            .print-button {
                display: none;
            }

            .sheet {
                width: 100%;
                margin: 0;
            }
        .signature-table {
                table-layout: fixed;
                width: 100%;
            }

            .signature-table th,
            .signature-table td {
                text-align: center;
                vertical-align: middle;
                overflow: hidden;
                white-space: nowrap;
            }

            .signature-footer-empty {
                border: none !important;
            }

            .footer-box {
                text-align: center;
                font-weight: 700;
            }
        }

        .signature-box svg{
            width:85px;
            height:85px;
        }
    </style>
</head>

<body>

<button onclick="window.print()" class="print-button">Cetak Form</button>

<div class="sheet">
    <table>
        <tr>
            <th colspan="4" class="title">SKILL ASSESSMENT</th>
        </tr>

        <tr>
            <td class="label">Nama Karyawan</td>
            <td class="value">: {{ $assessment->operator->nama_lengkap ?? '-' }}</td>
            <td class="right-label">No. Part</td>
            <td class="right-value">: {{ $assessment->part->id ?? '-' }}</td>
        </tr>

        <tr>
            <td class="label">NIK</td>
            <td class="value">: {{ $assessment->operator->nik ?? '-' }}</td>
            <td class="right-label">Nama Part</td>
            <td class="right-value">: {{ $assessment->part->nama_part ?? '-' }}</td>
        </tr>

        <tr>
            <td class="label">Jabatan</td>
            <td class="value">: {{ $assessment->operator->jabatan ?? 'Operator' }}</td>
            <td class="right-label">Proses</td>
            <td class="right-value">: {{ $assessment->part->kategori ?? '-' }}</td>
        </tr>

       <tr>
            <td class="label">Departemen</td>
            <td class="value">: {{ $assessment->operator->divisi->nama_divisi ?? '-' }}</td>
            <td class="right-label">Tanggal Pelaksanaan</td>
            <td class="right-value">: {{ optional($assessment->created_at)->format('d-m-Y') }}</td>
        </tr>
        
    </table>

    <div class="section-title">TEORI</div>

    <table class="theory-table">
        <tr>
            <th class="flow-col">Flow Proses</th>
            <th class="subpart-col">Nama Subpart / Material</th>
            <th class="qpoint-col">Q - POINT</th>
        </tr>

        <tr>
            <td class="theory-box">
                - Bahan baku<br>
                - Machining / forming<br>
                - Subcont / proses
            </td>

            <td class="theory-box">
                - {{ $assessment->part->nama_part ?? '-' }}
            </td>

            <td class="theory-box">
                - Tidak burry<br>
                - Tidak dented<br>
                - Marking jelas<br>
                - Dimensi sesuai standar<br>
                - Visual OK
            </td>
        </tr>
    </table>

    <div class="section-title nilai">NILAI</div>

    <div class="middle-area">
        <div>
            <table>
                <tr>
                    <th colspan="3" class="score-title">TEORI</th>
                </tr>

                <tr>
                    <th class="score-head">Flow Proses</th>
                    <th class="score-head">Nama Subpart</th>
                    <th class="score-head">Q - Point</th>
                </tr>

                <tr>
                    <td class="score-value">
                        {{ $assessment->penilaian->nilai_flow ?? 0 }}
                    </td>

                    <td class="score-value">
                        {{ $assessment->penilaian->nilai_subpart ?? 0 }}
                    </td>

                    <td class="score-value">
                        {{ $assessment->penilaian->nilai_qpoint ?? 0 }}
                    </td>
                </tr>

                <tr>
                    <td class="score-max">MAX 30%</td>
                    <td class="score-max">MAX 30%</td>
                    <td class="score-max">MAX 40%</td>
                </tr>
            </table>
        </div>
        <div>
        <table class="signature-table" style="width:170px;margin-left:auto;margin-right:0;">
        <tr>
            <th>VERIFIKASI DIGITAL</th>
        </tr>
        <tr>
            <td class="signature-box" style="padding:8px;height:110px;">
                @if($verificationQrText)
                    {!! QrCode::size(90)->generate($verificationQrText) !!}
                @endif
            </td>
        </tr>
        <tr>
            <td class="signature-name" style="font-size:10px;padding:4px;">Scan QR untuk Verifikasi Digital</td>
        </tr>
        <tr class="signature-footer-row">
            <td class="footer-box" style="font-size:10px;padding:3px;">FORM PRM-08 &nbsp;&nbsp; REVISI : 03</td>
        </tr>
    </table>
        </div>
    </div>
    <div class="bottom-area">
        <table class="assessment-table">
            <tr>
                <th>POINT ASSESMENT</th>
                <th>MIN</th>
                <th>ACTUAL</th>
                <th>JUDGE</th>
            </tr>
            <tr class="assessment-row">
                <td class="assessment-label">TEORI</td>
                <td class="assessment-min">85%</td>
                <td class="assessment-actual">
                    {{ $assessment->penilaian->total_nilai ?? '-' }}
                </td>
                <td class="assessment-judge">
                    {{ strtoupper(str_replace('_', ' ', $assessment->status ?? '-')) }}
                </td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>