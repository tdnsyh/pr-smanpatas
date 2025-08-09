<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GaleriFoto extends Model
{
    use HasFactory;

    protected $table = 'galeri_foto';

    protected $fillable = ['galeri_id', 'gambar'];

    public function galeri()
    {
        return $this->belongsTo(Galeri::class);
    }
}
