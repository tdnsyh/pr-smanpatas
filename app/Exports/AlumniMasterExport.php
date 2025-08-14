<?php

namespace App\Exports;

use App\Models\AlumniMaster;
use Maatwebsite\Excel\Concerns\FromCollection;

class AlumniMasterExport implements FromCollection
{
    public function collection()
    {
        return AlumniMaster::select('nama_lengkap', 'tahun_kelulusan', 'tanggal_lahir')->get();
    }

    public function headings(): array
    {
        return [
            'nama_lengkap',
            'tahun_kelulusan',
            'tanggal_lahir',
        ];
    }
}
