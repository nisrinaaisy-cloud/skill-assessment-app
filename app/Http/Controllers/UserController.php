<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Divisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
	public function index(Request $request)
	{
		$query=User::with(['divisi','divisis']);
		if($request->filled('search')){
			$search=$request->search;
			$query->where(function($q)use($search){
				$q->where('name','like','%'.$search.'%')
					->orWhere('employee_nik','like','%'.$search.'%')
					->orWhere('username','like','%'.$search.'%')
					->orWhere('role','like','%'.$search.'%');
			});
		}
		$users=$query
			->orderBy('name')
			->paginate(10)
			->withQueryString();
		return view('user.index',compact('users'));
	}
	public function create()
	{
		$divisis=Divisi::orderBy('nama_divisi')->get();
		return view('user.create',compact('divisis'));
	}
	public function store(Request $request)
	{
		$request->validate([
			'name'=>'required|string|max:255',
			'employee_nik'=>'nullable|string|max:50|unique:users,employee_nik',
			'username'=>'required|string|max:100|unique:users,username',
			'email'=>'nullable|email|unique:users,email',
			'password'=>'required|string|min:6',
			'role'=>'required|in:admin,leader,foreman,kabag',
			'divisi_ids'=>'nullable|array',
			'divisi_ids.*'=>'exists:divisi,id',
		]);
		$divisiIds=$request->input('divisi_ids',[]);
		if(in_array($request->role,['admin','kabag'])){
			$divisiIds=Divisi::pluck('id')->toArray();
		}
		if(in_array($request->role,['leader','foreman'])&&empty($divisiIds)){
			return back()
				->withErrors(['divisi_ids'=>'Minimal pilih satu cakupan divisi.'])
				->withInput();
		}
		$user=User::create([
			'name'=>$request->name,
			'employee_nik'=>$request->employee_nik,
			'username'=>$request->username,
			'email'=>$request->email,
			'password'=>Hash::make($request->password),
			'role'=>$request->role,
			'divisi_id'=>$divisiIds[0]??null,
			'is_active'=>true,
		]);
		$user->divisis()->sync($divisiIds);
		return redirect()
			->route('user.index')
			->with('success','User berhasil ditambahkan.');
	}
	public function edit(User $user)
	{
		$divisis=Divisi::orderBy('nama_divisi')->get();
		$user->load('divisis');
		return view('user.edit',compact('user','divisis'));
	}
	public function update(Request $request,User $user)
	{
		$request->validate([
			'name'=>'required|string|max:255',
			'employee_nik'=>'nullable|string|max:50|unique:users,employee_nik,'.$user->id,
			'username'=>'required|string|max:100|unique:users,username,'.$user->id,
			'email'=>'nullable|email|unique:users,email,'.$user->id,
			'role'=>'required|in:admin,leader,foreman,kabag',
			'divisi_ids'=>'nullable|array',
			'divisi_ids.*'=>'exists:divisi,id',
		]);
		$divisiIds=$request->input('divisi_ids',[]);
		if(in_array($request->role,['admin','kabag'])){
			$divisiIds=Divisi::pluck('id')->toArray();
		}
		if(in_array($request->role,['leader','foreman'])&&empty($divisiIds)){
			return back()
				->withErrors(['divisi_ids'=>'Minimal pilih satu cakupan divisi.'])
				->withInput();
		}
		$user->update([
			'name'=>$request->name,
			'employee_nik'=>$request->employee_nik,
			'username'=>$request->username,
			'email'=>$request->email,
			'role'=>$request->role,
			'divisi_id'=>$divisiIds[0]??null,
		]);
		$user->divisis()->sync($divisiIds);
		if($request->filled('password')){
			$request->validate([
				'password'=>'string|min:6',
			]);
			$user->update([
				'password'=>Hash::make($request->password),
			]);
		}
		return redirect()
			->route('user.index')
			->with('success','User berhasil diperbarui.');
	}
	public function destroy(User $user)
	{
		$user->delete();
		return redirect()
			->route('user.index')
			->with('success','User berhasil dihapus.');
	}
	public function resetPassword(User $user)
	{
		$user->update([
			'password'=>Hash::make('12345678'),
		]);
		return redirect()
			->route('user.index')
			->with('success','Password berhasil direset menjadi 12345678.');
	}
}