<?php
namespace App\Http\Controllers;

use App\Models\ResepRacikan;
use Illuminate\Http\Request;

class RacikanController
{
    public function index(Request $request)
    {
        $query = ResepRacikan::with(['signa', 'details.obat', 'resep']);

        if ($request->filled('search')) {
            $query->where('nama_racikan', 'like', '%' . $request->search . '%');
        }

        $data = $query->latest()->paginate(10)->withQueryString();

        return view('pages.racikan', compact('data')); // <== DIKIRIMKAN DI SINI
    }

    public function show($id)
    {
    
        $racikan = ResepRacikan::with(['signa', 'details.obat'])->findOrFail($id);

        return response()->json($racikan);
    }
    public function cetak($id)
    {
        $racikan = ResepRacikan::with(['signa', 'details.obat'])->findOrFail($id);

        return view('print.cetakResep', compact('racikan'));
    }

}
