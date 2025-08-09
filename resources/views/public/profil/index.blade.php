@extends('layouts.web')
@section('title', 'Tentang Organisasi')

@section('content')
    @include('partials.navbar')
    {{-- profil --}}
    <section class="py-5">
        <div class="container">
            <img src="{{ asset('assets/images/logos/logo1.png') }}" alt="" class="img-fluid">
            <div class="row row-cols-1 row-cols-md-2 align-items-center mt-5">
                <div class="col" data-aos="fade-right">
                </div>
                <div class="col" data-aos="fade-left" data-aos-delay="100">
                    <span class="badge text-bg-light rounded-1 py-2 px-3">PROFIL</span>
                    <h1 class="fw-semibold mt-2">Tentang Organisasi</h1>
                    <p>
                        Ikatan Alumni SMAN 4 Tasikamalaya adalah sebuah perkumpulan yang berkedudukan di
                        <strong>Jl. Letkol RE. Djaelani, Kel. Cilembang, Kec. Cihideung, Kota Tasikmalaya 46123</strong>.
                        Dapat membentuk cabang di wilayah lain sesuai kebutuhan.
                    </p>
                    <p>
                        Didirikan pada <strong>25 Januari 2025</strong> dan berlangsung tanpa batas waktu. Berazaskan
                        <strong>Pancasila</strong> dan <strong>Undang-Undang Dasar 1945</strong>. Mengedepankan nilai-nilai
                        kekeluargaan, persatuan, musyawarah, sportifitas, tolong-menolong, dan independensi.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- visi misi organisasi --}}
    <section class="py-4 text-bg-primary" data-aos="fade-in">
        <div class="container text-center py-4">
            <span class="badge text-bg-light rounded-1 py-2 px-3">VISION AND MISSION</span>
            <h1 class="fw-semibold mt-2 text-white">Visi Misi dan Tujuan</h1>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 mt-3">
                <div class="col" data-aos="zoom-in" data-aos-duration="1000">
                    <div class="d-flex flex-column align-items-center text-center">
                        <div class="bg-white text-primary rounded-circle d-flex justify-content-center align-items-center mb-2"
                            style="width: 56px; height: 56px;">
                            <i class="ti ti-users fs-4"></i>
                        </div>
                        <p class="mb-0">Menjalin dan mempererat hubungan kekeluargaan antar alumni.</p>
                    </div>
                </div>
                <div class="col" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="200">
                    <div class="d-flex flex-column align-items-center text-center">
                        <div class="bg-secondary text-white rounded-circle d-flex justify-content-center align-items-center mb-2"
                            style="width: 56px; height: 56px;">
                            <i class="ti ti-heart fs-4"></i>
                        </div>
                        <p class="mb-0">Memberikan kontribusi positif bagi almamater dan masyarakat.</p>
                    </div>
                </div>

                <div class="col" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="400">
                    <div class="d-flex flex-column align-items-center text-center">
                        <div class="bg-success text-white rounded-circle d-flex justify-content-center align-items-center mb-2"
                            style="width: 56px; height: 56px;">
                            <i class="ti ti-award fs-4"></i>
                        </div>
                        <p class="mb-0">Meningkatkan profesionalisme dan kompetensi alumni.</p>
                    </div>
                </div>

                <div class="col" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="600">
                    <div class="d-flex flex-column align-items-center text-center">
                        <div class="bg-warning text-white rounded-circle d-flex justify-content-center align-items-center mb-2"
                            style="width: 56px; height: 56px;">
                            <i class="ti ti-message fs-4"></i>
                        </div>
                        <p class="mb-0">Menjadi wadah komunikasi, informasi, dan kolaborasi antar alumni.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- pengurus organisasi --}}
    <section class="py-4" data-aos="fade-up" data-aos-duration="1000">
        <div class="container text-center">
            <span class="badge text-bg-light rounded-1 py-2 px-3">PENGURUS</span>
            <h1 class="fw-semibold mt-2">Struktur Organisasi</h1>
            <div class="row row-cols-1 row-cols-md-5 g-3">
                <div class="col">
                    <div class="card border shadow-none">
                        <div class="card-body">
                            <p class="card-title">Lorem, ipsum dolor.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border shadow-none">
                        <div class="card-body">
                            <p class="card-title">Lorem, ipsum dolor.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border shadow-none">
                        <div class="card-body">
                            <p class="card-title">Lorem, ipsum dolor.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border shadow-none">
                        <div class="card-body">
                            <p class="card-title">Lorem, ipsum dolor.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border shadow-none">
                        <div class="card-body">
                            <p class="card-title">Lorem, ipsum dolor.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- logo dan makna --}}
    <section class="py-4" data-aos="zoom-in" data-aos-duration="1000">
        <div class="container">
            <div class="rounded border p-5">
                <div class="text-center">
                    <span class="badge text-bg-light rounded-1 py-2 px-3">LOGO</span>
                    <h1 class="fw-semibold mt-2">Logo dan Makna</h1>
                </div>
                <div class="row row-cols-1 row-cols-md-2">
                    <div class="col">
                        <img src="{{ asset('assets/images/logos/logo1.png') }}" alt="" class="img-fluid">
                    </div>
                    <div class="col">
                        <p>Lambang Ikatan Alumni SMAN 4 Tasikmalaya terdiri dari dua siluet manusia yang bersambung serta
                            centang berwarna biru dan oranye. Makna simbol tersebut:</p>
                        <ul>
                            <li><strong>Dua siluet manusia:</strong> Melambangkan hubungan erat antar alumni dan kolaborasi.
                            </li>
                            <li><strong>Centang:</strong> Menunjukkan persetujuan dan komitmen terhadap nilai-nilai
                                almamater.</li>
                            <li><strong>Warna biru:</strong> Melambangkan keyakinan, keteguhan, dan kebijaksanaan.</li>
                            <li><strong>Warna oranye:</strong> Melambangkan kegembiraan, kreativitas, dan optimisme.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- kontak --}}
    <section class="py-5 bg-warning">
        <div class="container">
            <div class="text-center mb-4" data-aos="fade-up">
                <span class="badge text-bg-secondary rounded-1 py-2 px-3">KONTAK</span>
                <h1 class="fw-semibold mt-3">Kontak & Media Sosial</h1>
            </div>

            <div class="row row-cols-2 row-cols-md-4 g-3 justify-content-center">
                <div class="col" data-aos="fade-up" data-aos-delay="0">
                    <div class="card h-100 text-center border">
                        <div class="card-body">
                            <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center mx-auto mb-3"
                                style="width: 64px; height: 64px;">
                                <i class="ti ti-mail fs-3"></i>
                            </div>
                            <h6 class="fw-bold">Email</h6>
                            <p class="mb-0">alumnisman4tsm@gmail.com</p>
                        </div>
                    </div>
                </div>

                <div class="col" data-aos="fade-up" data-aos-delay="100">
                    <div class="card h-100 text-center border">
                        <div class="card-body">
                            <div class="bg-danger text-white rounded-circle d-flex justify-content-center align-items-center mx-auto mb-3"
                                style="width: 64px; height: 64px;">
                                <i class="ti ti-brand-instagram fs-3"></i>
                            </div>
                            <h6 class="fw-bold">Instagram</h6>
                            <p class="mb-0">
                                <a href="https://www.instagram.com/alumnisman4tsm" class="text-decoration-none"
                                    target="_blank">@alumnisman4tsm</a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col" data-aos="fade-up" data-aos-delay="200">
                    <div class="card h-100 text-center border">
                        <div class="card-body">
                            <div class="bg-dark text-white rounded-circle d-flex justify-content-center align-items-center mx-auto mb-3"
                                style="width: 64px; height: 64px;">
                                <i class="ti ti-brand-tiktok fs-3"></i>
                            </div>
                            <h6 class="fw-bold">TikTok</h6>
                            <p class="mb-0">
                                <a href="https://www.tiktok.com/@alumnisman4tsm" class="text-decoration-none"
                                    target="_blank">@alumnisman4tsm</a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col" data-aos="fade-up" data-aos-delay="300">
                    <div class="card h-100 text-center border">
                        <div class="card-body">
                            <div class="bg-danger text-white rounded-circle d-flex justify-content-center align-items-center mx-auto mb-3"
                                style="width: 64px; height: 64px;">
                                <i class="ti ti-brand-youtube fs-3"></i>
                            </div>
                            <h6 class="fw-bold">YouTube</h6>
                            <p class="mb-0">
                                <a href="https://www.youtube.com/@AlumniSman4tsm" class="text-decoration-none"
                                    target="_blank">@AlumniSman4tsm</a>
                            </p>
                        </div>
                    </div>
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
