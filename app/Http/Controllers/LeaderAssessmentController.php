<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Approval;
use App\Models\Notification;
use App\Models\Penilaian;
use App\Models\User;
use App\Models\Divisi;
use Illuminate\Http\Request;

class LeaderAssessmentController extends Controller
{
    public function index(Request $request)
    {
        $assessments = Assessment::with(['operator.divisi', 'part', 'periode', 'answer'])
            ->whereHas('operator', function ($q) {
                $q->where('leader_id', auth()->id());
            })
            ->when($request->filled('status'), function ($q) use ($request) {
                $q->where('status', $request->status);
            }, function ($q) {
                $q->where('status', 'submitted');
            })
            ->when($request->filled('search'), function ($q) use ($request) {
                $search = trim($request->search);
                $q->where(function ($query) use ($search) {
                    $query->whereHas('operator', function ($operatorQuery) use ($search) {
                        $operatorQuery->where('nama_lengkap', 'like', '%' . $search . '%')
                            ->orWhere('nik', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('part', function ($partQuery) use ($search) {
                        $partQuery->where('nama_part', 'like', '%' . $search . '%')
                            ->orWhere('no_part', 'like', '%' . $search . '%');
                    });
                });
            })
            ->when($request->filled('kategori'), function ($q) use ($request) {
                $q->whereHas('part', function ($partQuery) use ($request) {
                    $partQuery->where('kategori', $request->kategori);
                });
            })
            ->when($request->filled('periode_id'), function ($q) use ($request) {
                $q->where('periode_id', $request->periode_id);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('leader_assessments.index', compact('assessments'));
    }
    public function show(Assessment $assessment)
    {
        $assessment->load([
            'operator.divisi',
            'part',
            'subProcess',
            'periode',
            'answer',
            'penilaian'
        ]);
        if ($assessment->operator->leader_id != auth()->id()) {
            abort(403);
        }
        if ($assessment->status !== 'submitted') {
            return redirect()->route('leader.assessments.index');
        }
        return view('leader_assessments.show', compact('assessment'));
    }
    public function store(Request $request, Assessment $assessment)
    {
        $assessment->loadMissing(['operator', 'part']);

        if ($assessment->operator->leader_id != auth()->id()) {
            abort(403);
        }

        if ($assessment->status !== 'submitted') {
            return back()->with('error', 'Assessment ini sudah dinilai.');
        }

        $kategori = strtolower($assessment->part->kategori ?? '');

        /*
        |--------------------------------------------------------------------------
        | VALIDASI NILAI AKTUAL
        |--------------------------------------------------------------------------
        | Stamping / Machining / Welding:
        | - Flow Proses      : maksimal 30
        | - Nama Subpart     : maksimal 30
        | - Q-Point          : maksimal 40
        | - Minimal Lulus    : 85
        |
        | Packing:
        | - Q-Point          : maksimal 50
        | - Standar Packing  : maksimal 30
        | - Flow Proses      : maksimal 20
        | - Minimal Lulus    : 80
        */

        if ($kategori === 'packing') {
            $rules = [
                'nilai_qpoint' => 'required|integer|min:0|max:50',
                'nilai_packing' => 'required|integer|min:0|max:30',
                'nilai_flow' => 'required|integer|min:0|max:20',
                'catatan_penilai' => 'nullable|string',
            ];

            $messages = [
                'nilai_qpoint.required' => 'Nilai Q-Point wajib diisi.',
                'nilai_qpoint.integer' => 'Nilai Q-Point harus berupa angka.',
                'nilai_qpoint.min' => 'Nilai Q-Point minimal 0.',
                'nilai_qpoint.max' => 'Maksimal nilai Q-Point untuk Packing adalah 50.',

                'nilai_packing.required' => 'Nilai Standar Packing wajib diisi.',
                'nilai_packing.integer' => 'Nilai Standar Packing harus berupa angka.',
                'nilai_packing.min' => 'Nilai Standar Packing minimal 0.',
                'nilai_packing.max' => 'Maksimal nilai Standar Packing adalah 30.',

                'nilai_flow.required' => 'Nilai Flow Proses wajib diisi.',
                'nilai_flow.integer' => 'Nilai Flow Proses harus berupa angka.',
                'nilai_flow.min' => 'Nilai Flow Proses minimal 0.',
                'nilai_flow.max' => 'Maksimal nilai Flow Proses untuk Packing adalah 20.',
            ];

            $validated = $request->validate($rules, $messages);

            $totalNilai =
                $validated['nilai_qpoint'] +
                $validated['nilai_packing'] +
                $validated['nilai_flow'];

            $minimalLulus = 80;
        } else {
            $rules = [
                'nilai_flow' => 'required|integer|min:0|max:30',
                'nilai_subpart' => 'required|integer|min:0|max:30',
                'nilai_qpoint' => 'required|integer|min:0|max:40',
                'catatan_penilai' => 'nullable|string',
            ];

            $messages = [
                'nilai_flow.required' => 'Nilai Flow Proses wajib diisi.',
                'nilai_flow.integer' => 'Nilai Flow Proses harus berupa angka.',
                'nilai_flow.min' => 'Nilai Flow Proses minimal 0.',
                'nilai_flow.max' => 'Maksimal nilai Flow Proses adalah 30.',

                'nilai_subpart.required' => 'Nilai Nama Subpart wajib diisi.',
                'nilai_subpart.integer' => 'Nilai Nama Subpart harus berupa angka.',
                'nilai_subpart.min' => 'Nilai Nama Subpart minimal 0.',
                'nilai_subpart.max' => 'Maksimal nilai Nama Subpart adalah 30.',

                'nilai_qpoint.required' => 'Nilai Q-Point wajib diisi.',
                'nilai_qpoint.integer' => 'Nilai Q-Point harus berupa angka.',
                'nilai_qpoint.min' => 'Nilai Q-Point minimal 0.',
                'nilai_qpoint.max' => 'Maksimal nilai Q-Point adalah 40.',
            ];

            $validated = $request->validate($rules, $messages);

            $totalNilai =
                $validated['nilai_flow'] +
                $validated['nilai_subpart'] +
                $validated['nilai_qpoint'];

            $minimalLulus = 85;
        }

$statusLulus = $totalNilai >= $minimalLulus;

Penilaian::updateOrCreate(
    ['assessment_id' => $assessment->id],
    [
        'nilai_flow'      => $validated['nilai_flow'],
        'nilai_subpart'   => $validated['nilai_subpart'] ?? 0,
        'nilai_qpoint'    => $validated['nilai_qpoint'],
        'nilai_packing'   => $validated['nilai_packing'] ?? 0,
        'total_nilai'     => $totalNilai,
        'status_lulus'    => $statusLulus,
        'catatan_penilai' => $validated['catatan_penilai'] ?? null,
        'dinilai_oleh'    => auth()->id(),
    ]
);

if ($statusLulus) {

    $assessment->update([
        'status' => 'dinilai',
    ]);

    Approval::where('assessment_id', $assessment->id)->delete();

    $foreman = User::where('role', 'foreman')
        ->whereHas('divisis', function ($q) use ($assessment) {
            $q->where('divisi.id', $assessment->operator->divisi_id);
        })
        ->first();

    $kabag = User::where('role', 'kabag')->first();

    Approval::updateOrCreate(

        [
            'assessment_id' => $assessment->id
        ],

        [
            'foreman_id'     => optional($foreman)->id,
            'kabag_id'       => optional($kabag)->id,
            'status_foreman' => 'pending',
            'status_kabag'   => 'pending',
            'status'         => 'pending',
        ]

    );

    if ($foreman) {
        Notification::create([
            'title' => 'Assessment Menunggu Approval',
            'message' => $assessment->operator->nama_lengkap .
                ' dinyatakan LULUS oleh Leader dan menunggu approval Foreman.',
            'user_id' => $foreman->id,
            'assessment_id' => $assessment->id,
            'is_read' => 0,
        ]);
    }

    return redirect()
        ->route('leader.assessments.index')
        ->with('success', 'Assessment berhasil dinilai.');
}

$assessment->update([
    'status' => 'tidak_lulus',
]);

// Hapus approval lama jika ada
Approval::where('assessment_id', $assessment->id)->delete();

return redirect()
    ->route('leader.assessments.index')
    ->with('success', 'Assessment tidak lulus.');
    }
}