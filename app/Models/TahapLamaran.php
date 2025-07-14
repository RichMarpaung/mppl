<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahapLamaran extends Model
{
    /** @use HasFactory<\Database\Factories\TahapLamaranFactory> */
    use HasFactory;
    protected $guarded = [];

    public function pelamar()
    {
        return $this->belongsTo(Pelamar::class);
    }

    public function jadwalTahap()
    {
        return $this->belongsTo(JadwalTahap::class);
    }
}
