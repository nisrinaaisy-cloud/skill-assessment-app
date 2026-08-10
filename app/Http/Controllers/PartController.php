<?php

namespace App\Http\Controllers;

use App\Models\Part;
use App\Models\Divisi;
use Illuminate\Http\Request;

class PartController extends Controller
{
    public function index(Request $request)
    {
        $query=Part::with('partDivisions.division');

        if($request->filled('search')){
            $query->where(function($q) use($request){
                $q->where('no_part','like','%'.$request->search.'%')
                ->orWhere('nama_part','like','%'.$request->search.'%');
            });
        }

        if($request->filled('division_id')){
            $query->whereHas('partDivisions',function($q) use($request){
                $q->where('division_id',$request->division_id);
            });
        }

        $parts=$query->paginate(10)->withQueryString();

        $divisions=Divisi::orderBy('nama_divisi')->get();

        return view('parts.index',compact(
            'parts',
            'divisions'
        ));
    }
    public function create()
    {
        $divisions = Divisi::orderBy('nama_divisi')->get();
        $subProcesses = \App\Models\SubProcess::orderBy('nama_sub_proses')->get();

        return view('parts.create', compact(
            'divisions',
            'subProcesses'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_part' => 'required|string|max:100',
            'nama_part' => 'required|string|max:150',
            'is_active' => 'required|boolean',
        ], [
            'no_part.required'   => 'No Part wajib diisi.',
            'nama_part.required' => 'Nama Part wajib diisi.',
            'proses.required'    => 'Divisi wajib dipilih.',
        ]);

        $duplicatePart = Part::where('no_part', $request->no_part)->first();

        if ($duplicatePart) {
            return back()
                ->withErrors([
                    'no_part' => 'No Part ' . $request->no_part . ' sudah digunakan oleh part: ' . $duplicatePart->nama_part . '.',
                ])
                ->withInput();
        }

       $part = Part::create([
            'no_part'   => $request->no_part,
            'nama_part' => $request->nama_part,
            'kategori'  => null,
            'is_active' => true,
        ]);
        \App\Models\PartDivision::create([
            'part_id'     => $part->id,
            'division_id' => $request->division_id,
        ]);

        // Simpan Sub Proses
        if ($request->filled('sub_process')) {

            foreach ($request->sub_process as $index => $subProcessId) {
                if (!empty($subProcessId)) {
                    \App\Models\PartProcess::create([
                        'part_id'        => $part->id,
                        'sub_process_id' => $subProcessId,
                        'urutan'         => $index + 1,
                    ]);
                }
            }
        }
        return redirect()->route('parts.index')
            ->with('success', 'Part berhasil ditambahkan.');
    }

    public function checkNoPart(Request $request)
    {
        $noPart = $request->query('no_part');

        if (!$noPart) {
            return response()->json([
                'exists' => false,
                'message' => null,
            ]);
        }

        $part = Part::where('no_part', $noPart)->first();

        if ($part) {
            return response()->json([
                'exists' => true,
                'message' => 'No Part ' . $noPart . ' sudah digunakan oleh part: ' . $part->nama_part . '.',
                'nama_part' => $part->nama_part,
            ]);
        }

        return response()->json([
            'exists' => false,
            'message' => 'No Part tersedia dan dapat digunakan.',
        ]);
    }

    public function show(string $id)
    {
        $part = Part::with([
            'partDivisions.division',
            'partProcesses.subProcess'
        ])->findOrFail($id);
        $divisions = Divisi::orderBy('nama_divisi')->get();
        return view('parts.show', compact(
            'part',
            'divisions'
        ));
    }

   public function edit(string $id)
    {
        $part = Part::with([
            'partDivisions.division',
            'partProcesses.subProcess'
        ])->findOrFail($id);

        $divisions = Divisi::orderBy('nama_divisi')->get();
        $subProcesses = \App\Models\SubProcess::orderBy('nama_sub_proses')->get();

        return view('parts.edit', compact(
            'part',
            'divisions',
            'subProcesses'
        ));
    }

    public function update(Request $request, string $id)
    {
        $part = Part::findOrFail($id);

        $request->validate([
            'no_part'      => 'required|string|max:100',
            'nama_part'    => 'required|string|max:150',
            'division_id'  => 'required|exists:divisi,id',
            'sub_process'   => 'required|array|min:1',
            'sub_process.*' => 'required|exists:sub_processes,id',
        ],[
            'no_part.required'   => 'No Part wajib diisi.',
            'nama_part.required' => 'Nama Part wajib diisi.',
            'division_id.required' => 'Divisi wajib dipilih.',
        ]);

        $part->update([
            'no_part'   => $request->no_part,
            'nama_part' => $request->nama_part,
        ]);

        \App\Models\PartDivision::updateOrCreate(
        ['part_id' => $part->id,],['division_id' => $request->division_id,]);
        // Hapus seluruh proses lama
        \App\Models\PartProcess::where('part_id', $part->id)->delete();
        // Simpan proses baru
        if ($request->filled('sub_process')) {
            foreach ($request->sub_process as $index => $subProcessId) {
                if (!empty($subProcessId)) {
                    \App\Models\PartProcess::create([
                        'part_id'        => $part->id,
                        'sub_process_id' => $subProcessId,
                        'urutan'         => $index + 1,
                    ]);
                }
            }
        }
        return redirect()->route('parts.index')
            ->with('success', 'Data part berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $part = Part::findOrFail($id);
        \App\Models\PartProcess::where('part_id', $part->id)->delete();
        \App\Models\PartDivision::where('part_id', $part->id)->delete();
        $part->delete();
        return redirect()->route('parts.index')
            ->with('success', 'Part berhasil dihapus.');
    }
}