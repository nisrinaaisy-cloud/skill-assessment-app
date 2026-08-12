<?php
namespace App\Http\Controllers;
use App\Models\Approval;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
class ApprovalController extends Controller
{
	public function index(Request $request)
	{
		$user = auth()->user();
		$role = $user->role;
		if (!in_array($role, ['foreman', 'kabag'])) {
			abort(403);
		}
		$approvals = Approval::with([
			'assessment.operator.divisi',
			'assessment.part',
			'assessment.subProcess',
			'assessment.periode',
			'assessment.penilaian',
			'foreman',
			'kabag',
		])
		->whereHas('assessment', function ($q) {
			$q->where('status', 'dinilai')
				->whereHas('penilaian', function ($p) {
					$p->where('status_lulus', true);
				});
		})
		->when($role === 'foreman', function ($q) use ($user) {
			$q->where('foreman_id', $user->id)
				->where('status_foreman', 'pending');
		})
		->when($role === 'kabag', function ($q) {
			$q->where('status_foreman', 'approved')
				->where('status_kabag', 'pending');
		})
		->latest()
		->paginate(10)
		->withQueryString();
		return view('approvals.index', compact('approvals'));
	}
	public function show(Approval $approval)
	{
		$user = auth()->user();
		$role = $user->role;
		if (!in_array($role, ['foreman', 'kabag'])) {
			abort(403);
		}
		$approval->load([
			'assessment.operator.divisi',
			'assessment.part',
			'assessment.subProcess',
			'assessment.periode',
			'assessment.answer',
			'assessment.penilaian',
			'foreman',
			'kabag',
		]);
		if (!$approval->assessment) {
			abort(404);
		}
		if ($role === 'foreman') {
			if ($approval->foreman_id != $user->id) {
				abort(403);
			}
			if ($approval->status_foreman !== 'pending') {
				return redirect()
					->route('approvals.index')
					->with('error', 'Assessment sudah diproses Foreman.');
			}
		}
		if ($role === 'kabag') {
			if ($approval->status_foreman !== 'approved') {
				return redirect()
					->route('approvals.index')
					->with('error', 'Belum disetujui Foreman.');
			}
			if ($approval->status_kabag !== 'pending') {
				return redirect()
					->route('approvals.index')
					->with('error', 'Assessment sudah diproses Kabag.');
			}
		}
		return view('approvals.show', compact('approval'));
	}
	public function approve(Request $request, Approval $approval)
	{
		$request->validate([
			'note' => 'nullable|string|max:1000',
		]);
		$user = auth()->user();
		$role = $user->role;
		$approval->load([
			'assessment.operator',
			'assessment.penilaian',
		]);
		$assessment = $approval->assessment;
		if (!$assessment) {
			return redirect()
				->route('approvals.index')
				->with('error', 'Data assessment tidak ditemukan.');
		}
		if ($role === 'foreman') {
			if ($approval->foreman_id != $user->id) {
				abort(403);
			}
			if ($approval->status_foreman !== 'pending') {
				return redirect()
					->route('approvals.index')
					->with('error', 'Assessment sudah diproses Foreman.');
			}
			$approval->update([
				'foreman_id' => $user->id,
				'status_foreman' => 'approved',
				'foreman_note' => $request->note,
				'foreman_approved_at' => now(),
				'status_kabag' => 'pending',
				'status' => 'pending',
			]);
			foreach (User::where('role', 'kabag')->get() as $kabag) {
				Notification::create([
					'title' => 'Assessment Menunggu Approval Kabag',
					'message' => $assessment->operator->nama_lengkap . ' telah disetujui Foreman ' . $user->name . ' dan menunggu approval Kabag.',
					'tipe' => 'approval_kabag',
					'user_id' => $kabag->id,
					'operator_id' => $assessment->operator_id,
					'assessment_id' => $assessment->id,
					'is_read' => 0,
				]);
			}
			return redirect()
				->route('approvals.index')
				->with('success', 'Assessment berhasil disetujui Foreman.');
		}
		if ($role === 'kabag') {
			if ($approval->status_foreman !== 'approved') {
				return redirect()
					->route('approvals.index')
					->with('error', 'Belum disetujui Foreman.');
			}
			if ($approval->status_kabag !== 'pending') {
				return redirect()
					->route('approvals.index')
					->with('error', 'Sudah diproses Kabag.');
			}
			$approval->update([
				'kabag_id' => $user->id,
				'status_kabag' => 'approved',
				'kabag_note' => $request->note,
				'kabag_approved_at' => now(),
				'status' => 'approved',
			]);
			$assessment->update([
				'status' => 'lulus',
			]);
			foreach (User::where('role', 'admin')->get() as $admin) {
				Notification::create([
					'title' => 'Assessment Final',
					'message' => $assessment->operator->nama_lengkap . ' telah disetujui Kabag.',
					'tipe' => 'approval_final',
					'user_id' => $admin->id,
					'operator_id' => $assessment->operator_id,
					'assessment_id' => $assessment->id,
					'is_read' => 0,
				]);
			}
			return redirect()
				->route('approvals.index')
				->with('success', 'Assessment berhasil disetujui Kabag.');
		}
		abort(403);
	}
	public function reject(Request $request, Approval $approval)
	{
		abort(403, 'Foreman dan Kabag tidak memiliki akses reject assessment.');
	}
}