<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agenda;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AgendaController extends Controller
{
    public function agendaIndex()
    {
        $title = 'Agenda';
        $agendas = Agenda::latest()->paginate(10);
        return view('admin.agenda.index', compact('agendas', 'title'));
    }

    public function agendaCreate()
    {
        $title = 'Tambah agenda';
        return view('admin.agenda.form', compact('title'));
    }

    public function agendaStore(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi_pendek' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
            'lokasi' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $slug = Str::slug($request->judul);
        $originalSlug = $slug;
        $counter = 1;
        while (Agenda::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        $gambar = null;
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('agenda', 'public');
        }

        Agenda::create([
            'judul' => $request->judul,
            'slug' => $slug,
            'gambar' => $gambar,
            'deskripsi_pendek' => $request->deskripsi_pendek,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'lokasi' => $request->lokasi,
        ]);

        return redirect()->route('admin.agenda.index')->with('success', 'Agenda berhasil ditambahkan.');
    }

    public function agendaEdit(Agenda $agenda)
    {
        $title = 'Edit agenda';
        return view('admin.agenda.form', compact('agenda', 'title'));
    }

    public function agendaUpdate(Request $request, Agenda $agenda)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi_pendek' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
            'lokasi' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $slug = Str::slug($request->judul);
        if ($slug !== $agenda->slug) {
            $originalSlug = $slug;
            $counter = 1;
            while (Agenda::where('slug', $slug)->where('id', '!=', $agenda->id)->exists()) {
                $slug = $originalSlug . '-' . $counter++;
            }
            $agenda->slug = $slug;
        }

        if ($request->hasFile('gambar')) {
            // Optional: hapus gambar lama
            if ($agenda->gambar && Storage::disk('public')->exists($agenda->gambar)) {
                Storage::disk('public')->delete($agenda->gambar);
            }

            $agenda->gambar = $request->file('gambar')->store('agenda', 'public');
        }

        $agenda->update([
            'judul' => $request->judul,
            'deskripsi_pendek' => $request->deskripsi_pendek,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'lokasi' => $request->lokasi,
        ]);

        $agenda->save();

        return redirect()->route('admin.agenda.index')->with('success', 'Agenda berhasil diupdate.');
    }


    public function agendaDestroy(Agenda $agenda)
    {
        if ($agenda->gambar && Storage::disk('public')->exists($agenda->gambar)) {
            Storage::disk('public')->delete($agenda->gambar);
        }

        $agenda->delete();

        return redirect()->route('admin.agenda.index')->with('success', 'Agenda berhasil dihapus.');
    }

    public function agendaShow(Agenda $agenda)
    {
        $title = 'Detail';
        return view('admin.agenda.show', compact('agenda', 'title'));
    }
}
