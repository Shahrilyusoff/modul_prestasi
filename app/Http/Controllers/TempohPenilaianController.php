<?php

// app/Http/Controllers/TempohPenilaianController.php

namespace App\Http\Controllers;

use App\Models\TempohPenilaian;
use Illuminate\Http\Request;

class TempohPenilaianController extends Controller
{
    public function index()
    {
        $tempoh = TempohPenilaian::all();
        return response()->json($tempoh);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_tempoh' => 'required',
            'tarikh_mula' => 'required|date',
            'tarikh_tamat' => 'required|date|after:tarikh_mula',
            'jenis' => 'required|in:sasaran_awal,pertengahan,akhir',
        ]);

        // Deactivate all other periods if this one is set to active
        if ($request->aktif) {
            TempohPenilaian::where('aktif', true)->update(['aktif' => false]);
        }

        $tempoh = TempohPenilaian::create($request->all());
        return response()->json($tempoh, 201);
    }

    public function show(TempohPenilaian $tempohPenilaian)
    {
        return response()->json($tempohPenilaian);
    }

    public function update(Request $request, TempohPenilaian $tempohPenilaian)
    {
        $request->validate([
            'nama_tempoh' => 'required',
            'tarikh_mula' => 'required|date',
            'tarikh_tamat' => 'required|date|after:tarikh_mula',
            'jenis' => 'required|in:sasaran_awal,pertengahan,akhir',
        ]);

        // Deactivate all other periods if this one is set to active
        if ($request->aktif) {
            TempohPenilaian::where('aktif', true)->where('id', '!=', $tempohPenilaian->id)->update(['aktif' => false]);
        }

        $tempohPenilaian->update($request->all());
        return response()->json($tempohPenilaian);
    }

    public function destroy(TempohPenilaian $tempohPenilaian)
    {
        $tempohPenilaian->delete();
        return response()->json(null, 204);
    }

    public function aktifkan(TempohPenilaian $tempohPenilaian)
    {
        TempohPenilaian::where('aktif', true)->update(['aktif' => false]);
        $tempohPenilaian->update(['aktif' => true]);
        return response()->json($tempohPenilaian);
    }
}
