@extends('layouts.admin')
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
    <div class="card">
        <div class="card-body">
            <h2 class="fw-semibold mb-3">{{ $campaign->judul ?? '-' }}</h2>
            <div class="row row-cols-1 row-cols-md-2">
                <div class="col">
                    @if (isset($campaign) && $campaign->gambar)
                        <div class="mb-3">
                            <div class="ratio ratio-16x9">
                                <img src="{{ asset('storage/' . $campaign->gambar) }}" alt="Gambar Campaign"
                                    class="img-fluid rounded object-fit-cover">
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col">
                    <h3 class="card-title">Tersisa:</h3>
                    <h3 class="text-danger fw-semibold">
                        Rp{{ number_format($sisaDonasi, 0, ',', '.') }}
                    </h3>
                    <hr>
                    <h3 class="card-title">Donasi masuk:</h3>
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
                    <h3 class="card-title mt-3">Deskripsi:</h3>
                    <div id="deskripsiSingkat" style="overflow: hidden; max-height: 120px;">
                        <div>{!! $campaign->deskripsi !!}</div>
                    </div>
                    <button class="btn btn-link p-0 text-decoration-none" id="btnSelengkapnya"
                        onclick="toggleDeskripsi()">Selengkapnya</button>
                </div>
            </div>

            {{-- riwayat donasi --}}
            <h5 class="mt-3">Riwayat Donasi</h5>
            @if ($campaign->donasi->count() > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead class="table-dark border-0">
                            <tr>
                                <th class="rounded-start">Tanggal</th>
                                <th>Nama Donatur</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th class="rounded-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($campaign->donasi as $donasi)
                                <tr>
                                    <td>{{ $donasi->created_at->format('d-m-Y') }}</td>
                                    <td>{{ $donasi->nama_donatur }}</td>
                                    <td>Rp {{ number_format($donasi->jumlah, 0, ',', '.') }}</td>
                                    <td>
                                        <span
                                            class="badge rounded-pill
                                                    @if ($donasi->status == 'Verified') text-bg-success
                                                    @elseif($donasi->status == 'Blocked') text-bg-danger
                                                    @else text-bg-warning @endif">
                                            {{ $donasi->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal"
                                            data-bs-target="#modalDonasi{{ $donasi->id }}">
                                            Detail
                                        </button>
                                    </td>
                                </tr>

                                {{-- modal detail dan konfirmasi donasi --}}
                                <div class="modal fade" id="modalDonasi{{ $donasi->id }}" tabindex="-1"
                                    aria-labelledby="modalDonasiLabel{{ $donasi->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalDonasiLabel{{ $donasi->id }}">Detail
                                                    Donasi</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Tutup"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="mb-0"><strong>Nama Donatur:</strong>
                                                    {{ $donasi->nama_donatur }}</p>
                                                <p class="mb-0"><strong>Jumlah Donasi:</strong> Rp
                                                    {{ number_format($donasi->jumlah, 0, ',', '.') }}</p>
                                                <p class="mb-0"><strong>Tanggal:</strong>
                                                    {{ $donasi->created_at->format('d-m-Y H:i') }}
                                                </p>
                                                <p class="mb-0"><strong>Status:</strong> {{ $donasi->status }}</p>
                                                <p class="mb-0"><strong>Keterangan:</strong>
                                                    {{ $donasi->keterangan ?? '-' }}</p>
                                                @if ($donasi->bukti_transfer)
                                                    <p><strong>Bukti Transfer:</strong></p>
                                                    <img src="{{ asset('storage/' . $donasi->bukti_transfer) }}"
                                                        alt="Bukti Transfer" class="img-fluid rounded">
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                @if ($donasi->status !== 'Verified' && $donasi->status !== 'Blocked')
                                                    <form action="{{ route('admin.campaign.verifikasi', $donasi->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-success">Verified</button>
                                                    </form>

                                                    <form action="{{ route('admin.campaign.tolak', $donasi->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-danger">Blocked</button>
                                                    </form>
                                                @endif
                                                <button type="button" class="btn btn-outline-secondary"
                                                    data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info">Belum ada donasi untuk campaign ini.</div>
            @endif

            {{-- doa dari orang baik --}}
            <h5>Do'a dari orang baik</h5>
            @if ($doas->count())
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="table-dark border-0">
                            <tr>
                                <th class="rounded-start">Nama</th>
                                <th>Isi Doa</th>
                                <th class="rounded-end">Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($doas as $item)
                                <tr>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->isi }}</td>
                                    <td class="text-muted small">{{ $item->created_at->diffForHumans() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info">Belum ada doa untuk campaign ini.</div>
            @endif

            <a href="{{ route('admin.campaign.index') }}" class="btn btn-secondary mt-3">Kembali</a>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/js/custom.js') }}"></script>
@endpush

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
@endpush
