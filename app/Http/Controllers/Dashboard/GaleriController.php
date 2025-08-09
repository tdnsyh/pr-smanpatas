<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Galeri;
use App\Models\GaleriFoto;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function galeriIndex()
    {
        $galeriList = Galeri::withCount('galeriFoto')->latest()->get();
        return view('admin.galeri.index', compact( 'galeriList'));
    }

    public function galeriCreate()
    {
        return view('admin.galeri.create');
    }

    public function galeriStore(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
            'gambar.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $galeri = Galeri::create($request->only('judul', 'deskripsi', 'tanggal'));

        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                $path = $file->store('galeri', 'public');
                GaleriFoto::create([
                    'galeri_id' => $galeri->id,
                    'gambar' => $path,
                ]);
            }
        }

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil ditambahkan!');
    }

    public function galeriEdit(Galeri $galeri)
    {
        $galeri->load('galeriFoto');
        return view('admin.galeri.edit', compact('galeri'));
    }

    public function galeriUpdate(Request $request, Galeri $galeri)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
            'gambar.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $galeri->update($request->only('judul', 'deskripsi', 'tanggal'));

        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                $path = $file->store('galeri', 'public');
                GaleriFoto::create([
                    'galeri_id' => $galeri->id,
                    'gambar' => $path,
                ]);
            }
        }

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil diperbarui!');
    }

    public function galeriShow(Galeri $galeri)
    {
        $galeri->load('galeriFoto');
        return view('admin.galeri.show', compact('galeri'));
    }

    public function galeriFotoDestroy(GaleriFoto $foto)
    {
        $path = str_replace('storage/', '', $foto->gambar);

        if ($foto->gambar && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }

        $foto->delete();

        return back()->with('success', 'Foto berhasil dihapus.');
    }

    public function galeriDestroy(Galeri $galeri)
    {
        foreach ($galeri->galeriFoto as $foto) {
            $path = str_replace('storage/', '', $foto->gambar);

            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }

            $foto->delete();
        }

        $galeri->delete();

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil dihapus.');
    }
}
