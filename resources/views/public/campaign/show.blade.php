@extends('layouts.web')
@section('title', $campaign->judul ?? '-')
@php
    $totalDonasiMasuk = $campaign->donasi->where('status', 'Verified')->sum('jumlah');
    $sisaDonasi = max($campaign->target_donasi - $totalDonasiMasuk, 0);
    $jumlahPendonatur = $campaign->donasi->where('status', 'Verified')->count();
    $jumlahDoa = $campaign->doa->whereNotNull('isi')->count();
    $persentase = $campaign->target_donasi > 0 ? round(($totalDonasiMasuk / $campaign->target_donasi) * 100) : 0;

    $warnaProgress = 'bg-danger';
    if ($persentase >= 75) {
        $warnaProgress = 'bg-success';
    } elseif ($persentase >= 50) {
        $warnaProgress = 'bg-warning';
    }
@endphp
@section('content')
    @include('partials.navbar')
    <section class="py-3 py-md-4">
        <div class="container">
            <h1 class="fw-semibold">{{ $campaign->judul }}</h1>
            <div class="row row-cols-1 row-cols-md-2 mt-3">
                <div class="col-md-8 col">
                    @if ($campaign->gambar)
                        <div class="ratio ratio-16x9">
                            <img src="{{ asset('storage/' . $campaign->gambar) }}" class="img-fluid rounded object-fit-cover"
                                alt="Gambar Campaign">
                        </div>
                    @endif
                    <p class="card-title mb-1 mt-3">
                        Donasi tersedia:
                    </p>
                    <h2 class="text-danger fw-semibold">
                        Rp{{ number_format($sisaDonasi, 0, ',', '.') }}
                    </h2>

                    <a class="text-decoration-none" data-bs-toggle="collapse" href="#detailDonasi{{ $campaign->id }}"
                        role="button" aria-expanded="false" aria-controls="detailDonasi{{ $campaign->id }}">
                        Lihat rincian <i class="ti ti-arrow-down ms-3"></i>
                    </a>

                    <div class="collapse mt-2" id="detailDonasi{{ $campaign->id }}">
                        <p class="mb-2"> <span
                                class="h3 fw-semibold">Rp{{ number_format($totalDonasiMasuk, 0, ',', '.') }}</span> dari
                            target:
                            Rp{{ number_format($campaign->target_donasi, 0, ',', '.') }} ({{ $persentase }}%)
                        </p>
                        <div class="progress mb-2" role="progressbar" aria-valuenow="{{ $persentase }}" aria-valuemin="0"
                            aria-valuemax="100" style="height: 6px">
                            <div class="progress-bar {{ $warnaProgress }}" style="width: {{ $persentase }}%"></div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <p class="mb-0">
                                <i class="ti ti-heart text-primary"></i> {{ $jumlahPendonatur }} Donasi
                            </p>
                            <p class="mb-0">{{ $persentase }}% dari target</p>
                        </div>
                    </div>

                    <div class="py-3">{!! $campaign->deskripsi !!}</div>

                    <hr>
                    <div class="collapse show" id="collapseDonasi">
                        <div class="mt-3">
                            <a href="{{ auth()->check()
                                ? route('campaign.form', $campaign->id)
                                : route('login', ['redirect_to' => route('campaign.form', $campaign->id)]) }}"
                                class="btn text-primary bg-primary-subtle rounded">
                                Kirim Donasi <span class="badge text-bg-primary ms-2 px-3">{{ $jumlahPendonatur }}</span>
                            </a>
                        </div>
                    </div>
                    <hr>
                    <h5 class="mb-0" style="cursor: pointer;" data-bs-toggle="collapse" data-bs-target="#collapseDoa">
                        Doa<span class="badge text-bg-dark ms-3">{{ $jumlahDoa }}</span>
                    </h5>
                    <hr>
                    <div class="collapse" id="collapseDoa">
                        <div class="mt-3">
                            <h5 class="mt-2">Kirim Do'a untuk Campaign Ini</h5>
                            <form action="{{ route('campaign.doa.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="campaign_id" value="{{ $campaign->id }}">

                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Anda</label>
                                    <input type="text" name="nama" id="nama" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="isi_doa" class="form-label">Isi Doa</label>
                                    <textarea name="isi_doa" id="isi_doa" rows="2" class="form-control" required></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">Kirim Doa</button>
                            </form>

                            <h5 class="mt-4">Doa dari Donatur</h5>
                            @foreach ($campaign->doa->sortByDesc('created_at')->take(5) as $doa)
                                <div class="border rounded p-3 d-flex align-items-start mb-2">
                                    <div class="avatar rounded-circle d-flex align-items-center justify-content-center me-3"
                                        style="width: 43px; height: 43px; background-color: #6c757d; color: white; font-weight: bold;">
                                        {{ strtoupper(substr($doa->nama, 0, 1)) }}
                                    </div>
                                    <div>
                                        <strong>{{ $doa->nama }}</strong>
                                        <p class="mb-0">{{ $doa->isi }}</p>
                                        <div class="text-muted small mt-1 mb-0">
                                            {{ $doa->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <a href="{{ route('campaign.doa.riwayat', $campaign->id) }}" class="btn btn-outline-success">
                                Riwayat
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col mt-3 mt-md-0">
                    <h3>Lainnya</h3>
                    <div class="row row-cols-2 row-cols-md-1 g-3">
                        @foreach ($campaignLainnya->take(5) as $lainnya)
                            <div class="col">
                                <div class="card border">
                                    <div class="row g-0 h-100">
                                        <div class="col-md-4">
                                            <img src="{{ asset('storage/' . $lainnya->gambar) }}"
                                                class="img-fluid h-100 w-100 object-fit-cover rounded"
                                                alt="{{ $lainnya->judul }}">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body h-100">
                                                <a href="{{ route('campaign.show', $lainnya->slug) }}"
                                                    class="text-decoration-none text-dark">
                                                    {{ $lainnya->judul }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script src="{{ asset('assets/js/custom.js') }}"></script>
@endpush

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
@endpush
