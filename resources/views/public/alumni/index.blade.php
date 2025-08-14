@extends('layouts.web')
@section('title', 'Sebaran Alumni')

@section('content')
    @include('partials.navbar')
    <section class="py-5">
        <div class="container" data-aos="fade-down">
            <span class="badge text-bg-light rounded-1 py-2 px-3">ALUMNI</span>
            <h1 class="mt-2">Sebaran Alumni SMAN 4 Tasikmalaya.</h1>
            <hr>
            <div class="row row-cols-2 row-cols-md-4 g-3 mb-4">
                <div class="col" data-aos="fade-down">
                    <div class="card border h-100">
                        <div class="card-body p-4">
                            <i class="ti ti-users display-5 text-primary mb-2"></i>
                            <h3 class="fw-bold mb-0">{{ number_format($totalAlumni) }}</h3>
                            <p class="mb-0">Alumni Terdaftar</p>
                        </div>
                    </div>
                </div>

                <div class="col" data-aos="fade-down" data-aos-delay="200">
                    <div class="card border h-100">
                        <div class="card-body p-4">
                            <i class="ti ti-school display-5 text-success mb-2"></i>
                            <h3 class="fw-bold mb-0">{{ $pendidikanTerbanyak->jumlah ?? 0 }}</h3>
                            <p class="mb-0">Terbanyak: {{ $pendidikanTerbanyak->jenjang_pendidikan_terakhir ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <div class="col" data-aos="fade-down" data-aos-delay="400">
                    <div class="card border h-100">
                        <div class="card-body p-4">
                            <i class="ti ti-briefcase display-5 text-warning mb-2"></i>
                            <h3 class="fw-bold mb-0">{{ $pekerjaanTerbanyak->jumlah ?? 0 }}</h3>
                            <p class="mb-0">Pekerjaan: {{ $pekerjaanTerbanyak->pekerjaan_saat_ini ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <div class="col" data-aos="fade-down" data-aos-delay="600">
                    <div class="card border h-100">
                        <div class="card-body p-4">
                            <i class="ti ti-calendar-stats display-5 text-info mb-2"></i>
                            <h3 class="fw-bold mb-0">{{ $tahunTerbanyak->tahun_kelulusan ?? '-' }}</h3>
                            <p class="mb-0">Lulusan Terbanyak ({{ $tahunTerbanyak->jumlah ?? 0 }})</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- form pencarian data alumni --}}
    <section class="py-5" data-aos="fade-up" data-aos-duration="1000">
        <div class="container">
            <div class="rounded border">
                <div class="p-5">
                    <div class="align-items-center justify-content-center">
                        <div class="text-center">
                            <h1 class="fw-bold mb-3">Kamu alumni SMAN 4 Tasikmalaya?</h1>
                            <p class="text-muted mb-4">Temukan teman lama, jalin koneksi baru, dan jadi bagian dari
                                jaringan alumni yang aktif dan solid!</p>
                        </div>

                        <div class="">
                            <form method="GET" action="{{ route('alumni.publik') }}">
                                <input type="text" name="search"
                                    class="form-control text-center form-control-lg rounded-1"
                                    placeholder="Cari berdasarkan nama atau angkatan . ." value="{{ request('search') }}">
                                <div class="mt-3 d-flex justify-content-center">
                                    <button class="btn btn-primary rounded-1" type="submit">Cari Alumni</button>
                                    <a href="/alumni/cek/form" class="btn btn-outline-primary rounded-1 ms-2">Isi Data
                                        Alumni</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Tabel Hasil -->
                    @if ($alumnis->isNotEmpty())
                        <h3>Hasil pencarian</h3>
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead class="table-dark border-0">
                                    <tr>
                                        <th class="rounded-start py-4">Nama</th>
                                        <th class="py-4">Tahun Kelulusan</th>
                                        <th class="py-4">Pekerjaan Saat Ini</th>
                                        <th class="rounded-end py-4">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($alumnis as $alumni)
                                        @php
                                            $detail = \App\Models\Alumni::where('nama_lengkap', $alumni->nama_lengkap)
                                                ->where('tahun_kelulusan', $alumni->tahun_kelulusan)
                                                ->first();
                                            $id = $detail ? $detail->id : $alumni->id;
                                        @endphp
                                        <tr>
                                            <td class="py-3">{{ $alumni->nama_lengkap }}</td>
                                            <td class="py-3">{{ $alumni->tahun_kelulusan }}</td>
                                            <td class="py-3">{{ $alumni->pekerjaan_saat_ini ?? '-' }}</td>
                                            <td class="py-3">
                                                <a href="{{ route('alumni.show', $id) }}" class="text-decoration-none">
                                                    Lihat Detail
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    @if (request()->has('search'))
                        @if ($alumnis->isEmpty())
                            <div class="alert alert-warning mt-3" role="alert">
                                <div class="p-2">
                                    Tidak menemukan data yang kamu cari. Isi data
                                    <a href="/alumni/cek/form" class="text-decoration-none">di sini</a>
                                    atau <a href="/hubungi-admin" class="text-decoration-none">hubungi admin</a>.
                                </div>
                            </div>
                        @else
                            <div class="alert alert-success mt-3" role="alert">
                                <div class="p-2">
                                    Menampilkan hasil pencarian untuk "<strong>{{ request('search') }}</strong>". Data yang
                                    diminta tidak ada? Tambah<a href="/alumni/cek/form"
                                        class="text-decoration-none ms-1">disini</a> atau <a href="/hubungi-admin"
                                        class="text-decoration-none">hubungi admin</a>.
                                </div>
                            </div>
                        @endif
                    @endif

                </div>
            </div>
        </div>
    </section>
@endsection

@push('style')
    <style>
        .bg-glass {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(2px);
            -webkit-backdrop-filter: blur(2px);
            border-radius: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        #map {
            width: 100%;
            height: 400px;
        }
    </style>
@endpush

@push('script')
    <script>
        AOS.init();
    </script>
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
    <script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>
@endpush
