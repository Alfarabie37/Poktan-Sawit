<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Petani;

class Pupuk extends Model
{
    use HasFactory;

    protected $fillable = [
        'petani_id',
        'tanggal_distribusi',
        'jenis_pupuk',
        'kategori',
        'jumlah_sak',
        'total_berat_kg',
    ];

    public function petani()
    {
        return $this->belongsTo(Petani::class);
    }
}
