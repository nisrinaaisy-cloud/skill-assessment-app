<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\AssessmentAnswer;
use App\Models\Operator;
use App\Models\Part;
use App\Models\Periode;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;

class OperatorAssessmentController extends Controller
{
    public function index()
    {
        $operators = Operator::with(['divisi','leader'])
        ->where('is_active',1)
        ->orderBy('nama_lengkap')
        ->get();

        return view('operator_assessment.index', compact('operators'));
    }

    public function pilihOperator(Request $request)
    {
        $request->validate([
            'operator_id' => 'required|exists:operators,id',
            'email'       => 'required|email|max:255',
        ]);

        $operator = Operator::findOrFail($request->operator_id);

        $operator->update([
            'email' => $request->email,
        ]);

        $failedAssessment = Assessment::where('operator_id', $operator->id)
            ->where('status', 'tidak_lulus')
            ->latest()
            ->first();

        if ($failedAssessment) {

            return redirect()
                ->route(
                    'operator.assessment.form',
                    $failedAssessment->id
                )
                ->with([
                    'remedial' => true,
                    'failedAssessment' => [
                        'part'       => optional($failedAssessment->part)->nama_part,
                        'subProcess' => optional($failedAssessment->subProcess)->nama_sub_proses,
                        'periode'    => optional($failedAssessment->periode)->label,
                        'url'        => route(
                            'operator.assessment.form',
                            $failedAssessment->id
                        ),
                    ]
                ]);

        }

        return redirect()->route(
            'operator.assessment.pilihPart',
            $operator->id
        );
    } // <<< WAJIB ADA KURUNG INI

    public function pilihPart(Operator $operator)
    {
        $parts = Part::where('is_active',1)
        ->whereHas('partDivisions',function($q) use($operator){
            $q->where('division_id',$operator->divisi_id);
        })
        ->with(['subProcesses','partDivisions.division'])
        ->orderBy('nama_part')
        ->get();

        $periodeAktif = $this->getTargetPeriodeForOperator($operator);

        $totalLulus = Assessment::where('operator_id', $operator->id)
            ->where('periode_id', $periodeAktif->id)
            ->where('status', 'lulus')
            ->distinct('part_id')
            ->count('part_id');

        $sisaPart = max(0, 3 - $totalLulus);
        if (!$periodeAktif) {
            return view('operator_assessment.status', [
                'title' => 'Periode Belum Tersedia',
                'message' => 'Belum ada data periode assessment yang dapat digunakan. Silakan hubungi Admin.',
                'type' => 'warning',
            ]);
        }

        $tanggalMasuk = $this->getTanggalMasukOperator($operator);
        $periodeBerjalan = Periode::where('bulan', now()->month)
            ->where('tahun', now()->year)
            ->first();

        $periodeInfo = null;

        if ($tanggalMasuk && $periodeAktif) {
            $periodeLabel = str_pad($periodeAktif->bulan, 2, '0', STR_PAD_LEFT) . '/' . $periodeAktif->tahun;

            if (!$periodeBerjalan || (int) $periodeAktif->id !== (int) $periodeBerjalan->id) {
                $periodeInfo = 'Anda diarahkan ke periode ' . $periodeLabel . ' karena masih ada periode sebelumnya yang belum diisi.';
            }
        }

        return view('operator_assessment.pilih-part', compact(
            'operator',
            'parts',
            'periodeAktif',
            'periodeInfo',
            'totalLulus',
            'sisaPart'
        ));
    }

    public function mulai(Request $request)
    {
       $request->validate([
            'operator_id'    => 'required|exists:operators,id',
            'periode_id'     => 'required|exists:periode,id',
            'part_id'        => 'required|exists:parts,id',
            'sub_process_id' => 'required|exists:sub_processes,id',
        ]);

       $operatorId    = $request->operator_id;
        $periodeId     = $request->periode_id;
        $partId        = $request->part_id;
        $subProcessId  = $request->sub_process_id;

        $draftAssessment = Assessment::where('operator_id', $operatorId)
            ->where('status', 'draft')
            ->latest('id')
            ->first();

        if ($draftAssessment) {

            return redirect()
                ->route('operator.assessment.form', $draftAssessment->id)
                ->with(
                    'warning',
                    'Anda masih memiliki Assessment yang belum diselesaikan.'
                );

        }

        $part = Part::findOrFail($partId);
        $operator = Operator::findOrFail($operatorId);
        $validDivision=$part->partDivisions()
            ->where('division_id',$operator->divisi_id)
            ->exists();

        if(!$validDivision){
            return back()->with(
                'error',
                'Part tidak sesuai dengan divisi operator.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | CEK STATUS ASSESSMENT TERAKHIR
        |--------------------------------------------------------------------------
        */

            $lastAssessment = Assessment::where('operator_id', $operatorId)
                ->where('part_id', $partId)
                ->latest('id')
                ->first();

            if ($lastAssessment) {

        switch ($lastAssessment->status) {

            case 'lulus':

                return back()->with(
                    'error',
                    'Part ini sudah dinyatakan LULUS.'
                );

            case 'submitted':

                return back()->with(
                    'warning',
                    'Assessment masih menunggu penilaian Leader.'
                );

            case 'dinilai':

                return back()->with(
                    'warning',
                    'Assessment sudah dinilai.'
                );

            case 'draft':

                return redirect()
                    ->route(
                        'operator.assessment.form',
                        $lastAssessment->id
                    );

        }

    }

                $totalLulusPeriode = Assessment::where('operator_id', $operatorId)
            ->where('periode_id', $periodeId)
            ->where('status', 'lulus')
            ->distinct('part_id')
            ->count('part_id');

        if ($totalLulusPeriode >= 3) {

            return back()->with(
                'warning',
                'Target assessment pada periode ini sudah terpenuhi (3 Part).'
            );

        }

        /*
        |--------------------------------------------------------------------------
        | ASSESSMENT BARU
        |--------------------------------------------------------------------------
        */
        $subProcess=\App\Models\SubProcess::findOrFail($subProcessId);
        $assessment = Assessment::create([
            'operator_id'      => $operatorId,
            'part_id'          => $partId,
            'sub_process_id'   => $subProcessId,
            'input_no_part'    => $part->no_part,
            'input_nama_part'  => $part->nama_part,
            'input_proses'     => $subProcess->nama_sub_proses,
            'is_master_valid'  => 1,
            'periode_id'       => $periodeId,
            'attempt_no'       => 1,
            'status'           => 'draft',
        ]);

        AssessmentAnswer::create([
            'assessment_id' => $assessment->id,
        ]);

        return redirect()
            ->route('operator.assessment.form', $assessment->id);
    }


    public function form(Assessment $assessment)
    {
        $assessment->load(
            'operator.divisi',
            'operator.shift',
            'part',
            'subProcess',
            'periode',
            'answer'
        );

        if (!in_array($assessment->status, ['draft', 'tidak_lulus'])) {

            return view('operator_assessment.status', [
                'title' => 'Assessment Tidak Bisa Diubah',
                'message' => 'Assessment sudah dikirim dan tidak dapat diubah kembali.',
                'type' => 'info',
                'assessment' => $assessment,
            ]);

        }

        if (!session()->has('recall_type')) {

            session([
                'recall_type' => rand(1, 3)
            ]);

        }

        return view(
            'operator_assessment.form',
            [
                'assessment' => $assessment,
                'recallType' => session('recall_type')
            ]
        );
    }

    public function submit(Request $request, Assessment $assessment)
{
    if (!in_array($assessment->status, ['draft', 'tidak_lulus'])) {

            return redirect()
                ->route('operator.assessment.form', $assessment->id)
                ->with(
                    'error',
                    'Assessment sudah dikirim.'
                );

        }

    $part = $assessment->part;
    $rules = [
        'flow_process' => 'required|string',
        'q_point' => 'required|string',
    ];

    if ($part->kategori === 'packing') {
        $rules['standard_packing'] = 'required|string';
    } else {
        $rules['nama_subpart'] = 'required|string';
    }
    $recallType = session('recall_type');

    /*
    |--------------------------------------------------------------------------
    | NORMALISASI
    |--------------------------------------------------------------------------
    */

    $namaPartInput = mb_strtolower(
        trim(
            preg_replace('/\s+/', ' ', $request->recall_nama_part)
        )
    );

    $namaPartMaster = mb_strtolower(
        trim(
            preg_replace('/\s+/', ' ', $part->nama_part)
        )
    );

    $noPartInput = strtoupper(str_replace(' ', '', trim($request->recall_no_part)));
    $noPartMaster = strtoupper(str_replace(' ', '', trim($part->no_part)));

    $subProcessInput = mb_strtolower(
        trim(
            preg_replace('/\s+/', ' ', $request->recall_proses)
        )
    );

    $subProcessMaster = mb_strtolower(
        trim(
            preg_replace(
                '/\s+/',
                ' ',
                optional($assessment->subProcess)->nama_sub_proses ?? ''
            )
        )
    );
    if ($recallType == 1) {

        if (
            $namaPartInput != $namaPartMaster ||
            $noPartInput != $noPartMaster
        ) {

            return back()
                ->withInput()
                ->withErrors([
                    'recall' => 'Recall Test tidak sesuai.'
                ]);

        }

    }
    elseif ($recallType == 2) {

        if (
            $namaPartInput != $namaPartMaster ||
            $subProcessInput != $subProcessMaster
        ) {

            return back()
                ->withInput()
                ->withErrors([
                    'recall' => 'Recall Test tidak sesuai.'
                ]);

        }

    }
    else {

        if (
            $noPartInput != $noPartMaster ||
            $subProcessInput != $subProcessMaster
        ) {

            return back()
                ->withInput()
                ->withErrors([
                    'recall' => 'Recall Test tidak sesuai.'
                ]);

        }

    }

        session()->forget('recall_type');
        $validated = $request->validate($rules);

        AssessmentAnswer::updateOrCreate(
            ['assessment_id' => $assessment->id],
            [
                'flow_process' => $validated['flow_process'],
                'nama_subpart' => $validated['nama_subpart'] ?? null,
                'q_point' => $validated['q_point'],
                'standard_packing' => $validated['standard_packing'] ?? null,
            ]
        );

        $assessment->fill([
            'status' => 'submitted',
        ]);

        $assessment->approved_foreman_by = null;
        $assessment->approved_foreman_at = null;

        $assessment->approved_kabag_by = null;
        $assessment->approved_kabag_at = null;

        $assessment->save();

        // Generate Verification Code (hanya sekali)
        if (empty($assessment->verification_code)) {

            $assessment->verification_code =
                'SA-' .
                now()->format('Ymd') .
                '-' .
                str_pad($assessment->id, 5, '0', STR_PAD_LEFT);

            $assessment->save();
        }

        $assessment->load(
            'operator.divisi',
            'operator.leader',
            'part',
            'subProcess',
            'periode'
        );

        $message = $assessment->operator->nama . ' baru mengisi assessment part ' .
            $assessment->part->nama_part . ' periode ' .
            $assessment->periode->label . '. Menunggu penilaian leader.';

       if ($assessment->operator->leader_id) {

            Notification::create([
                'title' => 'Assessment Baru Masuk',
                'message' => $message,
                'user_id' => $assessment->operator->leader_id,
                'assessment_id' => $assessment->id,
                'is_read' => 0,
            ]);

        }

        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
           Notification::create([
            'title' => 'Assessment Baru Masuk',
            'message' => $message,
            'user_id' => $admin->id,
            'assessment_id' => $assessment->id,
            'is_read' => 0,
        ]);
        }

        return view('operator_assessment.status', [
            'title' => 'Menunggu Penilaian Leader',
            'message' => 'Assessment sudah berhasil dikirim. Silakan menunggu hasil penilaian.',
            'type' => 'info',
            'assessment' => $assessment->fresh([
                'operator',
                'part',
                'subProcess',
                'periode'
            ]),
        ]);
    }

    private function getTargetPeriodeForOperator(Operator $operator): ?Periode
    {
        $tanggalMasuk = $this->getTanggalMasukOperator($operator);

        if (!$tanggalMasuk) {
            return null;
        }

        $periode = $tanggalMasuk->copy()->startOfMonth();
        $bulanSekarang = now()->copy()->startOfMonth();

        while ($periode->lessThanOrEqualTo($bulanSekarang)) {

            $periodeDb = Periode::firstOrCreate([
                'bulan' => $periode->month,
                'tahun' => $periode->year,
            ]);

            $jumlahLulus = Assessment::where('operator_id', $operator->id)
                ->where('periode_id', $periodeDb->id)
                ->where('status', 'lulus')
                ->distinct('part_id')
                ->count('part_id');

            if ($jumlahLulus < 3) {
                return $periodeDb;
            }

            $periode->addMonth();
        }

        return Periode::firstOrCreate([
            'bulan' => now()->month,
            'tahun' => now()->year,
        ]);
    }

    public function getSubProcess(Part $part)
    {
        return response()->json(
            $part->subProcesses()
                ->orderBy('nama_sub_proses')
                ->get([
                    'sub_processes.id',
                    'nama_sub_proses'
                ])
        );
    }
    private function getTanggalMasukOperator(Operator $operator): ?Carbon
{
    if (empty($operator->nik)) {
        return null;
    }

    if (!preg_match('/\.(\d{6})\./', trim($operator->nik), $matches)) {
        return null;
    }

    $tanggal = $matches[1];

    $yy = substr($tanggal, 0, 2);
    $mm = substr($tanggal, 2, 2);
    $dd = substr($tanggal, 4, 2);

    $year = 2000 + (int) $yy;

    try {
        return Carbon::create(
            $year,
            (int) $mm,
            (int) $dd
        );
    } catch (\Throwable $e) {
        return null;
    }
}

public function history(Operator $operator)
{
    $assessments = Assessment::with([
        'part',
        'subProcess',
        'periode',
        'penilaian',
        'approval',
    ])
    ->where('operator_id', $operator->id)
    ->latest('updated_at')
    ->latest('id')
    ->get();

    return view(
        'operator_assessment.history',
        compact(
            'operator',
            'assessments'
        )
    );
}
}

