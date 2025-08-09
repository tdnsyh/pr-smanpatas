@extends('layouts.web')
@section('title', $alumni->nama_lengkap)

@section('content')
    @include('partials.navbar')
    <section class="py-5">
        <div class="container">
            <div class="rounded py-4 bg-primary-subtle">
                <div class="text-center" data-aos="fade-down">
                    <h5 class="mb-0">Biodata Alumni</h5>
                    <h1 class="fw-bold text-primary mb-0">{{ $alumni->nama_lengkap }}</h1>
                </div>
            </div>
            @if (!empty($alumni->is_basic_data))
                <div class="alert alert-warning d-flex align-items-center gap-2 mt-3" role="alert" data-aos="fade-up"
                    data-aos-delay="200">
                    <i class="ti ti-info-circle fs-5"></i>
                    <p class="mb-0">Data detail alumni belum tersedia.</p>
                </div>
            @endif
            @php
                $data = $alumni->data_publik;
                $items = [
                    ['label' => 'Nama Lengkap', 'key' => 'nama_lengkap', 'icon' => 'user'],
                    ['label' => 'Nama Panggilan', 'key' => 'nama_panggilan', 'icon' => 'user-circle'],
                    ['label' => 'Tahun Kelulusan', 'key' => 'tahun_kelulusan', 'icon' => 'calendar'],
                    ['label' => 'Email', 'key' => 'email', 'icon' => 'mail'],
                    ['label' => 'No WhatsApp', 'key' => 'no_wa', 'icon' => 'brand-whatsapp'],
                    ['label' => 'Alamat Saat Ini', 'key' => 'alamat_saat_ini', 'icon' => 'map'],
                    [
                        'label' => 'Jenjang Pendidikan Terakhir',
                        'key' => 'jenjang_pendidikan_terakhir',
                        'icon' => 'school',
                    ],
                    [
                        'label' => 'Institusi Pendidikan',
                        'key' => 'nama_institusi_pendidikan_terakhir',
                        'icon' => 'building',
                    ],
                    ['label' => 'Program Studi', 'key' => 'program_studi', 'icon' => 'book'],
                    ['label' => 'Pekerjaan Saat Ini', 'key' => 'pekerjaan_saat_ini', 'icon' => 'briefcase'],
                    ['label' => 'Nama Instansi', 'key' => 'nama_instansi', 'icon' => 'building-skyscraper'],
                    ['label' => 'Jabatan', 'key' => 'jabatan', 'icon' => 'id-badge'],
                    ['label' => 'Lokasi Tempat Bekerja', 'key' => 'lokasi_tempat_bekerja', 'icon' => 'map-pin'],
                ];
            @endphp

            <div class="row g-3 mt-3" data-aos="fade-up" data-aos-delay="100">
                @foreach ($items as $item)
                    @if (isset($data[$item['key']]))
                        <div class="col-12 col-md-6">
                            <div class="card border h-100">
                                <div class="card-body d-flex align-items-center">
                                    <div class="me-3 bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 48px; height: 48px;">
                                        <i class="ti ti-{{ $item['icon'] }} fs-5"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted">{{ $item['label'] }}</small>
                                        <div class="fw-semibold text-break">{{ $data[$item['key']] ?: '-' }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="alert alert-warning d-flex align-items-center gap-2 mt-3" role="alert" data-aos="fade-up"
                data-aos-delay="200">
                <i class="ti ti-info-circle fs-5"></i>
                <div>
                    Terdapat kesalahan pada data? <a href="/" class="text-decoration-none fw-semibold">Klik di sini
                        untuk koreksi</a>.
                </div>
            </div>

            <div class="text-center mt-4" data-aos="zoom-in">
                <a href="{{ route('alumni.publik') }}" class="btn btn-outline-secondary px-4 py-2 rounded">
                    <i class="ti ti-arrow-left me-1"></i> Kembali ke Pencarian
                </a>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        AOS.init();
    </script>
@endpush
