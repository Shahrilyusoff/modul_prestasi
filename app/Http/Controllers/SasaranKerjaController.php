<?php

// app/Http/Controllers/SasaranKerjaController.php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use App\Models\SasaranKerja;
use Illuminate\Http\Request;

class SasaranKerjaController extends Controller
{
    public function index(Penilaian $penilaian)
    {
        $this->authorize('view', $penilaian);
        
        $sasaran = $penilaian->sasaranKerja()->get();
        return response()->json($sasaran);
    }

    public function store(Request $request, Penilaian $penilaian)
    {
        $this->authorize('modify', $penilaian);
        
        $request->validate([
            'aktiviti' => 'required|string',
            'petunjuk_prestasi' => 'required|string',
            'bahagian' => 'required|in:awal,pertengahan,akhir',
            'ditambah' => 'boolean',
            'digugurkan' => 'boolean',
            'ulasan_pyd' => 'nullable|string',
            'ulasan_ppp' => 'nullable|string',
        ]);

        $sasaran = $penilaian->sasaranKerja()->create($request->all());
        return response()->json($sasaran, 201);
    }

    public function show(SasaranKerja $sasaranKerja)
    {
        $this->authorize('view', $sasaranKerja->penilaian);
        return response()->json($sasaranKerja);
    }

    public function update(Request $request, SasaranKerja $sasaranKerja)
    {
        $this->authorize('modify', $sasaranKerja->penilaian);
        
        $request->validate([
            'aktiviti' => 'required|string',
            'petunjuk_prestasi' => 'required|string',
            'bahagian' => 'required|in:awal,pertengahan,akhir',
            'ditambah' => 'boolean',
            'digugurkan' => 'boolean',
            'ulasan_pyd' => 'nullable|string',
            'ulasan_ppp' => 'nullable|string',
        ]);

        $sasaranKerja->update($request->all());
        return response()->json($sasaranKerja);
    }

    public function destroy(SasaranKerja $sasaranKerja)
    {
        $this->authorize('modify', $sasaranKerja->penilaian);
        $sasaranKerja->delete();
        return response()->json(null, 204);
    }

    public function sahkan(SasaranKerja $sasaranKerja)
    {
        $user = auth()->user();
        
        if ($user->role !== 'ppp') {
            abort(403);
        }
        
        $sasaranKerja->update(['disahkan' => true]);
        
        // Notify PYD
        $sasaranKerja->penilaian->pyd->notify(new \App\Notifications\PenilaianNotifikasi(
            'Sasaran kerja anda telah disahkan oleh PPP.'
        ));
        
        return response()->json($sasaranKerja);
    }
}
