@extends('layouts.admin')
@section('title', 'Default')

@section('content')
    <p class="mb-0">Halo, selamat datang di halaman</p>
    <h1 class="fw-semibold display-4 mb-3">{{ $title ?? '-' }}</h1>
    <div class="mt-3">
        {{-- keuangan --}}
        <div class="row row-cols-1 row-cols-md-2">
            <div class="col-md-8">
                <div class="card border shadow-none h-100">
                    <div class="card-body">
                        <h5 class="card-title">Pemasukan dan Pengeluaran</h5>
                        <canvas id="financeChart" height="200"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row row-cols-1 g-4">
                    <div class="col">
                        <div class="card shadow-none border mb-0">
                            <div class="card-body">
                                <h1 class="py-2 px-3 rounded text-primary bg-primary-subtle d-inline-block">
                                    <i class="ti ti-wallet"></i>
                                </h1>
                                <div>
                                    <h5 class="text-primary mb-1">Saldo Kas</h5>
                                    <h3 class="mb-0 fw-semibold">Rp {{ number_format($saldoKas, 0, ',', '.') }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card shadow-none border mb-0">
                            <div class="card-body">
                                <h1 class="py-2 px-3 rounded text-success bg-success-subtle d-inline-block">
                                    <i class="ti ti-cash-banknote"></i>
                                </h1>
                                <div>
                                    <h5 class="text-success mb-1">Total Pemasukan</h5>
                                    <h3 class="mb-0 fw-semibold">Rp
                                        {{ number_format($totalPemasukan, 0, ',', '.') }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card shadow-none border mb-0">
                            <div class="card-body">
                                <h1 class="py-2 px-3 rounded text-danger bg-danger-subtle d-inline-block">
                                    <i class="ti ti-credit-card-off"></i>
                                </h1>
                                <div>
                                    <h5 class="text-danger mb-1">Total Pengeluaran</h5>
                                    <h3 class="mb-0 fw-semibold">Rp
                                        {{ number_format($totalPengeluaran, 0, ',', '.') }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- campaign dan donasi --}}
        <div class="mt-4">
            <div class="card border shadow-none">
                <div class="card-body">
                    <div class="row row-cols-md-3 row-cols-1">
                        {{-- campaign aktif --}}
                        <div class="col">
                            <div class="d-flex align-items-center gap-3">
                                <h1 class="py-2 mb-0 px-3 rounded text-secondary bg-secondary-subtle d-inline-block">
                                    <i class="ti ti-broadcast"></i>
                                </h1>
                                <div>
                                    <h6 class="mb-1">Campaign Aktif</h6>
                                    <h2 class="mb-0">{{ $totalCampaign }}</h2>
                                </div>
                            </div>
                        </div>
                        {{-- Total Donasi --}}
                        <div class="col">
                            <div class="d-flex align-items-center gap-3">
                                <h1 class="py-2 mb-0 px-3 rounded text-info bg-info-subtle d-inline-block">
                                    <i class="ti ti-heart-handshake"></i>
                                </h1>
                                <div>
                                    <h6 class="text-info mb-1">Total Donasi</h6>
                                    <h4 class="mb-0">Rp {{ number_format($totalDonasi, 0, ',', '.') }}</h4>
                                </div>
                            </div>
                        </div>

                        {{-- Donasi Pending --}}
                        <div class="col">
                            <div class="d-flex align-items-center gap-3">
                                <h1 class="py-2 mb-0 px-3 rounded text-warning bg-warning-subtle d-inline-block">
                                    <i class="ti ti-clock-hour-5"></i>
                                </h1>
                                <div>
                                    <h6 class="text-warning mb-1">Donasi Pending</h6>
                                    <h4 class="mb-0">{{ $donasiPending }} transaksi</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- alumni --}}
        <div class="mt-4 mb-0">
            <div class="row row-cols-1 row-cols-md-2 g-4">
                <div class="col-md-4">
                    <div class="card border shadow-none mb-4">
                        <div class="card-body d-flex align-items-start gap-3">
                            <h1 class="py-2 px-3 mb-0 rounded text-success bg-success-subtle d-inline-block">
                                <i class="ti ti-users"></i>
                            </h1>
                            <div>
                                <h6 class="mb-1">Alumni</h6>
                                <h2 class="mb-0">{{ $totalAlumni }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card border mb-4 shadow-none">
                        <div class="card-body d-flex align-items-start gap-3">
                            <h1 class="py-2 mb-0 px-3 rounded text-success bg-success-subtle d-inline-block">
                                <i class="ti ti-briefcase"></i>
                            </h1>
                            <div>
                                <h6 class="mb-1">Alumni Bekerja</h6>
                                <h2 class="mb-0">{{ $alumniBekerja }}</h2>
                            </div>
                        </div>
                    </div>
                    @if ($topInstitusi)
                        <div class="card border mb-4 shadow-none">
                            <div class="card-body d-flex align-items-start gap-3">
                                <h1 class="py-2 mb-0 px-3 rounded text-warning bg-warning-subtle d-inline-block">
                                    <i class="ti ti-building"></i>
                                </h1>
                                <div>
                                    <h6 class="mb-1">Top Institusi:
                                        {{ $topInstitusi->nama_institusi_pendidikan_terakhir }}</h6>
                                    <h2 class="mb-0">{{ $topInstitusi->total }} alumni</h2>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($pekerjaanPopuler)
                        <div class="card border mb-4 shadow-none">
                            <div class="card-body d-flex align-items-start gap-3">
                                <h1 class="py-2 mb-0 px-3 rounded text-secondary bg-secondary-subtle d-inline-block">
                                    <i class="ti ti-activity-heartbeat"></i>
                                </h1>
                                <div>
                                    <h6 class="mb-1">Pekerjaan Populer:
                                        {{ $pekerjaanPopuler->pekerjaan_saat_ini }}
                                    </h6>
                                    <h2 class="mb-0">{{ $pekerjaanPopuler->total }} alumni</h2>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($lulusanTerbanyak)
                        <div class="card border mb-0 shadow-none">
                            <div class="card-body d-flex align-items-start gap-3">
                                <h1 class="py-2 mb-0 px-3 rounded text-danger bg-danger-subtle d-inline-block">
                                    <i class="ti ti-calendar-event"></i>
                                </h1>
                                <div>
                                    <h6 class="mb-1">Lulusan Terbanyak: {{ $lulusanTerbanyak->tahun_kelulusan }}
                                    </h6>
                                    <h2 class="mb-0">{{ $lulusanTerbanyak->total }} alumni</h2>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-md-8">
                    <div class="card border shadow-none mb-4">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Grafik Kelulusan</h5>
                            <canvas id="kelulusanChart" height="71"></canvas>
                        </div>
                    </div>
                    <div class="row row-cols-1 row-cols-md-2">
                        <div class="col">
                            <div class="card border shadow-none mb-0">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">Pendidikan</h5>
                                    <canvas id="pendidikanChart" width="300" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card border shadow-none mb-0">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">Pekerjaan</h5>
                                    <canvas id="pekerjaanChart" width="400" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- media --}}
        <div class="mt-4 mb-4">
            <div class="row row-cols-1 row-cols-md-4 g-4">
                {{-- Agenda --}}
                <div class="col">
                    <div class="card border shadow-none mb-0">
                        <div class="card-body d-flex align-items-start gap-3">
                            <h1 class="py-2 mb-0 px-3 rounded text-dark bg-dark-subtle d-inline-block">
                                <i class="ti ti-calendar-event"></i>
                            </h1>
                            <div>
                                <h6 class="mb-1">Agenda</h6>
                                <h2 class="mb-0">{{ $totalAgenda }}</h2>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Berita --}}
                <div class="col">
                    <div class="card border shadow-none mb-0">
                        <div class="card-body d-flex align-items-start gap-3">
                            <h1 class="py-2 mb-0 px-3 rounded text-primary bg-primary-subtle d-inline-block">
                                <i class="ti ti-news"></i>
                            </h1>
                            <div>
                                <h6 class="mb-1">Berita</h6>
                                <h2 class="mb-0">{{ $totalBerita }}</h2>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Galeri --}}
                <div class="col">
                    <div class="card border mb-0 shadow-none">
                        <div class="card-body d-flex align-items-start gap-3">
                            <h1 class="py-2 mb-0 px-3 rounded text-warning bg-warning-subtle d-inline-block">
                                <i class="ti ti-photo"></i>
                            </h1>
                            <div>
                                <h6 class="mb-1">Galeri</h6>
                                <h2 class="mb-0">{{ $totalGaleri }}</h2>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Foto Galeri --}}
                <div class="col">
                    <div class="card border mb-0 shadow-none">
                        <div class="card-body d-flex align-items-start gap-3">
                            <h1 class="py-2 mb-0 px-3 rounded text-info bg-info-subtle d-inline-block">
                                <i class="ti ti-photo-up"></i>
                            </h1>
                            <div>
                                <h6 class="mb-1">Foto Galeri</h6>
                                <h2 class="mb-0">{{ $totalFoto }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        window.financeData = {
            pemasukan: @json($pemasukan),
            pengeluaran: @json($pengeluaran)
        };
    </script>
    <script src="{{ asset('assets/js/keuangan.js') }}"></script>
    <script>
        window.alumniData = {
            pendidikan: @json($pendidikan),
            pekerjaan: @json($pekerjaan),
            tahunKelulusan: @json($tahunKelulusan)
        };
    </script>
    <script src="{{ asset('assets/js/alumni.js') }}"></script>
@endpush
