<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panen extends Model
{
    use HasFactory;

    protected $fillable = [
        'lahan_id',
        'tanggal_panen',
        'berat_kg',
        'harga_per_kg',
        'total_pendapatan',
        'keterangan',
    ];

    public function lahan()
    {
        return $this->belongsTo(Lahan::class);
    }
}