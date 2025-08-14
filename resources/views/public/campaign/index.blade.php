@extends('layouts.web')
@section('title', 'Campaign')
@section('content')
    @include('partials.navbar')
    <section class="py-4">
        <div class="container">
            <span class="badge text-bg-light rounded-1 py-2 px-3">ALUMNI</span>
            <h1 class="fw-semibold mt-2">Campaign Prioritas</h1>
            <div class="row row-cols-2 row-cols-md-4 g-3">
                @foreach ($highlighted as $item)
                    @php
                        $terkumpul = $item->donasi()->where('status', 'Verified')->sum('jumlah');
                        $persen = $item->target_donasi > 0 ? round(($terkumpul / $item->target_donasi) * 100) : 0;
                    @endphp
                    <div class="col">
                        <div class="card shadow-none border">
                            <div class="ratio ratio-16x9">
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}"
                                    class="img-fluid rounded object-fit-cover">
                            </div>
                            <div class="card-body">
                                <a href="{{ route('campaign.show', $item->slug) }}" class="text-decoration-none text-dark">
                                    <h5 class="fw-bold mb-0 card-title">
                                        {{ \Illuminate\Support\Str::limit($item->judul, 60) }}
                                    </h5>
                                </a>
                                <p class="mb-1 mt-3">
                                    Rp. {{ number_format($item->target_donasi, 0, ',', '.') }}
                                </p>
                                <div class="progress mb-3" role="progressbar" aria-label="Progress" style="height: 3px">
                                    <div class="progress-bar" style="width: {{ $persen }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="py-4">
        <div class="container">
            <span class="badge text-bg-light rounded-1 py-2 px-3">ALUMNI</span>
            <h1 class="fw-semibold mt-2">Campaign Lainnya</h1>
            <div class="row row-cols-2 row-cols-md-4 g-3">
                @foreach ($all as $item)
                    <div class="col">
                        <div class="card h-100 border-0 shadow-none">
                            <div class="card-body p-0 d-flex flex-column">
                                <div class="ratio ratio-16x9">
                                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}"
                                        class="img-fluid rounded object-fit-cover">
                                </div>
                                <h4 class="mt-3 mb-2">
                                    {{ \Illuminate\Support\Str::limit($item->judul, 60) }}
                                </h4>

                                @php
                                    $terkumpul = $item->donasi()->where('status', 'Verified')->sum('jumlah');
                                    $persen =
                                        $item->target_donasi > 0 ? round(($terkumpul / $item->target_donasi) * 100) : 0;
                                @endphp

                                <p class="mb-1 mt-3">
                                    Rp. {{ number_format($terkumpul, 0, ',', '.') }}
                                    <small>
                                        Dari Rp. {{ number_format($item->target_donasi, 0, ',', '.') }}
                                        ({{ $persen }}%)
                                    </small>
                                </p>
                                <div class="progress mb-3" style="height: 3px">
                                    <div class="progress-bar" style="width: {{ $persen }}%"></div>
                                </div>
                                <div class="mt-auto">
                                    <a href="{{ route('campaign.show', $item->slug) }}"
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
