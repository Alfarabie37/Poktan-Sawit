<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Petani;

class KelompokTani extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'nama_kelompok', 'desa', 'kecamatan',
        'nama_ketua', 'tahun_berdiri', 'no_hp',
        'alamat_sekretariat', 'status_verifikasi', 'catatan_admin',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function petanis()
    {
        return $this->hasMany(Petani::class);
    }
}
