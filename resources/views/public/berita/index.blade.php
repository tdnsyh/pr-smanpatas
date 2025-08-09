@extends('layouts.web')
@section('title', 'Berita')

@section('content')
    @include('partials.navbar')
    <section class="py-5">
        <div class="container">
            <span class="badge text-bg-light rounded-1 py-2 px-3">BERITA</span>
            <h1 class="fw-semibold mt-2">Berita Terbaru</h1>
            <div class="row row-cols-2 row-cols-md-4 g-3">
                @foreach ($highlighted as $berita)
                    <div class="col">
                        <div class="card border h-100 shadow-none bg-glass">
                            <div class="ratio ratio-16x9">
                                <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}"
                                    class="img-fluid rounded object-fit-cover">
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h4 class="mb-2">{{ $berita->judul }}</h4>
                                <div class="mt-auto">
                                    <a href="{{ route('berita.show', $berita->slug) }}"
                                        class="d-inline-flex align-items-center gap-2 text-decoration-none text-primary">
                                        <span>Selengkapnya</span>
                                        <span
                                            class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary text-white"
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
    </section>

    <section class="py-5">
        <div class="container">
            <span class="badge text-bg-light rounded-1 py-2 px-3">BERITA</span>
            <h1 class="fw-semibold mt-2">Berita Lainnya</h1>
            <div class="row row-cols-2 row-cols-md-4 g-3">
                @foreach ($beritas as $berita)
                    <div class="col">
                        <div class="card shadow-none border bg-glass">
                            <div class="card-body d-flex flex-column">
                                <div class="ratio ratio-16x9">
                                    <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}"
                                        class="img-fluid rounded object-fit-cover">
                                </div>
                                <h4 class="mt-3 mb-2">{{ $berita->judul }}</h4>
                                <div class="mt-auto">
                                    <a href="{{ route('berita.show', $berita->slug) }}"
                                        class="d-inline-flex align-items-center gap-2 text-decoration-none text-primary">
                                        <span>Selengkapnya</span>
                                        <span
                                            class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary text-white"
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
    </section>
@endsection
