<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doa extends Model
{
    use HasFactory;

    protected $table = 'doa';

    protected $fillable = [
        'campaign_id',
        'nama',
        'isi'
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
