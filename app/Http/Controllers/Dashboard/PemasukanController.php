<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Pemasukan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemasukanController extends Controller
{
    public function pemasukanIndex(Request $request)
    {

        $query = Pemasukan::with('user')->latest();

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $pemasukan = $query->get();

        $totalPemasukan = $pemasukan->sum('jumlah');

        return view('admin.pemasukan.index', compact('pemasukan', 'totalPemasukan'));
    }

    public function pemasukanCreate()
    {
        return view('admin.pemasukan.create');
    }

    public function pemasukanStore(Request $request)
    {
        $request->validate([
            'kategori' => 'required|string|max:255',
            'sumber' => 'required|string|max:255',
            'jumlah' => 'required|numeric',
            'keterangan' => 'nullable|string',
        ]);

        Pemasukan::create([
            'kategori' => $request->kategori,
            'sumber' => $request->sumber,
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('admin.pemasukan.index')->with('success', 'Data pemasukan berhasil ditambahkan.');
    }

    public function pemasukanEdit($id)
    {
        $pemasukan = Pemasukan::findOrFail($id);

        return view('admin.pemasukan.edit', compact('pemasukan'));
    }

    public function pemasukanUpdate(Request $request, $id)
    {
        $request->validate([
            'kategori' => 'required|string|max:255',
            'sumber' => 'required|string|max:255',
            'jumlah' => 'required|numeric',
            'keterangan' => 'nullable|string',
        ]);

        $pemasukan = Pemasukan::findOrFail($id);
        $pemasukan->update([
            'kategori' => $request->kategori,
            'sumber' => $request->sumber,
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('admin.pemasukan.index')->with('success', 'Data pemasukan berhasil diperbarui.');
    }

    public function pemasukanDestroy($id)
    {
        $pemasukan = Pemasukan::findOrFail($id);
        $pemasukan->delete();

        return redirect()->route('admin.pemasukan.index')->with('success', 'Data pemasukan berhasil dihapus.');
    }
}
