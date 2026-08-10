<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\LeaderAssignment;
use App\Models\Operator;
use App\Models\Divisi;
use App\Models\User;
class LeaderAssignmentController extends Controller
{
	public function index()
	{
		$leaders=LeaderAssignment::with(['leader','divisi'])
			->where('is_active',true)
			->whereNotNull('leader_id')
			->latest()
			->get();
		$leaders->each(function($assignment){
			$assignment->mapped_operator_count=Operator::where('leader_id',$assignment->leader_id)
				->where('divisi_id',$assignment->divisi_id)
				->where('jabatan','Operator')
				->count();
		});
		$divisis=Divisi::orderBy('nama_divisi')->get();
		return view('leader_assignments.index',compact('leaders','divisis'));
	}
	public function create()
	{
		$divisis=Divisi::orderBy('nama_divisi')->get();
		$leaders=User::where('role','leader')
			->where('is_active',true)
			->orderBy('name')
			->get(['id','name','employee_nik']);
		return view('leader_assignments.create',compact('divisis','leaders'));
	}
	public function store(Request $request)
	{
		$request->validate([
			'leader_id'=>'required|exists:users,id',
			'divisi_id'=>'required|exists:divisi,id',
		]);
		$leader=User::where('id',$request->leader_id)
			->where('role','leader')
			->where('is_active',true)
			->firstOrFail();
		$hasDivisi=$leader->divisi_id==$request->divisi_id||$leader->divisis()->where('divisi.id',$request->divisi_id)->exists();
		if(!$hasDivisi){
			return back()
				->withInput()
				->with('error','Leader tersebut belum memiliki cakupan divisi yang dipilih di User Management.');
		}
		$exists=LeaderAssignment::where('leader_id',$leader->id)
			->where('divisi_id',$request->divisi_id)
			->where('is_active',true)
			->exists();
		if($exists){
			return back()
				->withInput()
				->with('error','Leader tersebut sudah terdaftar pada divisi ini.');
		}
		LeaderAssignment::create([
			'leader_id'=>$leader->id,
			'divisi_id'=>$request->divisi_id,
			'is_active'=>true,
		]);
		return redirect()
			->route('leader-assignments.index')
			->with('success',strtoupper($leader->name).' berhasil ditambahkan ke Leader Assignment.');
	}
	public function getLeaders($divisi)
	{
		$leaders=User::where('role','leader')
			->where('is_active',true)
			->where(function($q)use($divisi){
				$q->where('divisi_id',$divisi)
					->orWhereHas('divisis',function($q2)use($divisi){
						$q2->where('divisi.id',$divisi);
					});
			})
			->orderBy('name')
			->get(['id','name','employee_nik']);
		return response()->json($leaders);
	}
	public function getOperators($divisi)
	{
		$operators=Operator::where('divisi_id',$divisi)
			->where('jabatan','Operator')
			->orderBy('nama_lengkap')
			->get(['id','nik','nama_lengkap','leader_id']);
		return response()->json($operators);
	}
	public function show($id)
	{
		$leader=LeaderAssignment::with(['leader','divisi'])
			->where('is_active',true)
			->findOrFail($id);
		$operators=Operator::where('divisi_id',$leader->divisi_id)
			->where('jabatan','Operator')
			->where(function($q)use($leader){
				$q->whereNull('leader_id')
					->orWhere('leader_id',$leader->leader_id);
			})
			->orderBy('nama_lengkap')
			->get();
		return view('leader_assignments.show',compact('leader','operators'));
	}
	public function mapping(Request $request,$id)
	{
		$leader=LeaderAssignment::where('is_active',true)->findOrFail($id);
		$request->validate([
			'operators'=>'nullable|array',
			'operators.*'=>'exists:operators,id',
		]);
		Operator::where('leader_id',$leader->leader_id)
			->where('divisi_id',$leader->divisi_id)
			->where('jabatan','Operator')
			->update(['leader_id'=>null]);
		if($request->filled('operators')){
			Operator::whereIn('id',$request->operators)
				->where('divisi_id',$leader->divisi_id)
				->where('jabatan','Operator')
				->update(['leader_id'=>$leader->leader_id]);
		}
		return redirect()
			->route('leader-assignments.index')
			->with('success','Mapping operator berhasil disimpan.');
	}
	public function update(Request $request,$id)
	{
		$leader=LeaderAssignment::where('is_active',true)->findOrFail($id);
		$request->validate([
			'leader_id'=>'required|exists:users,id',
			'divisi_id'=>'required|exists:divisi,id',
		]);
		$newLeader=User::where('id',$request->leader_id)
			->where('role','leader')
			->where('is_active',true)
			->firstOrFail();
		$hasDivisi=$newLeader->divisi_id==$request->divisi_id||$newLeader->divisis()->where('divisi.id',$request->divisi_id)->exists();
		if(!$hasDivisi){
			return back()
				->withInput()
				->with('error','Leader tersebut belum memiliki cakupan divisi yang dipilih.');
		}
		$exists=LeaderAssignment::where('leader_id',$newLeader->id)
			->where('divisi_id',$request->divisi_id)
			->where('is_active',true)
			->where('id','!=',$leader->id)
			->exists();
		if($exists){
			return back()
				->withInput()
				->with('error','Leader tersebut sudah memiliki assignment pada divisi ini.');
		}
		Operator::where('leader_id',$leader->leader_id)
			->where('divisi_id',$leader->divisi_id)
			->where('jabatan','Operator')
			->update(['leader_id'=>null]);
		$leader->update([
			'leader_id'=>$newLeader->id,
			'divisi_id'=>$request->divisi_id,
		]);
		return redirect()
			->route('leader-assignments.index')
			->with('success','Leader Assignment berhasil diperbarui.');
	}
	public function destroy($id)
	{
		$leader=LeaderAssignment::where('is_active',true)->findOrFail($id);
		Operator::where('leader_id',$leader->leader_id)
			->where('divisi_id',$leader->divisi_id)
			->where('jabatan','Operator')
			->update(['leader_id'=>null]);
		$leader->update(['is_active'=>false]);
		return redirect()
			->route('leader-assignments.index')
			->with('success','Leader Assignment berhasil dihapus.');
	}
    public function leader()
    {
        return $this->belongsTo(User::class, 'leader_id');
    }
}