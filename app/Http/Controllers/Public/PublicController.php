<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\AlumniMaster;
use Illuminate\Http\Request;
use App\Models\Alumni;
use App\Models\AlumniPrivasi;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PublicController extends Controller
{
    public function cekForm()
    {
        return view('public.alumni.cek');
    }

    public function cekData(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string',
            'tahun_kelulusan' => 'required|integer',
            'tanggal_lahir' => 'required|date',
        ]);

        $data = AlumniMaster::where('nama_lengkap', $request->nama_lengkap)
            ->where('tahun_kelulusan', $request->tahun_kelulusan)
            ->where('tanggal_lahir', $request->tanggal_lahir)
            ->first();

        if (!$data) {
            return back()->withErrors(['Data tidak ditemukan di database alumni.']);
        }

        // Tampilkan form lanjutan
        return view('public.alumni.form', [
            'alumni_master' => $data
        ]);
    }

    public function simpanAlumni(Request $request)
    {
        $data = $request->validate([
            'nama_lengkap'                        => 'required|string',
            'nama_panggilan'                      => 'nullable|string',
            'tahun_kelulusan'                     => 'nullable|integer',
            'email'                               => 'required|email|unique:users,email',
            'no_wa'                               => 'nullable|string',
            'alamat_saat_ini'                     => 'nullable|string',
            'jenjang_pendidikan_terakhir'         => 'nullable|string',
            'nama_institusi_pendidikan_terakhir'  => 'nullable|string',
            'program_studi'                       => 'nullable|string',
            'pekerjaan_saat_ini'                  => 'nullable|string',
            'nama_instansi'                       => 'nullable|string',
            'jabatan'                             => 'nullable|string',
            'lokasi_tempat_bekerja'               => 'nullable|string',
            'privasi'                             => 'array',
        ]);

        // =====================
        // 1. Generate NIA
        // =====================
        $tahun = $data['tahun_kelulusan'] ?? now()->year;
        do {
            $randomDigits = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
            $nia = $tahun . $randomDigits;
        } while (Alumni::where('nia', $nia)->exists());

        $data['nia'] = $nia;

        // =====================
        // 2. Simpan ke alumni
        // =====================
        $alumni = Alumni::create([
            'id' => Str::uuid(),
            ...$data,
        ]);

        // =====================
        // 3. Simpan privasi
        // =====================
        $privasi = $data['privasi'] ?? [];
        foreach ($privasi as $kolom => $isPublic) {
            AlumniPrivasi::create([
                'alumni_id' => $alumni->id,
                'kolom'     => $kolom,
                'is_public' => (bool)$isPublic,
            ]);
        }

        // =====================
        // 4. Simpan ke users
        // =====================
        User::create([
            'name'       => $data['nama_lengkap'],
            'email'      => $data['email'],
            'password'   => Hash::make($nia), // password = NIA
            'role'       => 'alumni',
            'alumni_id'  => $alumni->id,      // optional, jika kolom tersedia
        ]);

        // =====================
        // 5. Redirect dengan info login
        // =====================
        return redirect()->route('alumni.cekform')->with('success', "Pendaftaran berhasil. Silakan login dengan:<br><strong>Email:</strong> {$data['email']}<br><strong>Password (NIA):</strong> {$nia}");
    }
}
