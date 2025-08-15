<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Alumni;

class DashboardController extends Controller
{
    public function dashboardOperator()
    {
        // Statistik Umum
        $totalPemasukan = DB::table('pemasukan')->sum('jumlah');
        $totalPengeluaran = DB::table('pengeluaran')->sum('jumlah');
        $saldoKas = $totalPemasukan - $totalPengeluaran;

        $totalDonasi = DB::table('donasi')->where('status', 'Verified')->sum('jumlah');
        $donasiPending = DB::table('donasi')->where('status', 'Pending')->count();

        $pemasukan = DB::table('pemasukan')
            ->select(DB::raw("MONTH(created_at) as bulan"), DB::raw("SUM(jumlah) as total"))
            ->groupBy('bulan')
            ->get();

        $pengeluaran = DB::table('pengeluaran')
            ->select(DB::raw("MONTH(created_at) as bulan"), DB::raw("SUM(jumlah) as total"))
            ->groupBy('bulan')
            ->get();

        $totalCampaign = DB::table('campaign')->where('status', 'Aktif')->count();
        $totalAgenda = DB::table('agenda')->count();
        $totalBerita = DB::table('berita')->count();
        $totalGaleri = DB::table('galeri')->count();
        $totalFoto = DB::table('galeri_foto')->count();

        $totalAlumni = DB::table('alumni')->count();
        $alumniBekerja = Alumni::whereNotNull('pekerjaan_saat_ini')->count();

        $alumniKuliah = Alumni::whereNotNull('nama_institusi_pendidikan_terakhir')->count();

        $topInstitusi = Alumni::select('nama_institusi_pendidikan_terakhir', DB::raw('count(*) as total'))
            ->whereNotNull('nama_institusi_pendidikan_terakhir')
            ->groupBy('nama_institusi_pendidikan_terakhir')
            ->orderByDesc('total')
            ->first();

        $lulusanTerbanyak = Alumni::select('tahun_kelulusan', DB::raw('count(*) as total'))
            ->whereNotNull('tahun_kelulusan')
            ->groupBy('tahun_kelulusan')
            ->orderByDesc('total')
            ->first();

        $pekerjaanPopuler = Alumni::select('pekerjaan_saat_ini', DB::raw('count(*) as total'))
            ->whereNotNull('pekerjaan_saat_ini')
            ->groupBy('pekerjaan_saat_ini')
            ->orderByDesc('total')
            ->first();

        $pendidikan = DB::table('alumni')
            ->select('jenjang_pendidikan_terakhir', DB::raw('COUNT(*) as total'))
            ->groupBy('jenjang_pendidikan_terakhir')
            ->get();

        $pekerjaan = DB::table('alumni')
            ->select('pekerjaan_saat_ini', DB::raw('COUNT(*) as total'))
            ->groupBy('pekerjaan_saat_ini')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();

        $tahunKelulusan = DB::table('alumni')
            ->select('tahun_kelulusan', DB::raw('COUNT(*) as total'))
            ->whereNotNull('tahun_kelulusan')
            ->groupBy('tahun_kelulusan')
            ->orderBy('tahun_kelulusan')
            ->get();

        return view('admin.dashboard.operator', compact(
            'totalPemasukan',
            'totalPengeluaran',
            'saldoKas',
            'totalDonasi',
            'donasiPending',
            'totalCampaign',
            'totalAgenda',
            'totalBerita',
            'totalAlumni',
            'totalGaleri',
            'totalFoto',
            'alumniBekerja',
            'alumniKuliah',
            'topInstitusi',
            'lulusanTerbanyak',
            'pekerjaanPopuler',
            'pemasukan',
            'pengeluaran',
            'pendidikan',
            'pekerjaan',
            'tahunKelulusan',
        ));
    }

    public function dashboardBendahara()
    {
        return view("admin.dashboard.bendahara");
    }

    public function dashboardAlumni()
    {
        return view("admin.dashboard.alumni");
    }

    public function dashboardKehormatan()
    {
        return view("admin.dashboard.kehormatan");
    }

    public function dashboardMedia()
    {
        return view("admin.dashboard.media");
    }

    public function dashboardSekretaris()
    {
        return view("admin.dashboard.sekretaris");
    }
}
