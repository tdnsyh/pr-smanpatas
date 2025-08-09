<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Galeri extends Model
{
    use HasFactory;

    protected $table = 'galeri';

    protected $fillable = ['judul', 'deskripsi', 'tanggal'];

    public function galeriFoto()
    {
        return $this->hasMany(GaleriFoto::class);
    }
}
