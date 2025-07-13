<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Signa;

class SignaController 
{
    public function index()
    {
        return response()->json(Signa::orderBy('signa_nama')->get());
    }
    public function signa(Request $request)
    {
        $keyword = $request->input('search');

        $data = Signa::when($keyword, function ($query, $keyword) {
            return $query->where('signa_kode', 'like', "%{$keyword}%");
        })
        ->orderBy('signa_kode')
        ->paginate(10);

        return view('pages.mastersigna', compact('data', 'keyword'));
    }

}