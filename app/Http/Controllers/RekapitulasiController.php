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
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Chart\Chart;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\Title;

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

    public function export(Request $request)
    {
        $query = Assessment::with([
            'operator.divisi',
            'operator.leader',
            'part',
            'periode',
            'approval',
            'penilaian',
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

        if ($request->filled('search')) {
            $search = $request->search;

            $query->whereHas('operator', function ($q) use ($search) {
                $q->where(function ($q) use ($search) {
                    $q->where('nama_lengkap', 'like', '%' . $search . '%')
                        ->orWhere('nik', 'like', '%' . $search . '%');
                });
            });
        }

        $assessments = $query
            ->latest()
            ->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('REKAP ASSESSMENT');

        $navy = '172554';
        $blue = '4F46E5';
        $green = '16A34A';
        $red = 'DC2626';
        $orange = 'F59E0B';
        $lightBlue = 'EEF2FF';
        $lightGreen = 'DCFCE7';
        $lightRed = 'FEE2E2';
        $lightOrange = 'FEF3C7';
        $gray = '64748B';
        $dark = '0F172A';
        $white = 'FFFFFF';
        $border = 'D9E2F2';

        $sheet->mergeCells('A1:M1');
        $sheet->setCellValue('A1', 'REKAPITULASI SKILL ASSESSMENT');
        $sheet->getStyle('A1')->getFont()->setSize(20)->setBold(true)->getColor()->setRGB($navy);
        $sheet->getStyle('A1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getRowDimension(1)->setRowHeight(30);

        $sheet->mergeCells('A2:M2');
        $sheet->setCellValue('A2', 'Ringkasan hasil assessment untuk kebutuhan monitoring dan audit.');
        $sheet->getStyle('A2')->getFont()->setSize(10)->getColor()->setRGB($gray);

        $periodeLabel = 'Semua Periode';
        if ($request->filled('periode_id')) {
            $periode = Periode::find($request->periode_id);

            if ($periode) {
                $periodeLabel = str_pad($periode->bulan, 2, '0', STR_PAD_LEFT) . '/' . $periode->tahun;
            }
        }

        $divisiLabel = 'Semua Divisi';
        if ($request->filled('divisi_id')) {
            $divisiLabel = optional(Divisi::find($request->divisi_id))->nama_divisi ?? 'Semua Divisi';
        }

        $leaderLabel = 'Semua Leader';
        if ($request->filled('leader_id')) {
            $leaderLabel = optional(User::find($request->leader_id))->name ?? 'Semua Leader';
        }

        $statusLabels = [
            'submitted' => 'Menunggu Penilaian',
            'dinilai' => 'Menunggu Approval',
            'lulus' => 'Lulus',
            'tidak_lulus' => 'Tidak Lulus',
        ];

        $statusLabel = $statusLabels[$request->status] ?? 'Semua Status';

        $filterData = [
            ['A4', 'A5', 'PERIODE', $periodeLabel],
            ['C4', 'C5', 'DIVISI', $divisiLabel],
            ['E4', 'E5', 'LEADER', $leaderLabel],
            ['G4', 'G5', 'STATUS', $statusLabel],
            ['I4', 'I5', 'PART', 'Semua Part'],
        ];

        foreach ($filterData as [$labelCell, $valueCell, $label, $value]) {
            $labelColumn = preg_replace('/\d+/', '', $labelCell);
            $valueColumn = preg_replace('/\d+/', '', $valueCell);

            $labelColNumber = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($labelColumn);
            $valueColNumber = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($valueColumn);

            $labelEnd = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($labelColNumber + 1);
            $valueEnd = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($valueColNumber + 1);

            $sheet->mergeCells("{$labelColumn}4:{$labelEnd}4");
            $sheet->mergeCells("{$valueColumn}5:{$valueEnd}6");

            $sheet->setCellValue($labelCell, $label);
            $sheet->setCellValue($valueCell, $value);

            $sheet->getStyle("{$labelColumn}4:{$labelEnd}4")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB($lightBlue);
            $sheet->getStyle("{$valueColumn}5:{$valueEnd}6")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('F8FAFF');

            $sheet->getStyle($labelCell)->getFont()->setSize(9)->setBold(true)->getColor()->setRGB($navy);
            $sheet->getStyle($valueCell)->getFont()->setSize(10)->getColor()->setRGB($dark);

            $sheet->getStyle("{$labelColumn}4:{$labelEnd}6")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN)->getColor()->setRGB($border);
        }

        $totalAssessment = $assessments->count();

        $lulusCount = $assessments
            ->filter(fn ($assessment) => $this->getAssessmentVisualStatus($assessment)['key'] === 'lulus')
            ->count();

        $tidakLulusCount = $assessments
            ->filter(fn ($assessment) => $this->getAssessmentVisualStatus($assessment)['key'] === 'tidak_lulus')
            ->count();

        $menungguCount = $assessments
            ->filter(fn ($assessment) => $this->getAssessmentVisualStatus($assessment)['key'] === 'submitted')
            ->count();

        $passRate = ($lulusCount + $tidakLulusCount) > 0
            ? $lulusCount / ($lulusCount + $tidakLulusCount)
            : 0;

        $kpis = [
            ['A8', 'A9', 'A11', 'TOTAL ASSESSMENT', $totalAssessment, 'Total data', $blue, $lightBlue],
            ['D8', 'D9', 'D11', 'LULUS', $lulusCount, $totalAssessment > 0 ? number_format(($lulusCount / $totalAssessment) * 100, 1) . '% dari total' : '0%', $green, $lightGreen],
            ['G8', 'G9', 'G11', 'TIDAK LULUS', $tidakLulusCount, $totalAssessment > 0 ? number_format(($tidakLulusCount / $totalAssessment) * 100, 1) . '% dari total' : '0%', $red, $lightRed],
            ['J8', 'J9', 'J11', 'MENUNGGU PENILAIAN', $menungguCount, $totalAssessment > 0 ? number_format(($menungguCount / $totalAssessment) * 100, 1) . '% dari total' : '0%', $orange, $lightOrange],
        ];

        foreach ($kpis as [$titleCell, $valueCell, $subCell, $title, $value, $sub, $color, $background]) {
            $startColumn = preg_replace('/\d+/', '', $titleCell);
            $startIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($startColumn);
            $endColumn = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($startIndex + 2);

            $sheet->mergeCells("{$startColumn}8:{$endColumn}8");
            $sheet->mergeCells("{$startColumn}9:{$endColumn}10");
            $sheet->mergeCells("{$startColumn}11:{$endColumn}11");

            $sheet->setCellValue($titleCell, $title);
            $sheet->setCellValue($valueCell, $value);
            $sheet->setCellValue($subCell, $sub);

            $sheet->getStyle("{$startColumn}8:{$endColumn}11")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB($background);
            $sheet->getStyle("{$startColumn}8:{$endColumn}11")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN)->getColor()->setRGB($border);

            $sheet->getStyle($titleCell)->getFont()->setSize(9)->setBold(true)->getColor()->setRGB($navy);
            $sheet->getStyle($valueCell)->getFont()->setSize(19)->setBold(true)->getColor()->setRGB($color);
            $sheet->getStyle($subCell)->getFont()->setSize(8)->getColor()->setRGB($gray);
        }

        $sheet->mergeCells('M8:M8');
        $sheet->mergeCells('M9:M10');
        $sheet->mergeCells('M11:M11');

        $sheet->setCellValue('M8', 'PASS RATE');
        $sheet->setCellValue('M9', $passRate);
        $sheet->setCellValue('M11', 'Lulus / (Lulus + Tidak Lulus)');

        $sheet->getStyle('M8:M11')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB($lightBlue);
        $sheet->getStyle('M8:M11')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN)->getColor()->setRGB($border);
        $sheet->getStyle('M8')->getFont()->setSize(9)->setBold(true)->getColor()->setRGB($navy);
        $sheet->getStyle('M9')->getFont()->setSize(19)->setBold(true)->getColor()->setRGB($blue);
        $sheet->getStyle('M9')->getNumberFormat()->setFormatCode('0.0%');
        $sheet->getStyle('M11')->getFont()->setSize(8)->getColor()->setRGB($gray);

        $monthlyData = $assessments
            ->filter(fn ($assessment) => $assessment->created_at !== null)
            ->groupBy(fn ($assessment) => optional($assessment->created_at)->format('Y-m'));

        $chartStartRow = 13;

        $sheet->setCellValue('O1', 'Bulan');
        $sheet->setCellValue('P1', 'Lulus');
        $sheet->setCellValue('Q1', 'Tidak Lulus');
        $sheet->setCellValue('R1', 'Menunggu');

        $row = 2;

        foreach ($monthlyData->sortKeys() as $month => $monthAssessments) {
            $sheet->setCellValue("O{$row}", Carbon::createFromFormat('Y-m', $month)->format('M Y'));

            $sheet->setCellValue("P{$row}", $monthAssessments
                ->filter(fn ($assessment) => $this->getAssessmentVisualStatus($assessment)['key'] === 'lulus')
                ->count());

            $sheet->setCellValue("Q{$row}", $monthAssessments
                ->filter(fn ($assessment) => $this->getAssessmentVisualStatus($assessment)['key'] === 'tidak_lulus')
                ->count());

            $sheet->setCellValue("R{$row}", $monthAssessments
                ->filter(fn ($assessment) => $this->getAssessmentVisualStatus($assessment)['key'] === 'submitted')
                ->count());

            $row++;
        }

        if ($row === 2) {
            $sheet->setCellValue('O2', 'Tidak ada data');
            $sheet->setCellValue('P2', 0);
            $sheet->setCellValue('Q2', 0);
            $sheet->setCellValue('R2', 0);
        }

        $monthlyEndRow = max(2, $row - 1);

$lineChart = new Chart(
    'trend_assessment',
    new Title('Trend Assessment'),
    new Legend(Legend::POSITION_BOTTOM, null, false),
    new PlotArea(null, [
        new DataSeries(
            DataSeries::TYPE_LINECHART,
            DataSeries::GROUPING_STANDARD,
            range(0, 2),
            [
                new DataSeriesValues(
                    'String',
                    "'REKAP ASSESSMENT'!\$P\$1",
                    null,
                    1
                ),
                new DataSeriesValues(
                    'String',
                    "'REKAP ASSESSMENT'!\$Q\$1",
                    null,
                    1
                ),
                new DataSeriesValues(
                    'String',
                    "'REKAP ASSESSMENT'!\$R\$1",
                    null,
                    1
                ),
            ],
            [
                new DataSeriesValues(
                    'String',
                    "'REKAP ASSESSMENT'!\$O\$2:\$O\$" . $monthlyEndRow,
                    null,
                    $monthlyEndRow - 1
                ),
            ],
            [
                new DataSeriesValues(
                    'Number',
                    "'REKAP ASSESSMENT'!\$P\$2:\$P\$" . $monthlyEndRow,
                    null,
                    $monthlyEndRow - 1
                ),
                new DataSeriesValues(
                    'Number',
                    "'REKAP ASSESSMENT'!\$Q\$2:\$Q\$" . $monthlyEndRow,
                    null,
                    $monthlyEndRow - 1
                ),
                new DataSeriesValues(
                    'Number',
                    "'REKAP ASSESSMENT'!\$R\$2:\$R\$" . $monthlyEndRow,
                    null,
                    $monthlyEndRow - 1
                ),
            ]
        )
    ]),
    null,
    false
);

        $lineChart->setTopLeftPosition('A13');
        $lineChart->setBottomRightPosition('E27');
        $sheet->addChart($lineChart);

        $divisionData = $assessments
            ->groupBy(fn ($assessment) => $assessment->operator->divisi->nama_divisi ?? 'Belum Ada Divisi');

        $sheet->setCellValue('T1', 'Divisi');
        $sheet->setCellValue('U1', 'Pass Rate');

        $divisionRow = 2;

        foreach ($divisionData as $divisionName => $divisionAssessments) {
            $divisionLulus = $divisionAssessments
                ->filter(fn ($assessment) => $this->getAssessmentVisualStatus($assessment)['key'] === 'lulus')
                ->count();

            $divisionTidakLulus = $divisionAssessments
                ->filter(fn ($assessment) => $this->getAssessmentVisualStatus($assessment)['key'] === 'tidak_lulus')
                ->count();

            $divisionPassRate = ($divisionLulus + $divisionTidakLulus) > 0
                ? $divisionLulus / ($divisionLulus + $divisionTidakLulus)
                : 0;

            $sheet->setCellValue("T{$divisionRow}", $divisionName);
            $sheet->setCellValue("U{$divisionRow}", $divisionPassRate);
            $sheet->getStyle("U{$divisionRow}")->getNumberFormat()->setFormatCode('0.0%');

            $divisionRow++;
        }

        if ($divisionRow === 2) {
            $sheet->setCellValue('T2', 'Tidak ada data');
            $sheet->setCellValue('U2', 0);
        }

        $divisionEndRow = max(2, $divisionRow - 1);

        $barChart = new Chart(
            'pass_rate_divisi',
            new Title('Pass Rate per Divisi'),
            new Legend(Legend::POSITION_BOTTOM, null, false),
            new PlotArea(null, [
                new DataSeries(
                    DataSeries::TYPE_BARCHART,
                    DataSeries::GROUPING_CLUSTERED,
                    [0],
                    [
                        new DataSeriesValues('String', "'REKAP ASSESSMENT'!\$U\$1", null, 1),
                    ],
                    [
                        new DataSeriesValues('String', "'REKAP ASSESSMENT'!\$T\$2:\$T\${$divisionEndRow}", null, $divisionEndRow - 1),
                    ],
                    [
                        new DataSeriesValues('Number', "'REKAP ASSESSMENT'!\$U\$2:\$U\${$divisionEndRow}", null, $divisionEndRow - 1),
                    ]
                )
            ])
        );

        $barChart->setTopLeftPosition('F13');
        $barChart->setBottomRightPosition('J27');
        $sheet->addChart($barChart);

        $sheet->setCellValue('W1', 'Status');
        $sheet->setCellValue('X1', 'Jumlah');
        $sheet->setCellValue('W2', 'Lulus');
        $sheet->setCellValue('X2', $lulusCount);
        $sheet->setCellValue('W3', 'Tidak Lulus');
        $sheet->setCellValue('X3', $tidakLulusCount);
        $sheet->setCellValue('W4', 'Menunggu');
        $sheet->setCellValue('X4', $menungguCount);

        $doughnutChart = new Chart(
            'status_assessment',
            new Title('Status Assessment'),
            new Legend(Legend::POSITION_RIGHT, null, false),
            new PlotArea(null, [
                new DataSeries(
                    DataSeries::TYPE_PIECHART,
                    null,
                    range(0, 0),
                    [
                        new DataSeriesValues('String', "'REKAP ASSESSMENT'!\$X\$1", null, 1),
                    ],
                    [
                        new DataSeriesValues('String', "'REKAP ASSESSMENT'!\$W\$2:\$W\$4", null, 3),
                    ],
                    [
                        new DataSeriesValues('Number', "'REKAP ASSESSMENT'!\$X\$2:\$X\$4", null, 3),
                    ]
                )
            ])
        );

        $doughnutChart->setTopLeftPosition('K13');
        $doughnutChart->setBottomRightPosition('M27');
        $sheet->addChart($doughnutChart);

        $sheet->mergeCells('A29:M29');
        $sheet->setCellValue('A29', 'DETAIL ASSESSMENT');
        $sheet->getStyle('A29:M29')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB($navy);
        $sheet->getStyle('A29')->getFont()->setSize(12)->setBold(true)->getColor()->setRGB($white);

        $headers = [
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
        ];

        foreach ($headers as $column => $header) {
            $cell = $sheet->getCellByColumnAndRow($column + 1, 30);
            $cell->setValue($header);
            $cell->getStyle()->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB($navy);
            $cell->getStyle()->getFont()->setBold(true)->getColor()->setRGB($white);
            $cell->getStyle()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $cell->getStyle()->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
            $cell->getStyle()->getAlignment()->setWrapText(true);
        }

        $detailRow = 31;

        foreach ($assessments as $index => $assessment) {
            $approval = $this->getApprovalBreakdown($assessment);
            $displayStatus = $this->getAssessmentVisualStatus($assessment, $approval);

            $values = [
                $index + 1,
                $assessment->operator->nama_lengkap ?? $assessment->operator->nama ?? '-',
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
            ];

            foreach ($values as $column => $value) {
                $cell = $sheet->getCellByColumnAndRow($column + 1, $detailRow);
                $cell->setValue($value);
                $cell->getStyle()->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                $cell->getStyle()->getAlignment()->setWrapText(true);
                $cell->getStyle()->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN)->getColor()->setRGB($border);
            }

            $statusCell = $sheet->getCell("J{$detailRow}");

            if ($displayStatus['key'] === 'lulus') {
                $statusCell->getStyle()->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB($lightGreen);
                $statusCell->getStyle()->getFont()->setBold(true)->getColor()->setRGB($green);
            } elseif ($displayStatus['key'] === 'tidak_lulus') {
                $statusCell->getStyle()->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB($lightRed);
                $statusCell->getStyle()->getFont()->setBold(true)->getColor()->setRGB($red);
            } elseif ($displayStatus['key'] === 'submitted') {
                $statusCell->getStyle()->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB($lightOrange);
                $statusCell->getStyle()->getFont()->setBold(true)->getColor()->setRGB('92400E');
            }

            $detailRow++;
        }

        $lastDataRow = max(30, $detailRow - 1);

        $columnWidths = [
            'A' => 5,
            'B' => 22,
            'C' => 21,
            'D' => 13,
            'E' => 20,
            'F' => 34,
            'G' => 12,
            'H' => 9,
            'I' => 10,
            'J' => 25,
            'K' => 21,
            'L' => 22,
            'M' => 22,
        ];

        foreach ($columnWidths as $column => $width) {
            $sheet->getColumnDimension($column)->setWidth($width);
        }

        $sheet->getRowDimension(30)->setRowHeight(32);
        $sheet->freezePane('A31');
        $sheet->setAutoFilter("A30:M{$lastDataRow}");

        $noteRow = $lastDataRow + 2;

        $sheet->mergeCells("A{$noteRow}:M{$noteRow}");
        $sheet->setCellValue("A{$noteRow}", 'CATATAN');
        $sheet->getStyle("A{$noteRow}:M{$noteRow}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB($lightOrange);
        $sheet->getStyle("A{$noteRow}")->getFont()->setBold(true)->getColor()->setRGB('92400E');

        $notes = [
            '• Data mengikuti hasil assessment aktual sesuai filter yang digunakan saat download.',
            '• Pass Rate = Lulus / (Lulus + Tidak Lulus) × 100%.',
            '• Menunggu Penilaian tidak dihitung sebagai Lulus atau Tidak Lulus.',
            '• Tabel detail digunakan sebagai data utama untuk kebutuhan monitoring dan audit.',
        ];

        foreach ($notes as $index => $note) {
            $rowNumber = $noteRow + $index + 1;
            $sheet->mergeCells("A{$rowNumber}:M{$rowNumber}");
            $sheet->setCellValue("A{$rowNumber}", $note);
            $sheet->getStyle("A{$rowNumber}:M{$rowNumber}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB($lightOrange);
            $sheet->getStyle("A{$rowNumber}")->getFont()->setSize(9)->getColor()->setRGB($dark);
        }

        foreach (['O','P','Q','R','T','U','W','X'] as $column) {
            $sheet->getColumnDimension($column)->setVisible(false);
        }

        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        $sheet->getPageSetup()->setFitToWidth(1);
        $sheet->getPageSetup()->setFitToHeight(0);
        $sheet->setShowGridlines(false);
        $sheet->getPageMargins()->setTop(0.3);
        $sheet->getPageMargins()->setRight(0.3);
        $sheet->getPageMargins()->setBottom(0.3);
        $sheet->getPageMargins()->setLeft(0.3);
        $sheet->getHeaderFooter()->setOddFooter('&CRekapitulasi Skill Assessment &RPage &P of &N');

        $filename = 'rekapitulasi_skill_assessment_' . now()->format('Ymd_His') . '.xlsx';

        $writer = new Xlsx($spreadsheet);
        $writer->setIncludeCharts(true);

        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
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
