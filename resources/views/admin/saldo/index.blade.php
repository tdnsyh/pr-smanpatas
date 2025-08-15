@extends('layouts.admin')
@section('title', 'Saldo')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="fw-semibold mb-3">@yield('title')</h2>
            <div class="card border shadow-none">
                <div class="card-body">
                    <div class="card-title">Total Saldo</div>
                    <h5 class="h3 fw-semibold mb-0">Rp {{ number_format($totalSaldo, 2, ',', '.') }}</h5>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-md-3">
                <div class="col">
                    <div class="card border shadow-none">
                        <div class="card-body">
                            <div class="card-title">Total Pemasukan</div>
                            <h5 class="h3 fw-semibold mb-0">Rp {{ number_format($totalPemasukan, 2, ',', '.') }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border shadow-none">
                        <div class="card-body">
                            <div class="card-title">Total Donasi (Verified)</div>
                            <h5 class="h3 fw-semibold mb-0">Rp {{ number_format($totalDonasi, 2, ',', '.') }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border shadow-none">
                        <div class="card-body">
                            <div class="card-title">Total Pengeluaran</div>
                            <h5 class="h3 fw-semibold mb-0">Rp {{ number_format($totalPengeluaran, 2, ',', '.') }}</h5>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ringkasan --}}
            <h5 class="mt-3">Rincian Pemasukan</h5>
            @if ($pemasukan->isEmpty())
                <div class="alert alert-warning" role="alert">
                    Belum ada data pemasukan.
                    <a href="/operator/pemasukan/tambah" class="text-decoration-none">Input pemasukan</a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead class="table-dark border-0">
                            <tr>
                                <th class="rounded-start">Tanggal</th>
                                <th>Kategori</th>
                                <th>Sumber</th>
                                <th>Keterangan</th>
                                <th class="rounded-end">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pemasukan as $item)
                                <tr>
                                    <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                    <td>{{ $item->kategori }}</td>
                                    <td>{{ $item->sumber }}</td>
                                    <td>{{ $item->keterangan ?? '-' }}</td>
                                    <td>Rp {{ number_format($item->jumlah, 2, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <h5 class="mt-3">Rincian Donasi (Verified)</h5>
            @if ($donasi->isEmpty())
                <div class="alert alert-warning" role="alert">
                    Belum ada campaign atau donasi masuk.
                    <a href="/operator/donasi/tambah" class="text-decoration-none">Buat campaign</a> atau
                    <a href="/operator/donasi" class="text-decoration-none">Lihat campaign</a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead class="table-dark border-0">
                            <tr>
                                <th class="rounded-start">Tanggal</th>
                                <th>Nama Donatur</th>
                                <th>Jumlah</th>
                                <th class="rounded-end">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($donasi as $item)
                                <tr>
                                    <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                    <td>{{ $item->nama_donatur }}</td>
                                    <td>Rp {{ number_format($item->jumlah, 2, ',', '.') }}</td>
                                    <td>{{ $item->keterangan ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <h5 class="mt-3">Rincian Pengeluaran</h5>
            @if ($pengeluaran->isEmpty())
                <div class="alert alert-warning" role="alert">
                    Belum ada data pengeluaran.
                    <a href="/operator/pengeluaran/tambah" class="text-decoration-none">Input pengeluaran</a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead class="table-dark border-0">
                            <tr>
                                <th class="rounded-start">Tanggal</th>
                                <th>Kategori</th>
                                <th>Sumber</th>
                                <th>Keterangan</th>
                                <th class="rounded-end">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengeluaran as $item)
                                <tr>
                                    <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                    <td>{{ $item->kategori }}</td>
                                    <td>{{ $item->sumber }}</td>
                                    <td>{{ $item->keterangan ?? '-' }}</td>
                                    <td>Rp {{ number_format($item->jumlah, 2, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
