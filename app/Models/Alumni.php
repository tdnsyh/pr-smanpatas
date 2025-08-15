<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $table = 'alumni';
    protected array $defaultPublik = ['nama_lengkap', 'tahun_kelulusan', 'nama_panggilan'];

    protected $fillable = [
        'nia',
        'nama_lengkap',
        'nama_panggilan',
        'tahun_kelulusan',
        'email',
        'no_wa',
        'alamat_saat_ini',
        'jenjang_pendidikan_terakhir',
        'nama_institusi_pendidikan_terakhir',
        'program_studi',
        'pekerjaan_saat_ini',
        'nama_instansi',
        'jabatan',
        'lokasi_tempat_bekerja',
        'avatar'
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function donasi()
    {
        return $this->hasManyThrough(
            Donasi::class,
            User::class,
            'alumni_id',
            'user_id',
            'id',
            'id'
        );
    }

    public function privasi()
    {
        return $this->hasMany(AlumniPrivasi::class);
    }

    public function getDataPublikAttribute(): array
    {
        $privasi = $this->privasi ? $this->privasi->pluck('is_public', 'kolom') : collect();

        $dataPublik = [];

        foreach ($this->getAttributes() as $kolom => $nilai) {
            $bolehTampil = $privasi[$kolom] ?? in_array($kolom, $this->defaultPublik);
            if ($bolehTampil) {
                $dataPublik[$kolom] = $nilai;
            }
        }

        return $dataPublik;
    }
}
