<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AlumniMaster;

class AlumniMasterController extends Controller
{
    public function alumnimasterIndex()
    {
        $alumnis = AlumniMaster::orderBy('nama_lengkap')->get();
        return view('admin.alumnimaster.index', compact('alumnis'));
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
}
