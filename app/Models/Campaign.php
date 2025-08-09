<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Campaign extends Model
{
    use HasFactory;

    protected $table = 'campaign';

    protected $fillable = [
        'judul',
        'slug',
        'gambar',
        'deskripsi',
        'target_donasi',
        'status'
    ];

    public function donasi()
    {
        return $this->hasMany(Donasi::class);
    }
    public function doa()
    {
        return $this->hasMany(Doa::class);
    }
}
