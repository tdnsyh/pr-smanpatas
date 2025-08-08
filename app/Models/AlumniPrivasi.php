<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumniPrivasi extends Model
{
    use HasFactory;
    protected $table = 'alumni_privasi';

    protected $fillable = [
        'alumni_id', 'kolom', 'is_public',
    ];

    public function alumni()
    {
        return $this->belongsTo(Alumni::class);
    }
}
