<?php

// app/Models/ResepRacikan.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ResepRacikan extends Model
{
    protected $fillable = ['resep_id', 'nama_racikan', 'signa_id'];

    public function resep()
    {
        return $this->belongsTo(Resep::class);
    }

    public function signa()
    {
        return $this->belongsTo(Signa::class, 'signa_id');
    }

    public function details(): HasMany
    {
        return $this->hasMany(ResepRacikanDetail::class);
    }
}
