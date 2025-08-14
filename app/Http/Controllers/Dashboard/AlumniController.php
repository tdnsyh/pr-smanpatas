<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\AlumniExport;
use App\Http\Controllers\Controller;
use App\Imports\AlumniImport;
use Illuminate\Http\Request;
use App\Models\Alumni;
use App\Models\AlumniPrivasi;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class AlumniController extends Controller
{
    public function alumniIndex(Request $request)
    {
        $tahun = $request->input('tahun_kelulusan');
        $pekerjaan = $request->input('pekerjaan_saat_ini');
        $pendidikan = $request->input('jenjang_pendidikan_terakhir');

        $query = Alumni::orderBy('nama_lengkap');

        if ($tahun) {
            $query->where('tahun_kelulusan', $tahun);
        }

        if ($pekerjaan) {
            $query->where('pekerjaan_saat_ini', $pekerjaan);
        }

        if ($pendidikan) {
            $query->where('jenjang_pendidikan_terakhir', $pendidikan);
        }

        $alumnis = $query->get();

        $tahunList = Alumni::select('tahun_kelulusan')->distinct()->orderBy('tahun_kelulusan', 'desc')->pluck('tahun_kelulusan');
        $pekerjaanList = Alumni::select('pekerjaan_saat_ini')->whereNotNull('pekerjaan_saat_ini')->distinct()->orderBy('pekerjaan_saat_ini')->pluck('pekerjaan_saat_ini');
        $pendidikanList = Alumni::select('jenjang_pendidikan_terakhir')->whereNotNull('jenjang_pendidikan_terakhir')->distinct()->orderBy('jenjang_pendidikan_terakhir')->pluck('jenjang_pendidikan_terakhir');

        return view('admin.alumni.index', compact('alumnis', 'tahunList', 'pekerjaanList', 'pendidikanList', 'tahun', 'pekerjaan', 'pendidikan'));
    }

    public function alumniCreate()
    {
        return view('admin.alumni.create');
    }

    public function alumniStore(Request $request)
    {
        $data = $request->validate([
            'nama_lengkap'                        => 'required|string',
            'nama_panggilan'                      => 'nullable|string',
            'tahun_kelulusan'                     => 'nullable|integer',
            'email'                               => 'nullable|email',
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
        // 1.1 Generate Email jika kosong
        // =====================
        if (empty($data['email'])) {
            $slugName = Str::slug($data['nama_lengkap'], '.');
            $data['email'] = strtolower($slugName) . '@ika-smanpatas.com';
        }

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
            'password'   => Hash::make($nia),
            'role'       => 'alumni',
            'alumni_id'  => $alumni->id,
        ]);

        return redirect()->route('admin.alumni.index')
            ->with('success', 'Alumni berhasil ditambahkan.');
    }

    public function alumniEdit(Alumni $alumni)
    {
        $privasi = $alumni->privasi->pluck('is_public', 'kolom')->toArray();
        return view('admin.alumni.edit', compact('alumni', 'privasi'));
    }

    public function alumniUpdate(Request $request, Alumni $alumni)
    {
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

        return redirect()->route('admin.alumni.index')
            ->with('success', 'Data alumni berhasil diperbarui.');
    }

    public function alumniShow(Alumni $alumni)
    {
        $alumni->load('privasi');
        $title = 'Detail alumni';
        $privasi = $alumni->privasi->pluck('is_public', 'kolom')->toArray();

        return view('admin.alumni.show', compact('alumni', 'privasi', 'title'));
    }

    public function alumniDestroy(Alumni $alumni)
    {
        $alumni->delete();
        return redirect()->route('admin.alumni.index')->with('success', 'Alumni berhasil dihapus.');
    }

    public function alumniImport()
    {
        return view('admin.alumni.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(new AlumniImport, $request->file('file'));

        return redirect()->route('admin.alumni.index')->with('success', 'Data alumni berhasil diimport!');
    }

    public function export()
    {
        return Excel::download(new AlumniExport, 'data_alumni.xlsx');
    }
}
