<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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