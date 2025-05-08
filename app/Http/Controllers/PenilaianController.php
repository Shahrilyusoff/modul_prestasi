<?php

// app/Http/Controllers/PenilaianController.php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use App\Models\TempohPenilaian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenilaianController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $query = Penilaian::with(['pyd', 'ppp', 'ppk', 'tempohPenilaian']);
        
        if ($user->role === 'pyd') {
            $query->where('pyd_id', $user->id);
        } elseif ($user->role === 'ppp') {
            $query->where('ppp_id', $user->id);
        } elseif ($user->role === 'ppk') {
            $query->where('ppk_id', $user->id);
        }
        
        $penilaian = $query->get();
        return view('penilaian.index', compact('penilaian'));
    }

    public function pyd()
    {
        $penilaian = Penilaian::with(['tempohPenilaian', 'ppp', 'ppk'])
            ->where('pyd_id', auth()->id())
            ->get();
            
        return view('penilaian.pyd', compact('penilaian'));
    }

    public function create()
    {
        $tempohPenilaian = TempohPenilaian::where('aktif', true)->get();
        $pydOptions = User::where('role', 'pyd')->get();
        $pppOptions = User::where('role', 'ppp')->get();
        $ppkOptions = User::where('role', 'ppk')->get();
        
        return view('penilaian.create', compact('tempohPenilaian', 'pydOptions', 'pppOptions', 'ppkOptions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tempoh_penilaian_id' => 'required|exists:tempoh_penilaian,id',
            'pyd_id' => 'required|exists:users,id',
            'ppp_id' => 'required|exists:users,id',
            'ppk_id' => 'nullable|exists:users,id',
        ]);

        // Check if evaluation period exists and is active
        $tempoh = TempohPenilaian::find($request->tempoh_penilaian_id);
        if (!$tempoh || !$tempoh->aktif) {
            return back()->with('error', 'Tempoh penilaian tidak aktif');
        }

        // Check if PYD already has evaluation for this period
        $existing = Penilaian::where('tempoh_penilaian_id', $request->tempoh_penilaian_id)
            ->where('pyd_id', $request->pyd_id)
            ->exists();
            
        if ($existing) {
            return back()->with('error', 'Penilaian untuk PYD ini dalam tempoh ini sudah wujud');
        }

        $penilaian = Penilaian::create([
            'tempoh_penilaian_id' => $request->tempoh_penilaian_id,
            'pyd_id' => $request->pyd_id,
            'ppp_id' => $request->ppp_id,
            'ppk_id' => $request->ppk_id,
            'status' => 'draf'
        ]);

        return redirect()->route('penilaian.show', $penilaian->id)->with('success', 'Penilaian berjaya dicipta.');
    }

    public function show(Penilaian $penilaian)
    {
        $this->authorize('view', $penilaian);
        
        $penilaian->load(['pyd', 'ppp', 'ppk', 'tempohPenilaian', 'sasaranKerja', 'kegiatanLuar', 'latihan']);
        
        $sasaranAwal = $penilaian->sasaranKerja->where('bahagian', 'awal');
        $sasaranPertengahan = $penilaian->sasaranKerja->where('bahagian', 'pertengahan');
        $sasaranAkhir = $penilaian->sasaranKerja->where('bahagian', 'akhir');
        
        return view('penilaian.show', compact('penilaian', 'sasaranAwal', 'sasaranPertengahan', 'sasaranAkhir'));
    }

    public function edit(Penilaian $penilaian)
    {
        $this->authorize('update', $penilaian);
        
        $tempohPenilaian = TempohPenilaian::where('aktif', true)->get();
        $pydOptions = User::where('role', 'pyd')->get();
        $pppOptions = User::where('role', 'ppp')->get();
        $ppkOptions = User::where('role', 'ppk')->get();
        
        return view('penilaian.edit', compact('penilaian', 'tempohPenilaian', 'pydOptions', 'pppOptions', 'ppkOptions'));
    }

    public function update(Request $request, Penilaian $penilaian)
    {
        $this->authorize('update', $penilaian);
        
        $user = auth()->user();
        $data = $request->all();

        DB::beginTransaction();
        try {
            // Handle kegiatan luar
            if (isset($data['kegiatan'])) {
                $penilaian->kegiatanLuar()->delete();
                foreach ($data['kegiatan'] as $kegiatan) {
                    $penilaian->kegiatanLuar()->create($kegiatan);
                }
            }

            // Handle latihan
            if (isset($data['latihan']) || isset($data['latihan_diperlukan'])) {
                $penilaian->latihan()->delete();
                
                if (isset($data['latihan'])) {
                    foreach ($data['latihan'] as $latihan) {
                        $penilaian->latihan()->create($latihan);
                    }
                }
                
                if (isset($data['latihan_diperlukan'])) {
                    foreach ($data['latihan_diperlukan'] as $latihan) {
                        $penilaian->latihan()->create($latihan);
                    }
                }
            }

            // Handle sasaran kerja
            if (isset($data['sasaran_awal']) || isset($data['sasaran_tambah']) || isset($data['sasaran_gugur'])) {
                $penilaian->sasaranKerja()->delete();
                
                if (isset($data['sasaran_awal'])) {
                    foreach ($data['sasaran_awal'] as $sasaran) {
                        $penilaian->sasaranKerja()->create($sasaran);
                    }
                }
                
                if (isset($data['sasaran_tambah'])) {
                    foreach ($data['sasaran_tambah'] as $sasaran) {
                        $penilaian->sasaranKerja()->create($sasaran);
                    }
                }
                
                if (isset($data['sasaran_gugur'])) {
                    foreach ($data['sasaran_gugur'] as $sasaran) {
                        $penilaian->sasaranKerja()->create($sasaran);
                    }
                }
            }

            // Handle ulasan sasaran kerja akhir tahun
            if (isset($data['sasaran_ulasan_pyd']) || isset($data['sasaran_ulasan_ppp'])) {
                if (isset($data['sasaran_ulasan_pyd'])) {
                    foreach ($data['sasaran_ulasan_pyd'] as $sasaranId => $ulasan) {
                        $penilaian->sasaranKerja()->where('id', $sasaranId)->update(['ulasan_pyd' => $ulasan]);
                    }
                }
                
                if (isset($data['sasaran_ulasan_ppp'])) {
                    foreach ($data['sasaran_ulasan_ppp'] as $sasaranId => $ulasan) {
                        $penilaian->sasaranKerja()->where('id', $sasaranId)->update(['ulasan_ppp' => $ulasan]);
                    }
                }
            }

            // Handle evaluation sections for PPP/PPK
            if ($user->role === 'ppp' || $user->role === 'ppk') {
                $bahagian = [];
                
                if (isset($data['bahagian_iii'])) {
                    $existing = $penilaian->bahagian_iii ?? [];
                    foreach ($data['bahagian_iii'] as $key => $value) {
                        $existing[$key][$user->role] = $value;
                    }
                    $bahagian['bahagian_iii'] = $existing;
                }
                
                if (isset($data['bahagian_iv'])) {
                    $existing = $penilaian->bahagian_iv ?? [];
                    foreach ($data['bahagian_iv'] as $key => $value) {
                        $existing[$key][$user->role] = $value;
                    }
                    $bahagian['bahagian_iv'] = $existing;
                }
                
                if (isset($data['bahagian_v'])) {
                    $existing = $penilaian->bahagian_v ?? [];
                    foreach ($data['bahagian_v'] as $key => $value) {
                        $existing[$key][$user->role] = $value;
                    }
                    $bahagian['bahagian_v'] = $existing;
                }
                
                if (isset($data['bahagian_vi'])) {
                    if ($user->role === 'ppp') {
                        $bahagian['bahagian_vi_ppp'] = $data['bahagian_vi'];
                    } else {
                        $bahagian['bahagian_vi_ppk'] = $data['bahagian_vi'];
                    }
                }
                
                if (isset($data['tempoh_penilaian_tahun']) && isset($data['tempoh_penilaian_bulan'])) {
                    $tahun = $data['tempoh_penilaian_tahun'];
                    $bulan = $data['tempoh_penilaian_bulan'];
                    
                    if ($tahun && $bulan) {
                        if ($user->role === 'ppp') {
                            $bahagian['tempoh_penilaian_ppp'] = "$tahun-$bulan-01";
                        } else {
                            $bahagian['tempoh_penilaian_ppk'] = "$tahun-$bulan-01";
                        }
                    }
                }
                
                if (isset($data['ulasan_ppp'])) {
                    $bahagian['ulasan_ppp'] = $data['ulasan_ppp'];
                }
                
                if (isset($data['ulasan_ppk'])) {
                    $bahagian['ulasan_ppk'] = $data['ulasan_ppk'];
                }
                
                // If PPP is submitting evaluation
                if ($user->role === 'ppp' && $penilaian->status === 'penilaian_ppp') {
                    // Calculate total scores
                    $total = $this->calculateTotalScore($data, 'ppp');
                    $bahagian['markah_keseluruhan_ppp'] = $total;
                    $bahagian['status'] = 'penilaian_ppk';
                }

                // If PPK is submitting evaluation
                if ($user->role === 'ppk' && $penilaian->status === 'penilaian_ppk') {
                    $total = $this->calculateTotalScore($data, 'ppk');
                    $bahagian['markah_keseluruhan_ppk'] = $total;
                    
                    // Calculate average
                    if ($penilaian->markah_keseluruhan_ppp && $total) {
                        $bahagian['markah_purata'] = ($penilaian->markah_keseluruhan_ppp + $total) / 2;
                    }
                    
                    $bahagian['status'] = 'selesai';
                }
                
                $penilaian->update($bahagian);
            } else {
                $penilaian->update($data);
            }

            DB::commit();
            return redirect()->route('penilaian.show', $penilaian->id)->with('success', 'Penilaian berjaya dikemaskini.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal mengemaskini penilaian: ' . $e->getMessage());
        }
    }

    public function destroy(Penilaian $penilaian)
    {
        $this->authorize('delete', $penilaian);
        
        $penilaian->delete();
        return redirect()->route('penilaian.index')->with('success', 'Penilaian berjaya dipadam.');
    }

    public function submitBahagianII(Penilaian $penilaian)
    {
        $this->authorize('pyd', $penilaian);
        
        $penilaian->update(['status' => 'penilaian_ppp']);
        return redirect()->route('penilaian.show', $penilaian->id)->with('success', 'Bahagian II berjaya dihantar untuk penilaian PPP.');
    }

    private function calculateTotalScore($data, $role)
    {
        $total = 0;
        
        // Bahagian III (50%)
        if (isset($data['bahagian_iii'])) {
            $scores = array_column($data['bahagian_iii'], $role);
            $average = array_sum($scores) / count($scores);
            $total += $average * 0.5;
        }
        
        // Bahagian IV (25%)
        if (isset($data['bahagian_iv'])) {
            $scores = array_column($data['bahagian_iv'], $role);
            $average = array_sum($scores) / count($scores);
            $total += $average * 0.25;
        }
        
        // Bahagian V (20%)
        if (isset($data['bahagian_v'])) {
            $scores = array_column($data['bahagian_v'], $role);
            $average = array_sum($scores) / count($scores);
            $total += $average * 0.2;
        }
        
        // Bahagian VI (5%)
        if (isset($data['bahagian_vi'])) {
            $total += $data['bahagian_vi'] * 0.05;
        }
        
        return round($total * 100); // Convert to percentage
    }
}