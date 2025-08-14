@extends('layouts.web')
@section('title', 'Home')

@section('content')
    @include('partials.navbar')
    <section>
        <div class="container d-flex justify-content-center align-items-center min-vh-100">
            <div class="container text-center">
                <img src="{{ asset('assets/images/logos/logo1.png') }}" alt="" class="img-fluid" width="1000px">
                <h1 class="text-primary fw-bold display-4 mt-4">"sabilulungan ngawangun diri, sakola jeung balarea"</h1>
                <div class="d-flex gap-3 justify-content-center mt-3">
                    <a href="{{ route('login') }}"
                        class="btn rounded btn-primary d-flex align-items-center justify-content-center">
                        <h2 class="text-white m-0">Masuk</h2>
                    </a>
                    <a href="{{ route('alumni.publik') }}"
                        class="btn rounded bg-primary-subtle d-flex align-items-center justify-content-center">
                        <h2 class="text-primary m-0">Cari Alumni</h2>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- profil singkat --}}
    <section class="bg-primary text-white" data-aos="zoom-in-up" data-aos-duration="750">
        <div class="container py-5">
            <div class="row row-cols-1 row-cols-md-2 g-3 mt-2">
                <div class="col-md-4">
                    <img src="https://plus.unsplash.com/premium_photo-1695927605639-a7209d8116ea?q=80&w=1171&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        alt="" class="img-fluid rounded object-fit-cover mb-0 h-100">
                </div>
                <div class="col-md-8">
                    <div class="an">
                        <span class="badge text-bg-light rounded-1 py-2 px-3">PROFIL SINGKAT</span>
                        <h1 class="mt-2 text-white">
                            <strong>IKA SMANPATAS</strong> adalah <span class="text-bg-primary">wadah alumni SMAN 4
                                Tasikmalaya</span> untuk bersilaturahmi dan berkontribusi.
                        </h1>
                        <p class="fs-4">
                            Ikatan Alumni SMAN 4 Tasikmalaya (IKA SMANPATAS) adalah organisasi resmi yang berdiri pada 25
                            Januari 2025 sebagai wadah silaturahmi, kolaborasi, dan kontribusi alumni kepada almamater serta
                            masyarakat, berlandaskan nilai kekeluargaan, kesetiakawanan, dan profesionalisme.
                        </p>
                    </div>

                    <div class="row row-cols-2 row-cols-md-4 g-3">
                        <div class="col" data-aos="zoom-in" data-aos-duration="1000">
                            <div class="d-flex p-3 h-100 flex-column align-items-start">
                                <div class="bg-white text-primary rounded-circle d-flex justify-content-center align-items-center mb-2"
                                    style="width: 56px; height: 56px;">
                                    <i class="ti ti-users fs-4"></i>
                                </div>
                                <p class="mb-0 fs-3">Mempererat hubungan antar alumni.</p>
                            </div>
                        </div>

                        <div class="col" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="200">
                            <div class="d-flex p-3 h-100 flex-column align-items-start">
                                <div class="bg-secondary text-white rounded-circle d-flex justify-content-center align-items-center mb-2"
                                    style="width: 56px; height: 56px;">
                                    <i class="ti ti-heart fs-4"></i>
                                </div>
                                <p class="mb-0 fs-3">Berkontribusi untuk almamater dan masyarakat.</p>
                            </div>
                        </div>

                        <div class="col" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="400">
                            <div class="d-flex p-3 h-100 flex-column align-items-start">
                                <div class="bg-success text-white rounded-circle d-flex justify-content-center align-items-center mb-2"
                                    style="width: 56px; height: 56px;">
                                    <i class="ti ti-award fs-4"></i>
                                </div>
                                <p class="mb-0 fs-3">Meningkatkan kompetensi alumni.</p>
                            </div>
                        </div>

                        <div class="col" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="600">
                            <div class="d-flex p-3 h-100 flex-column align-items-start">
                                <div class="bg-warning text-white rounded-circle d-flex justify-content-center align-items-center mb-2"
                                    style="width: 56px; height: 56px;">
                                    <i class="ti ti-message fs-4"></i>
                                </div>
                                <p class="mb-0 fs-3">Wadah komunikasi dan kolaborasi.</p>
                            </div>
                        </div>
                    </div>
                    <a href="/profil" class="btn bg-primary-subtle text-primary mt-3 rounded" data-aos="zoom-in"
                        data-aos-duration="1000" data-aos-delay="700">Selengkapnya</a>
                </div>
            </div>
        </div>
    </section>

    {{-- manfaat website --}}
    <section class="py-5">
        <div class="container">
            <div class="bg-light rounded" data-aos="zoom-in" data-aos-duration="1000">
                <div class="p-5">
                    <div class="row row-cols-1 row-cols-md-2">
                        <div class="col">
                            <span class="badge text-bg-primary rounded-1 py-2 px-3">WEBSITE</span>
                            <h1>Website ini dibangun sebagai sarana resmi untuk <strong>menghubungkan alumni lintas
                                    angkatan.</strong></h1>
                            <p class="card-text">
                                Dibangun sebagai pusat informasi dan komunikasi antar alumni lintas angkatan, situs ini
                                menjadi media strategis
                                untuk mempererat hubungan kekeluargaan, mendukung kolaborasi, serta mendorong kontribusi
                                nyata alumni bagi almamater dan masyarakat.
                            </p>
                        </div>
                        <div class="col mt-3 mt-md-0">
                            <div class="row row-cols-1 row-cols-md-2 g-3">
                                <div class="col text-center text-md-start" data-aos="zoom-in" data-aos-duration="1000">
                                    <div class="icon-circle mx-auto mx-md-0">
                                        <i class="ti ti-news h1"></i>
                                    </div>
                                    <h5 class="fw-semibold">Pusat Informasi</h5>
                                    <p class="mb-0">Menyajikan berita, agenda kegiatan, dan pengumuman resmi IKA
                                        SMANPATAS.</p>
                                </div>

                                <div class="col text-center text-md-start" data-aos="zoom-in" data-aos-duration="1000">
                                    <div class="icon-circle mx-auto mx-md-0">
                                        <i class="ti ti-network h1"></i>
                                    </div>
                                    <h5 class="fw-semibold">Jejaring Alumni</h5>
                                    <p class="mb-0">Mewadahi interaksi, komunikasi, dan solidaritas antar alumni berbagai
                                        angkatan.</p>
                                </div>

                                <div class="col text-center text-md-start" data-aos="zoom-in" data-aos-duration="1000">
                                    <div class="icon-circle mx-auto mx-md-0">
                                        <i class="ti ti-heart-handshake h1"></i>
                                    </div>
                                    <h5 class="fw-semibold">Kolaborasi</h5>
                                    <p class="mb-0">Fasilitasi sinergi antar alumni dalam bidang sosial, profesional,
                                        bisnis, dan pendidikan.</p>
                                </div>

                                <div class="col text-center text-md-start" data-aos="zoom-in" data-aos-duration="1000">
                                    <div class="icon-circle mx-auto mx-md-0">
                                        <i class="ti ti-building-community h1"></i>
                                    </div>
                                    <h5 class="fw-semibold">Kontribusi Almamater</h5>
                                    <p class="mb-0">Sarana alumni untuk memberikan dukungan dan kontribusi bagi SMAN 4
                                        Tasikmalaya.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- statistik singkat alumni --}}
    <section class="py-5">
        <div class="container text-center">
            <span class="badge text-bg-light rounded-1 py-2 px-3">ALUMNI</span>
            <h1 class="mt-2">Sebaran Alumni SMAN 4 Tasikmalaya.</h1>
            <div class="rounded border p-4">
                <div class="row row-cols-2 row-cols-md-4 g-3">
                    <div class="col" data-aos="fade-down">
                        <i class="ti ti-users display-5 text-primary mb-2"></i>
                        <h3 class="fw-bold mb-0">{{ number_format($totalAlumni) }}</h3>
                        <p class="mb-0">Alumni Terdaftar</p>
                    </div>

                    <div class="col" data-aos="fade-down" data-aos-delay="200">
                        <i class="ti ti-school display-5 text-success mb-2"></i>
                        <h3 class="fw-bold mb-0">{{ $pendidikanTerbanyak->jumlah ?? 0 }}</h3>
                        <p class="mb-0">Terbanyak: {{ $pendidikanTerbanyak->jenjang_pendidikan_terakhir ?? '-' }}
                        </p>
                    </div>

                    <div class="col" data-aos="fade-down" data-aos-delay="400">
                        <i class="ti ti-briefcase display-5 text-warning mb-2"></i>
                        <h3 class="fw-bold mb-0">{{ $pekerjaanTerbanyak->jumlah ?? 0 }}</h3>
                        <p class="mb-0">Pekerjaan: {{ $pekerjaanTerbanyak->pekerjaan_saat_ini ?? '-' }}</p>
                    </div>

                    <div class="col" data-aos="fade-down" data-aos-delay="600">
                        <i class="ti ti-calendar-stats display-5 text-info mb-2"></i>
                        <h3 class="fw-bold mb-0">{{ $tahunTerbanyak->tahun_kelulusan ?? '-' }}</h3>
                        <p class="mb-0">Lulusan Terbanyak ({{ $tahunTerbanyak->jumlah ?? 0 }})</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- agenda terdekat --}}
    <section class="py-5" data-aos="fade-in">
        <div class="container">
            <div class="text-bg-primary rounded">
                <div class="p-5">
                    <div class="text-center">
                        <p class="display-3 text-white mb-0">
                            <i class="ti ti-calendar-event"></i>
                        </p>
                        <h1 class="text-light">Catat tanggalnya!</h1>
                        <p class="card-text">Kegiatan resmi, reuni alumni, hingga seminar akan segera berlangsung. Pastikan
                            kamu jadi bagian dari momen penting ini.</p>
                    </div>
                    <div class="mt-3">
                        <div class="row row-cols-1 row-cols-md-3 g-3">
                            @foreach ($agendas as $agenda)
                                <div class="col">
                                    <div class="card h-100 border-0 shadow-none">
                                        <div class="card-body d-flex flex-column">
                                            <div class="ratio ratio-16x9">
                                                <img src="{{ asset('storage/' . $agenda->gambar) }}"
                                                    alt="{{ $agenda->judul }}" loading="lazy"
                                                    class="card-img-top rounded object-fit-cover">
                                            </div>

                                            <a href="{{ route('agenda.show', $agenda->slug) }}"
                                                class="text-decoration-none text-black">
                                                <h5 class=" mb-0 card-title mt-3">
                                                    {{ \Illuminate\Support\Str::limit($agenda->judul, 60) }}
                                                </h5>
                                            </a>
                                            <div class="mt-3">
                                                <div class="d-flex align-items-center mb-1">
                                                    <i class="ti ti-calendar-event me-2"></i>
                                                    <span>{{ \Carbon\Carbon::parse($agenda->tanggal)->format('d F Y, H:i') }}
                                                        WIB</span>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <i class="ti ti-map-pin me-2"></i>
                                                    <span>{{ $agenda->lokasi }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="mt-3 text-center">
                        <a href="/agenda" class="btn btn-outline-light rounded">Lihat agenda lainnya</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- galeri --}}
    <section class="py-4 bg-warning-subtle" data-aos="fade-up">
        <div class="container py-3 py-md-5">
            <div class="text-center mb-4">
                <span class="badge text-bg-warning rounded-1 py-2 px-3">GALERI</span>
                <h1>Setiap foto, sebuah cerita. Temukan kenanganmu di sini.</h1>
                <p class="mb-0">
                    Pernahkah kamu menyadari bahwa setiap foto di galerimu lebih dari sekadar gambar? Ia adalah gerbang
                    menuju masa lalu, sebuah catatan visual dari momen-momen yang membentuk dirimu.
                </p>
                <div class="row row-cols-2 row-cols-md-5 g-3 mt-3" data-masonry='{"percentPosition": true }'>
                    @foreach ($fotos as $foto)
                        <div class="col">
                            <img src="{{ asset('storage/' . $foto->gambar) }}" alt="Galeri"
                                class="img-fluid rounded w-100 fade-in">
                        </div>
                    @endforeach
                </div>
                <div class="mt-3">
                    <a href="/galeri" class="btn text-white bg-warning rounded">Lihat lebih banyak</a>
                </div>
            </div>
        </div>
    </section>

    {{-- campaign terbaru --}}
    <section class="bg-warning" data-aos="zoom-in">
        <div class="container py-3 py-md-5">
            <div class="d-flex justify-content-between align-items-end">
                <div>
                    <span class="badge text-bg-light rounded-1 py-2 px-3">CAMPAIGN</span>
                    <h1 class="mb-0 text-white">Ayo dukung dan bantu</h1>
                </div>
                <div>
                    <a href="/campaign" class="btn text-warning bg-warning-subtle rounded">Lainnya</a>
                </div>
            </div>
            <div class="mt-3">
                <div class="row row-cols-2 row-cols-md-4 g-3">
                    @foreach ($campaigns as $campaign)
                        <div class="col">
                            <div class="card h-100 border-0 shadow-none bg-transparent">
                                <div class="card-body p-0 d-flex flex-column">
                                    <div class="ratio ratio-16x9">
                                        <img src="{{ asset('storage/' . $campaign->gambar) }}"
                                            alt="{{ $campaign->judul }}" class="img-fluid rounded object-fit-cover"
                                            loading="lazy">
                                    </div>
                                    <h4 class="mt-3 mb-2">{{ $campaign->judul }}</h4>
                                    <p class="mb-1 mt-3">
                                    <div class="mt-auto">
                                        <p class="text-white">
                                            Rp. {{ number_format($campaign->terkumpul, 0, ',', '.') }}
                                            <small>
                                                Dari Rp. {{ number_format($campaign->target, 0, ',', '.') }}
                                                ({{ $campaign->persen }}%)
                                            </small>
                                        </p>
                                        <div class="progress mb-3" role="progressbar" aria-label="Progress"
                                            aria-valuenow="{{ $campaign->persen }}" aria-valuemin="0"
                                            aria-valuemax="100" style="height: 3px">
                                            <div class="progress-bar" style="width: {{ $campaign->persen }}%"></div>
                                        </div>
                                        <a href="{{ route('campaign.show', $campaign->slug) }}"
                                            class="d-inline-flex align-items-center text-white gap-2 text-decoration-none">
                                            <span>Selengkapnya</span>
                                            <span
                                                class="d-inline-flex align-items-center justify-content-center rounded-circle bg-warning-subtle text-warning"
                                                style="width: 32px; height: 32px;">
                                                <i class="ti ti-arrow-right"></i>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- berita --}}
    <section class="py-4 bg-black bg-opacity-50" data-aos="fade-out">
        <div class="container">
            <div class="py-5">
                <div class="row row-cols-1 row-cols-md-2">
                    <div class="col-md-8 col sticky-mobile-fix position-sticky" style="top: 6rem; height: fit-content;">
                        <div id="carouselBerita" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($beritaTerbaru as $index => $berita)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <div class="ratio ratio-21x9">
                                            <img src="{{ asset('storage/' . $berita->gambar) }}"
                                                class="d-block w-100 object-fit-cover rounded" alt="{{ $berita->judul }}"
                                                loading="lazy">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <span class="badge text-bg-primary rounded-1 py-2 px-3 mt-3">BERITA</span>
                        <h1 class="text-white">Dapatkan informasi terkini seputar aktivitas, prestasi, dan
                            kontribusi alumni SMANPATAS dari berbagai angkatan.</h1>
                        <a href="/berita" class="btn text-dark bg-light mb-3 rounded">Lihat Semua Berita</a>
                    </div>
                    <div class="col-md-4 col scrollable-mobile-fix" style="overflow-y: auto;">
                        @foreach ($beritaTerbaru as $berita)
                            <div class="card-berita card border-0 bg-black shadow-none mb-3">
                                <div class="card-body p-4">
                                    <span class="badge text-bg-success">Berita</span>
                                    <p class="text-white mb-1 mt-2">
                                        <i
                                            class="ti ti-calendar me-2"></i>{{ \Carbon\Carbon::parse($berita->created_at)->format('d M Y') }}
                                    </p>
                                    <a href="{{ route('berita.show', $berita->slug) }}"
                                        class="text-decoration-none text-white card-title h5">
                                        {{ $berita->judul }}
                                    </a>
                                </div>
                                <div class="ratio ratio-16x9">
                                    <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}"
                                        class="card-img-bottom object-fit-cover" loading="lazy">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- faq --}}
    <section class="py-4" data-aos="fade-up">
        <div class="container">
            <div class="text-center">
                <span class="badge text-bg-primary rounded-1 py-2 px-3">FaQ</span>
                <h1>Pertanyaan yang Sering Diajukan (FAQ)</h1>
            </div>
            <div class="accordion mt-3" id="faqAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqHeading1">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faqCollapse1" aria-expanded="true" aria-controls="faqCollapse1">
                            <i class="ti ti-notes me-2 text-primary"></i>
                            Siapa saja yang bisa mendaftar sebagai alumni?
                        </button>
                    </h2>
                    <div id="faqCollapse1" class="accordion-collapse collapse show" aria-labelledby="faqHeading1"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Semua orang yang pernah menempuh pendidikan dan lulus dari SMAN 4 Tasikmalaya berhak
                            mendaftarkan diri sebagai alumni. Tidak terbatas pada tahun kelulusan tertentu, seluruh angkatan
                            dari awal berdirinya sekolah ini dapat bergabung untuk membangun jaringan alumni yang lebih luas
                            dan solid.
                        </div>
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqHeading2">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faqCollapse2" aria-expanded="false" aria-controls="faqCollapse2">
                            <i class="ti ti-edit-circle me-2 text-primary"></i>
                            Bagaimana cara mengisi atau memperbarui data alumni?
                        </button>
                    </h2>
                    <div id="faqCollapse2" class="accordion-collapse collapse" aria-labelledby="faqHeading2"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Kamu bisa mengisi atau memperbarui data dengan mengklik tombol <strong>Isi Data Alumni</strong>
                            yang tersedia di halaman utama. Setelah itu, isi formulir secara lengkap dengan informasi
                            terbaru tentang dirimu, seperti nama, tahun kelulusan, pekerjaan saat ini, dan kontak yang dapat
                            dihubungi. Jika kamu sudah pernah mendaftar tapi ingin mengubah data, cukup kirimkan pembaruan
                            melalui form yang sama.
                        </div>
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqHeading3">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faqCollapse3" aria-expanded="false" aria-controls="faqCollapse3">
                            <i class="ti ti-search me-2 text-primary"></i>
                            Bagaimana cara mencari data alumni tertentu?
                        </button>
                    </h2>
                    <div id="faqCollapse3" class="accordion-collapse collapse" aria-labelledby="faqHeading3"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Di halaman utama, tersedia kolom pencarian tempat kamu bisa mencari alumni berdasarkan
                            <strong>nama lengkap</strong>, <strong>nama panggilan</strong>, <strong>tahun
                                kelulusan</strong>, atau <strong>pekerjaan saat ini</strong>. Cukup ketik kata kunci dan
                            klik tombol "Cari Alumni". Sistem akan menampilkan hasil yang sesuai dengan kata kunci tersebut.
                        </div>
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqHeading4">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faqCollapse4" aria-expanded="false" aria-controls="faqCollapse4">
                            <i class="ti ti-shield-lock me-2 text-primary"></i>
                            Apakah data saya aman di website ini?
                        </button>
                    </h2>
                    <div id="faqCollapse4" class="accordion-collapse collapse" aria-labelledby="faqHeading4"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Ya, keamanan data kamu adalah prioritas kami. Data alumni disimpan dengan sistem yang aman dan
                            hanya digunakan untuk keperluan internal jaringan alumni. Kami tidak akan membagikan data
                            pribadi kepada pihak ketiga tanpa izin. Selain itu, form kami dilengkapi validasi dan
                            autentikasi agar tidak disalahgunakan.
                        </div>
                    </div>
                </div>

                <!-- FAQ 5 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqHeading5">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faqCollapse5" aria-expanded="false" aria-controls="faqCollapse5">
                            <i class="ti ti-mail-forward me-2 text-primary"></i>
                            Saya sudah mengisi data, tapi belum muncul. Apa yang harus saya lakukan?
                        </button>
                    </h2>
                    <div id="faqCollapse5" class="accordion-collapse collapse" aria-labelledby="faqHeading5"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Jika datamu belum tampil setelah mengisi form, kemungkinan sedang dalam proses verifikasi oleh
                            admin. Kami melakukan pengecekan manual untuk memastikan keaslian dan kelengkapan data. Silakan
                            tunggu 1–3 hari kerja. Jika setelah itu masih belum muncul, hubungi admin melalui kontak yang
                            tersedia untuk konfirmasi.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- call to action --}}
    <section class="py-4" data-aos="fade-in">
        <div class="container">
            <div class="bg-primary rounded p-5">
                <h1 class="fw-bold text-light">Ayo Bersama Majukan Alumni SMAN 4 Tasikmalaya!</h1>
                <p class="mb-3 text-white">Isi data alumni, dukung program melalui donasi, ikuti kabar terbaru dan agenda
                    kegiatan alumni.</p>
                <div class="d-flex flex-wrap gap-1">
                    <a href="/alumni/cek/form" class="btn btn-light text-primary rounded">Isi Data Alumni</a>
                    <a href="/campaign" class="btn btn-outline-light rounded">Berdonasi</a>
                    <a href="/berita" class="btn btn-outline-light rounded">Baca Berita</a>
                    <a href="/agenda" class="btn btn-outline-light rounded">Lihat Agenda</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        AOS.init();
    </script>
@endpush

@push('style')
    <link rel="stylesheet" href="{{ asset('web/css/custom.css') }}">
@endpush
