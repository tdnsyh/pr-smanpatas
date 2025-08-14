<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\AlumniMaster;
use Illuminate\Http\Request;
use App\Models\Alumni;
use App\Models\AlumniPrivasi;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\GaleriFoto;
use App\Models\Campaign;
use App\Models\Agenda;
use App\Models\Berita;
use Illuminate\Support\Facades\DB;
use App\Models\Donasi;
use App\Models\Galeri;
use App\Models\Doa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PublicController extends Controller
{
    protected $totalAlumni;
    protected $pendidikanTerbanyak;
    protected $pekerjaanTerbanyak;
    protected $tahunTerbanyak;
    protected $lokasiAlumni;
    protected $lokasiTerbanyak;
    protected $fotos;
    protected $campaigns;
    protected $agendas;
    protected $beritaTerbaru;
    protected $suaraAlumni;

    public function __construct()
    {
        // Inisialisasi satu kali
        $this->totalAlumni = Alumni::count();

        $this->pendidikanTerbanyak = Alumni::select('jenjang_pendidikan_terakhir')
            ->whereNotNull('jenjang_pendidikan_terakhir')
            ->groupBy('jenjang_pendidikan_terakhir')
            ->selectRaw('jenjang_pendidikan_terakhir, COUNT(*) as jumlah')
            ->orderByDesc('jumlah')
            ->first();

        $this->pekerjaanTerbanyak = Alumni::select('pekerjaan_saat_ini')
            ->whereNotNull('pekerjaan_saat_ini')
            ->groupBy('pekerjaan_saat_ini')
            ->selectRaw('pekerjaan_saat_ini, COUNT(*) as jumlah')
            ->orderByDesc('jumlah')
            ->first();

        $this->tahunTerbanyak = Alumni::select('tahun_kelulusan')
            ->whereNotNull('tahun_kelulusan')
            ->groupBy('tahun_kelulusan')
            ->selectRaw('tahun_kelulusan, COUNT(*) as jumlah')
            ->orderByDesc('jumlah')
            ->first();

        $this->lokasiAlumni = Alumni::whereNotNull('lokasi_tempat_bekerja')
            ->select('lokasi_tempat_bekerja')
            ->distinct()
            ->pluck('lokasi_tempat_bekerja');

        $this->lokasiTerbanyak = DB::table('alumni')
            ->whereNotNull('lokasi_tempat_bekerja')
            ->select('lokasi_tempat_bekerja', DB::raw('count(*) as jumlah'))
            ->groupBy('lokasi_tempat_bekerja')
            ->orderByDesc('jumlah')
            ->limit(3)
            ->get();

        $this->fotos = GaleriFoto::latest()->take(10)->get();

        $this->campaigns = Campaign::where('status', 'Aktif')
            ->with('donasi')
            ->latest()
            ->take(4)
            ->get()
            ->map(function ($c) {
                $terkumpul = $c->donasi->sum('jumlah');
                $persen = $c->target_donasi > 0 ? min(100, round($terkumpul / $c->target_donasi * 100)) : 0;

                return (object)[
                    'id' => $c->id,
                    'judul' => $c->judul,
                    'slug' => $c->slug,
                    'gambar' => $c->gambar,
                    'target' => $c->target_donasi,
                    'terkumpul' => $terkumpul,
                    'persen' => $persen,
                ];
            });

        $this->agendas = Agenda::latest()->take(3)->get();
        $this->beritaTerbaru = Berita::latest()->take(5)->get();
    }

    public function index()
    {
        return view('public.index', [
            'totalAlumni' => $this->totalAlumni,
            'pendidikanTerbanyak' => $this->pendidikanTerbanyak,
            'pekerjaanTerbanyak' => $this->pekerjaanTerbanyak,
            'tahunTerbanyak' => $this->tahunTerbanyak,
            'lokasiAlumni' => $this->lokasiAlumni,
            'fotos' => $this->fotos,
            'campaigns' => $this->campaigns,
            'agendas' => $this->agendas,
            'beritaTerbaru' => $this->beritaTerbaru,
            'suaraAlumni' => $this->suaraAlumni,
        ]);
    }

    public function agendaIndex()
    {
        $agendas = Agenda::orderBy('tanggal', 'asc')->get();

        return view('public.agenda.index', compact('agendas'));
    }

    public function agendaShow($slug)
    {
        $agenda = Agenda::where('slug', $slug)->firstOrFail();

        $agendaLainnya = Agenda::where('id', '!=', $agenda->id)
                                ->latest()
                                ->take(5)
                                ->get();

        return view('public.agenda.show', compact('agenda', 'agendaLainnya'));
    }

    public function alumniIndex(Request $request)
    {
        $alumnis = collect();

        if ($request->filled(['search'])) {
            $search = $request->search;

            $alumnis = AlumniMaster::where(function ($query) use ($search) {
                $query->where('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('tahun_kelulusan', 'like', "%{$search}%");
                })
                ->get();

            foreach ($alumnis as $alumni) {
                $alumni->visible_data = $alumni->data_publik;
            }
        }

        return view('public.alumni.index', [
            'alumnis' => $alumnis,
            'totalAlumni' => $this->totalAlumni,
            'pendidikanTerbanyak' => $this->pendidikanTerbanyak,
            'pekerjaanTerbanyak' => $this->pekerjaanTerbanyak,
            'tahunTerbanyak' => $this->tahunTerbanyak,
        ]);
    }

    public function alumniShow($id)
    {
        if (ctype_digit($id)) {
            $master = AlumniMaster::findOrFail($id);

            $alumni = Alumni::with('privasi')
                ->where('nama_lengkap', $master->nama_lengkap)
                ->where('tahun_kelulusan', $master->tahun_kelulusan)
                ->first();

            if (!$alumni) {
                $alumni = $master;
                $alumni->is_basic_data = true;
            }
        } else {
            $alumni = Alumni::with('privasi')->findOrFail($id);
        }

        return view('public.alumni.show', compact('alumni'));
    }

    public function donasiIndex()
    {
        $highlightedIds = Campaign::where('kategori', '!=', 'Lainnya')->latest()->pluck('id');
        $highlighted = Campaign::whereIn('id', $highlightedIds)->get();
        $all = Campaign::where('kategori', 'Lainnya')->whereNotIn('id', $highlightedIds)->latest()->get();

        return view('public.campaign.index', compact('highlighted', 'all'));
    }

    public function donasiCreate(Campaign $campaign)
    {
        return view('public.campaign.form', compact('campaign'));
    }

    public function donasiShow($slug)
    {
        $campaign = Campaign::where('slug', $slug)->first();

        if (!$campaign) {
            abort(404);
        }

        $campaignLainnya = Campaign::where('id', '!=', $campaign->id)
            ->where('status', 'Aktif')
            ->latest()
            ->take(3)
            ->get();

        return view('public.campaign.show', compact('campaign', 'campaignLainnya'));
    }

    public function donasiRiwayat(Campaign $campaign)
    {
        $title = 'Riwayat';
        $donasi = $campaign->donasi()
            ->where('status', 'Verified')
            ->orderByDesc('created_at')
            ->get();

        return view('public.campaign.riwayat', compact('campaign', 'donasi', 'title'));
    }

    public function doaRiwayat(Campaign $campaign)
    {
        $doas = $campaign->doa()->latest()->get();
        return view('public.campaign.doa', compact( 'campaign', 'doas'));
    }

    public function doaKirim(Request $request)
    {
        $request->validate([
            'campaign_id' => 'required|exists:campaign,id',
            'nama' => 'required|string|max:255',
            'isi_doa' => 'required|string',
        ]);

        Doa::create([
            'campaign_id' => $request->campaign_id,
            'nama' => $request->nama,
            'isi' => $request->isi_doa,
        ]);

        return back()->with('success', 'Doa Anda telah dikirim.');
    }

    public function donasiKirim(Request $request)
    {
        $request->validate([
            'campaign_id' => 'required|exists:campaign,id',
            'nama_donatur' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:1',
            'bukti_transfer' => 'nullable|image|max:2048',
            'keterangan' => 'nullable|string',
        ]);

        $data = $request->only(['campaign_id', 'nama_donatur', 'jumlah', 'keterangan']);

        // 🔹 Simpan ID user yang sedang login
        $data['user_id'] = Auth::id();

        if ($request->hasFile('bukti_transfer')) {
            $data['bukti_transfer'] = $request->file('bukti_transfer')->store('bukti_transfer', 'public');
        }

        Donasi::create($data);

        $campaign = Campaign::find($request->campaign_id);

        return redirect()->route('campaign.show', $campaign->slug)->with('success', 'Donasi berhasil dikirim.');
    }

    public function galeriIndex()
    {
        $galeri = Galeri::with('galeriFoto')->latest()->get();

        return view('public.galeri.index', compact('galeri'));
    }

    public function ajax(Request $request)
    {
        $filter = $request->input('filter', 'all');
        $offset = (int) $request->input('offset', 0);
        $limit = 1;

        $query = Galeri::with('galeriFoto')->orderBy('tanggal', 'desc');

        if ($filter !== 'all') {
            $query->where('id', $filter);
        }

        $galeri = $query->skip($offset)->take($limit)->get();
        $html = view('public.galeri._items', compact('galeri'))->render();

        return response()->json([
            'html' => $html,
            'count' => $galeri->count()
        ]);
    }

    public function beritaIndex()
    {
        $beritas = Berita::orderBy('created_at', 'desc')->get();

        return view('public.berita.index', compact('beritas'));
    }

    public function beritaShow($slug)
    {
        $berita = Berita::where('slug', $slug)->firstOrFail();
        $beritaLainnya = Berita::where('id', '!=', $berita->id)
                        ->latest()
                        ->take(5)
                        ->get();

        return view('public.berita.show', compact('berita',  'beritaLainnya'));
    }

    public function cekForm()
    {
        return view('public.alumni.cek');
    }

    public function cekData(Request $request)
    {
        $request->validate([
            'nama_lengkap'     => 'required|string',
            'tahun_kelulusan'  => 'required|integer',
            // 'tanggal_lahir'    => 'required|date',
        ]);

        // Cek apakah ada di tabel master alumni
        $data = AlumniMaster::where('nama_lengkap', $request->nama_lengkap)
            ->where('tahun_kelulusan', $request->tahun_kelulusan)
            // ->where('tanggal_lahir', $request->tanggal_lahir)
            ->first();

        if (!$data) {
            return back()->withErrors(['Data tidak ditemukan di database alumni.']);
        }

        // Cek apakah sudah ada di tabel alumni
        $sudahAda = Alumni::where('nama_lengkap', $request->nama_lengkap)
            ->where('tahun_kelulusan', $request->tahun_kelulusan)
            ->exists();

        if ($sudahAda) {
            return back()->withErrors(['Data alumni ini sudah terdaftar.']);
        }

        // Jika belum terdaftar, tampilkan form lanjutan
        return view('public.alumni.form', [
            'alumni_master' => $data
        ]);
    }

    public function simpanAlumni(Request $request)
    {
        $data = $request->validate([
            'nama_lengkap'                        => 'required|string',
            'nama_panggilan'                      => 'nullable|string',
            'tahun_kelulusan'                     => 'nullable|integer',
            'email'                               => 'required|email|unique:users,email',
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
            'password'   => Hash::make($nia), // password = NIA
            'role'       => 'alumni',
            'alumni_id'  => $alumni->id,      // optional, jika kolom tersedia
        ]);

        // =====================
        // 5. Redirect dengan info login
        // =====================
        return redirect()->route('alumni.cekform')->with('success', "Pendaftaran berhasil. Silakan login dengan:<br><strong>Email:</strong> {$data['email']}<br><strong>Password (NIA):</strong> {$nia}");
    }

    public function profilIndex()
    {
        $folderPath = public_path('images');
        $files = File::files($folderPath);

        $fileNames = [];
        foreach ($files as $file) {
            $fileNames[] = $file->getFilename();
        }

        return view("public.profil.index", ['files' => $fileNames]);
    }
}
