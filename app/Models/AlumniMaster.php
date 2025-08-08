<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumniMaster extends Model
{
    use HasFactory;

    protected $table = 'alumni_master';

    protected $fillable = [
        'nama_lengkap',
        'tahun_kelulusan',
        'tanggal_lahir',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tahun_kelulusan' => 'integer',
    ];
}
