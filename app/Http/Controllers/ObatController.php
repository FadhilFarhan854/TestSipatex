<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obatalkes;

class ObatController 
{
    public function index()
    {
        return response()->json(Obatalkes::orderBy('obatalkes_nama')->get());
    }
    public function obat(Request $request)
    {
        $keyword = $request->input('search');

        $data = Obatalkes::when($keyword, function ($query, $keyword) {
            return $query->where('obatalkes_nama', 'like', "%{$keyword}%")
                        ->orWhere('obatalkes_kode', 'like', "%{$keyword}%");
        })
        ->orderBy('obatalkes_nama')
        ->paginate(10);

        return view('pages.masterobat', compact('data', 'keyword'));
    }




}