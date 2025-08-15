<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengeluaran;
use Illuminate\Support\Facades\Auth;
use App\Models\Donasi;
use App\Models\Pemasukan;

class PengeluaranController extends Controller
{
    public function pengeluaranIndex(Request $request)
    {

        $query = Pengeluaran::with('user')->latest();

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $pengeluaran = $query->get();

        $totalPengeluaran = $pengeluaran->sum('jumlah');

        return view('admin.pengeluaran.index', compact( 'pengeluaran', 'totalPengeluaran'));
    }

    public function pengeluaranCreate()
    {
        return view('admin.pengeluaran.create');
    }

    public function pengeluaranStore(Request $request)
    {
        $request->validate([
            'kategori'   => 'required|string|max:255',
            'sumber'   => 'required|string|max:255',
            'jumlah'     => 'required|numeric',
            'keterangan' => 'nullable|string',
        ]);

        Pengeluaran::create([
            'kategori'   => $request->kategori,
            'sumber'   => $request->sumber,
            'jumlah'     => $request->jumlah,
            'keterangan' => $request->keterangan,
            'user_id'    => Auth::id(),
        ]);

        return redirect()->route('admin.pengeluaran.index')->with('success', 'Data pengeluaran berhasil ditambahkan.');
    }

    public function pengeluaranEdit($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);

        return view('admin.pengeluaran.edit', compact( 'pengeluaran'));
    }

    public function pengeluaranUpdate(Request $request, $id)
    {
        $request->validate([
            'kategori'   => 'required|string|max:255',
            'sumber'   => 'required|string|max:255',
            'jumlah'     => 'required|numeric',
            'keterangan' => 'nullable|string',
        ]);

        $pengeluaran = Pengeluaran::findOrFail($id);

        $pengeluaran->update([
            'kategori'   => $request->kategori,
            'sumber'   => $request->sumber,
            'jumlah'     => $request->jumlah,
            'keterangan' => $request->keterangan,
            'user_id'    => Auth::id(),
        ]);

        return redirect()->route('admin.pengeluaran.index')->with('success', 'Data pengeluaran berhasil diperbarui.');
    }

    public function pengeluaranDestroy($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        $pengeluaran->delete();

        return redirect()->route('admin.pengeluaran.index')->with('success', 'Data pengeluaran berhasil dihapus.');
    }

    public function saldoIndex()
    {

        $pemasukan = Pemasukan::latest()->take(5)->get();
        $pengeluaran = Pengeluaran::latest()->take(5)->get();
        $donasi = Donasi::where('status', 'Verified')->latest()->take(5)->get();

        $totalPemasukan = $pemasukan->sum('jumlah');
        $totalPengeluaran = $pengeluaran->sum('jumlah');
        $totalDonasi = $donasi->sum('jumlah');

        $totalSaldo = $totalPemasukan + $totalDonasi - $totalPengeluaran;

        return view('admin.saldo.index', compact(
            'pemasukan',
            'pengeluaran',
            'donasi',
            'totalPemasukan',
            'totalPengeluaran',
            'totalDonasi',
            'totalSaldo'
        ));
    }
}
