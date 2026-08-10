<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Divisi;
use App\Models\Operator;
use App\Models\Periode;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\StreamedResponse;

class RekapitulasiController extends Controller
{
    private int $minimumPart = 3;

    public function index(Request $request)
    {
        $periodes = Periode::orderBy('tahun', 'desc')
            ->orderBy('bulan', 'desc')
            ->get();

        $divisis = Divisi::orderBy('nama_divisi', 'asc')->get();

        $leaders = User::where('role', 'leader')
            ->when($request->filled('divisi_id'), function ($q) use ($request) {
                $q->where('divisi_id', $request->divisi_id);
            })
            ->orderBy('name', 'asc')
            ->get();

        $operatorQuery = Operator::with(['divisi', 'leader'])
            ->where('is_active', 1);

        if ($request->filled('search')) {
            $search = $request->search;

            $operatorQuery->where(function ($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('nik', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('divisi_id')) {
            $operatorQuery->where('divisi_id', $request->divisi_id);
        }

        if ($request->filled('leader_id')) {
            $operatorQuery->where('leader_id', $request->leader_id);
        }

        $operators = $operatorQuery
            ->orderBy('nama_lengkap', 'asc')
            ->get();

        $operatorRows = $operators->map(function ($operator) use ($periodes, $request) {
            $joinDate = $this->parseJoinDateFromNik($operator->nik);
            $requiredPeriods = $this->getRequiredPeriodsForOperator($operator, $periodes);

            if ($request->filled('periode_id')) {
                $requiredPeriods = $requiredPeriods
                    ->where('id', (int) $request->periode_id)
                    ->values();
            }

            $periodIds = $requiredPeriods->pluck('id')->toArray();

            $assessments = Assessment::with(['part', 'periode', 'approval'])
                ->where('operator_id', $operator->id)
                ->when(!empty($periodIds), function ($q) use ($periodIds) {
                    $q->whereIn('periode_id', $periodIds);
                })
                ->get();

            $latestAssessment = $assessments
                ->filter(fn ($assessment) => $assessment->periode !== null)
                ->sortByDesc(function ($assessment) {
                    $year = (int) ($assessment->periode->tahun ?? 0);
                    $month = (int) ($assessment->periode->bulan ?? 0);
                    return ($year * 100) + $month;
                })
                ->first();

            $periodStatusRows = $requiredPeriods->map(function ($periode) use ($assessments) {
                $periodAssessments = $assessments->where('periode_id', $periode->id);
                $status = $this->determinePeriodStatus($periodAssessments);

                return [
                    'periode' => $periode,
                    'status_key' => $status['key'],
                    'status_label' => $status['label'],
                ];
            });

            $requiredCount = $requiredPeriods->count();

            $completedPeriodCount = $periodStatusRows
                ->where('status_key', 'lulus')
                ->count();

            $notFilledPeriodCount = $periodStatusRows
                ->where('status_key', 'belum_mengisi')
                ->count();

            $lessPartPeriodCount = $periodStatusRows
                ->where('status_key', 'belum_lengkap')
                ->count();

            $waitingScoringPeriodCount = $periodStatusRows
                ->where('status_key', 'submitted')
                ->count();

            $waitingApprovalPeriodCount = $periodStatusRows
                ->where('status_key', 'dinilai')
                ->count();

            $failedPeriodCount = $periodStatusRows
                ->where('status_key', 'tidak_lulus')
                ->count();

            $followUpPeriodCount =
                $lessPartPeriodCount +
                $waitingScoringPeriodCount +
                $waitingApprovalPeriodCount +
                $failedPeriodCount;

            $statusSummary = $this->determineOperatorSummaryStatus($requiredPeriods, $assessments);

            return [
                'operator' => $operator,
                'join_date' => $joinDate,
                'latest_assessment' => $latestAssessment,
                'latest_period' => $latestAssessment?->periode,
                'required_period_count' => $requiredCount,
                'completed_period_count' => $completedPeriodCount,
                'follow_up_period_count' => $followUpPeriodCount,
                'less_part_period_count' => $lessPartPeriodCount,
                'waiting_scoring_period_count' => $waitingScoringPeriodCount,
                'waiting_approval_period_count' => $waitingApprovalPeriodCount,
                'failed_period_count' => $failedPeriodCount,
                'not_filled_period_count' => $notFilledPeriodCount,
                'status_key' => $statusSummary['key'],
                'status_label' => $statusSummary['label'],
                'status_class' => $statusSummary['class'],
            ];
        });

        if ($request->filled('status')) {
            $operatorRows = $operatorRows
                ->filter(fn ($row) => $row['status_key'] === $request->status)
                ->values();
        }

        $operatorRows = $this->paginateCollection($operatorRows, 10, $request);

        return view('rekapitulasi.index', compact(
            'operatorRows',
            'periodes',
            'divisis',
            'leaders'
        ));
    }

    public function show(Operator $operator)
    {
        $operator->load(['divisi', 'leader']);

        $periodes = Periode::orderBy('tahun', 'asc')
            ->orderBy('bulan', 'asc')
            ->get();

        $requiredPeriods = $this->getRequiredPeriodsForOperator($operator, $periodes);

        $assessmentQuery = Assessment::with([
            'part',
            'periode',
            'approval'
        ])->where('operator_id', $operator->id);

        if ($requiredPeriods->isNotEmpty()) {
            $assessmentQuery->whereIn(
                'periode_id',
                $requiredPeriods->pluck('id')
            );
        }

        $assessments = $assessmentQuery->get();
        /*
        |--------------------------------------------------------------------------
        | GABUNGKAN PERIODE WAJIB DENGAN HISTORI ASSESSMENT
        |--------------------------------------------------------------------------
        */

        $historyPeriods = $assessments
            ->pluck('periode')
            ->filter();

        $requiredPeriods = $requiredPeriods
            ->merge($historyPeriods)
            ->unique('id')
            ->sortBy(function ($periode) {
                return ($periode->tahun * 100) + $periode->bulan;
            })
            ->values();
        $periodRows = $requiredPeriods->map(function ($periode) use ($assessments) {
            $periodAssessments = $assessments->where('periode_id', $periode->id);
            $partCount = $periodAssessments->pluck('part_id')->filter()->unique()->count();

            $status = $this->determinePeriodStatus($periodAssessments);

            $latestAssessment = $periodAssessments
                ->sortByDesc(function ($assessment) {
                    return optional($assessment->created_at)->timestamp ?? 0;
                })
                ->first();

            return [
                'periode' => $periode,
                'part_count' => $partCount,
                'minimum_part' => $this->minimumPart,
                'assessment_count' => $periodAssessments->count(),
                'latest_assessment' => $latestAssessment,
                'status_key' => $status['key'],
                'status_label' => $status['label'],
                'status_class' => $status['class'],
            ];
        });

        $joinDate = $this->parseJoinDateFromNik($operator->nik);

        return view('rekapitulasi.show', compact(
            'operator',
            'periodRows',
            'joinDate'
        ));
    }

    public function showPeriod(Operator $operator, Periode $periode)
    {
        $operator->load(['divisi', 'leader']);

        $assessments = Assessment::with([
            'part',
            'periode',
            'approval.foreman',
            'approval.kabag',
            'operator.divisi',
            'operator.leader',
            'penilaian'
        ])
        ->where('operator_id', $operator->id)
        ->where('periode_id', $periode->id)
        ->latest()
        ->get();

        $partCount = $assessments->pluck('part_id')->filter()->unique()->count();

        $periodStatus = $this->determinePeriodStatus($assessments);

        $partRows = $assessments->map(function ($assessment) {
            $approval = $this->getApprovalBreakdown($assessment);
            $displayStatus = $this->getAssessmentVisualStatus($assessment, $approval);

            if ($displayStatus['key'] === 'dinilai') {
                if ($this->normalizeApprovalStatus($approval['foreman'] ?? null) === '') {
                    $approval['foreman'] = 'pending';
                }

                if ($this->normalizeApprovalStatus($approval['kabag'] ?? null) === '') {
                    $approval['kabag'] = 'pending';
                }
            }

            return [
                'assessment' => $assessment,
                'score' => $this->getAssessmentScore($assessment),
                'approval' => $approval,
                'display_status_key' => $displayStatus['key'],
                'display_status_label' => $displayStatus['label'],
                'display_status_class' => $displayStatus['class'],
            ];
        });

        return view('rekapitulasi.period-detail', compact(
            'operator',
            'periode',
            'assessments',
            'partRows',
            'partCount',
            'periodStatus'
        ));
    }

    public function export(Request $request): StreamedResponse
    {
        $query = Assessment::with([
            'operator.divisi',
            'operator.leader',
            'part',
            'periode',
            'approval',
        ]);

        if ($request->filled('periode_id')) {
            $query->where('periode_id', $request->periode_id);
        }

        if ($request->filled('status') && in_array($request->status, ['submitted', 'dinilai', 'lulus', 'tidak_lulus'])) {
            $query->where('status', $request->status);
        }

        if ($request->filled('operator_id')) {
            $query->where('operator_id', $request->operator_id);
        }

        if ($request->filled('divisi_id')) {
            $query->whereHas('operator', function ($q) use ($request) {
                $q->where('divisi_id', $request->divisi_id);
            });
        }

        if ($request->filled('leader_id')) {
            $query->whereHas('operator', function ($q) use ($request) {
                $q->where('leader_id', $request->leader_id);
            });
        }

        $assessments = $query->latest()->get();

        $filename = 'rekapitulasi_skill_assessment_' . now()->format('Ymd_His') . '.csv';

        return response()->streamDownload(function () use ($assessments) {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, [
                'No',
                'Nama Operator',
                'NIK',
                'Divisi',
                'Leader',
                'Part',
                'Periode',
                'Attempt',
                'Nilai',
                'Status Assessment',
                'Tanggal Submit',
                'Approval Foreman',
                'Approval Kabag',
            ]);

            foreach ($assessments as $index => $assessment) {
                $approval = $this->getApprovalBreakdown($assessment);
                $displayStatus = $this->getAssessmentVisualStatus($assessment, $approval);

                fputcsv($handle, [
                    $index + 1,
                    $assessment->operator->nama ?? '-',
                    $assessment->operator->nik ?? '-',
                    $assessment->operator->divisi->nama_divisi ?? '-',
                    $assessment->operator->leader->name ?? '-',
                    $assessment->part->nama_part ?? '-',
                    ($assessment->periode->bulan ?? '-') . '/' . ($assessment->periode->tahun ?? '-'),
                    $assessment->attempt_no ?? '-',
                    $this->getAssessmentScore($assessment) ?? '-',
                    $displayStatus['label'],
                    optional($assessment->created_at)->format('d-m-Y H:i'),
                    $approval['foreman'],
                    $approval['kabag'],
                ]);
            }

            fclose($handle);
        }, $filename);
    }

    public function printForm(Assessment $assessment)
    {
        $assessment->load(['operator.divisi','operator.leader','part','periode','penilaian','approval.foreman','approval.kabag']);
        $verificationQrText="PT MADA WIKRI TUNGGAL

        SKILL ASSESSMENT

        Assessment ID : {$assessment->id}

        Nama : {$assessment->operator->nama_lengkap}
        NIK : {$assessment->operator->nik}
        Departemen : ".($assessment->operator->divisi->nama_divisi??'-')."
        Periode : ".($assessment->periode->bulan??'-')."/".($assessment->periode->tahun??'-')."

        Part : {$assessment->part->nama_part}
        Proses : {$assessment->part->kategori}
        Tanggal : ".optional($assessment->created_at)->format('d-m-Y')."

        Nilai : ".(optional($assessment->penilaian)->total_nilai??'-')."
        Status : ".strtoupper(str_replace('_',' ',$assessment->status))."

        Leader : ".(optional($assessment->operator->leader)->name??'-')."
        Leader Approved : ".(optional($assessment->penilaian)->updated_at?->format('d-m-Y H:i')??'-')."

        Foreman : ".(optional(optional($assessment->approval)->foreman)->name??'-')."
        Foreman Status : ".strtoupper(optional($assessment->approval)->status_foreman??'-')."
        Foreman Approved : ".(optional($assessment->approval)->foreman_approved_at?->format('d-m-Y H:i')??'-')."

        Kabag : ".(optional(optional($assessment->approval)->kabag)->name??'-')."
        Kabag Status : ".strtoupper(optional($assessment->approval)->status_kabag??'-')."
        Kabag Approved : ".(optional($assessment->approval)->kabag_approved_at?->format('d-m-Y H:i')??'-')." WIB";

        return view('rekapitulasi.print',compact('assessment','verificationQrText'));
    }
    private function parseJoinDateFromNik(?string $nik): ?Carbon
    {
        if (!$nik) {
            return null;
        }

        $parts = explode('.', $nik);

        if (count($parts) < 2) {
            return null;
        }

        $middle = preg_replace('/[^0-9]/', '', $parts[1] ?? '');

        if (strlen($middle) !== 6) {
            return null;
        }

        $yy = (int) substr($middle, 0, 2);
        $mm = substr($middle, 2, 2);
        $dd = substr($middle, 4, 2);

        $currentYY = (int) now()->format('y');
        $year = $yy <= ($currentYY + 1) ? 2000 + $yy : 1900 + $yy;

        try {
            return Carbon::createFromFormat('Y-m-d', $year . '-' . $mm . '-' . $dd)->startOfDay();
        } catch (\Throwable $e) {
            return null;
        }
    }

    private function getRequiredPeriodsForOperator(Operator $operator, Collection $periodes): Collection
    {
        $joinDate = $this->parseJoinDateFromNik($operator->nik);

        $startPeriod = $joinDate
            ? $joinDate->copy()->startOfMonth()
            : null;

        $currentPeriodLimit = now()->startOfMonth();

        return $periodes
            ->filter(function ($periode) use ($startPeriod, $currentPeriodLimit) {

                $periodDate = Carbon::create(
                    (int) $periode->tahun,
                    (int) $periode->bulan,
                    1
                )->startOfMonth();

                if ($periodDate->greaterThan($currentPeriodLimit)) {
                    return false;
                }

                if ($startPeriod && $periodDate->lessThan($startPeriod)) {
                    return false;
                }

                return true;
            })
            ->sortBy([
                ['tahun', 'asc'],
                ['bulan', 'asc'],
            ])
            ->values();
    }
    private function determineOperatorSummaryStatus(Collection $requiredPeriods, Collection $assessments): array
    {
        if ($requiredPeriods->count() === 0) {
            return [
                'key' => 'tidak_ada_periode',
                'label' => 'Tidak Ada Periode',
                'class' => 'status-inactive',
            ];
        }

        $periodStatuses = $requiredPeriods->map(function ($periode) use ($assessments) {
            return $this->determinePeriodStatus($assessments->where('periode_id', $periode->id))['key'];
        });

        if ($periodStatuses->contains('tidak_lulus')) {
            return [
                'key' => 'tidak_lulus',
                'label' => 'Ada Periode Tidak Lulus',
                'class' => 'status-danger',
            ];
        }

        if ($periodStatuses->contains('submitted')) {
            return [
                'key' => 'submitted',
                'label' => 'Ada yang Menunggu Penilaian',
                'class' => 'status-inactive',
            ];
        }

        if ($periodStatuses->contains('dinilai')) {
            return [
                'key' => 'dinilai',
                'label' => 'Ada yang Menunggu Approval',
                'class' => 'status-warning',
            ];
        }

        if ($periodStatuses->contains('belum_lengkap')) {
            return [
                'key' => 'belum_lengkap',
                'label' => 'Ada Periode Kurang Part',
                'class' => 'status-warning',
            ];
        }

        if ($periodStatuses->contains('belum_mengisi')) {
            return [
                'key' => 'belum_mengisi',
                'label' => 'Ada Periode Belum Mengisi',
                'class' => 'status-warning',
            ];
        }

        return [
            'key' => 'lengkap',
            'label' => 'Lengkap',
            'class' => 'status-active',
        ];
    }

    private function determinePeriodStatus(Collection $periodAssessments): array
    {
        if ($periodAssessments->count() === 0) {
            return [
                'key' => 'belum_mengisi',
                'label' => 'Belum Mengisi',
                'class' => 'status-empty',
            ];
        }

        $partCount = $periodAssessments->pluck('part_id')->filter()->unique()->count();

        if ($partCount < $this->minimumPart) {
            return [
                'key' => 'belum_lengkap',
                'label' => 'Kurang Part',
                'class' => 'status-progress',
            ];
        }

        $visualStatuses = $periodAssessments->map(function ($assessment) {
            return $this->getAssessmentVisualStatus($assessment)['key'];
        });

        if ($visualStatuses->contains('tidak_lulus')) {
            return [
                'key' => 'tidak_lulus',
                'label' => 'Tidak Lulus',
                'class' => 'status-danger',
            ];
        }

        if ($visualStatuses->contains('submitted')) {
            return [
                'key' => 'submitted',
                'label' => 'Menunggu Penilaian',
                'class' => 'status-review',
            ];
        }

        if ($visualStatuses->contains('dinilai')) {
            return [
                'key' => 'dinilai',
                'label' => 'Menunggu Approval',
                'class' => 'status-approval',
            ];
        }

        return [
            'key' => 'lulus',
            'label' => 'Selesai',
            'class' => 'status-complete',
        ];
    }

    private function getAssessmentVisualStatus(Assessment $assessment, ?array $approvalData = null): array
    {
        $approval = $approvalData ?? $this->getApprovalBreakdown($assessment);

        $statusForeman = $this->normalizeApprovalStatus($approval['status_foreman'] ?? null);
        $statusKabag = $this->normalizeApprovalStatus($approval['status_kabag'] ?? null);
        $assessmentStatus = strtolower(trim((string)($assessment->status ?? '')));

        $approvedValues = ['approved', 'approve', 'disetujui'];
        $rejectedValues = ['rejected', 'reject', 'ditolak'];
        $pendingValues = ['pending', 'menunggu'];

            if($assessmentStatus==='submitted'){
                return['key'=>'submitted','label'=>'Menunggu Penilaian Leader','class'=>'status-review',];}
            if($assessmentStatus==='dinilai'){
            if($statusForeman==='pending'){
                return['key'=>'dinilai','label'=>'Menunggu Approval Foreman','class'=>'status-approval',];}
            if($statusForeman==='approved'&&$statusKabag==='pending'){
                return['key'=>'dinilai','label'=>'Menunggu Approval Kabag','class'=>'status-approval',];}
                return['key'=>'dinilai','label'=>'Menunggu Approval','class'=>'status-approval',];}
            if($assessmentStatus==='lulus'){
                return['key'=>'lulus','label'=>'Lulus','class'=>'status-complete',];}
            if($assessmentStatus==='tidak_lulus'){
                return['key'=>'tidak_lulus','label'=>'Tidak Lulus','class'=>'status-danger',];}
            return['key'=>'submitted','label'=>'Menunggu Penilaian Leader','class'=>'status-review', ];
            if ($isRejected || $assessmentStatus === 'tidak_lulus') {
                return ['key' => 'tidak_lulus','label' => 'Tidak Lulus','class' => 'status-danger',];}
            if ($isApprovedAll || $assessmentStatus === 'lulus') {
                return ['key' => 'lulus','label' => 'Lulus','class' => 'status-complete',];}
            if($assessmentStatus==='submitted'){
                return['key'=>'submitted','label'=>'Menunggu Penilaian Leader','class'=>'status-review',];}
    $statusForeman=$this->normalizeApprovalStatus($approval['status_foreman']??null);
    $statusKabag=$this->normalizeApprovalStatus($approval['status_kabag']??null);

    if($assessmentStatus==='dinilai'){
        if($statusForeman===''){
            return[
                'key'=>'dinilai',
                'label'=>'Menunggu Approval Foreman',
                'class'=>'status-approval',
            ];
        }

        if($statusForeman==='approved'&&$statusKabag===''){
            return[
                'key'=>'dinilai',
                'label'=>'Menunggu Approval Kabag',
                'class'=>'status-approval',
            ];
        }

        return[
            'key'=>'dinilai',
            'label'=>'Menunggu Approval',
            'class'=>'status-approval',
        ];
    }

        return [
            'key' => 'submitted',
            'label' => 'Menunggu Penilaian',
            'class' => 'status-review',
        ];
    }

    private function normalizeApprovalStatus($value): string
    {
        $value = strtolower(trim((string) $value));

        if (in_array($value, ['-', 'null', ''])) {
            return '';
        }

        if (in_array($value, ['approved', 'approve', 'disetujui', 'setuju', 'acc'])) {
            return 'approved';
        }

        if (in_array($value, ['rejected', 'reject', 'ditolak', 'tolak'])) {
            return 'rejected';
        }

        if (in_array($value, ['pending', 'menunggu', 'waiting'])) {
            return 'pending';
        }

        return $value;
    }

    private function getAssessmentScore(Assessment $assessment): mixed
    {
        return optional($assessment->penilaian)->total_nilai;
    }

    private function getApprovalBreakdown(Assessment $assessment): array
    {
        $approval = $assessment->approval;

        return [
            'foreman' => optional(optional($approval)->foreman)->name ?? '-',
            'kabag'   => optional(optional($approval)->kabag)->name ?? '-',

            'status_foreman' => optional($approval)->status_foreman,
            'status_kabag'   => optional($approval)->status_kabag,
        ];
    }
    private function normalizeApprovalRole($value): string
    {
        $value = strtolower(trim((string) $value));

        if (str_contains($value, 'foreman')) {
            return 'foreman';
        }

        if (str_contains($value, 'kabag') || str_contains($value, 'kepala')) {
            return 'kabag';
        }

        return $value;
    }

    private function readAttribute($model, array $columns): mixed
    {
        foreach ($columns as $column) {
            if (is_object($model) && method_exists($model, 'getAttribute')) {
                $value = $model->getAttribute($column);
            } else {
                $value = data_get($model, $column);
            }

            if ($value !== null && $value !== '') {
                return $value;
            }
        }

        return null;
    }

    private function paginateCollection(Collection $items, int $perPage, Request $request): LengthAwarePaginator
    {
        $page = LengthAwarePaginator::resolveCurrentPage();
        $total = $items->count();

        $results = $items
            ->slice(($page - 1) * $perPage, $perPage)
            ->values();

        return new LengthAwarePaginator(
            $results,
            $total,
            $perPage,
            $page,
            [
                'path' => $request->url(),
                'query' => $request->query(),
            ]
        );
    }
}
