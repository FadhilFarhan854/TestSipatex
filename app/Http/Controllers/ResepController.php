<?php
namespace App\Http\Controllers;

use App\Models\Obatalkes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Signa;
use App\Models\Resep;
use App\Models\ResepObat;
use App\Models\ResepRacikan;
use App\Models\ResepRacikanDetail;

class ResepController 
{
    public function create()
    {
        $obatList = Obatalkes::where('stok', '>', 0)->get();
        $signaList = Signa::all();

        return view('pages.resep_input', compact('obatList', 'signaList'));
    }

public function store(Request $request)
{
    \Log::info('Masuk ke method store()');
    \Log::info('Request data:', $request->all());

    DB::beginTransaction();

    try {
       
        $resep = Resep::create([
            'created_at' => now(),
        ]);
        \Log::info('Resep berhasil dibuat', ['resep_id' => $resep->id]);

      
        if ($request->has('submit_non_racikan')) {
            \Log::info('Submit non racikan terdeteksi');

            $non = $request->input('non_racikan');
            \Log::info('Data non racikan:', $non);

            
            if (!$non['obatalkes_id'] || !$non['signa_id'] || !$non['qty']) {
                throw new \Exception('Data non racikan tidak lengkap');
            }

          
            ResepObat::create([
                'resep_id' => $resep->id,
                'obatalkes_id' => $non['obatalkes_id'],
                'signa_id' => $non['signa_id'],
                'qty' => $non['qty'],
            ]);

           
            Obatalkes::where('obatalkes_id', $non['obatalkes_id'])->decrement('stok', $non['qty']);

            \Log::info('Non racikan berhasil disimpan dan stok dikurangi');
        }

        if ($request->has('submit_racikan')) {
            \Log::info('Submit racikan terdeteksi');

            $racikan = $request->input('racikan');
            \Log::info('Data racikan:', $racikan);

            if (empty($racikan['nama']) || empty($racikan['signa_id']) || empty($racikan['detail'])) {
                throw new \Exception('Data racikan tidak lengkap');
            }

            
            $racik = ResepRacikan::create([
                'resep_id' => $resep->id,
                'nama_racikan' => $racikan['nama'], 
                'signa_id' => $racikan['signa_id'],
            ]);
            \Log::info('Racikan berhasil dibuat', ['racikan_id' => $racik->id]);

            
            foreach ($racikan['detail'] as $index => $bahan) {
                \Log::info("Bahan racikan ke-$index:", $bahan);

                if (!$bahan['obatalkes_id'] || !$bahan['qty']) {
                    throw new \Exception("Data bahan ke-$index tidak lengkap");
                }

                ResepRacikanDetail::create([
                    'resep_racikan_id' => $racik->id,
                    'obatalkes_id' => $bahan['obatalkes_id'],
                    'qty' => $bahan['qty'],
                ]);

                Obatalkes::where('obatalkes_id', $bahan['obatalkes_id'])->decrement('stok', $bahan['qty']);
            }

            \Log::info('Semua bahan racikan berhasil disimpan');
        }

        DB::commit();
        \Log::info('Transaksi berhasil disimpan');

        return redirect()->back()->with('success', 'Resep berhasil disimpan.');
    } catch (\Exception $e) {
        DB::rollBack();
        \Log::error('Gagal menyimpan resep:', ['error' => $e->getMessage()]);
        return redirect()->back()->with('error', 'Gagal menyimpan resep: ' . $e->getMessage());
    }
}

}
