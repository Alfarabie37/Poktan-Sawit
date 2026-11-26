<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Petani;
use App\Models\Panen;

class Lahan extends Model
{
    use HasFactory;

    protected $fillable = [
        'petani_id',
        'kode_lahan',
        'lokasi',
        'luas_hektar',
        'jenis_bibit',
        'tahun_tanam',
        'status_legalitas',
    ];

    public function petani()
    {
        return $this->belongsTo(Petani::class);
    }

    public function panens()
    {
        return $this->hasMany(Panen::class);
    }
}
