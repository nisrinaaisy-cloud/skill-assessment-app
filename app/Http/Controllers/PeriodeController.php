<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    public function index(Request $request)
    {
        $query = Periode::query();

        if ($request->filled('bulan')) {
            $query->where('bulan', $request->bulan);
        }

        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $periodes = $query->orderBy('tahun', 'desc')
            ->orderBy('bulan', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('periode.index', compact('periodes'));
    }

    public function create()
    {
        return view('periode.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:2020|max:2100',
            'status' => 'required|in:open,close',
        ], [
            'bulan.required' => 'Bulan wajib diisi.',
            'tahun.required' => 'Tahun wajib diisi.',
            'status.required' => 'Status wajib dipilih.',
        ]);

        Periode::create([
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
            'status' => $request->status,
        ]);

        return redirect()->route('periode.index')
            ->with('success', 'Periode berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $periode = Periode::findOrFail($id);
        return view('periode.edit', compact('periode'));
    }

    public function update(Request $request, $id)
    {
        $periode = Periode::findOrFail($id);

        $request->validate([
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:2020|max:2100',
            'status' => 'required|in:open,close',
        ]);

        $periode->update([
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
            'status' => $request->status,
        ]);

        return redirect()->route('periode.index')
            ->with('success', 'Periode berhasil diupdate.');
    }

    public function destroy($id)
    {
        $periode = Periode::findOrFail($id);
        $periode->delete();

        return redirect()->route('periode.index')
            ->with('success', 'Periode berhasil dihapus.');
    }
}