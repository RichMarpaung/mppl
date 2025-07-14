<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalTahap extends Model
{
    /** @use HasFactory<\Database\Factories\JadwalTahapFactory> */
    use HasFactory;
      protected $guarded = [];

    public function lowongan()
    {
        return $this->belongsTo(Lowongan::class);
    }

    public function tahapLamarans()
    {
        return $this->hasMany(TahapLamaran::class);
    }
}
