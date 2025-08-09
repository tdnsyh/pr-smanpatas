@extends('layouts.web')
@section('title', $title ?? '-')
@php
    $start = \Carbon\Carbon::parse($agenda->tanggal)->format('Ymd');
    $end = \Carbon\Carbon::parse($agenda->tanggal)->addDay()->format('Ymd');
    $url =
        'https://www.google.com/calendar/render?action=TEMPLATE' .
        '&text=' .
        urlencode($agenda->judul) .
        '&dates=' .
        $start .
        '/' .
        $end .
        '&details=' .
        urlencode($agenda->deskripsi_pendek) .
        '&location=' .
        urlencode($agenda->lokasi);
@endphp

@section('content')
    @include('partials.navbar')
    <section class="py-3 py-md-4">
        <div class="container">
            <h1>{{ $agenda->judul }}</h1>
            <div class="row row-cols-1 row-cols-md-2">
                <div class="col-md-8 col">

                    @if ($agenda->gambar)
                        <img src="{{ asset('storage/' . $agenda->gambar) }}" class="img-fluid rounded w-100"
                            alt="{{ $agenda->judul }}">
                    @endif

                    <h3 class="mt-3">Informasi agenda</h3>
                    <div class="card bg-secondary-subtle">
                        <div class="card-body">
                            <div class="row row-cols-1 row-cols-md-2">
                                <div class="col">
                                    <div class="d-flex align-items-center">
                                        <div class="me-2">
                                            <h1><i class="ti ti-calendar-event"></i></h1>
                                        </div>
                                        <div>
                                            <p class="card-title fw-semibold mb-0">Tanggal</p>
                                            <p class="text-muted mb-0">
                                                {{ \Carbon\Carbon::parse($agenda->tanggal)->translatedFormat('d F Y') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="d-flex align-items-center">
                                        <div class="me-2">
                                            <h1><i class="ti ti-map-pin"></i></h1>
                                        </div>
                                        <div>
                                            <p class="card-title fw-semibold mb-0">Lokasi</p>
                                            @if ($agenda->lokasi)
                                                <p class="text-muted mb-0">{{ $agenda->lokasi }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">{!! $agenda->deskripsi !!}</div>
                    <div class="mt-4">
                        <a href="{{ $url }}" class="btn btn-success" target="_blank">
                            <i class="ti ti-calendar-plus"></i> Tambahkan ke Google Calendar
                        </a>
                        <a href="{{ route('agenda.index') }}" class="btn btn-outline-secondary">
                            Kembali
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col mt-3 mt-md-0">
                    <h3>Lainnya</h3>
                    @foreach ($agendaLainnya->take(5) as $lainnya)
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
