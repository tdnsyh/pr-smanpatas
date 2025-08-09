<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function beritaIndex()
    {
        $title = 'Berita';
        $beritas = Berita::latest()->paginate(10);
        return view('admin.berita.index', compact('beritas', 'title'));
    }

    public function beritaCreate()
    {
        $title = 'Tambah Berita';

        return view('admin.berita.create', compact('title'));
    }

    public function beritaStore(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
            'penulis' => 'required|string|max:100',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['judul']);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        Berita::create($validated);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan');
    }

    public function beritaEdit($slug)
    {
        $title = 'Edit Berita';

        $berita = Berita::where('slug', $slug)->firstOrFail();
        return view('admin.berita.edit', compact('berita', 'title'));
    }

    public function beritaUpdate(Request $request, $slug)
    {
        $berita = Berita::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
            'penulis' => 'required|string|max:100',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['judul']);

        if ($request->hasFile('gambar')) {
            if ($berita->gambar) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        $berita->update($validated);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui');
    }

    public function beritaDestroy($slug)
    {
        $berita = Berita::where('slug', $slug)->firstOrFail();

        if ($berita->gambar) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $berita->delete();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus');
    }
}
