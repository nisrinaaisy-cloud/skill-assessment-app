<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Divisi;
use App\Models\Operator;
use App\Models\PartDivision;
use App\Models\Periode;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    private array $assessmentStatuses = ['submitted', 'dinilai', 'lulus', 'tidak_lulus'];
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

        $selectedTargetPeriode = $this->getSelectedTargetPeriode($request, $periodes);

        $totalOperator = Operator::where('is_active', 1)->count();

        $totalOperatorBelumMapping = Operator::where('is_active', 1)
            ->whereNull('leader_id')
            ->count();

        $totalAssessment = Assessment::whereIn('status', $this->assessmentStatuses)
            ->whereYear('created_at', now()->year)
            ->count();

        $assessmentSelesai = Assessment::whereIn('status', ['lulus', 'tidak_lulus'])->count();
        $totalLulus = Assessment::where('status', 'lulus')->count();
        $totalTidakLulus = Assessment::where('status', 'tidak_lulus')->count();

        $passRate = $assessmentSelesai > 0
            ? round(($totalLulus / $assessmentSelesai) * 100, 1)
            : 0;

        $totalBelumMengisi = $this->countOperatorsWithoutAssessment($selectedTargetPeriode);
        $totalMenungguPenilaian = Assessment::where('status', 'submitted')->count();
        $userRole = auth()->user()->role ?? null;

        $totalMenungguApproval = match ($userRole) {

            'foreman' => \App\Models\Approval::where('status_foreman', 'pending')
                ->count(),

            'kabag' => \App\Models\Approval::where('status_foreman', 'approved')
                ->where('status_kabag', 'pending')
                ->count(),

            default => \App\Models\Approval::where(function ($q) {
                    $q->where('status_foreman', 'pending')
                    ->orWhere('status_kabag', 'pending');
                })
                ->count(),
        };

        $topOperators = $this->getTopOperators();
        $topCategories = $this->getTopCategories();

        $selectedPartRankType = $request->get('part_rank_type', 'top');

        if (!in_array($selectedPartRankType, ['top', 'low'], true)) {
            $selectedPartRankType = 'top';
        }

        $selectedPartRankDivisiId = $request->filled('part_rank_divisi_id')
            ? (int) $request->part_rank_divisi_id
            : null;

        $partRankingRows = $this->getPartRankingRows($selectedPartRankType, $selectedPartRankDivisiId);
        $maxPartRankingTotal = max(collect($partRankingRows)->max('total') ?? 0, 1);

        $targetCategoryRows = $this->getTargetCategoryRows($selectedTargetPeriode, $totalOperator);
        $monthlyRows = $this->getMonthlyRows(now()->year, $totalOperator);
        $completionRows = $this->getCompletionRows($selectedTargetPeriode, $totalOperator);

        $latestQuery = Assessment::with([
            'operator.divisi',
            'operator.leader',
            'part',
            'periode',
        ]);

        if ($request->filled('periode_id')) {
            $latestQuery->where('periode_id', $request->periode_id);
        }

        if ($request->filled('divisi_id')) {
            $latestQuery->whereHas('operator', function ($q) use ($request) {
                $q->where('divisi_id', $request->divisi_id);
            });
        }

        if ($request->filled('leader_id')) {
            $latestQuery->whereHas('operator', function ($q) use ($request) {
                $q->where('leader_id', $request->leader_id);
            });
        }

        if ($request->filled('status')) {
            $latestQuery->where('status', $request->status);
        }

        $latestAssessments = $latestQuery
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('dashboard.index', compact(
            'periodes',
            'divisis',
            'leaders',
            'selectedTargetPeriode',
            'totalOperator',
            'totalOperatorBelumMapping',
            'totalAssessment',
            'assessmentSelesai',
            'totalLulus',
            'totalTidakLulus',
            'passRate',
            'totalBelumMengisi',
            'totalMenungguPenilaian',
            'totalMenungguApproval',
            'topOperators',
            'topCategories',
            'selectedPartRankType',
            'selectedPartRankDivisiId',
            'partRankingRows',
            'maxPartRankingTotal',
            'targetCategoryRows',
            'monthlyRows',
            'completionRows',
            'latestAssessments'
        ));
    }

    private function getSelectedTargetPeriode(Request $request, $periodes): ?Periode
    {
        if ($request->filled('target_periode_id')) {
            return $periodes->firstWhere('id', (int) $request->target_periode_id);
        }

        $currentPeriode = $periodes->first(function ($periode) {
            return (int) $periode->bulan === (int) now()->month
                && (int) $periode->tahun === (int) now()->year;
        });

        return $currentPeriode ?? $periodes->first();
    }

    private function countOperatorsWithoutAssessment(?Periode $periode): int
    {
        if (!$periode) {
            return 0;
        }

        return Operator::where('is_active', 1)
            ->whereDoesntHave('assessments', function ($q) use ($periode) {
                $q->where('periode_id', $periode->id)
                    ->whereIn('status', $this->assessmentStatuses);
            })
            ->count();
    }

    private function getTopOperators()
    {
        return Assessment::select('operator_id', DB::raw('COUNT(*) as total_assessment'))
            ->whereIn('status', $this->assessmentStatuses)
            ->whereYear('created_at', now()->year)
            ->whereNotNull('operator_id')
            ->groupBy('operator_id')
            ->orderByDesc('total_assessment')
            ->limit(5)
            ->with('operator')
            ->get();
    }

    private function getTopCategories(): array
    {
        $rows=PartDivision::query()
            ->join('divisi','part_divisions.division_id','=','divisi.id')
            ->join('parts','part_divisions.part_id','=','parts.id')
            ->leftJoin('assessments','parts.id','=','assessments.part_id')
            ->select(
                'divisi.id',
                'divisi.nama_divisi',
                DB::raw('COUNT(assessments.id) as total_assessment')
            )
            ->groupBy(
                'divisi.id',
                'divisi.nama_divisi'
            )
            ->orderByDesc('total_assessment')
            ->get();

        return $rows->map(function($row){
            return[
                'key'=>$row->id,
                'name'=>$row->nama_divisi,
                'total'=>(int)$row->total_assessment,
            ];
        })->toArray();
    }
       private function getPartRankingRows($type='top',$divisionId=null)
        {
            $query=Assessment::join('parts','assessments.part_id','=','parts.id')
                ->leftJoin('part_processes','parts.id','=','part_processes.part_id')
                ->leftJoin('sub_processes','part_processes.sub_process_id','=','sub_processes.id')
                ->when($divisionId,function($q)use($divisionId){
                    $q->join('part_divisions','parts.id','=','part_divisions.part_id')
                    ->where('part_divisions.division_id',$divisionId);
                })
                ->selectRaw("
                    parts.id,
                    parts.no_part,
                    parts.nama_part,
                    GROUP_CONCAT(DISTINCT sub_processes.nama_sub_proses ORDER BY part_processes.urutan SEPARATOR ', ') as proses,
                    COUNT(DISTINCT assessments.operator_id) as total
                ")
                ->groupBy('parts.id','parts.no_part','parts.nama_part');

            if($type=='low'){
                $query->orderBy('total');
            }else{
                $query->orderByDesc('total');
            }

            return $query->limit(5)
                ->get()
                ->map(fn($row)=>[
                    'nama_part'=>$row->nama_part,
                    'no_part'=>$row->no_part,
                    'proses'=>$row->proses ?: '-',
                    'kategori'=>'-',
                    'total'=>(int)$row->total,
                ])->toArray();
        }
    private function getTargetCategoryRows(?Periode $periode,int $totalOperator): array
    {
        $periodTarget=max($totalOperator,1);
        $divisions=Divisi::orderBy('nama_divisi')->get();
        return $divisions->map(function($division) use($periode,$periodTarget){
            $actual=0;
            if($periode){
                $actual=Assessment::query()
                ->join('parts','assessments.part_id','=','parts.id')
                ->join('part_divisions','parts.id','=','part_divisions.part_id')
                ->where('assessments.periode_id',$periode->id)
                ->where('part_divisions.division_id',$division->id)
                ->whereIn('assessments.status',['lulus','tidak_lulus'])
                ->select('assessments.operator_id')
                ->distinct()
                ->count();
            }
            $percentage = $periodTarget > 0
    ? round(($actual / $periodTarget) * 100, 1)
    : 0;

    $status = match (true) {
        $percentage >= 100 => [
            'class' => 'target-success',
            'label' => 'Target Tercapai',
        ],

        $percentage >= 80 => [
            'class' => 'target-info',
            'label' => 'Hampir Tercapai',
        ],

        $percentage >= 50 => [
            'class' => 'target-warning',
            'label' => 'Perlu Peningkatan',
        ],

        default => [
            'class' => 'target-danger',
            'label' => 'Belum Tercapai',
        ],
    };

    return [
        'key'     => $division->id,
        'name'    => $division->nama_divisi,
        'target'  => $periodTarget,
        'actual'  => $actual,
        'percent' => $percentage,
        'status'  => $status,
    ];
        })->toArray();
    }
    private function getMonthlyRows(int $year, int $totalOperator): array
    {
        $target = max($totalOperator * $this->minimumPart, 1);

        return collect(range(1, 12))->map(function ($month) use ($year, $target) {
            $actual = Assessment::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->whereIn('status', $this->assessmentStatuses)
                ->count();

            $percent = $target > 0
                ? round(($actual / $target) * 100)
                : 0;

            return [
                'month_number' => $month,
                'month' => Carbon::create($year, $month, 1)->translatedFormat('M'),
                'actual' => $actual,
                'target' => $target,
                'percent' => $percent,
            ];
        })->toArray();
    }

    private function getCompletionRows(?Periode $periode, int $totalOperator): array
    {
        $divisions = Divisi::orderBy('nama_divisi')->get();
        return $divisions->map(function ($division) use ($periode, $totalOperator) {
            $completedOperators = 0;
            if ($periode) {
                $completedOperators = Assessment::query()
                    ->join('parts', 'assessments.part_id', '=', 'parts.id')
                    ->join('part_divisions', 'parts.id', '=', 'part_divisions.part_id')
                    ->where('assessments.periode_id', $periode->id)
                    ->where('part_divisions.division_id', $division->id)
                    ->whereIn('assessments.status', $this->assessmentStatuses)
                    ->select(
                        'assessments.operator_id',
                        DB::raw('COUNT(DISTINCT assessments.part_id) as total_part')
                    )
                    ->groupBy('assessments.operator_id')
                    ->having('total_part', '>=', $this->minimumPart)
                    ->get()
                    ->count();
            }
            $percent = $totalOperator > 0
                ? round(($completedOperators / $totalOperator) * 100, 1)
                : 0;
            return [
                'key'       => $division->id,
                'name'      => $division->nama_divisi,
                'completed' => $completedOperators,
                'target'    => $totalOperator,
                'percent'   => $percent,
            ];
        })->values()->toArray();
    }
    private function targetStatus(int|float $percent): array
    {
        if ($percent >= 100) {
            return [
                'label' => 'Tercapai',
                'class' => 'target-success',
            ];
        }

        if ($percent >= 70) {
            return [
                'label' => 'Hampir',
                'class' => 'target-info',
            ];
        }

        if ($percent >= 40) {
            return [
                'label' => 'Progres',
                'class' => 'target-warning',
            ];
        }

        return [
            'label' => 'Kurang',
            'class' => 'target-danger',
        ];
    }
}