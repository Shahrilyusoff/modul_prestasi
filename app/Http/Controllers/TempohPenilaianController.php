<?php

namespace App\Http\Controllers;

use App\Models\TempohPenilaian;
use Illuminate\Http\Request;

class TempohPenilaianController extends Controller
{
    public function index()
    {
        $tempohPenilaian = TempohPenilaian::all();
        return view('tempoh-penilaian.index', compact('tempohPenilaian'));
    }

    public function create()
    {
        return view('tempoh-penilaian.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_tempoh' => 'required|string|max:255',
            'tarikh_mula' => 'required|date',
            'tarikh_tamat' => 'required|date|after:tarikh_mula',
            'jenis' => 'required|in:sasaran_awal,pertengahan,akhir',
            'aktif' => 'nullable|boolean'
        ]);

        $data = $request->all();
        $data['aktif'] = $request->has('aktif');

        // Deactivate all other periods if activating this one
        if ($data['aktif']) {
            TempohPenilaian::where('aktif', true)->update(['aktif' => false]);
        }

        TempohPenilaian::create($data);

        return redirect()->route('tempoh-penilaian.index')
            ->with('success', 'Tempoh penilaian berjaya ditambah');
    }

    public function edit(TempohPenilaian $tempohPenilaian)
    {
        return view('tempoh-penilaian.edit', compact('tempohPenilaian'));
    }

    public function update(Request $request, TempohPenilaian $tempohPenilaian)
    {
        $request->validate([
            'nama_tempoh' => 'required|string|max:255',
            'tarikh_mula' => 'required|date',
            'tarikh_tamat' => 'required|date|after:tarikh_mula',
            'jenis' => 'required|in:sasaran_awal,pertengahan,akhir',
            'aktif' => 'nullable|boolean'
        ]);

        $data = $request->all();
        $data['aktif'] = $request->has('aktif');

        // Deactivate all other periods if activating this one
        if ($data['aktif']) {
            TempohPenilaian::where('id', '!=', $tempohPenilaian->id)
                ->where('aktif', true)
                ->update(['aktif' => false]);
        }

        $tempohPenilaian->update($data);

        return redirect()->route('tempoh-penilaian.index')
            ->with('success', 'Tempoh penilaian berjaya dikemaskini');
    }

    public function destroy(TempohPenilaian $tempohPenilaian)
    {
        $tempohPenilaian->delete();
        return redirect()->route('tempoh-penilaian.index')
            ->with('success', 'Tempoh penilaian berjaya dipadam');
    }

    public function aktifkan(TempohPenilaian $tempohPenilaian)
    {
        TempohPenilaian::where('aktif', true)->update(['aktif' => false]);
        $tempohPenilaian->update(['aktif' => true]);

        return redirect()->route('tempoh-penilaian.index')
            ->with('success', 'Tempoh penilaian berjaya diaktifkan');
    }
}