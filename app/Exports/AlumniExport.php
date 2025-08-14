<?php

namespace App\Exports;

use App\Models\Alumni;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AlumniExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Alumni::select(
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
            'created_at',
            'updated_at'
        )->orderBy('tahun_kelulusan')->get();
    }

    public function headings(): array
    {
        return [
            'NIA',
            'Nama Lengkap',
            'Nama Panggilan',
            'Tahun Kelulusan',
            'Email',
            'No WA',
            'Alamat Saat Ini',
            'Jenjang Pendidikan Terakhir',
            'Nama Institusi Pendidikan Terakhir',
            'Program Studi',
            'Pekerjaan Saat Ini',
            'Nama Instansi',
            'Jabatan',
            'Lokasi Tempat Bekerja',
            'Dibuat',
            'Diupdate'
        ];
    }
}
