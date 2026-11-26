<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\KelompokTani;
use App\Models\Lahan;
use App\Models\Pupuk;

class Petani extends Model
{
    use HasFactory;

    protected $fillable = [
        'kelompok_tani_id',
        'nik',
        'nama_petani',
        'jabatan',
        'no_hp',
        'alamat',
        'tanggal_bergabung',
    ];

    public function kelompokTani()
    {
        return $this->belongsTo(KelompokTani::class);
    }

    public function lahans()
    {
        return $this->hasMany(Lahan::class);
    }

    public function pupuks()
    {
        return $this->hasMany(Pupuk::class);
    }
}
