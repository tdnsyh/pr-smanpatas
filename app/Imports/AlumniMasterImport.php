<?php

namespace App\Imports;

use App\Models\AlumniMaster;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AlumniMasterImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        if (empty($row['nama_lengkap'])) {
            return null; // skip baris tanpa nama
        }

        return new AlumniMaster([
            'nama_lengkap' => $row['nama_lengkap'],
            'tahun_kelulusan' => $row['tahun_kelulusan'] ?? null,
            'tanggal_lahir' => $row['tanggal_lahir'] ?? null,
        ]);
    }

}
