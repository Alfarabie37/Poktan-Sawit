<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petani extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik',
        'nama_petani',
        'no_hp',
        'alamat',
        'luas_lahan',
    ];
}