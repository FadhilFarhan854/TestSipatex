<?php

// app/Models/Resep.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Resep extends Model
{
    protected $fillable = ['created_at']; // Tidak perlu nama_pasien

    public function resepObats()
    {
        return $this->hasMany(ResepObat::class);
    }

    public function resepRacikans()
    {
        return $this->hasMany(ResepRacikan::class);
    }
    public function racikans()
    {
        return $this->hasMany(ResepRacikan::class);
    }
}
