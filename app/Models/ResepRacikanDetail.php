<?php

// app/Models/ResepRacikanDetail.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResepRacikanDetail extends Model
{
    protected $fillable = ['resep_racikan_id', 'obatalkes_id', 'signa_id', 'qty'];

    public function racikan()
    {
        return $this->belongsTo(ResepRacikan::class, 'resep_racikan_id');
    }

    public function obat()
    {
        return $this->belongsTo(Obatalkes::class, 'obatalkes_id');
    }
}
