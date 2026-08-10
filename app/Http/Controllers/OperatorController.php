<?php

namespace App\Http\Controllers;

use App\Models\Operator;
use App\Models\Divisi;
use App\Models\LeaderAssignment;
use Illuminate\Http\Request;

class OperatorController extends Controller
{
	public function index(Request $request)
	{
		$query=Operator::with(['divisi','leader'])->where('jabatan','Operator');
		if($request->filled('search')){
			$search=$request->search;
			$query->where(function($q) use($search){
				$q->where('nama_lengkap','like','%'.$search.'%')
					->orWhere('nik','like','%'.$search.'%');
			});
		}
		if($request->filled('divisi_id')){
			$query->where('divisi_id',$request->divisi_id);
		}
		if($request->filled('leader_id')){
			$query->where('leader_id',$request->leader_id);
		}
		$operators=$query->orderBy('nama_lengkap')->paginate(10)->withQueryString();
		$divisis=Divisi::orderBy('nama_divisi')->get();
        $leaders=LeaderAssignment::with('leader')
            ->where('is_active',1)
            ->when($request->filled('divisi_id'),function($q) use($request){
                $q->where('divisi_id',$request->divisi_id);
            })
            ->whereHas('leader',function($q){
                $q->where('role','leader');
            })
            ->get()
            ->map(fn($item)=>$item->leader)
            ->filter()
            ->unique('id')
            ->sortBy('name')
            ->values();
		return view('operators.index',compact('operators','divisis','leaders'));
	}

	public function create()
	{
		$divisis=Divisi::orderBy('nama_divisi')->get();
		$leaders=LeaderAssignment::with(['leader','divisi'])
			->where('is_active',1)
			->whereHas('leader')
			->get()
			->unique('leader_id')
			->sortBy(fn($item)=>$item->leader->name)
			->values();
		return view('operators.create',compact('divisis','leaders'));
	}

	public function store(Request $request)
	{
		$request->validate([
			'nama_lengkap'=>'required|string|max:100',
			'nik'=>'required|string|max:50|unique:operators,nik',
			'jabatan'=>'nullable|string|max:100',
			'divisi_id'=>'required|exists:divisi,id',
			'leader_id'=>'required|exists:users,id',
		]);
		Operator::create([
			'nama_lengkap'=>$request->nama_lengkap,
			'nik'=>$request->nik,
			'jabatan'=>$request->jabatan??'Operator',
			'divisi_id'=>$request->divisi_id,
			'leader_id'=>$request->leader_id,
			'is_active'=>1,
		]);
		return redirect()->route('operators.index')->with('success','Operator berhasil ditambahkan.');
	}

	public function show(string $id)
	{
		return redirect()->route('operators.index');
	}

	public function edit($id)
	{
		$operator=Operator::findOrFail($id);
		$divisis=Divisi::orderBy('nama_divisi')->get();
		$leaders=LeaderAssignment::with(['leader','divisi'])
			->where('divisi_id',$operator->divisi_id)
			->where('is_active',1)
			->whereHas('leader')
			->get()
			->unique('leader_id')
			->sortBy(fn($item)=>$item->leader->name)
			->values();
		return view('operators.edit',compact('operator','divisis','leaders'));
	}

	public function update(Request $request,$id)
	{
		$operator=Operator::findOrFail($id);
		$request->validate([
			'nama_lengkap'=>'required|string|max:100',
			'nik'=>'required|string|max:50|unique:operators,nik,'.$operator->id,
			'jabatan'=>'nullable|string|max:100',
			'divisi_id'=>'required|exists:divisi,id',
			'leader_id'=>'required|exists:users,id',
		]);
		$operator->update([
			'nama_lengkap'=>$request->nama_lengkap,
			'nik'=>$request->nik,
			'jabatan'=>$request->jabatan??'Operator',
			'divisi_id'=>$request->divisi_id,
			'leader_id'=>$request->leader_id,
			'is_active'=>1,
		]);
		return redirect()->route('operators.index')->with('success','Data operator berhasil diperbarui.');
	}

	public function destroy($id)
	{
		$operator=Operator::findOrFail($id);
		$operator->delete();
		return redirect()->route('operators.index')->with('success','Operator berhasil dihapus.');
	}
}