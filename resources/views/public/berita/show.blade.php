@extends('layouts.web')
@section('title', $berita->judul ?? 'Campaign')
@section('content')
    @include('partials.navbar')
    <section class="py-5">
        <div class="container">
            <div class="row row-cols-1 row-cols-md-2">
                <div class="col-md-8">
                    @if ($berita->gambar)
                        <img src="{{ asset('storage/' . $berita->gambar) }}" class="rounded img-fluid w-100"
                            alt="{{ $berita->judul }}">
                    @endif
                    <h1 class="mt-3">{{ $berita->judul }}</h1>
                    <div class="card bg-secondary-subtle border-0 mb-3">
                        <div class="card-body">
                            <div class="row row-cols-1 row-cols-md-2">
                                <div class="col d-flex align-items-center mb-2 mb-md-0">
                                    <div class="avatar rounded-circle d-flex align-items-center justify-content-center me-3"
                                        style="width: 40px; height: 40px; background-color: #6c757d; color: white; font-weight: bold; font-size: 1.25rem;">
                                        {{ strtoupper(substr($berita->penulis, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="mb-0">
                                            Oleh <span class="text-danger fw-semibold">{{ $berita->penulis }}</span>
                                        </p>
                                        <p class="text-muted small mb-0">
                                            Terakhir diperbarui
                                            {{ \Carbon\Carbon::parse($berita->updated_at)->translatedFormat('d F Y') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div>{!! $berita->isi !!}</div>
                    </div>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3 rounded">Kembali</a>
                </div>
                <div class="col-md-4 col mt-3 mt-md-0">
                    <h3>Lainnya</h3>
                    @foreach ($beritaLainnya->take(5) as $lainnya)
                        <div class="card shadow-sm border mb-3">
                            <div class="row g-0 h-100">
                                <div class="col-md-5">
                                    <div class="ratio ratio-16x9">
                                        <img src="{{ $lainnya->gambar ? asset('storage/' . $lainnya->gambar) : asset('images/default.jpg') }}"
                                            class="img-fluid w-100 h-100 object-fit-cover rounded"
                                            alt="{{ $lainnya->judul }}">
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="card-body h-100">
                                        <a href="{{ route('agenda.show', $lainnya->slug) }}"
                                            class="text-decoration-none text-dark">
                                            {{ Str::limit(strip_tags($lainnya->judul), 30) }}
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
@endsection
