<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\AlumniMasterExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AlumniMaster;
use App\Imports\AlumniMasterImport;
use Maatwebsite\Excel\Facades\Excel;

class AlumniMasterController extends Controller
{
    public function alumnimasterIndex(Request $request)
    {
        $tahun = $request->input('tahun_kelulusan');

        $query = AlumniMaster::orderBy('nama_lengkap');

        if ($tahun) {
            $query->where('tahun_kelulusan', $tahun);
        }

        $alumnis = $query->get();

        $tahunList = AlumniMaster::select('tahun_kelulusan')
                        ->distinct()
                        ->orderBy('tahun_kelulusan', 'desc')
                        ->pluck('tahun_kelulusan');

        return view('admin.alumnimaster.index', compact('alumnis', 'tahunList', 'tahun'));
    }

    public function alumnimasterCreate()
    {
        return view('admin.alumnimaster.create');
    }

    public function alumnimasterStore(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'tahun_kelulusan' => 'required|digits:4|integer',
            'tanggal_lahir' => 'required|date',
        ]);

        AlumniMaster::create($validated);
        return redirect()->route('admin.alumnimaster.index')->with('success', 'Data alumni ditambahkan.');
    }

    public function alumnimasterEdit($id)
    {
        $alumni = AlumniMaster::findOrFail($id);
        return view('admin.alumnimaster.edit', compact('alumni'));
    }

    public function alumnimasterUpdate(Request $request, $id)
    {
        $alumni = AlumniMaster::findOrFail($id);

        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'tahun_kelulusan' => 'required|digits:4|integer',
            'tanggal_lahir' => 'required|date',
        ]);

        $alumni->update($validated);
        return redirect()->route('admin.alumnimaster.index')->with('success', 'Data alumni diperbarui.');
    }

    public function alumnimasterDestroy($id)
    {
        $alumni = AlumniMaster::findOrFail($id);
        $alumni->delete();

        return redirect()->route('admin.alumnimaster.index')->with('success', 'Data alumni dihapus.');
    }

    public function alumniMasterImport()
    {
        return view('admin.alumnimaster.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(new AlumniMasterImport, $request->file('file'));

        return redirect()->route('admin.alumnimaster.index')->with('success', 'Data alumni berhasil diimport!');
    }

    public function export()
    {
        return Excel::download(new AlumniMasterExport, 'alumni_master.xlsx');
    }
}
