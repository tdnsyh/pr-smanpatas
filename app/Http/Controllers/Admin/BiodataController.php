<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AlumniPrivasi;

class BiodataController extends Controller
{
    public function biodataEdit()
    {
        // Ambil alumni berdasarkan alumni_id user yang login
        $alumni = Alumni::where('id', Auth::user()->alumni_id)
            ->with('privasi')
            ->firstOrFail();

        $privasi = $alumni->privasi->pluck('is_public', 'kolom')->toArray();

        return view('admin.biodata.edit', compact('alumni', 'privasi'));
    }

    public function biodataUpdate(Request $request)
    {
        $alumni = Alumni::where('id', Auth::user()->alumni_id)
            ->with('user')
            ->firstOrFail();

        $data = $request->validate([
            'nama_lengkap'                        => 'required|string',
            'nama_panggilan'                      => 'nullable|string',
            'tahun_kelulusan'                     => 'nullable|integer',
            'email'                               => 'nullable|email|unique:users,email,' . optional($alumni->user)->id,
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

        $privasi = $data['privasi'] ?? [];
        unset($data['privasi']);

        // Update alumni
        $alumni->update($data);

        // Update user (jika terhubung)
        if ($alumni->user) {
            $alumni->user->update([
                'name'  => $data['nama_lengkap'],
                'email' => $data['email'],
            ]);
        }

        // Update privasi
        AlumniPrivasi::where('alumni_id', $alumni->id)->delete();

        foreach ($privasi as $kolom => $isPublic) {
            AlumniPrivasi::create([
                'alumni_id' => $alumni->id,
                'kolom'     => $kolom,
                'is_public' => (bool)$isPublic,
            ]);
        }

        return redirect()->route('admin.biodata.edit')
            ->with('success', 'Biodata berhasil diperbarui.');
    }

}
