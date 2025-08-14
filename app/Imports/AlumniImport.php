<?php

namespace App\Imports;
use App\Models\Alumni;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AlumniImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Skip jika nama lengkap kosong
        if (empty($row['nama_lengkap'])) {
            return null;
        }

        // =====================
        // Generate NIA jika kosong
        if (empty($row['nia'])) {
            $tahun = $row['tahun_kelulusan'] ?? now()->year;
            do {
                $randomDigits = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
                $nia = $tahun . $randomDigits;
            } while (Alumni::where('nia', $nia)->exists());
        } else {
            $nia = $row['nia'];
        }

        // Generate Email jika kosong
        if (empty($row['email'])) {
            $slugName = Str::slug($row['nama_lengkap'], '.');
            $email = strtolower($slugName) . '@ika-smanpatas.com';
        } else {
            $email = $row['email'];
        }

        // Simpan alumni
        $alumni = Alumni::create([
            'id' => Str::uuid(),
            'nia' => $nia,
            'nama_lengkap' => $row['nama_lengkap'],
            'nama_panggilan' => $row['nama_panggilan'] ?? null,
            'tahun_kelulusan' => $row['tahun_kelulusan'] ?? null,
            'email' => $email,
            'no_wa' => $row['no_wa'] ?? null,
            'alamat_saat_ini' => $row['alamat_saat_ini'] ?? null,
            'jenjang_pendidikan_terakhir' => $row['jenjang_pendidikan_terakhir'] ?? null,
            'nama_institusi_pendidikan_terakhir' => $row['nama_institusi_pendidikan_terakhir'] ?? null,
            'program_studi' => $row['program_studi'] ?? null,
            'pekerjaan_saat_ini' => $row['pekerjaan_saat_ini'] ?? null,
            'nama_instansi' => $row['nama_instansi'] ?? null,
            'jabatan' => $row['jabatan'] ?? null,
            'lokasi_tempat_bekerja' => $row['lokasi_tempat_bekerja'] ?? null,
        ]);

        // Simpan user
        User::create([
            'name'       => $row['nama_lengkap'],
            'email'      => $email,
            'password'   => Hash::make($nia),
            'role'       => 'alumni',
            'alumni_id'  => $alumni->id,
        ]);

        return $alumni;
    }
}
