<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pupuk extends Model
{
    use HasFactory;

    protected $fillable = [
        'petani_id',
        'tanggal_distribusi',
        'jenis_pupuk',
        'kategori',
        'jumlah_sak',
        'berat_total_kg',
        'keterangan',
    ];

    public function petani()
    {
        return $this->belongsTo(Petani::class);
    }
}